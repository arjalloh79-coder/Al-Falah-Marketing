<?php

namespace App\Support;

/**
 * Tiny JSON-file backed store for editable site content.
 *
 * Used instead of database tables so content can be managed without running
 * migrations on the server. Files live in storage/app/content/ and are never
 * web-accessible.
 */
class ContentStore
{
    protected string $path;

    public function __construct(protected string $name)
    {
        $dir = storage_path('app/content');

        if (! is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }

        $this->path = $dir . '/' . $name . '.json';
    }

    public static function for(string $name): self
    {
        return new self($name);
    }

    /** Every item, in stored order. */
    public function all(): array
    {
        if (! is_file($this->path)) {
            return [];
        }

        $raw = @file_get_contents($this->path);

        if ($raw === false || trim($raw) === '') {
            return [];
        }

        $data = json_decode($raw, true);

        return is_array($data) ? $data : [];
    }

    /** Every item, ordered by sort_order then id. */
    public function sorted(): array
    {
        $items = $this->all();

        usort($items, function ($a, $b) {
            return [$a['sort_order'] ?? 0, $a['id'] ?? 0]
               <=> [$b['sort_order'] ?? 0, $b['id'] ?? 0];
        });

        return $items;
    }

    /** Active items only, sorted — what the public site should show. */
    public function active(): array
    {
        return array_values(array_filter($this->sorted(), function ($item) {
            return ! empty($item['is_active']);
        }));
    }

    /** Items grouped by their category, preserving sort order. */
    public function grouped(): array
    {
        $groups = [];

        foreach ($this->sorted() as $item) {
            $groups[$item['category'] ?? 'Autres'][] = $item;
        }

        return $groups;
    }

    public function find(int $id): ?array
    {
        foreach ($this->all() as $item) {
            if ((int) ($item['id'] ?? 0) === $id) {
                return $item;
            }
        }

        return null;
    }

    /**
     * Create or update one item. Returns the saved item (with its id).
     */
    public function save(array $item): array
    {
        $items = $this->all();
        $now = now()->toIso8601String();
        $id = (int) ($item['id'] ?? 0);

        if ($id > 0) {
            $found = false;

            foreach ($items as $i => $existing) {
                if ((int) ($existing['id'] ?? 0) === $id) {
                    $item = array_merge($existing, $item);
                    $item['updated_at'] = $now;
                    $items[$i] = $item;
                    $found = true;
                    break;
                }
            }

            if (! $found) {
                $item['created_at'] = $now;
                $item['updated_at'] = $now;
                $items[] = $item;
            }
        } else {
            $item['id'] = $this->nextId($items);
            $item['created_at'] = $now;
            $item['updated_at'] = $now;
            $items[] = $item;
        }

        $this->write($items);

        return $item;
    }

    public function delete(int $id): bool
    {
        $items = $this->all();

        $remaining = array_values(array_filter($items, function ($item) use ($id) {
            return (int) ($item['id'] ?? 0) !== $id;
        }));

        if (count($remaining) === count($items)) {
            return false;
        }

        $this->write($remaining);

        return true;
    }

    /** Flip is_active on one item. Returns the new state, or null if not found. */
    public function toggle(int $id): ?bool
    {
        $item = $this->find($id);

        if ($item === null) {
            return null;
        }

        $state = empty($item['is_active']);

        $this->save(['id' => $id, 'is_active' => $state]);

        return $state;
    }

    public function count(): int
    {
        return count($this->all());
    }

    protected function nextId(array $items): int
    {
        $max = 0;

        foreach ($items as $item) {
            $max = max($max, (int) ($item['id'] ?? 0));
        }

        return $max + 1;
    }

    /**
     * Write via a temp file + rename so a failed write can never leave a
     * half-written (and therefore unreadable) content file behind.
     */
    protected function write(array $items): void
    {
        $json = json_encode(
            array_values($items),
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        );

        $tmp = $this->path . '.tmp';

        if (@file_put_contents($tmp, $json . "\n", LOCK_EX) === false) {
            throw new \RuntimeException("Impossible d'écrire le fichier de contenu : {$this->path}");
        }

        if (! @rename($tmp, $this->path)) {
            @unlink($tmp);
            throw new \RuntimeException("Impossible de finaliser l'écriture : {$this->path}");
        }
    }
}
