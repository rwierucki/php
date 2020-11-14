<?php
session_start();
var_dump($_SESSION['session_example']);

// phpinfo();

//rekurencja - silnia //
function power(int $number)
{
    if($number === 1) return $number;
    return $number * power($number - 1);
}

var_dump(number_format(power(10)));
