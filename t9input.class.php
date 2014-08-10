<?php
/**
 * T9input class
 * Use Trie tree to search string via prefix
 * User: Tuan Duong <bacduong[at]gmail[dot]com
 * Date: 8/9/14
 * Time: 9:05 AM
 */
include_once("trie.class.php");
class T9input
{
    public $trie;
    const DICTIONARY_FILE = "dictionary.txt";
    public $key = array(
        '2'   => 'abc',
        '3'   => 'def',
        '4'   => 'ghi',
        '5'   => 'jkl',
        '6'   => 'mno',
        '7'   => 'pqrs',
        '8'   => 'tuv',
        '9'   => 'wxyz'
    );

    public function __construct()
    {
        ini_set('memory_limit', '512M');
        $this->trie = new Trie();
    }

    /**
     * @param string $file  Dictionary file, should contain word by word in each line
     * @param array $prefix To reduce usage memory, we should add only words have same prefix
     *                      with input into Trie tree's dictionary
     */
    public function addDictionary($file = self::DICTIONARY_FILE, $prefix = array())
    {
        $dictionary = file_get_contents($file);
        $words = explode("\n", $dictionary);
        foreach ($words as $word) {
            if ($word != '') {
                if (in_array($word[0], $prefix)) {
                    $this->trie->add($word);
                }
            }
        }
        unset($words);
    }

    /**
     * Generate all strings from $input
     * Ex: 23 => [ad, ae, af, bd, be, bf, cd, ce, cf]
     * @param string $input
     * @return array
     */
    public function getAllPatternsFromInput($input)
    {
        $patterns = array();
        $numbers = str_split($input);
        $validNumbers = array_keys($this->key);
        foreach ($numbers as $number) {
            if (in_array($number, $validNumbers)) {
                $reversedChars = str_split($this->key[$number]);
                $patterns = $this->appendChars($patterns, $reversedChars);
            }
        }
        return $patterns;
    }

    private function appendChars($patterns, $chars = array())
    {
        $newPatterns = array();
        if (count($patterns) == 0) {
            return $chars;
        }
        foreach ($patterns as $pattern) {
            foreach ($chars as $char) {
                $newPatterns[] = $pattern . $char;
            }
        }
        return $newPatterns;
    }

    /**
     * @param $input - number 0-9, pressed by user
     * @return array - list of possible words
     */
    public function translate($input)
    {
        $searchWords = $this->getAllPatternsFromInput($input);
        $result = array();
        foreach ($searchWords as $word) {
            $tmp = $this->trie->prefixSearch($word);
            if (is_array($tmp)) {
                $result = array_merge($result, array_keys($tmp));
            }
        }
        return array_unique($result);
    }
}


/**
 * This function is simplified implementation of T9 input method for mobile phone.
 * It get users' input and return list of possible words. In real world T9 use some kind of dictionary,
 * but this function should return all possible words
 *
 * @param string $input - numbers 0-9, pressed by user
 * @return array - list of possible words
 *
 */
function getPossibleWords($input)
{
    // Initialize T9input instance with dictionary.
    $t9input = new T9input();
    $t9input->addDictionary("dictionary.txt", str_split($t9input->key[$input[0]]));

    return $t9input->translate($input);
}