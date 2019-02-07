<?php
/**
 * Created by PhpStorm.
 * User: gemor
 * Date: 9/30/2018
 * Time: 10:43 PM
 */


function buy_items($money, $items_for_sale){ //constructs a list of items that are bought using a specified amount of money, plus the amount of change required
    $items_bought = array();
    foreach ($items_for_sale as $item => $price){
        $items_bought[$item] = 0;
    }
    unset($item);
    unset($price);
    while ($money > 1.5){
        $item = array_rand($items_for_sale);
        if ($money-$items_for_sale[$item] > 0){
            $money = $money - $items_for_sale[$item];
            $items_bought[$item] ++;
        }
        unset($item);
    }
    $items_bought["change"] = $money;
    return $items_bought;
}

function give_change($remainder){ //constructs a string describing the amount of change (not fully correct English)
    $change_counter = array();
    array_push($change_counter, 0, 0, 0, 0);

    while ($remainder >= 0.25) {
        $remainder = $remainder - 0.25;
        $change_counter[0] ++;
    }
    while ($remainder >= 0.1) {
        $remainder = $remainder - 0.1;
        $change_counter[1] ++;
    }
    while ($remainder >= 0.05) {
        $remainder = $remainder - 0.05;
        $change_counter[2] ++;
    }
    while ($remainder >= 0.01) {
        $remainder = $remainder - 0.01;
        $change_counter[3] ++;
    }
    $format = 'Your change is %d quarters, %d dimes, %d nickels, and %d pennies.';
    return sprintf($format, ...$change_counter);
}

function list_purchases($items_bought){ //construct a string describing what items were bought
    unset($items_bought["change"]);
    $purchases_string = 'You bought ';
    foreach ($items_bought as $key => $item){
        $purchases_string .=sprintf('%d %s and ',$item,$key);
    }
    unset($item);
    unset($key);
    return substr($purchases_string, 0, -4);
}

function run($items_for_sale){
    $wallet = rand(2,40);
    $items_bought = buy_items($wallet, $items_for_sale);
    $change_string = give_change($items_bought["change"]);
    $purchases_string = list_purchases($items_bought);
    $out = 'You paid $'.$wallet.'. '.$purchases_string.'. '.$change_string;
    echo $out;
    return;
}


$items_for_sale = array(
    "M&Ms" => 1.5,
    "Pretzels" => 2,
    "Pepsi 20 oz." => 2.5,
    "Sprite 12 oz." => 1.75,
    "Trail Mix" => 2,
    "Champagne" => 10,
    "Pita Chips" => 1.65,
    "Paper Clips" => 3.5,
    "Bananas" => 2.15,
    "Cherry Coke 64 oz." => 3.25,
    "Thin Mints" => 35,
    "Famous Amos Chocolate Chip Cookies" => 1.5,
    "Peanut M&Ms" => 1.5,
    "Guitars" => 4.82
);

run($items_for_sale);

