<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'subtotal',
        'shipping_cost',
        'total_amount',
        'status',
        'payment_status',
        'payment_method',
        'notes',
        'paid_at',
        'shipped_at',
        'delivered_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime',
    ];

    // Relationships
    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }

    // Helper method untuk akses products lewat items
    public function products()
    {
        return $this->hasManyThrough(
            Product::class,
            TransactionItem::class,
            'transaction_id', // FK on transaction_items
            'id', // FK on products
            'id', // Local key on transactions
            'product_id' // Local key on transaction_items
        );
    }

    // Generate order number otomatis
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            if (empty($transaction->order_number)) {
                $transaction->order_number = 'ORD-' . date('Ymd') . '-' . strtoupper(uniqid());
            }
        });
    }

    // Status badge color helpers
    public function getStatusBadgeColor()
    {
        return match($this->status) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'processing' => 'bg-blue-100 text-blue-800',
            'shipped' => 'bg-purple-100 text-purple-800',
            'delivered' => 'bg-green-100 text-green-800',
            'cancelled' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getPaymentStatusBadgeColor()
    {
        return match($this->payment_status) {
            'unpaid' => 'bg-red-100 text-red-800',
            'paid' => 'bg-green-100 text-green-800',
            'refunded' => 'bg-gray-100 text-gray-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    // Helper untuk total items
    public function getTotalItemsAttribute()
    {
        return $this->items->sum('quantity');
    }
}