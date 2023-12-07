<?php

const HIGH_CARD = 1;
const ONE_PAIR = 2;
const TWO_PAIR = 3;
const THREE_OF_A_KIND = 4;
const FULL_HOUSE = 5;
const FOUR_OF_A_KIND = 6;
const FIVE_OF_A_KIND = 7;

const CARD_RANKS = [
    'A' => 14,
    'K' => 13,
    'Q' => 12,
    'J' => 11,
    'T' => 10,
    '9' => 9,
    '8' => 8,
    '7' => 7,
    '6' => 6,
    '5' => 5,
    '4' => 4,
    '3' => 3,
    '2' => 2,
];

function getHandRanking(array $hand): int
{
    if ($hand[0] === 5) {
        return FIVE_OF_A_KIND;
    }
    if ($hand[0] === 4) {
        return FOUR_OF_A_KIND;
    }
    if ($hand[0] === 3 && $hand[1] === 2) {
        return FULL_HOUSE;
    }
    if ($hand[0] === 3 && $hand[1] === 1) {
        return THREE_OF_A_KIND;
    }
    if ($hand[0] === 2 && $hand[1] === 2) {
        return TWO_PAIR;
    }
    if ($hand[0] === 2 && $hand[1] === 1) {
        return ONE_PAIR;
    }
    return HIGH_CARD;
}


$players = array_map(function ($player) {
    [$hand, $bid] = explode(' ', $player);

    $cards = array_map(fn($card) => CARD_RANKS[$card], str_split($hand));
    $counted = array_count_values($cards);
    arsort($counted);


    return [
        'handType' => getHandRanking(array_values($counted)),
        'cardRanking' => array_values($counted),
        'cards' => $cards,
        'bid' => $bid,
        'original' => $hand,
    ];
}, explode(PHP_EOL, file_get_contents(__DIR__ . '/input.txt')));

usort($players, function (array $playerA, array $playerB) {
    if ($playerA['handType'] === $playerB['handType']) {
        for ($i = 0; $i < count($playerA['cards']); $i++) {
            if ($playerA['cards'][$i] === $playerB['cards'][$i]) continue;
            return $playerA['cards'][$i] > $playerB['cards'][$i] ? 1 : -1;
        }
    }
    return $playerA['handType'] > $playerB['handType'] ? 1 : -1;
});

$result = 0;

for ($i = 0; $i < count($players); $i++) {
    $rank = $i + 1;
    $result += $players[$i]['bid'] * $rank;
}

var_dump($result);

//var_dump($result);