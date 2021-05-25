<?php

declare(strict_types=1);

namespace Platine\UserAgent\Detector;

$mock_function_exists_to_false = false;

function function_exists(string $str)
{
    global $mock_function_exists_to_false;
    if ($mock_function_exists_to_false) {
        return false;
    }

    return \function_exists($str);
}

namespace Platine\UserAgent\Util;

$mock_preg_replace_to_null = false;

function preg_replace($pattern, $replacement, $subject, $limit = -1)
{
    global $mock_preg_replace_to_null;
    if ($mock_preg_replace_to_null) {
        return null;
    }

    return \preg_replace($pattern, $replacement, $subject, $limit);
}
