<?php

$file = '3.txt';
$fileWrite = 'test.txt';

$fp = fopen($file, "r");
$emptyLine = 0;
$content = '';

while(! feof($fp))
{
    $line = fgets($fp);
    if (trim($line) == ''){
        $emptyLine++;
        if ($emptyLine == 2) {
            $content .= "\n";
        }
    } else {
        $content .= $line;
        $emptyLine = 0;
    }
}
fclose($fp);

echo $content;

file_put_contents($fileWrite, $content);
