<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class appointments extends Model
{
  use SoftDeletes;
    /**
    *
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'appointments';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];


    protected $primarykey = ['id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $fillable = ['doctor_id','patient_id', 'schedule_id', 'serial_number'];

    protected $dates = ['deleted_at'];
}
