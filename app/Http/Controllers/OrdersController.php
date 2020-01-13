<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Order;
use App\Ticket;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する
          $tickets = Ticket::where('ticket_title', 'LIKE', "%$cond_title%")->get();
      } else {
          // それ以外はすべてのチケットを取得する
          $tickets = Ticket::all()->sortByDesc('updated_at');;
      }

        // tickets/index.blade.php ファイルを渡している
        // また View テンプレートに  orders、という変数を渡している
        return view('orders.index', ['tickets' => $tickets, 'cond_title' => $cond_title]);
    }
    
    public function create(Request $request)
    {
        // Varidationを行う
        
        $this->validate($request, Order::$rules);
        $order = new Order;
        $user = Auth::user();
        $form = $request->all();
        $order->user_id = $user->id;

        unset($form['_token']);
        
        // データベースに保存する
        $order->fill($form);
        $order->save();
        
        return view('orders.complete');
       
    }
    public function confirm(Request $request)
    {
        $form = $request->all();
        $order = new Order;
        $ticket = Ticket::find($form["ticket_id"]);
        $order->ticket_id = $ticket->id;
        $order->number = $form["number"];
        $order->user_id = Auth::user()->id;
        // dd($ticket);
        return view('orders.confirm',["order" => $order, "ticket" => $ticket]);
       
    }
    public function complete(Request $request)
    {
        $form = $request->all();
        $order = new Order;
        $ticket = Ticket::find($form["ticket_id"]);
        $order->ticket_id = $ticket->id;
        $order->number = $form["number"];
        $order->user_id = Auth::user()->id;
        
        $order->save();
        
        return view('orders.complete',["order" => $order, "ticket" => $ticket]);
       
    }
    public function history(Request $request)
    {
       $user = Auth::user();
        
        
        $orders = Order::where('user_id',$user->id)->orderBy('created_at','desc')->paginate(10); 
        
        return view('orders.history', ['orders' => $orders,'user' => $user]);
    }
}
