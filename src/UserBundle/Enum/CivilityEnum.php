<?php

namespace UserBundle\Enum;

use UserBundle\Interfaces\EnumInterface;

/**
 * Class CivilityEnum
 * @package UserBundle\Enum
 */
abstract class CivilityEnum implements EnumInterface
{
    const MISTER = 'M';
    const MADAME = 'Mme';

    /** @var array $civilities */
    protected static $civilities = [
        self::MISTER => 'Monsieur',
        self::MADAME => 'Madame',
    ];

    /**
     * {@inheritdoc}
     */
    public static function getShortNameList(): array
    {
        return array_keys(self::$civilities);
    }

    /**
     * {@inheritdoc}
     */
    public static function getNameList(): array
    {
        return array_values(self::$civilities);
    }

    /**
     * {@inheritdoc}
     */
    public static function getList(): array
    {
        return self::$civilities;
    }

    /**
     * {@inheritdoc}
     */
    public static function getByShortName(string $shortName)
    {
        if (!isset(static::$civilities[$shortName])) {
            return "Unknown civility ($shortName)";
        }

        return static::$civilities[$shortName];
    }
}
