<?php

function fibo($n)
{
    $arr = [1, 1];

    while ($n-- > 1) {
        $arr = [$arr[1], array_sum($arr)];
    }

    return $arr[1];
}


function fibo2($n)
{
    if ($n == 0 || $n == 1) {
       return 1;
    } else {
       return fibo($n-1) + fibo($n-2);
    }
}



for ($i = 0; $i < 10; $i++) {
    echo "fibo($i) => " . fibo($i) . "\n";

}
echo '<br> -- <br>';
for ($i = 0; $i < 10; $i++) {
    echo "fibo($i) => " . fibo2($i) . "\n";

}


// example for eduweb //

echo "<pre>example 1";

$tablica = array_map(function () {
    return rand(0, 5);
}, array_fill(0, 10, 0));

$new_tab = array_diff($tablica, [0]);
$result = array_product($new_tab);

echo 'Tablica: ' . join(', ', $tablica) . PHP_EOL;
echo 'Iloczyn wszystkich niezerowych elementów tablicy to: ' . $result . PHP_EOL;



$fruits = array("d" => "lemon", "a" => "orange", "b" => "banana", "c" => "apple");

function test_alter(&$item1, $key, $prefix)
{
    $item1 = "$prefix: $item1";
}

function test_print($item2, $key)
{
    echo "$key. $item2<br />\n";
}

function test_upper(&$value){
    $value = strtoupper($value);
}
function test_suffix($value) {
    return $value .'- suffix';
}
array_walk($fruits, 'test_upper');
var_dump($fruits);

$new_fruits = array_map('test_suffix', $fruits);
var_dump($new_fruits);

// funkcja anonimowe //
$new_fruits = array_map(function ($value) { return $value .'- anonim';}, $fruits);
var_dump($new_fruits);






// echo "Before ...:\n";
// array_walk($fruits, 'test_print');

// array_walk($fruits, 'test_alter', 'fruit');
// echo "... and after:\n";

// array_walk($fruits, 'test_print');
$x = 1;
$y = 2;

switch (true) {

    case ($x != 1):
        echo 'jeden';
    break;
    case ($y != 1):
        echo 'dwa';
    break;

    default:
  }

$x2 = 2;


switch (true) {

    case ($x2 != 1):
        echo 'dwa';
    break;
    case ($x2 != 2):
        echo 'jeden';
    break;

    default:
  }
