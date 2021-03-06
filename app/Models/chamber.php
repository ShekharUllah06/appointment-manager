<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\schedule;
class chamber extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'chamber';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['chamber_id', 'user_id'];

    /**
     * The attributes that are Primary Key.
     *
     * @var array
     */
    protected $primarykey = array('chamber_id', 'user_id');

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
    protected $fillable = ['institute','address','consult_fee','telephone_number1','chamber_name',
        'mobile_number1','telephone_number2','telephone_number3','mobile_number2',
        'mobile_number3','city','post_code','district','thana'];


        /**
         *Relationship functions to other models
         *
         *
         */
        public function schedule(){
              return $this->hasMany('App\Models\schedule');
        }

        public function User(){
              return $this->belongsTo('App\Models\User');
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
//     public function schedules(){
//           return $this->hasMany('App\Models\schedule', 'schedule_id');
//    }
//
}
