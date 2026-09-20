<?php

namespace App\Support;

use Illuminate\Support\Facades\App;

/**
 * Client-facing contact details.
 *
 * Al-Falah runs two WhatsApp lines: a Guinean number for the local
 * French-speaking market, and a US number for international English-speaking
 * clients. Which one a visitor sees follows the language they are viewing the
 * site in, so the numbers are defined here once rather than hard-coded across
 * a dozen Blade templates.
 */
class Contact
{
    /** wa.me format: digits only — no '+', spaces or dashes. */
    public const WHATSAPP = [
        'fr' => '224611351302',
        'en' => '12402806137',
    ];

    /** Human-readable form for on-page display. */
    public const WHATSAPP_DISPLAY = [
        'fr' => '+224 611 351 302',
        'en' => '+1 240 280 6137',
    ];

    /** Falls back to French — Guinea is the primary market. */
    protected static function resolve(?string $locale = null): string
    {
        $locale = $locale ?: App::getLocale();

        return isset(self::WHATSAPP[$locale]) ? $locale : 'fr';
    }

    /** Digits, for use inside a wa.me link. */
    public static function whatsapp(?string $locale = null): string
    {
        return self::WHATSAPP[self::resolve($locale)];
    }

    /** Formatted number, for showing on the page. */
    public static function whatsappDisplay(?string $locale = null): string
    {
        return self::WHATSAPP_DISPLAY[self::resolve($locale)];
    }

    /** Complete wa.me URL, optionally pre-filled with a message. */
    public static function whatsappUrl(?string $text = null, ?string $locale = null): string
    {
        $url = 'https://wa.me/' . self::whatsapp($locale);

        return $text !== null && $text !== ''
            ? $url . '?text=' . rawurlencode($text)
            : $url;
    }
}
