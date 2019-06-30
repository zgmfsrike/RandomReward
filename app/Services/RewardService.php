<?php
namespace App\Services;

/**
*
*/
class RewardService
{
    public function __construct()
    {
        $this->rewardTaken = [];
        $this->rewardTaken2Digit = [];
        $this->reward = [];
    }
    public function generateReward()
    {
        $firstReward = $this->firstReward();
        $secondReward = $this->secondReward();
        $thirdReward = $this->thirdReward($firstReward);
        $fourthReward = $this->fourthReward();

        $this->reward['firstReward'] = $firstReward;
        $this->reward['secondReward'] = $secondReward;
        $this->reward['thirdReward'] = $thirdReward;
        $this->reward['fourthReward'] = $fourthReward;

        return $this->reward;
    }

    public function random3DigitNumber()
    {
        $number = sprintf("%03d", mt_rand(000, 999));
        return $number;
    }

    public function random2DigitNumber()
    {
        $number = sprintf("%02d", mt_rand(00, 99));
        return $number;
    }

    public function randomNumberWithCounter($digit,$counter)
    {
        $allNumber = [];
        $index = 0;
        while ($index < $counter) {
            switch ($digit) {
                case 2:
                $number = $this->random2DigitNumber();
                $array = $this->rewardTaken2Digit;
                break;

                case 3:
                $number = $this->random3DigitNumber();
                $array = $this->rewardTaken;
                break;

                default:
                $number = $this->random3DigitNumber();
                $array = $this->rewardTaken;
                break;
            }
            if(!in_array($number, $array)){
                array_push($allNumber,$number);
                array_push($array,$number);
                $index++;
            }
        }
        return $allNumber;
    }
    //first reward == match all 3 digits, 1 etc
    public function firstReward()
    {
        $firstRewardNumber = $this->random3DigitNumber();
        array_push($this->rewardTaken, $firstRewardNumber);
        return $firstRewardNumber;
    }
    //second reward == match last 3 digits, 3 etc
    public function secondReward()
    {
        $secondReward =  $this->randomNumberWithCounter(3,3);
        return $secondReward;
    }
    //third reward == match +1 and -1 of first reward, 2 etc
    public function thirdReward($firstRewardNumber)
    {
        $thirdReward = [];
        array_push($thirdReward, sprintf("%03d",$firstRewardNumber+1 ));
        array_push($thirdReward, sprintf("%03d",$firstRewardNumber-1 ));
        return $thirdReward;
    }

    //fourth reward == match last 2 digits, 10 etc
    public function fourthReward()
    {
        $fourthReward =  $this->randomNumberWithCounter(2,10);
        return $fourthReward;
    }

    public function mock()
    {
        $allReward = [
            'firstReward'=>[
                '147'
            ],
            'secondReward'=>[
                '456','895','854'
            ],
            'thridReward'=>[
                '121','002'
            ],
            'fourthReward'=>[
                '111','325','332','774','556',
                '327','445','385','117','995'
            ]
        ];
        return $allReward;
    }
}


?>
