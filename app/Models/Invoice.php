<?php

namespace App\Models;

use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = []; 

    public static function rules($id = null)
    {
        return[
            'id' =>[
                'required',
                'numeric',
                Rule::exists('invoices','id'),
                Rule::unique('invoices','id')->ignore($id)
            ],
        ];
    }
    
    public function getTaxAttribute()
    {
        return $this->total * 10 / 100; 
    }
    
    public function getTotalPriceAttribute()
    {
        return $this->total + $this->total * 10 / 100;
    }

    public function getAmountDueAttribute()
    {
        return $this->total  + $this->total * 10/100 - $this->total_paid;
    }
    
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function detail()
    {
        return $this->hasMany(Invoice_detail::class);
    }
}
