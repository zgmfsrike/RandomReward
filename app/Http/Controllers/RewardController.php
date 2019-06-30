<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RewardService;
use App\Services\CheckRewardService;
use Illuminate\Support\Facades\Session;
class RewardController extends Controller
{
    public function __construct()
    {
        $this->service = new RewardService;
        $this->checkReward = new CheckRewardService;
        $this->rewardIndex = config('view.reward.index');

    }

    public function index(){
        // Session::flush();
        return view($this->rewardIndex);
    }

    public function randomReward()
    {
        $randomNumber = $this->service->random3DigitNumber();
        $reward = $this->service->generateReward();
        session(['randomNumber'=>$randomNumber,'reward'=>$reward]);
        return redirect()->back();
    }

    public function checkReward(Request $request)
    {
        $reward = Session::get('reward');
        $randomNumber = $request->input('randomNumber');
        $result =$this->checkReward->check($reward,$randomNumber);
        $message =  "หมายเลข ".$randomNumber." ถูก".$result."!";
        return redirect()->back()->with('success',$message);

    }
}
