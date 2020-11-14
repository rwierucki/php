<?php
$name = 'test.txt';
// $f = fopen($name,'w+b');
$f = fopen($name,'a+b');
var_dump($f);
$data = fwrite($f, 'test data 1');
var_dump($data);
rewind($f);
$text = fread($f, filesize($name));
var_dump($text);

$name2 = 'test2.txt';
$f2 = fopen($name2,'c+b');
var_dump($f2);
$data2 = fwrite($f2, 'test data 2');
var_dump($data2);
rewind($f2);
$text2 = fread($f2, filesize($name2));
var_dump($text2);

// tylko tworzenie pliku
$example_name = 'jakis_nowy_plik.txt';

touch($example_name);

// usuwanie pliku
$result = @unlink($example_name);


//
$example_name_2 = 'jakis_nowy_plik_2.txt';
@touch($example_name_2);
$content = file_get_contents($example_name_2);

$text_to_file = 'pierwszy napis w pliku 2';
$result_put = file_put_contents($example_name_2, $text_to_file);
