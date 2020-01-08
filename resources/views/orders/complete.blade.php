@extends('layouts.front')
@section('title', '申込完了')

@section('content')
<div class="container">
    <hr color="#c0c0c0">
    <form action="{{ action('OrdersController@complete') }}" method="GET" enctype="multipart/form-data">
    <h3>申し込み完了しました。</h3>
    <ul style="font-size:18px; list-style: none;">
        <li>お名前：{{ $order->user->name }}様</li>
        <li>チケット名：{{ $ticket->ticket_title }}</li>
        <li>枚数：{{ $order->number }}枚</li>
        <li>チケット料金：{{ number_format($ticket->price) }}円</li>
        <li>合計：{{ number_format(intval($order->number) * intval($ticket->price))  }}円</li>
    </ul>
    {{ csrf_field() }}
    </form>
</div>
@endsection