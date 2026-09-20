<?php

namespace App\Console\Commands;

use App\Models\ContentPiece;
use App\Services\AI\ContentGenerator;
use Illuminate\Console\Command;
use Throwable;

class GenerateContent extends Command
{
    protected $signature = 'content:generate {--type=} {--topic=}';

    protected $description = 'Generate one draft content piece via AI and save it to the review queue.';

    public function handle(ContentGenerator $generator): int
    {
        $type = $this->option('type');

        if (! $type) {
            $type = $this->choice('Content type', array_keys(config('content_prompts.types')));
        }

        try {
            $result = $generator->generate($type, $this->option('topic'));
        } catch (Throwable $e) {
            $this->error($e->getMessage());

            return self::FAILURE;
        }

        $piece = ContentPiece::create($result);

        $this->info("Created draft #{$piece->id} ({$piece->type}, topic: {$piece->topic}).");

        return self::SUCCESS;
    }
}
