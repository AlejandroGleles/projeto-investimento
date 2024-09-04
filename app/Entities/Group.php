<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Group.
 *
 * @package namespace App\Entities;
 */
class Group extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'user_id','instituition_id'];

    public function getTotalValueAttribute()
    {
        $total = 0;
        foreach ($this->moviments as $moviment) 
        $total+=$moviment->value;

        return $total;
    }

    public function owner()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class,'user_groups');
    }

   /* public  Instituition()*/
    public function Instituition()
    {
        return $this->belongsTo(Instituition::class);
    }
    public function moviments()
    {
        return $this->hasMany(Moviment::class);
    }

}
