<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_item_id',
        'quantity',
    ];

    /**
     * A cart belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A cart belongs to a product item.
     */
    public function productItem()
    {
        return $this->belongsTo(ProductItem::class);
    }
}
