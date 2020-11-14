<?php
// own 90minut.pl //
// use simplehtmldom //
include_once('./simplehtmldom/simple_html_dom.php');

$html = new simple_html_dom();
// Load HTML from a URL
$html->load_file('http://www.90minut.pl/liga/1/liga10748.html');
$maniTable = $html->find('table.main2');

// print '<pre>';
// var_dump($maniTable[1]);
// $str = $html->save();
// $html->save('result.htm');


