<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//Class to query the personal_info Database table
//

class personal_info extends Model
{
	protected $table='personal_info';

	protected $guarded = ['id','updated_at', 'created_at'];
        
        public $primarykey = 'id';
        
        protected $hidden = ['id','updated_at', 'created_at'];

	protected $fillable = ['date_of_birth','gender','home_town','country','address'];
}
