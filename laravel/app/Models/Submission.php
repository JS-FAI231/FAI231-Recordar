<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Submission
 *
 * @property $id
 * @property $comentario
 * @property $demand_id
 * @property $title_id
 * @property $user_id
 * @property $rating
 * @property $created_at
 * @property $updated_at
 *
 * @property Demand $demand
 * @property Title $title
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Submission extends Model
{
    
    static $rules = [
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['comentario','demand_id','title_id','user_id','rating'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function demand()
    {
        return $this->hasOne('App\Models\Demand', 'id', 'demand_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function title()
    {
        return $this->hasOne('App\Models\Title', 'id', 'title_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    

}
