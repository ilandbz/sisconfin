<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $data['title']='Pagina Inicial';
        return view('app', $data);
    }
    
}
