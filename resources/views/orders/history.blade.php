@extends('layouts.front')
@section('title', '購入履歴')

@section('content')
  <div class="container">
    <div class="card">
      <div class="card-header">
        <span>プロフィール情報</span>
      </div>
      <div class="card-body">
        <strong>お名前</strong>
        <p>{{ $user->name }}</p>
        
        <strong>メールアドレス</strong>
        <p>{{ $user->email }}</p>
        <a href="#" class="btn btn-sm btn-success">編集</a>
      </div>
    </div>
    <h3 class="mt-2">{{ $user->name }}様の購入履歴</h3>
    <div class="row">
     <div class="list-news col-md-12 mx-auto">
        <div class="row">
          <table class="table">
            <thead>
              <tr>
                <th width="5%">購入日</th>
                <th width="15%">チケット名</th>
                <th width="3%">枚数</th>
              </tr>
            </thead>
            <tbody>
              @foreach($orders as $order)
                <tr>
                    <th>{{ $order->created_at->format('Y年m月d日') }}</th>
                    <td>{{ $order->ticket->ticket_title }}</td>
                    <th>{{ $order->number }}</th>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        {{ $orders->links() }}
    </div>
</div>
@endsection