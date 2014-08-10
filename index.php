<?php
/**
 * Created by PhpStorm.
 * User: Tuan Duong <bacduong[at]gmail[dot]com>
 * Date: 8/10/14
 * Time: 3:04 PM
 */
include_once("t9input.class.php");

$t9input = new T9input();
$input = "8378464";
$t9input->addDictionary("dictionary.txt", str_split($t9input->key[$input[0]]));
$result = $t9input->translate($input);
var_dump($result);

die();
$trie = new Trie();
$words = array(
    'add',
    'adder',
    'addled',
    'alert',
    'busy',
    'agree',
    'agreement',
    'astronaut'
);

foreach ($words as $word) {
    $trie->add($word);
}

var_dump($trie->prefixSearch('ad'));