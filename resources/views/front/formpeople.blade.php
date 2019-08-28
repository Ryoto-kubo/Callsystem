@extends('layouts.app')

@include('common.header', ['title' => '人数を入力してください'])

@section('content')
    <form-input-peoples></form-input-peoples>
@endsection