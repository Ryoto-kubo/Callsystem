@extends('layouts.app')

@section('content')
<div class="container">
    <div class="top-container">
        <div class="fade-down">
            <div class="number-container">
                <div class="img-container">
                    <div class="img-area">
                        <img src="images/people.png" alt="">
                    </div>
                </div>
                <div class="peoples-container">
                    <div class="waiting-group">
                        現在の待ち組数
                    </div>
                    <div class="peoples-group-container">
                        <span class="peoples-group">
                            <reception-get-component></reception-get-component>
                        </span>
                        <div class="text-area">
                            <div class="group">
                                組
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="link-area">
            <button class="btn-container" type="button" onclick="location.href='/reception/form'">受付する</button>
        </div>
    </div>
    <div class="bottom-container">
        <div class="fade-up">
            <div class="infomation-container">
                <div class="infomation-area">
                    <p class="infomation-text">現在呼び出し中の番号はこちらの番号です</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection