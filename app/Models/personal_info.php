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
	protected $guarded = ['id','user_id','updated_at', 'created_at'];

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
        protected $hidden = ['updated_at', 'created_at'];

     /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
	protected $fillable = ['date_of_birth','gender','home_town','country','address','imageUrl'];



	/**
	 *Relationship functions to chamber and schedule models
	 *
	 *
	 */
	public function user(){
			return $this->belongsTo('App\Models\User');
	}

	public function age() {
			return $this->date_of_birth->diffInYears(\Carbon::now());
	}

}
