<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Title
 *
 * @property $id
 * @property $artista
 * @property $titulo
 * @property $format_id
 * @property $country_id
 * @property $catalogo
 * @property $sello
 * @property $style_id
 * @property $released
 * @property $creditos
 * @property $notas
 * @property $review
 * @property $version_id
 * @property $valoracion
 * @property $created_at
 * @property $updated_at
 *
 * @property Country $country
 * @property Format $format
 * @property Image[] $images
 * @property Style $style
 * @property Submission[] $submissions
 * @property Track[] $tracks
 * @property Visit[] $visits
 * @property Wish[] $wishes
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Title extends Model
{
    
    static $rules = [
    ];

    protected $perPage = 12;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['artista','titulo','format_id','country_id','catalogo','sello','style_id','released','creditos','notas','review','version_id','valoracion'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function country()
    {
        return $this->hasOne('App\Models\Country', 'id', 'country_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function format()
    {
        return $this->hasOne('App\Models\Format', 'id', 'format_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany('App\Models\Image', 'title_id', 'id');
    }
    
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
        return $this->hasMany('App\Models\Submission', 'title_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tracks()
    {
        return $this->hasMany('App\Models\Track', 'title_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function visits()
    {
        return $this->hasMany('App\Models\Visit', 'title_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wishes()
    {
        return $this->hasMany('App\Models\Wish', 'title_id', 'id');
    }
    

}
