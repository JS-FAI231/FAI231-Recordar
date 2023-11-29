<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Visit
 *
 * @property $id
 * @property $created_at
 * @property $updated_ar
 * @property $title_id
 * @property $comentario
 *
 * @property Title $title
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Visit extends Model
{
    
    static $rules = [
		'comentario' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['updated_ar','title_id','comentario'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function title()
    {
        return $this->hasOne('App\Models\Title', 'id', 'title_id');
    }
    

}
