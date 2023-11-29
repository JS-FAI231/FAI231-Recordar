<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Wish
 *
 * @property $id
 * @property $user_id
 * @property $title_id
 * @property $folder_id
 * @property $valoracion
 * @property $created_at
 * @property $updated_at
 *
 * @property Folder $folder
 * @property Title $title
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Wish extends Model
{
    
    static $rules = [
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','title_id','folder_id','valoracion'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function folder()
    {
        return $this->hasOne('App\Models\Folder', 'id', 'folder_id');
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
