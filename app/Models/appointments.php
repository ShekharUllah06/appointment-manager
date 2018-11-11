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
    protected $fillable = ['doctor_id','patient_id', 'schedule_id', 'serial_number', 'status'];

    protected $dates = ['deleted_at'];


    /**
     *Relationship functions to chamber and schedule models
     *
     *
     */
    public function schedules(){
           return $this->belongsTo('App\Models\schedule');
    }

    public function User_doctor(){
          return $this->belongsTo('App\Models\User', 'doctor_id');
    }

    public function User_patient(){
          return $this->belongsTo('App\Models\User', 'patient_id');
    }


}
