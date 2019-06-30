<?php
namespace App\Services;
/**
*
*/
class CheckRewardService
{

    public function check($reward, $randomNumber)
    {
        $rewardResult = [];
        $rewardResult['firstReward'] = $this->checkFirstReward($reward['firstReward'],$randomNumber);
        $rewardResult['secondReward'] = $this->checkReward($reward['secondReward'], $randomNumber);
        $rewardResult['thirdReward'] = $this->checkReward($reward['thirdReward'], $randomNumber);
        $rewardResult['fourthReward'] = $this->checkFourthReward($reward['fourthReward'], $randomNumber);
        return $this->messageResult($rewardResult);
    }

    public function checkReward($reward, $randomNumber)
    {
        if (in_array($randomNumber,$reward)) {
            return true;
        }else {
            return false;
        }
    }
    public function checkFirstReward($reward, $randomNumber)
    {
        if($reward == $randomNumber ){
            return true;
        }else {
            return false;
        }
    }

    public function checkFourthReward($reward,$randomNumber)
    {
        $randomNumber = substr($randomNumber, 1);
        return $this->checkReward($reward, $randomNumber);
    }

    public function messageResult($rewardResult)
    {
        if(in_array(true,$rewardResult)){
            $text = "";
            $counter = 1;
            foreach ($rewardResult as $key => $value) {
                switch ($key) {
                    case 'firstReward':
                    $reward = "รางวัลที่1";
                    break;
                    case 'secondReward':
                    $reward = "รางวัลที่2";
                    break;
                    case 'thirdReward':
                    $reward = "รางวัลเลขข้างเคียงรางวัลที่1";
                    break;
                    case 'fourthReward':
                    $reward = "รางวัลเลขท้าย2ตัว";
                    break;
                    default:
                    $reward = "";
                    break;
                }
                if($value == true){
                    if($counter > 1){
                    $text .= " ";
                    }
                    $text .= $reward;
                    $counter++;

                }
            }
            // $text = substr($text, 1);
            //
            // dd($text);
            $text = str_replace(" ", ",", $text);
            return $text;
        }else {
            return "ไม่ถูกรางวัลใดเลย";
        }





    }

}




?>
