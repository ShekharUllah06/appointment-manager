<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
  /**
    * The database table used by the model.
    *
    * @var string
    */
   protected $table = 'notifications';

   /**
    * The attributes that are not mass assignable.
    *
    * @var array
    */
   protected $guarded = [];

   /**
    * The attributes that are Primary Key.
    *
    * @var array
    */
   protected $primarykey = ['id'];

   /**
    * The attributes excluded from the model's JSON form.
    *
    * @var array
    */
   protected $hidden = ['created_at', 'updated_at', 'read_at'];

   /**
    * The attributes excluded from the model's JSON form.
    *
    * @var array
    */
   protected $fillable = ['type','notifiable_id','notifiable_type','data'];

}
