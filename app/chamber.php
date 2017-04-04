<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
    protected $fillable = ['institute','address','telephone_number1','chamber_name',
        'mobile_number1','telephone_number2','telephone_number3','mobile_number2',
        'mobile_number3','city','post_code','district','thana'];

    
    
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
