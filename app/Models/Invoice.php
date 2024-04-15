<?php

namespace App\Models;

use App\Models\Auth\User;
use App\Models\Auth\Order;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model{
    protected $guarded = [];

    protected $fillable = [
        'pdf_content',
    ];

    protected $dateFormat = 'Y-m-d\TH:i';

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function binary(){
        return $this->hasOne(InvoiceBinary::class, 'pdf_reference_uuid', 'pdf_reference_uuid');
    }
}
