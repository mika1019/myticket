<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = array('id');

    // 以下を追記
    public static $rules = array(
        'ticket_id' => 'required',
        'number' => 'required',
    );
    // Orderモデルに関連付けを行う
    public function ticket()
    {
      return $this->belongsTo('App\Ticket');

    }
    public function user()
    {
      return $this->belongsTo('App\User');

    }
    public function history()
    {
      return $this->hasMany('App\User');

    }
}
