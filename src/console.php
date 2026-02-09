<?php

namespace Framework;

class console
{
    public static function log($data): void
    {
        echo '<script>';
        echo 'console.log(' . json_encode($data) . ')';
        echo '</script>';
    }
}