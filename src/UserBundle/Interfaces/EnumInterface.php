<?php

namespace UserBundle\Interfaces;

/**
 * Interface EnumInterface
 * @package UserBundle\Interfaces
 */
interface EnumInterface
{
    /**
     * Return the list of available short name
     *
     * @return array
     */
    public static function getShortNameList(): array;

    /**
     * Return the list of available name
     *
     * @return array
     */
    public static function getNameList(): array;

    /**
     * Return the list of available name with below format:
     * [
     *      shortName => fullName,
     * ]
     *
     * @return array
     */
    public static function getList(): array;

    /**
     * Get a full name using his short name
     *
     * @param string $shortName
     * @return mixed
     */
    public static function getByShortName(string $shortName);
}
