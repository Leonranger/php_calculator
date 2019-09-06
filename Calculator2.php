<?php

namespace Jakmall\Recruitment\Calculator\Commands;
use Illuminate\Console\Command;

class Calculator2 extends Command{
	function calculate($exp) {
		return calculate_rpn(mathexp_to_rpn($exp));
	}
	// calculates the result of an expression in reverse polish notation
	function calculate_rpn($rpnexp) {
		$stack = array();
		foreach($rpnexp as $item) {
			if (is_operator($item)) {
				if ($item == '+') {
					$j = array_pop($stack);
					$i = array_pop($stack);
					array_push($stack, $i + $j);
				}
				if ($item == '-') {
					$j = array_pop($stack);
					$i = array_pop($stack);
					array_push($stack, $i - $j);
				}
				if ($item == '*') {
					$j = array_pop($stack);
					$i = array_pop($stack);
					array_push($stack, $i * $j);
				}
				if ($item == '/') {
					$j = array_pop($stack);
					$i = array_pop($stack);
					array_push($stack, $i / $j);
				}
				if ($item == '%') {
					$j = array_pop($stack);
					$i = array_pop($stack);
					array_push($stack, $i % $j);
				}
			} else {
				array_push($stack, $item);
			}
		}
		return $stack[0];
	}
	// converts infix notation to reverse polish notation
	function mathexp_to_rpn($mathexp) {
		$precedence = array(
			'(' => 0,
			'-' => 3,
			'+' => 3,
			'*' => 6,
			'/' => 6,
			'%' => 6
		);
	
		$i = 0;
		$final_stack = array();
		$operator_stack = array();
		while ($i < strlen($mathexp)) {
			$char = $mathexp{$i};
			if (is_number($char)) {
				$num = readnumber($mathexp, $i);
				array_push($final_stack, $num);
				$i += strlen($num); continue;
			}
			if (is_operator($char)) {
				$top = end($operator_stack);
				if ($top && $precedence[$char] <= $precedence[$top]) {
					$oper = array_pop($operator_stack);
					array_push($final_stack, $oper);
				}
				array_push($operator_stack, $char);
				$i++; continue;
			}
			if ($char == '(') {
				array_push($operator_stack, $char);
				$i++; continue;
			}
			if ($char == ')') {
				// transfer operators to final stack
				do {
					$operator = array_pop($operator_stack);
					if ($operator == '(') break;
					array_push($final_stack, $operator);
				} while ($operator);
				$i++; continue;
			}
			$i++;
		}
		while ($oper = array_pop($operator_stack)) {
			array_push($final_stack, $oper);
		}
		return $final_stack;
	}
	function readnumber($string, $i) {
		$number = '';
		while (is_number($string{$i})) {
			$number .= $string{$i};
			$i++;
		}
		return $number;
	}
	function is_operator($char) {
		static $operators = array('+', '-', '/', '*', '%');
		return in_array($char, $operators);
	}
	function is_number($char) {
		return (($char == '.') || ($char >= '0' && $char <= '9'));
    }
}
?>