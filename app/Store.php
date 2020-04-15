<?php

namespace App;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\StoreReceiveNewOrder;

class Store extends Model
{
    use HasSlug;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'phone', 'mobile_phone', 'slug', 'logo'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Ligação de 1 para muitos
     *
     * @return void
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Ligação de muitos para muitos - Essa loja tem muitos pedidos
     *
     * @return void
     */
    public function orders()
    {
        return $this->belongsToMany(UserOrder::class, 'order_store', 'store_id', 'order_id');
    }

    /**
     * Atraves das lojas pegar o dono atraves do relacionamento e enviar a notificação StoreReceiveNewOrder
     *
     * @param array $storesId
     * @return void
     */
    public function notifyStoreOwners(array $storesId = [])
    {
        $stores = \App\Store::whereIn('id', $storesId)->get(); 

        // com o each retorna as lojas e seus donos
        // return $stores->each(function($store){
        //     return $store->user;
        // });

        // Atraves das lojas pegou o dono atraves da ligação 
        $stores->map(function($store){
            return $store->user;
        })->each->notify(new StoreReceiveNewOrder());;
    }
}
