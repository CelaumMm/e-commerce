<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['image'];

    /**
     * Relacionamento de 1:1 ( 1 imagem pertence a 1 produto )
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
