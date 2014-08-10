=======================
T9 Input Implementation
=======================

Simple implementation of T9 input for mobile using Trie Tree Algorithm

Trie Tree
=========
http://phpir.com/tries-and-wildcards/

Dictionary
==========
Dictionary is raw text file which contains word by word in each line.
Simple t9 predictive and dictionary implemented by JS:
https://github.com/arifwn/t9-emulator

Usage
=====
Default dictionary:
getPossibleWords($input) in which $input are numbers pressed by user.
For example:
```php
include_once("t9input.class.php");

$input = "8378464";
$result = getPossibleWords($input);
var_dump($result);
```

Custom dictionary:
```php
include_once("t9input.class.php");

$t9input = new T9input();
$input = "8378464";
$t9input->addDictionary("another_dictionary.txt", str_split($t9input->key[$input[0]]));
$result = $t9input->translate($input);
var_dump($result);
```
