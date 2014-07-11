<?php

echo "scraping words...<br>";

// This file downloads a wordlist to store locally to a comma separated text file 
$words_file = "words.txt";
$words = []; // empty words array

// empty words file
file_put_contents($words_file, '');

// set words url & load HTML
$wordsurl = "http://www.englishclub.com/vocabulary/common-words-5000.htm";
$html = file_get_contents($wordsurl);

// create DOM object and load in HTML
$htmlDOM = new DOMDocument;
$htmlDOM->strictErrorChecking = false;
if ($htmlDOM->loadHTML($html) == false) {
    print "Error loading source. Exiting.\n";
    return;
}

// tokenize HTML dom by LI elements 
$wordlist = $htmlDOM->getElementsByTagName('li');

// iterate through list and add to array
foreach ($wordlist as $item) {
    $word = strip_tags($htmlDOM->saveHTML($item)) . ','; // strip HTML tags
    file_put_contents($words_file, $word, FILE_APPEND);
}

echo "complete! look for output in words.txt and rerun index.php";

?>