<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class work_history extends Model
{
   /**
    * 
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'work_history';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['work_history_id', 'user_id'];
    
    
    protected $primarykey = array('work_history_id', 'user_id');

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
    protected $fillable = ['organization','position','description','start_date','end_date','current_position'];

    
    
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