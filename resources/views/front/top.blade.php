@extends('layouts.app')

@section('content')
<div class="container">
    <div class="number-container">
        <div class="peoples-group-container">
            <span class="peoples-group">
                <reception-get-component></reception-get-component>
            </span>
            <div class="text-area">
                <div class="group">
                    組
                </div>
                <div class="waiting">
                    待ち
                </div>
            </div>
        </div>
        <div class="waiting-time-container">
            <div class="text-area">
                待ち時間約
                <div class="waiting-container">
                    <span class="time">
                        <reception-get-min-component></reception-get-min-component>
                    </span>
                    <span class="minits">分</span>
                </div>
            </div>
        </div>
    </div>
    <div class="link-area">
        <a href="/reception/form">
            <div class="btn-container">受付開始</div>
        </a>
        <p class="tell-notice">電話でのお呼び出しも行なっております</p>
    </div>
</div>
@endsection