<?php

namespace BorySaintVincentBundle\Service;

/**
 * Class StringService
 * @package BorySaintVincentBundle\Service
 */
class StringService
{
    /**
     * @param string $input
     * @return string
     */
    public function slugify(string $input)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $input);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            $text = 'n-a';
        }

        return $text.'-'.time();
    }
}
