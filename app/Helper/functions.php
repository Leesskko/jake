<?php
/**
 * Created by PhpStorm.
 * User: Ekko
 * Date: 2018/11/19
 * Time: 上午 10:59
 */
function console($text, $color = 201)
{
    $consolecolor = new \JakubOnderka\PhpConsoleColor\ConsoleColor();
    echo $consolecolor->apply("color_$color", $text) . "\r\n";
}
