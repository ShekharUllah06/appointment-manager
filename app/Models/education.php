<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class education extends Model
{
   /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'education';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['degree_name', 'user_id'];
    
    /**
     * The attributes that are Primary Key.
     *
     * @var array
     */
    protected $primarykey = array('degree_name', 'user_id');

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
    protected $fillable = ['pass_year','institute_name'];

    
    
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