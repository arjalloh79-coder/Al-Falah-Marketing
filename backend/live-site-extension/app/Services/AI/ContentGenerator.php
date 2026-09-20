<?php

namespace App\Services\AI;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class ContentGenerator
{
    /**
     * Generate one piece of content and return its parsed fields, ready to
     * be saved onto a ContentPiece. Throws on any failure (missing API
     * key, HTTP error, or a response that isn't the JSON we asked for) --
     * callers decide how to surface that (CLI output, admin flash message).
     */
    public function generate(string $type, ?string $topic = null): array
    {
        $types = config('content_prompts.types');

        if (! isset($types[$type])) {
            throw new RuntimeException("Unknown content type \"{$type}\". Known types: " . implode(', ', array_keys($types)));
        }

        $topic ??= config('content_prompts.topics')[array_rand(config('content_prompts.topics'))];

        $apiKey = config('services.openai.api_key');

        if (blank($apiKey)) {
            throw new RuntimeException('OPENAI_API_KEY is not set -- add it to .env before generating content.');
        }

        $definition = $types[$type];
        $userPrompt = str_replace('{topic}', $topic, $definition['user']);

        $response = Http::withToken($apiKey)
            ->timeout(60)
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => config('services.openai.model', 'gpt-4o-mini'),
                'response_format' => ['type' => 'json_object'],
                'messages' => [
                    ['role' => 'system', 'content' => $definition['system']],
                    ['role' => 'user', 'content' => $userPrompt],
                ],
            ]);

        if ($response->failed()) {
            throw new RuntimeException('OpenAI request failed: ' . $response->status() . ' ' . $response->body());
        }

        $raw = $response->json('choices.0.message.content');
        $parsed = json_decode($raw ?? '', true);

        if (! is_array($parsed)) {
            throw new RuntimeException('OpenAI did not return valid JSON: ' . substr((string) $raw, 0, 500));
        }

        return [
            'type' => $type,
            'topic' => $topic,
            'title' => $parsed['title'] ?? null,
            'body' => $this->extractBody($type, $parsed),
            'metadata' => $this->extractMetadata($type, $parsed),
        ];
    }

    protected function extractBody(string $type, array $parsed): string
    {
        return match ($type) {
            'youtube_script' => json_encode($parsed['scenes'] ?? [], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES),
            default => $parsed['body'] ?? '',
        };
    }

    protected function extractMetadata(string $type, array $parsed): array
    {
        return match ($type) {
            'blog' => ['read_time' => $parsed['read_time'] ?? null],
            'facebook_post', 'linkedin_post' => ['hashtags' => $parsed['hashtags'] ?? []],
            'youtube_script' => ['cta' => $parsed['cta'] ?? null],
            default => [],
        };
    }
}
