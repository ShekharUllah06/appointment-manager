<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//Class to query the personal_info Database table
//

class personal_info extends Model
{
    /**
     * 
     * The database table used by the model.
     *
     * @var string
     */
	protected $table='personal_info';
        
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
	protected $guarded = ['id','updated_at', 'created_at'];
        
    /**
     * The attributes that are Primary Key.
     *
     * @var array
     */
        public $primarykey = 'id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
        protected $hidden = ['id','updated_at', 'created_at'];
        
     /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
	protected $fillable = ['date_of_birth','gender','home_town','country','address','imageUrl'];
}
