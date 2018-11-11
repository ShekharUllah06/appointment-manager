<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class specialty extends Model
{
   /**
    *
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'specialty';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['user_id'];


    protected $primarykey = array('specialty', 'user_id');

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = ['specialty'];




    /**
     *Relationship functions to chamber and schedule models
     *
     *
     */
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


}
