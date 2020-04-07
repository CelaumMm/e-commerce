<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reference', 'pagseguro_status', 'pagseguro_code', 'store_id', 'items'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Ligação de muitos para muitos
     *
     * @return void
     */
    public function stores()
    {
        return $this->belongsToMany(Store::class, 'order_store', 'order_id');
    }
}
