@extends('layouts.app')

@section('content')

    @foreach($reception_objects as $reception_object)
    <div class="form-area">
        <form id="reseption{{$reception_object['id']}}" class="form">
        @csrf
        <div class="id">{{$reception_object['id']}}</div>
        <div>{{$reception_object['name']}}</div>
        <div>{{$reception_object['tell_number']}}</div>
        <div>
            <button type="submit" form="reseption{{$reception_object['id']}}">削除</button>
        </div>
        </form>
    </div>
    @endforeach
@endsection