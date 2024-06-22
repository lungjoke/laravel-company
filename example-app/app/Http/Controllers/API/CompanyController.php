<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(){
        
            return config ('app.url').' Date:'. now();
        
    }
    public function show($id){
        
         return 'Hello staff id ' . $id;
    
}
    
}
