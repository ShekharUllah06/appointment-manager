<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class schedule extends Model
{
   /**
    *
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'schedule';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['schedule_id', 'user_id', 'chamber_id'];

    /**
     * The attributes that are Primary Key.
     *
     * @var array
     */
    protected $primarykey = array('schedule_id', 'user_id');

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
    protected $fillable = ['schedule_date','start_time','end_time'];



    /**
     *Relationship functions to other models
     *
     *
     */
    public function appointments_doctor(){
        return $this->hasMany('App\Models\appointments', 'doctor_id');
    }

    public function appointments_patient(){
        return $this->hasMany('App\Models\appointments', 'patient_id');
    }

    public function User(){
        return $this->belongsTo('App\Models\User');
    }

    public function chamber(){
        return $this->belongsTo('App\Models\chamber');
    }


//function to set composit key
    protected function setKeysForSaveQuery(\Illuminate\Database\Eloquent\Builder $query) {
        if(is_array($this->primarykey)){
            foreach($this->primarykey as $pk){
                $query->where($pk, '=', $this->original[$pk]);
            }
            return $query;
        }else{
            return parent::setKeysForSaveQuery($query);
        }
    }

}
