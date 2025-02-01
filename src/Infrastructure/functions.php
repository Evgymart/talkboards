<?php

declare(strict_types=1);

/**
 * @throws JsonException
 */
function jsonEncode(mixed $data, int $flags = 0): string
{
    return json_encode($data, $flags | JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
}
