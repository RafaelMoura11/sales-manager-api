<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_cpf',
        'customer_id',
        'product_id',
        'quantity',
        'final_price',
    ];

    // Definindo os relacionamentos
    public function user()
    {
        return $this->belongsTo(User::class, 'user_cpf', 'cpf');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
