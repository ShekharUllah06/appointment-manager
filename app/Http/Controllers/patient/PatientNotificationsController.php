<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



class PatientNotificationsController extends Controller
{
//This function queries user table and returns account settings informations.
    public function viewNotifications()
    {
      //Query User Table
      $user = User::find(Auth::user()->id);

      return view('patient.account.patientNotifications', ['user' => $user]);
    }
}
