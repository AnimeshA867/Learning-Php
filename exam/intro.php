<?php

$str = "Hello world";

/* 
    String functions are the fuctions alters the strings in a php program. 
    Some string functions in php are:
    1) Strlen
    2) str_word_count()
    3) strrev()
    4) strpos()
    5) str_replace()
*/

echo strlen($str)."\n";

echo str_word_count($str)."\n";

echo strrev($str)."\n";

echo strpos($str,"o");

echo str_replace("world","Dorld",$str);



//Constants:

/* 
There are two ways of defined a constant in php:
They are:
1) define(name,value,isCaseSensitive);
2) const name = value
*/

define("pie",3.14,true);
const e = 2.31;
echo e;

/* 
    Php default argument value:
    In this we assign default value to the argument of the function. 

    Now is the time of associative array;
*/

$arr = array("name"=>"animesh","semester"=>"fifth");
echo $arr['name'];
?>