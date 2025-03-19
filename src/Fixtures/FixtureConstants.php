<?php

declare(strict_types=1);

namespace TalkBoards\Fixtures;

final readonly class FixtureConstants
{
    public const string BOARD_ID_ANIME = '32f1eacf-acf7-46a7-a7f2-68224e9e3c7f';
    public const string BOARD_ID_MANGA = '565a4d8e-8818-474d-a4e9-3b0b5a76c3f0';
    public const string BOARD_ID_MOVIES = 'e0dc5a06-782f-4da3-bf85-a3b108fa4b21';
    public const string BOARD_ID_BOOKS = '4a981193-30db-4463-ab22-e4c60f92d289';
    public const string USER_1 = 'e7bf3b15-7069-48ac-9f1e-f94122712232';

    public static function createdAt(): \DateTimeImmutable
    {
        $datetime = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2025-03-05 12:00:00');
        \assert($datetime instanceof \DateTimeImmutable);

        return $datetime;
    }

    public static function updatedAt(): \DateTimeImmutable
    {
        $datetime = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2025-03-05 12:25:00');
        \assert($datetime instanceof \DateTimeImmutable);

        return $datetime;
    }
}
