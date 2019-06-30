@extends('layouts.master')
@section('content')
    @if(Session::has('reward'))
        @php
        $reward = Session::get('reward');
        @endphp
    @endif
    @if (Session::has('randomNumber'))
        @php
        $randomNumber = Session::get('randomNumber');
        @endphp
    @endif
    <div class=" text-center  m-3 p-5">
        @if (Session::has('success'))
            <div class="alert alert-success alert-block text-center">
                <strong>{{ Session::get('success') }}</strong>
            </div>
        @endif
        <div class="col-lg align-self-center m-3">
            <div class="col-lg " id="firstReward">
                <p>รางวัลที่ 1</p>
                @if (isset($reward))
                    <div class="col-lg mx-auto firstReward-box " id="reward-box">
                        <p class="text-reward">
                            {{$reward['firstReward']}}
                        </p>
                    </div>
                @else
                    {{'-'}}
                @endif

            </div>
            <div class="row">
                <div class="col-lg-6 "id="secondReward">
                    <P>รางวัลที่ 2</P>
                    @if (isset($reward))

                        <div class="row col-lg mx-auto   " id="reward-box">
                            @foreach ($reward['secondReward'] as $key => $secondReward)
                                <div class="col-lg">
                                    <p class="text-reward">
                                        {{$secondReward}}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        {{'-'}}
                    @endif
                </div>
                <div class="col-lg-6" id="thirdReward">
                    <p>รางวัลเลขข้างเคียงรางวัลที่ 1 </p>
                    @if (isset($reward))
                        <div class="col-lg mx-auto row" id="reward-box">
                            @foreach ($reward['thirdReward'] as $key => $thirdReward)
                                <div class="col-lg">
                                    <p class="text-reward">
                                        {{$thirdReward}}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        {{'-'}}
                    @endif
                </div>
            </div>
            <div class="col-lg-12" id ="fourthReward">
                <p>รางวัลเลขท้าย 2 ตัว</p>
                @if (isset($reward))
                    <div class="col-lg-12 mx-auto  row justify-content-center  " id="reward-box">
                        @foreach ($reward['fourthReward'] as $key => $fourthReward)
                            <div class="col-lg-1">
                                <p class="text-reward">
                                    {{$fourthReward}}
                                </p>
                            </div>
                        @endforeach
                    </div>
                @else
                    {{'-'}}
                @endif
            </div>
            <br>
            <a class="text-white" href="{{route('reward.random')}}"><button class="btn btn-primary">  ดำเนินการสุ่มรางวัล </button></a><br>
            <p>หมายเลขของคุณ</p>
            <form class="justify-content-center" action="{{route('reward.check')}}" method="post">
                @csrf
                <input class="form-control  text-center " type="text" name="randomNumber" value="{{$randomNumber}}">
                <br>
                <button type="submit" class="btn btn-primary ">ตรวจเช็คผลรางวัล!</button>
            </form>
        </div>
    </div>
@stop
