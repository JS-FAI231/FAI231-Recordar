<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Image
 *
 * @property $id
 * @property $title_id
 * @property $path
 * @property $filename
 * @property $created_at
 * @property $updated_at
 *
 * @property Title $title
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Image extends Model
{
    
    static $rules = [
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title_id','path','filename'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function title()
    {
        return $this->hasOne('App\Models\Title', 'id', 'title_id');
    }
    

}
