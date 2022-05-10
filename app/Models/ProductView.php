<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductView extends Model
{
    use HasFactory;

    public static function createViewLog($item, $request) {
        $logViews = new ProductView();
        $logViews->product_id = $item->id;
        $logViews->url = $request->url();
        $logViews->session_id = $request->session()->getId();
        $logViews->ip = $request->ip();
        $logViews->agent = $request->header('user-agent');
        $logViews->save();
    }

    /**
     * Get the product_log that owns the ProductView
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product_log()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
