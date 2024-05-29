<?php
/**
 * Given a number, return the number + 'th' or 'rd' etc
 */
function ordinal($cardinal): string
{
    $test_c = abs($cardinal) % 10;
    $ext = ((abs($cardinal) % 100 < 21 && abs($cardinal) % 100 > 4) ? 'th'
        : (($test_c < 4) ? ($test_c < 3) ? ($test_c < 2) ? ($test_c < 1)
            ? 'th' : 'st' : 'nd' : 'rd' : 'th'));

    return $cardinal.$ext;
}

function last_name_clean($last): string
{
    $last_name = explode(' ', $last)[1];

    if ($last_name == 'McComas') {
        if (str_starts_with($last, 'M')) {
            return substr($last, 0, 2).'. '.$last_name;
        }

        return substr($last, 0, 1).'. '.$last_name;
    } elseif ($last_name == 'Baumgarner') {
        return substr($last, 0, 1).'. '.$last_name;
    } elseif ($last_name == 'Smith') {
        return substr($last, 0, 1).'. '.$last_name;
    } elseif ($last_name == 'Mills') {
        return substr($last, 0, 1).'. '.$last_name;
    } elseif ($last_name == 'Adkins') {
        return substr($last, 0, 1).'. '.$last_name;
    } else {
        return $last_name;
    }
}

if (!function_exists('str_possessive')) {
    /**
     * Make a string possessive.
     */
    function str_possessive(string $string): string
    {
        return $string.'\''.($string[strlen($string) - 1] != 's' ? 's' : '');
    }
}
