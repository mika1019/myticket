@extends('layouts.front')
@section('title', '申込確認画面')

@section('content')
<div class="container">
    <div class="row">
        <h2>チケット確認</h2>
    </div>
    <hr color="#c0c0c0">
  
    <form method="POST" action="{{action('OrdersController@complete')}}">
        <div class ="row col-md-12">
            <div class="col-md-6">
                <h3>申込内容</h3>
                <ul>
                    <li>チケット名：{{$ticket->ticket_title }}</li>
                    <li>枚数：{{ $order->number }}</li>
                    <li>チケット料金：{{ number_format($ticket->price) }}円</li>
                    <li>合計：{{ number_format(intval($order->number) * intval($ticket->price))  }}円</li>
                </ul>
            </div>
            <div class="col-md-6">
                <h3>お客様情報</h3>
                <ul>
                    <li>お名前：{{ $order->user->name }}</li>
                    <li>E-Mail：{{ $order->user->email }}</li>
                </ul>
            </div>
            <input type="submit" class="btn btn-primary" value="購入">
            <input type="hidden" value="{{ $order->ticket_id }}" name="ticket_id">
            <input type="hidden" value="{{ $order->user->id }}" name="user_id">
            <input type="hidden" value="{{ $order->number }}" name="number">
    　  </div>
    　  {{ csrf_field()}}
    </form>
</div>
　
@endsection