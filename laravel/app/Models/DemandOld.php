<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Demand
 *
 * @property $id
 * @property $user_id
 * @property $nombre
 * @property $status
 * @property $style_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Style $style
 * @property Submission[] $submissions
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Demand extends Model
{
    
    static $rules = [
		'status' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','nombre','status','style_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function style()
    {
        return $this->hasOne('App\Models\Style', 'id', 'style_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function submissions()
    {
        return $this->hasMany('App\Models\Submission', 'demand_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    

}
