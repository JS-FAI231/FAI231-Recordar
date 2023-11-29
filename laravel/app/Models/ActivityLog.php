<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ActivityLog
 *
 * @property $id
 * @property $log_name
 * @property $description
 * @property $subject_type
 * @property $event
 * @property $subject_id
 * @property $causer_type
 * @property $causer_id
 * @property $properties
 * @property $batch_uuid
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ActivityLog extends Model
{
    
    static $rules = [
		'description' => 'required',
    ];
    
    protected $table = 'activity_log';
    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['log_name','description','subject_type','event','subject_id','causer_type','causer_id','properties','batch_uuid'];



}
