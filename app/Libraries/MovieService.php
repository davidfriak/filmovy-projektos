<?php

namespace App\Libraries;

class MovieService
{
    /**
     * Převede datum z HTML formuláře na unix timestamp pro sloupec release_date.
     * Vstup: string|null $date ve formátu Y-m-d.
     * Výstup: int timestamp, nebo aktuální čas při chybě.
     */
    public function dateToTimestamp(?string $date): int
    {
        $timestamp = strtotime((string) $date);
        return $timestamp ? $timestamp : time();
    }

    /**
     * Nahraje plakát do public/uploads/posters a vrátí jeho bezpečný název.
     * Vstup: UploadedFile|null $file z formuláře.
     * Výstup: string|null název souboru, nebo null pokud soubor nebyl nahrán.
     */
    public function uploadPoster($file): ?string
    {
        if (!$file || !$file->isValid() || $file->hasMoved()) {
            return null;
        }

        $newName = $file->getRandomName();
        $file->move(FCPATH . 'uploads/posters', $newName);

        return $newName;
    }

    /**
     * Zkrátí text pro zobrazení v kartě filmu.
     * Vstup: string $text a int $length maximální délka.
     * Výstup: string zkrácený text bez HTML značek.
     */
    public function shortText(string $text, int $length = 120): string
    {
        $plain = strip_tags($text);
        return mb_strlen($plain) > $length ? mb_substr($plain, 0, $length) . '...' : $plain;
    }
}
