<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'courier_id',
        'from_address',
        'to_address',
        'description',
        'status',
        'assigned_at'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function courier()
    {
        return $this->belongsTo(\App\Models\User::class, 'courier_id');
    }
}
