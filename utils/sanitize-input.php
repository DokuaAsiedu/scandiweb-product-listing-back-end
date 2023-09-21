<?php

/**
 * This function removes unwanted characters from strings that could be used in an injection attack
*/

function sanitizeInput($str) 
{
    $str = trim($str);
    $str = stripslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}
