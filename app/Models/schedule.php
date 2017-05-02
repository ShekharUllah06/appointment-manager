<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class schedule extends Model
{
   /**
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
     *Relationship functions to chamber and schedule models
     *
     *
     */

    
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
//
//        public function chambers(){
//           return $this->belongsTo('App\Models\chamber', 'chamber_id');
//    }
    
}