<?php

namespace Orm\Entity\Helpers;

use RecursiveArrayIterator;
use RecursiveIteratorIterator;

class Config
{
    /**
     * Get configuration value by key.
     *
     * @param string $key Configuration key.
     * @return mixed Configuration value.
     */
    public static function get(string $key): mixed
    {
        list($file_name, $key_without_filename) = self::explodeKey($key);
        $data = self::dataToDots(self::getFileData($file_name));

        return $data[$key_without_filename];
    }


    /**
     * Explode a configuration key into filename and key within the file.
     *
     * @param string $key Configuration key.
     * @return array Array containing filename and key within the file.
     */
    private static function explodeKey(string $key): array
    {
        return explode('.', $key, 2);
    }

    /**
     * Get data from a configuration file.
     *
     * @param false|string $file_name Configuration file name.
     * @return array Data from the configuration file.
     */
    private static function getFileData(false|string $file_name): array
    {
        return require CONFIG_PATH . $file_name . '.php';
    }

    /**
     * Convert multidimensional array to dot notation.
     *
     * @param array $data Multidimensional array.
     * @return array Array converted to dot notation.
     */
    private static function dataToDots(array $data): array
    {
        $recursiveIterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($data));

        $new_array_dots = [];
        foreach ($recursiveIterator as $leafValue) {

            $keys = [];
            foreach (range(0, $recursiveIterator->getDepth()) as $depth) {
                $keys[] = $recursiveIterator->getSubIterator($depth)->key();
            }

            $new_array_dots[join('.', $keys)] =  $leafValue;
        }

        return $new_array_dots;
    }
}