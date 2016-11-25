<?php

$filename = 'word.txt';
$newfilename = 'newword.txt';

$word = file_get_contents($filename);


$wordarr = explode("\n", $word);

foreach ($wordarr as &$v) {
    $blank = str_pad('', 30 - strpos($v, '['));
    $v = str_replace('[', $blank . '[', $v);
}

// print_r($wordarr);

$newword = implode("\n", $wordarr);

// echo $newword;
$newword = preg_replace('/\[(.*)\]/', '', $newword);
echo $newword;



file_put_contents($newfilename, $newword);

// echo $word;

