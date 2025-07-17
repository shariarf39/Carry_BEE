<?php

if (!function_exists('formatCompactNumber')) {
    function formatCompactNumber($number): string {
        if ($number >= 1000000) {
            return number_format($number / 1000000, 1) . 'M';
        } elseif ($number >= 1000) {
            return number_format($number / 1000, 1) . 'k';
        } else {
            return number_format($number, 0);
        }
    }
}
