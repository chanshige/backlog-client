<?php
declare(strict_types=1);
/*
 * This file is part of the chanshige/backlog-client package.
 *
 * (c) shigeki tanaka <dev@shigeki.tokyo>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @param array $arr
 * @return mixed
 */
function array_value_first(array $arr)
{
    $key = array_key_first($arr);
    if ($key === null) {
        return $key;
    }

    return $arr[$key];
}

/**
 * @param array $arr
 * @return mixed
 * @version PHP 7 < 7.3.0
 */
if (!function_exists('array_key_first')) {
    function array_key_first(array $arr)
    {
        foreach (array_keys($arr) as $key) {
            return $key;
        }
        return null;
    }
}
