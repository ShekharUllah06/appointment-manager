<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


//This class contains the Admin Pannel Routing

class PagesController extends Controller
{

    public function getDashboard()
    {
        return view('admin.pages.dashboard');
    }
    
    public function getSchedule()
    {
        return view('admin.pages.schedule');
    }
    
    	public function getChamber()
    {
        return view('admin.pages.settings.chamber');
    }
    
    	public function getEducalion()
    {
        return view('admin.pages.settings.education');
    }
    
    public function getPersonalInfo()
    {
        return view('admin.pages.settings.personal-info');
    }
    
    public function getWorkHistory()
    {
        return view('admin.pages.settings.work-history');
    }
    
}
