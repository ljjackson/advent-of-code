<?php

enum HandRanking: int
{
    case HIGH_CARD = 1;
    case ONE_PAIR = 2;
    case TWO_PAIR = 3;
    case THREE_OF_A_KIND = 4;
    case FULL_HOUSE = 5;
    case FOUR_OF_A_KIND = 6;
    case FIVE_OF_A_KIND = 7;
}

const JOKER_LETTER = 'J';
const JOKER_SCORE = 1;

const CARD_WEIGHTS = [
    'A' => 14,
    'K' => 13,
    'Q' => 12,
    'T' => 10,
    '9' => 9,
    '8' => 8,
    '7' => 7,
    '6' => 6,
    '5' => 5,
    '4' => 4,
    '3' => 3,
    '2' => 2,
    'J' => JOKER_SCORE,
];

class Hand
{
    private array $cards;

    public function __construct(private string $input)
    {
        $this->cards = str_split($input);
    }

    /**
     * @return array<string>
     */
    public function getCards(): array
    {
        return $this->cards;
    }

    /**
     * @return array<int>
     */
    public function getCardsByWeight(): array
    {
        return array_map(fn(string $card) => CARD_WEIGHTS[$card], $this->cards);
    }

    public function getCountedCountedCardsByWeight(): array
    {
        $weighted = array_count_values($this->getCardsByWeight());
        arsort($weighted);
        return $weighted;
    }

    public function getHandRanking(): HandRanking
    {
        return (new HandRankingStrategy($this))->getRanking();
    }

    public function getJokerCount(): int
    {
        return substr_count($this->input, JOKER_LETTER);
    }
}

class HandComparisonStrategy
{
    public const HAND_A_WINS = 1;
    public const DRAW = 0;
    public const HAND_B_WINS = -1;

    public function __construct(private Hand $handA, private Hand $handB)
    {
    }

    public function compare(): int
    {
        $handARanking = $this->handA->getHandRanking();
        $handBRanking = $this->handB->getHandRanking();

        if ($handARanking->value !== $handBRanking->value) {
            return $handARanking->value > $handBRanking->value ? self::HAND_A_WINS : self::HAND_B_WINS;
        }

        $handACards = $this->handA->getCardsByWeight();
        $handBCards = $this->handB->getCardsByWeight();

        for ($i = 0; $i < 5; $i++) {
            if ($handACards[$i] === $handBCards[$i]) {
                continue;
            }
            return $handACards[$i] > $handBCards[$i] ? self::HAND_A_WINS : self::HAND_B_WINS;
        }

        return self::DRAW;
    }
}

class HandRankingStrategy
{
    public function __construct(private Hand $hand)
    {
    }

    public function getRanking(): HandRanking
    {
        $results = $this->hand->getCountedCountedCardsByWeight();
        unset($results[JOKER_SCORE]);
        $results = array_values($results);
        $jokerCount = $this->hand->getJokerCount();


        $firstCard = $results[0] ?? 0;
        $secondCard = $results[1] ?? 0;

        if ($firstCard === 3 && $secondCard === 2) {
            return HandRanking::FULL_HOUSE;
        }

        if ($firstCard === 2 && $secondCard === 2 && $jokerCount === 1) {
            return HandRanking::FULL_HOUSE;
        }

        if ($firstCard === 2 && $secondCard === 2 && $jokerCount === 0) {
            return HandRanking::TWO_PAIR;
        }

        if ($firstCard === 1 && $jokerCount == 1) {
            return HandRanking::ONE_PAIR;
        }

        if ($firstCard === 2 && $secondCard === 1 && $jokerCount === 0) {
            return HandRanking::ONE_PAIR;
        }

        for ($i = 0; $i < 6; $i++) {
            if ($firstCard === $i && $jokerCount === (5 - $i)) {
                return HandRanking::FIVE_OF_A_KIND;
            }

            if ($firstCard === $i && $jokerCount === (4 - $i) && $i < 5) {
                return HandRanking::FOUR_OF_A_KIND;
            }

            if ($firstCard === $i && $jokerCount === (3 - $i) && $i < 4) {
                return HandRanking::THREE_OF_A_KIND;
            }
        }

        return HandRanking::HIGH_CARD;
    }
}

class Player
{
    public function __construct(public int $bid, public Hand $hand)
    {
    }
}

class PokerWinningsCalculator
{
    /**
     * @var array<Player>
     */
    private array $players;

    public function __construct(string $contents)
    {
        $this->players = array_map(function ($player) {
            [$hand, $bid] = explode(' ', $player);

            return new Player($bid, new Hand($hand));
        }, explode(PHP_EOL, $contents));
    }

    public function getBidsToThePowerOfRank(): int
    {
        $result = 0;

        usort($this->players, function (Player $playerA, Player $playerB) {
            return (new HandComparisonStrategy($playerA->hand, $playerB->hand))->compare();
        });

        foreach ($this->players as $index => $player) {
            $result += $player->bid * ($index + 1);
        }

        return $result;
    }
}

$calculator = new PokerWinningsCalculator(file_get_contents(__DIR__ . '/input.txt'));
var_dump($calculator->getBidsToThePowerOfRank());