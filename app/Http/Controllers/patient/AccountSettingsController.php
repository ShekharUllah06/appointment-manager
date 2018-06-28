<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



class AccountSettingsController extends Controller
{

//This function queries user table and returns account settings informations.
    public function showAccountSettings()
    {
        $userId = Auth::user()->id;

        //Query User Table
       $userInfo = User::where('id', $userId)
                      ->select('id', 'first_name', 'last_name', 'email')
                      ->first();

      return view('patient.account.accountSettings', ['userInfo' => $userInfo]);
    }



//This function Valldates and Changes the Informations

    public function changeInformation(Request $request){

        //Validating Account Info form input data and show error massege if not valid
        $this->validate($request,[
            'userId' => 'alpha_num|max:10',
            'firstName' => 'string|max:25',
            'lastName' => 'string|max:25',
            'email'=> 'email|max:60',
            ]);

        //Query User Table
        $userInfo_1 = User::find($request['userId']);

       //Check if passed user id is logged in
       if($request['userId'] == Auth::user()->id){
            $userInfo_1->first_name = $request['firstName'];
            $userInfo_1->last_name = $request['lastName'];
            $userInfo_1->email = $request['email'];

            try{
            //save assigned data to the User table
                $userInfo_1->save();

            }catch(\Illuminate\Database\QueryException $ex){
                return redirect()
                ->back()
                ->with('message','Warning!! All fields are reqired.  And all data are of desired type. Then try again!')
                ->with('status', 'danger')
                ->withInput();
            }
            return redirect()
                    ->back()
                    ->with('message','Information Saved successfully!')
                    ->with('status', 'success')
                    ->withInput();

        }

        return redirect()
                ->back()
                ->with('message','Invalid User!')
                ->with('status', 'danger')
                ->withInput();
    }



//This function Valldates and Changes the Password

    public function changePassword(Request $request){

        //Validating Account Info form input data and show error massege if not valid
        $this->validate($request,[
            'userId' => 'alpha_num|max:10',
            'currentPassword' => 'string|max:35',
            'newPassword' => 'string|min:8|max:35',
            'reNewPassword'=> 'string|min:8|max:35',
            ]);

        //Check if passed user id is logged in and password is correct
       if(($request['userId'] == Auth::user()->id) && (Hash::check($request['currentPassword'], Auth::user()->password))){

          //Check if New Password and Confirm Passwird matchs, else redirect back
          if($request['newPassword'] !== $request['reNewPassword']){
              return redirect()
                 ->back()
                 ->with('message','The "New Password" and "Re-Type New Password" you typed in does not match!')
                 ->with('status', 'danger')
                 ->withInput();
          }
          //Query User Table
          $userInfo_1 = User::find($request['userId']);

          //Hash and Assign New Password
          $userInfo_1->password   = Hash::make($request['reNewPassword']);

          //Save Password to DB
          try{
          //save assigned data to the User table
              $userInfo_1->save();

          }catch(\Illuminate\Database\QueryException $ex){
              return redirect()
              ->back()
              ->with('message','Warning!! Could not save New Password! Please contact the site Admin for assistance.')
              ->with('status', 'danger')
              ->withInput();
          }

          return redirect()
                  ->back()
                  ->with('message','New Password Saved successfully!')
                  ->with('status', 'success')
                  ->withInput();
        }else{
          return redirect()
             ->back()
             ->with('message','Invalid User and/or Password combination!')
             ->with('status', 'danger')
             ->withInput();
        }
    }
}
