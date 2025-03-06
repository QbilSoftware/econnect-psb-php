<?php

declare(strict_types=1);

namespace GuzzleHttp\Psr7 {
    if (!function_exists('try_fopen')) {
        function try_fopen(string $filename, string $mode)
        {
            return Utils::tryFopen($filename, $mode);
        }
    }
}
