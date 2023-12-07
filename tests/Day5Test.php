<?php

use PHPUnit\Framework\TestCase;

require __DIR__ . '/../src/day-7/solution-2.php';

class Day5Test extends TestCase
{

    public function test_cards_are_parsed()
    {
        $hand = new Hand('JJJJK');
        $this->assertSame($hand->getCards(), ['J', 'J', 'J', 'J', 'K']);
    }

    public function test_can_get_ranked_card_list()
    {
        $hand = new Hand('J23456789TQK');
        $this->assertSame($hand->getCardsByWeight(), [1,2,3,4,5,6,7,8,9,10,12,13]);
    }

    public function test_can_get_joker_count()
    {
        $hand = new Hand('J23456789TQK');
        $this->assertSame(1, $hand->getJokerCount());
    }

    public function test_can_get_multiple_joker_count()
    {
        $hand = new Hand('JJJJJ');
        $this->assertSame(5, $hand->getJokerCount());
    }

    public function test_it_should_be_able_to_get_cards_sorted_by_rank()
    {
        $hand = new Hand('J22333444455555666666777777788888888999999999TTTTTTTTTTQQQQQQQQQQQQKKKKKKKKKKKKKAAAAAAAAAAAAAA');

        $result = $hand->getCountedCountedCardsByWeight();

        foreach (CARD_WEIGHTS as $weight) {
            $this->assertSame($weight, $result[$weight]);
        }
    }


    /**
     * @dataProvider comparisonDataProvider
     */
    public function test_comparison(string $handA, string $handB, int $outcome)
    {
        $comparison = new HandComparisonStrategy(new Hand($handA), new Hand($handB));
        $this->assertSame($outcome, $comparison->compare());
    }

    public function comparisonDataProvider(): array
    {
        return [
            ['JAAAA', 'QQQQA', HandComparisonStrategy::HAND_A_WINS],
            ['JQQQA', 'QQQAA', HandComparisonStrategy::HAND_A_WINS],
            ['JQQAA', 'QQQTA', HandComparisonStrategy::HAND_A_WINS],
            ['JQQTA', 'QQTTA', HandComparisonStrategy::HAND_A_WINS],
            ['JQTTA', 'QQT7A', HandComparisonStrategy::HAND_A_WINS],
            ['QQT7A', 'Q8T7A', HandComparisonStrategy::HAND_A_WINS],
            ['AAAJJ', 'AAAAJ', HandComparisonStrategy::HAND_B_WINS],
            ['AAAAA', 'AAAAA', HandComparisonStrategy::DRAW],

            ['32T3K', 'T55J5', HandComparisonStrategy::HAND_B_WINS],
            ['32T3K', 'KK677', HandComparisonStrategy::HAND_B_WINS],
            ['KK677', 'KTJJT', HandComparisonStrategy::HAND_B_WINS],
            ['32T3K', 'QQQJA', HandComparisonStrategy::HAND_B_WINS],

            ['KK677', '32T3K', HandComparisonStrategy::HAND_A_WINS],
            ['KK677', 'T55J5', HandComparisonStrategy::HAND_B_WINS],
            ['KK677', 'KTJJT', HandComparisonStrategy::HAND_B_WINS],
            ['KK677', 'QQQJA', HandComparisonStrategy::HAND_B_WINS],

            ['T55J5', '32T3K', HandComparisonStrategy::HAND_A_WINS],
            ['T55J5', 'KK677', HandComparisonStrategy::HAND_A_WINS],
            ['T55J5', 'KTJJT', HandComparisonStrategy::HAND_B_WINS],
            ['T55J5', 'QQQJA', HandComparisonStrategy::HAND_B_WINS],

            ['KTJJT', '32T3K', HandComparisonStrategy::HAND_A_WINS],
            ['KTJJT', 'KK677', HandComparisonStrategy::HAND_A_WINS],
            ['KTJJT', 'T55J5', HandComparisonStrategy::HAND_A_WINS],
            ['KTJJT', 'QQQJA', HandComparisonStrategy::HAND_A_WINS],

            ['QQQJA', '32T3K', HandComparisonStrategy::HAND_A_WINS],
            ['QQQJA', 'KK677', HandComparisonStrategy::HAND_A_WINS],
            ['QQQJA', 'T55J5', HandComparisonStrategy::HAND_A_WINS],
            ['QQQJA', 'KTJJT', HandComparisonStrategy::HAND_B_WINS],

        ];
    }

    /**
     * @dataProvider inputDataProvider
     */
    public function test_it_should_correctly_determine_the_best_hand(string $input, HandRanking $output)
    {
        $strategy = new HandRankingStrategy(new Hand($input));
        $this->assertSame($output, $strategy->getRanking());
    }

    public function inputDataProvider(): array
    {
        return [
            ['JJJJJ', HandRanking::FIVE_OF_A_KIND],
            ['JJJJA', HandRanking::FIVE_OF_A_KIND],
            ['JJJAA', HandRanking::FIVE_OF_A_KIND],
            ['JJAAA', HandRanking::FIVE_OF_A_KIND],
            ['JAAAA', HandRanking::FIVE_OF_A_KIND],
            ['AAAAA', HandRanking::FIVE_OF_A_KIND],
            ['JJJAJ', HandRanking::FIVE_OF_A_KIND],
            ['JJAAJ', HandRanking::FIVE_OF_A_KIND],
            ['JAAAJ', HandRanking::FIVE_OF_A_KIND],
            ['JAJAA', HandRanking::FIVE_OF_A_KIND],

            ['JJJAT', HandRanking::FOUR_OF_A_KIND],
            ['JJAAT', HandRanking::FOUR_OF_A_KIND],
            ['JAAAT', HandRanking::FOUR_OF_A_KIND],
            ['ATJJJ', HandRanking::FOUR_OF_A_KIND],
            ['AATJJ', HandRanking::FOUR_OF_A_KIND],
            ['AAATJ', HandRanking::FOUR_OF_A_KIND],
            ['AAAAT', HandRanking::FOUR_OF_A_KIND],

            ['AATTT', HandRanking::FULL_HOUSE],
            ['JAATT', HandRanking::FULL_HOUSE],
            ['AAJTT', HandRanking::FULL_HOUSE],
            ['AATTJ', HandRanking::FULL_HOUSE],

            ['AAATK', HandRanking::THREE_OF_A_KIND],
            ['JAATK', HandRanking::THREE_OF_A_KIND],
            ['JJATK', HandRanking::THREE_OF_A_KIND],
            ['AAJTK', HandRanking::THREE_OF_A_KIND],
            ['ATJJK', HandRanking::THREE_OF_A_KIND],

            ['AATTK', HandRanking::TWO_PAIR],

            ['JATKQ', HandRanking::ONE_PAIR],
            ['ATKQJ', HandRanking::ONE_PAIR],
            ['AAKQ4', HandRanking::ONE_PAIR],

            ['23456', HandRanking::HIGH_CARD],
        ];
    }
}