<?php

declare(strict_types=1);

namespace TalkBoards\Infrastructure\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;

final class DateMilliTimeZoneImmutableType extends CustomDoctrineType
{
    private const string FORMAT = 'Y-m-d H:i:s.vO';
    private const string ALT_FORMAT = 'Y-m-d H:i:sO';

    public static function name(): string
    {
        return 'date_milli_time_zone_immutable';
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return 'TIMESTAMP(3) WITH TIME ZONE';
    }

    /**
     * @throws ConversionException
     */
    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): ?string
    {
        if ($value === null) {
            return $value;
        }

        if ($value instanceof \DateTimeImmutable) {
            return $value->format(self::FORMAT);
        }

        throw ConversionException::conversionFailedInvalidType($value, self::name(), ['null', \DateTimeImmutable::class]);
    }

    /**
     * @throws ConversionException
     */
    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): ?\DateTimeImmutable
    {
        if ($value === null || $value instanceof \DateTimeImmutable) {
            return $value;
        }

        if (!\is_string($value)) {
            throw ConversionException::conversionFailedFormat(get_debug_type($value), self::name(), self::FORMAT);
        }

        $dateTime = \DateTimeImmutable::createFromFormat(self::FORMAT, $value)
            ?: \DateTimeImmutable::createFromFormat(self::ALT_FORMAT, $value);

        if (!$dateTime) {
            throw ConversionException::conversionFailedFormat($value, self::name(), self::FORMAT);
        }

        return $dateTime;
    }
}
