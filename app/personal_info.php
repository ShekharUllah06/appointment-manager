<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//Class to query the personal_info Database table
//

class personal_info extends Model
{
	protected $table='personal_info';

	protected $guarded = ['id'];
        
//        public $primarykey = 'id';
        
        protected $hidden = ['updated_at', 'created_at'];

	protected $fillable = ['date_of_birth','gender','home_town','country','address'];
}
