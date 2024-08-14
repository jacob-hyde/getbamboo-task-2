<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
//    $input = "23";
//    $combos = [];
//    $lettersMap = [2 => ['a', 'b', 'c'], 3 => ['d', 'e', 'f'], 4 => ['g', 'h', 'i'], 5 => ['j', 'k', 'l'], 6 => ['m', 'n', 'o'], 7 => ['p', 'q', 'r', 's'], 8 => ['t', 'u', 'v'], 9 => ['w', 'x', 'y', 'z']];
//
////    foreach ($input as $i => $num) {
////        foreach ($lettersMap[(int)$num] as $letters) {
//////            if ($i > count($input)) {
//////                return;
//////            }
////           foreach ($lettersMap[(int)$input[$i + 1]] as $letters2) {
////               $combos[] = array_map(function ($v) {
////                   $comobos[] = $v +
////               }, $letters);
////           }
////        }
////    }
//
//    function t (&$lettersMap, &$combos) {
//
//            foreach ($lettersMap as $l) {
////                if ($i === 0) {
////                    $combos[] = $l;
////                    continue;
////                }
//                foreach ($combos as $i => $combo) {
////                    if (strlen($combo) >= strlen($input) && $combo[strlen($combo) - 1] !== $l) {
////                        continue;
////                    }
//                    $combos[$i] = $combo . $l;
//                }
//            }
//    }
//
//    for ($i = 0; $i < strlen($input); $i++) {
//        $inputNum = $input[$i];
//        $map = $lettersMap[$inputNum];
//        t($map, $combos);
//    }
//
//    $combos = array_unique($combos);
//    dd($combos);


});
