<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $primaryKey = 'id'; 
    public $incrementing = false; 

    protected $fillable = ['id', 'card_number', 'balance'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    //ligar à tabela operations (um-vários)
    public function operations()
    {
        return $this->hasMany(Operations::class, 'card_id');
    }
}
