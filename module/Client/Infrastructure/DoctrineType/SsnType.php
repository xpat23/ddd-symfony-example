<?php

declare(strict_types=1);

namespace Client\Infrastructure\DoctrineType;

use Client\Domain\ValueObject\Ssn;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

final class SsnType extends Type
{

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getStringTypeDeclarationSQL($column);
    }

    public function getName(): string
    {
        return 'ssn';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): Ssn
    {
        return new Ssn($value);
    }

    /**
     * @param Ssn|string $value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (is_string($value)) {
            return $value;
        }

        return $value->value();
    }
}