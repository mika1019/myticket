<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 以下を追記することでTickets Modelが扱えるようになる
use App\Ticket;



class TicketsController extends Controller
{
    public function add()
  {
      return view('admin.tickets.create');
  }

// 以下を追記
  public function create(Request $request)
  {
      // 以下を追記
      // Varidationを行う
      $this->validate($request, Ticket::$rules);

      $tickets = new Ticket;
      $form = $request->all();

      // フォームから画像が送信されてきたら、保存して、$tickets->image_path に画像のパスを保存する
      if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $tickets->image_path = basename($path);
      } else {
          $tickets->image_path = null;
      }

      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      // フォームから送信されてきたimageを削除する
      unset($form['image']);

      // データベースに保存する
      $tickets->fill($form);
      $tickets->save();
      
      // admin/tickets/createにリダイレクトする
      return redirect('admin/tickets/create');
  }  
  // 以下を追記
  public function index(Request $request)
  {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する
          $posts = Ticket::where('title', $cond_title)->get();
      } else {
          // それ以外はすべてのニュースを取得する
          $posts = Ticket::all();
      }
      return view('admin.tickets.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }
  public function edit(Request $request)
  {
      // Tickets Modelからデータを取得する
      $tickets = Ticket::find($request->id);
      if (empty($tickets)) {
        abort(404);    
      }
      return view('admin.tickets.edit', ['tickets_form' => $tickets]);
  }


  public function update(Request $request)
  {
      // Validationをかける
      $this->validate($request, Ticket::$rules);
      // Tickets Modelからデータを取得する
      $tickets = Tickets::find($request->id);
      // 送信されてきたフォームデータを格納する
      $tickets_form = $request->all();
      if (isset($tickets_form['image'])) {
        $path = $request->file('image')->store('public/image');
        $tickets->image_path = basename($path);
        unset($tickets_form['image']);
      } elseif (isset($request->remove)) {
        $tickets->image_path = null;
        unset($tickets_form['remove']);
      }
      unset($tickets_form['_token']);

      // 該当するデータを上書きして保存する
      $tickets->fill($tickets_form)->save();
      
      return redirect('admin/tickets');
  }
  public function delete(Request $request)
  {
      // 該当するTickets Modelを取得
      $tickets = Ticket::find($request->id);
      // 削除する
      $tickets->delete();
      return redirect('admin/tickets/');
  }  
}

