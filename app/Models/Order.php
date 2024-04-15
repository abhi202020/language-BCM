<?php

namespace App\Models;

use App\Models\Auth\User;
use App\Models\Auth\Invioce;
use App\Models\Stripe\StripePlan;
use App\Models\stripe\UserCourses;
use Illuminate\Database\Eloquent\Model;

class Order extends Model{
    protected $guarded = [];
    protected $dateFormat = 'Y-m-d\TH:i';

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function items(){
        return $this->hasMany(OrderItem::class);
    }

    public function invoice(){
        return $this->hasOne(Invoice::class);
    }

    public function coupon(){
        return $this->belongsTo(Coupon::class);
    }

    public function plan(){
        return $this->hasOne(StripePlan::class, 'id', 'plan_id');
    }

    public function getInvoicePdfContent(){
        if ($this->invoice) {
            return $this->invoice->pdf_content;
        }
        return null;
    }
}
