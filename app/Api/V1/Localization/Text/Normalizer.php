<?php
namespace App\Api\V1\Localization\Text;

class Normalizer
{
    const DIACRITICS =             array('ă', 'â', 'î', 'ş', 'ţ', 'Ă', 'Â', 'Î', 'Ş', 'Ţ');
    const DIACRITICS_REPLACEMENT = array('a', 'a', 'i', 's', 't', 'A', 'A', 'I', 'S', 'T');

    static function normalize($text)
    {
        return str_replace(static::DIACRITICS, static::DIACRITICS_REPLACEMENT, $text);
    }
}