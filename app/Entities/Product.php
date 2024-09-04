<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Product.
 *
 * @package namespace App\Entities;
 */
class Product extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'name', 'description', 'index', 'interest_rate', 'instituition_id'
    ];

    public function instituition(){
        return $this->belongsTo(Instituition::class);

    }

    public function valueFromUser(User $user)
    {
        
        $inflows = $this->moviments()->product($this)->application()->sum('value');

     
        return $inflows;
     
    }
    public function moviments()
    {
        return $this->hasMany(Moviment::class);
    }
}
