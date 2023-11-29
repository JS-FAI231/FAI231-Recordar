<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Folder
 *
 * @property $id
 * @property $nombre
 * @property $user_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Wish[] $wishes
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Folder extends Model
{
    
    static $rules = [
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','user_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wishes()
    {
        return $this->hasMany('App\Models\Wish', 'folder_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
     public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

}
