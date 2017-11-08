<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Traits;

use App\Models\specialty;
use App\Models\chamber;


trait zakiPrivateLibTrait{
    
    protected function listSpecialties(){
        $specialtiesQueryResult = specialty::where()->get();
    }
    
    protected function listLocations(){
        
    }
    
}