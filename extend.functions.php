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
 * @param array $data
 * @return false|string
 */
function json_unescaped_encode(array $data)
{
    return \json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
}
