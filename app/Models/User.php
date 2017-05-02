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
     * @var string
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
    protected $fillable = ['username','first_name','last_name','email','password'];

    
    /**
     *Relationship functions to chamber and schedule models
     *
     *
     */

    
    public function schedules(){
           return $this->hasMany('App\Models\schedule', 'user_id');
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
