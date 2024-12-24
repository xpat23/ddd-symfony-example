<?php

declare(strict_types=1);

namespace Client\Infrastructure\DoctrineType;

use Client\Domain\ValueObject\Fico;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

final class FicoType extends Type
{

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getIntegerTypeDeclarationSQL($column);
    }

    public function getName(): string
    {
        return 'fico';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): Fico
    {
        return new Fico($value);
    }

    /**
     * @param Fico $value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): int
    {
        return $value->value();
    }
}