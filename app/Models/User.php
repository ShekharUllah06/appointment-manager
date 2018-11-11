<?php
namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Notifications\PasswordResetNotification;


class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, Notifiable;

    /**
     * The database table used by the model.
     *
     * @var string.
     */
    protected $table = 'users';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $fillable = ['username','first_name','last_name','userType','email','password'];



    /**
     *Relationship functions to other models
     *
     *
     */
    public function appointments(){
          return $this->hasMany('App\Models\appointments');
    }

    public function chamber(){
          return $this->hasMany('App\Models\chamber');
    }

    public function education(){
          return $this->hasMany('App\Models\education');
    }

    public function personal_info(){
          return $this->hasOne('App\Models\personal_info');
    }

    public function schedule(){
          return $this->hasMany('App\Models\schedule');
    }

    public function specialty(){
          return $this->hasMany('App\Models\specialty');
    }

    public function work_history(){
          return $this->hasMany('App\Models\work_history');
    }


    /**
     * Overriding the exiting sendPasswordResetNotification so that I can customize it
     *
     * @var array
     */
//	public function sendPasswordResetNotification($token)
//	{
//		$this->notify(new PasswordResetNotification($token));
//	}

}
