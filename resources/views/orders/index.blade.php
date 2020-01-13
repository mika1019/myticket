@extends('layouts.front')

@section('content')
    <div class="container">
        <div class="row">
            <h2>ライブチケット販売サイト</h2>
        </div>
        <hr color="#c0c0c0">
        
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('OrdersController@history') }}" role="button" class="btn btn-primary">マイページ</a>
            </div>
            <div class="col-md-8">
                <form action="{{ action('OrdersController@index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">チケット名検索</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
                        </div>
                        <div class="col-md-2">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
            <div class="orders col-md-8 mx-auto mt-3">
                @foreach($tickets as $ticket)
                    <div class="order">
                        <div class="row">
                            <div class="text col-md-6">
                                <div class="date">
                                    {{ $ticket->updated_at->format('Y年m月d日') }}
                                </div>
                                <div class="title">
                                    {{ str_limit($ticket->ticket_title, 100) }}
                                    <p>金額:{{ $ticket->price }}円
                                        在庫状況:
                                        @if ( $ticket->stock >= 100)
                                        ◯
                                        @elseif( $ticket->stock >= 1)
                                        △
                                        @else
                                        ✕
                                        @endif
                                    </p>
                                </div>
                                <form action="{{ action('OrdersController@confirm') }}" method="POST" enctype="multipart/form-data">
                                    @if( $ticket->stock == 1)
                                            <select id="number" name="number">
                                            <option value="1" class="number1">枚数: 1枚</option>
                                            </select>
                                        @elseif( $ticket->stock == 0)
                                            選択不可
                                        @else
                                            <select id="number" name="number">
                                            <option value="1" class="number1">枚数: 1枚</option>
                                            <option value="2" class="number2">枚数: 2枚</option>
                                            </select>
                                        @endif
                                            <input type="hidden" value="{{$ticket->id}}" name="ticket_id">
                                        {{ csrf_field() }}
                                        @if( $ticket->stock == 0)
                                            <input type="submit" class="btn btn-primary" value="SOLD OUT" disabled>
                                        @endif
                                    <div class="image col-md-6 text-right mt-4">
                                        @if ($ticket->image_path)
                                            <img src="{{ $ticket->image_path }}">
                                        @endif
                                    </div>
                                    <input type="submit" class="btn btn-primary" value="購入">
                                </form>
                            </div>
                        </div>
                    </div>
                    <hr color="#c0c0c0">
                @endforeach
            </div>
        </div>
    </div>
    </div>
@endsection