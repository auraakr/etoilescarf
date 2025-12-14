<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_category',
        'name',
        'description',
        'material',
        'size',
        'original_price',
        'sale_price',
        'is_on_sale',
        'sale_start_date',
        'sale_end_date',
        'main_image',
        'availability',
        'is_featured',
        'stock',
    ];

    protected $casts = [
        'is_on_sale' => 'boolean',
        'availability' => 'boolean',
        'is_featured' => 'boolean',
        'sale_start_date' => 'datetime',
        'sale_end_date' => 'datetime',
        'original_price' => 'decimal:2',
        'sale_price' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });
    }

    public function category()
    {
        return $this->belongsTo(ProductCategories::class, 'id_category');
    }

    // Cek apakah sedang sale
    public function isOnSale()
    {
        if (!$this->is_on_sale) {
            return false;
        }

        $now = now();
        
        if ($this->sale_start_date && $now->lt($this->sale_start_date)) {
            return false;
        }

        if ($this->sale_end_date && $now->gt($this->sale_end_date)) {
            return false;
        }

        return true;
    }

    // Get harga final (harga sale atau harga normal)
    public function getFinalPrice()
    {
        return $this->isOnSale() && $this->sale_price 
            ? $this->sale_price 
            : $this->original_price;
    }

    // Hitung persentase diskon
    public function getDiscountPercentage()
    {
        if (!$this->isOnSale() || !$this->sale_price) {
            return 0;
        }

        return round((($this->original_price - $this->sale_price) / $this->original_price) * 100);
    }
}