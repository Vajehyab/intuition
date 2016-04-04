<?php
/**
 * intuition(Exact word)
 * This function is able to find the exact word that user is looking for, and even find what dictionary, and what type of meaning the user needs.
 * Usage: intuition(user text here);
 * Return: Array
 */
function intuition($string)
{
    mb_internal_encoding("UTF-8");
    $founded_key = false;
    $founded_dictionary = false;
    $how_many_words = mb_substr_count($string, ' ');
    if ($how_many_words >= 1) {
//Means if this $string has more than one word (has space)
        //Words to ignore from the string:
        $ignore = [
            'چیست',
            'کیست',
            'چگونه',
            'چطور',
            'کلمه',
            'معنی',
            ' را ',
            ' از ',
            ' به ',
            '?',
            ' ? ',
            '!',
            ' ! ',
            '.',
            ' . ',
            ')',
            ' ) ',
            '(',
            ' ( ',
            '،',
            ' ، ',
            '؟',
            ' ؟ ',
            '؛',
            ' ؛ ',
            'دیکشنری',
            'فرهنگ لغت',
            'فرهنگ لغات',
            'واژه نامه',
            'در',
            ' در ',
            'ترجمه',
            'های'
        ];
//Keys what we care about:
        $keys = [
            'متضاد',
            'مترادف'
        ];
//Our Dictionaries:
        $dictionaries = [
            'دهخدا',
            'معین',
            'انگلیسی'
        ];
//Remove all unnecessary words from the string:
        $string = str_replace($ignore, ' ', $string);
// Check for $keys:
        if ($how_many_words = mb_substr_count($string, ' ') >= 1) {
//If still needs to be more clear and has more than one word (Mean if still is not exact word and has space)  Maybe has a key:
            foreach ($keys as $key) {
                if (mb_substr_count($string, $key)) {
                    //If found the key inside the $key (searching the $string in $key):
                    //Now remove all other keys, because we just work with the first founded key:
                    $string = str_replace($keys, '', $string);
                    $founded_key = $key;
                    break;
                }
            }
        }
//Check for dictionaries:
        if ($how_many_words = mb_substr_count($string, ' ') >= 1) {
//If still needs to be more clear and has more than one word (Mean if still is not exact word) maybe has a dictionary name inside the search term:
            foreach ($dictionaries as $key) {
                if (mb_substr_count($string, $key)) {
                    //If found the key inside the $key (searching the $string in $key):
                    //Now remove all other dictionary names inside this string, because we just work with the first dictionary what we found:
                    $string = str_replace($dictionaries, '', $string);
                    $founded_dictionary = $key;
                    break;
                }
            }
        }
    }
    $string = str_replace('  ', ' ', $string);
    $output['word'] = trim($string); //Exact word
    $output['key'] = $founded_key;
    $output['dictionary'] = $founded_dictionary;
    return $output;  //Returns array
}
