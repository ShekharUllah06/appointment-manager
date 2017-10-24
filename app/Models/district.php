<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class district extends Model
{
    /**
    * 
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'district';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['district'];
    
  
    protected $primarykey = ['district'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];
}
