<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //For home page
    public function index(){
        return view('frontend.home');
    }

    //For about page
    public function about(){
        return view('frontend.about');
    }

    //For service page
    public function service(){
        return view('frontend.service');
    }

    //For project page
    public function project(){
        return view('frontend.project');
    }

    //For contact page
    public function contact(){
        return view('frontend.contact');
    }

    //For team page
    public function team(){
        return view('frontend.team');
    }

    //For testimonial page
    public function testimonial(){
        return view('frontend.testimonial');
    }

}
