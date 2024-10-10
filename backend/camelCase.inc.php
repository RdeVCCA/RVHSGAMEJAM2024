<?php
function convertToCamelCase($string) {
    // Removes every character that isn't a letter, number or space
    $string = preg_replace('/[^a-zA-Z0-9 ]/', '', $string);

    // Make the whole string lowercase
    $string = mb_strtolower($string);
    
    // Capitalize the first letter of each word and then remove spaces
    $string = str_replace(' ', '', ucwords($string));

    // Lowercase the first character of the string
    $string = lcfirst($string);

    return $string;
}
?>

