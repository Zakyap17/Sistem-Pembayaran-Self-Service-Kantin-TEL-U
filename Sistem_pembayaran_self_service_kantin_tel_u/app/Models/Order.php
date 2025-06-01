<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\OrderDetail;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'total_amount',
    ];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function details() {
        return $this->hasMany(OrderDetail::class);
    }
}
