<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'ticket_title' => 'required',
        'body' => 'required',
        'stock' => 'required',
        'price' => 'required',
    );
     public function orders()
    {
      return $this->hasMany('App\Order');

    }
}
