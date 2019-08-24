@extends('layouts.app')

@include('common.header')

@section('content')
<!-- <div class="form-container">
    <form id="post_form" name="form">
        @csrf
        <div class="error-msg">
            <span class="js-error-msg-peoples"></span>
        </div>
        <div class="entry-area">
            <div class="title">人数<span style="color:red;">（必須）</span></div>
            <div>
                <div>
                    <label for="peoples">
                        <input id="peoples" type="num" name="peoples" placeholder="人数">
                    </label>
                </div>
            </div>
        </div>

        <div class="error-msg">
            <span class="js-error-msg-seat_id"></span>
        </div>
        <div class="entry-area">
            <div class="title">座席</div>
            <label for="seat">
                <select id="seat" name="seat_id">
                    <option value="1">テーブル席</option>
                    <option value="2">ボックス席</option>
                    <option value="3">カウンター席</option>
                    <option value="4">どこでも可</option>
                </select>
            </label>
        </div>

        <div class="error-msg">
            <span class="js-error-msg-smoke_id"></span>
        </div>
        <div class="entry-area">
            <div class="title">タバコ</div>
            <div>
                <div>
                    <label>
                        <input id="smoke" name="smoke_id" type="radio" value="1" checked>喫煙席
                    </label>
                </div>
                <div>
                    <label>
                        <input id="smoke" name="smoke_id" type="radio" value="2">禁煙席
                    </label>
                </div>
                <div>
                    <label>
                        <input id="smoke" name="smoke_id" type="radio" value="3">どちらでも可
                    </label>
                </div>
            </div>
        </div>

        <div class="error-msg">
            <span class="js-error-msg-tell_number"></span>
        </div>
        <div class="entry-area">
            <div class="title">電話番号</div>
            <div>
                <div>
                    <label for="tell">
                        <input id="tell" type="text" name="tell_number" placeholder="000-0000-0000（任意）">
                    </label>
                </div>
            </div>
        </div>

        <div class="btn-container">
            <button id="form-submit" type="submit">確認</button>
        </div>
    </form>
</div> -->
<reception-form-component></reception-form-component>
@endsection