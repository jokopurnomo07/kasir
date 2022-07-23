<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    
    protected $guarded = ["id"];

    /**
     * Get the user that owns the Kategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function produk()
    {
        return $this->hasMany(Product::class);
    }
}
