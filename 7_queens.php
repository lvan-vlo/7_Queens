#!/usr/bin/php
<?php

$board = array(".......", ".......", ".......", ".......", ".......", ".......", ".......");

solve_queens($board, 1, 0);

function	check_diagonal($board, $x, $y) {
	$x1 = 0;
	$x2 = 0;

	if ($x > $y) {
		$x1 = $x + (7 - $x);
		$y1 = $y + (7 - $x);
	} else {
		$x1 = $x + (7 - $y);
		$y1 = $y + (7 - $y);
	}
	while ($x1 >= 0 && $y1 >= 0) {
		if ($board[$y1][$x1] == 'Q') {
			return (true);
		}
		$x1--;
		$y1--;
	}
	$x1 = $x;
	$y1 = $y;
	while ($x1 < 7 && $y1 >= 0) {
		if ($board[$y1][$x1] == 'Q') {
			return (true);
		}
		$x1++;
		$y1--;
	}
	while ($y < 7 && $x >= 0) {
		if ($board[$y][$x] == 'Q') {
			return (true);
		}
		$x--;
		$y++;
	}
	return (false);
}

function	check_vertical($board, $x) {
	for ($y = 0; $y < 7; $y++) {
		if ($board[$y][$x] == 'Q')
			return (true);
	}
	return (false);
}

function	check_horizontal($board, $y) {
	for ($x = 0; $x < 7; $x++) {
		if ($board[$y][$x] == 'Q') {
			return (true);
		}
	}
	return (false);
}

function	position_available($board, $position) {
	$x = $position % 7;
	$y = floor($position / 7);

	if (check_horizontal($board, $y))
		return (false);
	if (check_vertical($board, $x))
		return (false);
	if (check_diagonal($board, $x, $y))
		return (false);
	return (true);
}

function	solve_queens($board, $queen, $position) {
	if ($queen == 8) {
		$GLOBALS['solutions']++;
		echo "solution number: ".$GLOBALS['solutions']."\n";
		print_r($board);
		return (0);
	}
	while ($position < 49)	{
		if (position_available($board, $position) === true) {
			$board[floor($position / 7)][$position % 7] = 'Q';
			if (solve_queens($board, $queen + 1, $position + 1)) {
				return (true);
			}
			$board[floor($position / 7)][$position % 7] = '.';
		}
		$position++;
	}
	return (false);
}

?>