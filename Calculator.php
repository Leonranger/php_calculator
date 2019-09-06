#!/usr/bin/php
<?php

namespace Jakmall\Recruitment\Calculator\Commands;
use Illuminate\Console\Command;

class Calculator extends Command
{
    /**
     * Calculator constructor.
     * @param $num1
     * @param $num2
     * @param $option
     */
    public function __construct($num1, $num2, $option)
    {
        switch ($option) {
            case "+":
                echo $this::add($num1, $num2);
                break;
            case "-":
                echo $this::subtract($num1, $num2);
                break;
            case "x":
                echo $this::multiply($num1, $num2);
                break;
            case "/":
                echo $this::divide($num1, $num2);
                break;
            default:
                echo "Usage: [number 1] [operator (+ - x /)] [number 2].\n";
                break;
        }
    }
    /**
     * @param $num1
     * @param $num2
     * @return string
     */
    protected function add($num1, $num2)
    {
        $result = $num1 + $num2;
        return $result . "\n";
    }
    /**
     * @param $num1
     * @param $num2
     * @return string
     */
    protected function subtract($num1, $num2)
    {
        $result = $num1 - $num2;
        return $result . "\n";
    }
    /**
     * @param $num1
     * @param $num2
     * @return string
     */
    protected function multiply($num1, $num2)
    {
        $result = $num1 * $num2;
        return $result . "\n";
    }
    /**
     * @param $num1
     * @param $num2
     * @return string
     */
    protected function divide($num1, $num2)
    {
        $result = $num1 / $num2;
        return $result . "\n";
    }
}
if (isset($argv[1]) && isset($argv[2]) && isset($argv[3])) {
    $num1 = $argv[1];
    $opt = $argv[2];
    $num2 = $argv[3];
    $cli = new CalculatorCLI($num1, $num2, $opt);
} elseif (!isset($argv[0])) {
    echo "You dun f*cked up.\n";
} else {
    echo "Usage: [number 1] [operator (+ - x /)] [number 2].\n";
}