<?php

/**
 * Given a number, return the number + 'th' or 'rd' etc
 */
function ordinal($cdnl)
{
    $test_c = abs($cdnl) % 10;
    $ext = ((abs($cdnl) % 100 < 21 && abs($cdnl) % 100 > 4) ? 'th'
        : (($test_c < 4) ? ($test_c < 3) ? ($test_c < 2) ? ($test_c < 1)
            ? 'th' : 'st' : 'nd' : 'rd' : 'th'));
    return $cdnl . $ext;
}

function last_name_clean($last)
{
    $last_name = explode(" ", $last)[1];

    if ($last_name == 'McComas') {
        if (substr($last, 0, 1) == 'M') {
            return substr($last, 0, 2) . ". " . $last_name;
        }
        return substr($last, 0, 1) . ". " . $last_name;
    }
    elseif ($last_name == 'Baumgarner') {
        return substr($last, 0, 1) . ". " . $last_name;
    }
    elseif ($last_name == 'Smith') {
        return substr($last, 0, 1) . ". " . $last_name;
    }
    elseif ($last_name == 'Mills') {
        return substr($last, 0, 1) . ". " . $last_name;
    }
    else {
        return $last_name;
    }
}

if ( ! function_exists('str_possessive')) {
    /**
     * Make a string possessive.
     * @param  string  $string
     * @return string
     */
     function str_possessive($string) {
         return $string.'\''.($string[strlen($string) - 1] != 's' ? 's' : '');
     }
}