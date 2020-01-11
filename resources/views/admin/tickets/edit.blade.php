{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')
@section('title', 'チケットの編集画面')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>チケット編集画面</h2>
                <form action="{{ action('Admin\TicketsController@create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">チケット名</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="ticket_title" value="{{ $tickets_form->ticket_title }}">
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label class="col-md-2">詳細</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="body" rows="20">{{ $tickets_form->body }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">チケット残数</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="stock" value="{{ $tickets_form->stock }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">金額</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="price" value="{{ $tickets_form->price }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                            <div class="form-text text-info">
                                設定中: {{ $tickets_form->image_path }}
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $tickets_form->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
                        