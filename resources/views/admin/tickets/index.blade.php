@extends('layouts.admin')
@section('title', 'チケット一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>チケット一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('Admin\TicketsController@add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            <div class="col-md-8">
                <form action="{{ action('Admin\TicketsController@index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">チケット名</label>
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
        </div>
        <div class="row">
            <div class="list-tickets col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">チケット名</th>
                                <th width="50%">本文</th>
                                <th width="10%">チケット残数</th>
                                <th width="20%">金額</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $tickets)
                                <tr>
                                    <th>{{ $tickets->id }}</th>
                                    <td>{{ \Str::limit($tickets->ticket_title, 100) }}</td>
                                    <td>{{ \Str::limit($tickets->body, 250) }}</td>
                                    <td>{{ \Str::limit($tickets->stock, 20) }}</td>
                                    <td>{{ \Str::limit($tickets->price, 60) }}</td>
                                    <td>
                                      <div>
                                            <a href="{{ action('Admin\TicketsController@edit', ['id' => $tickets->id]) }}">編集</a>
                                      </div>
                                      <div>
                                            <a href="{{ action('Admin\TicketsController@delete', ['id' => $tickets->id]) }}">削除</a>
                                      </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection