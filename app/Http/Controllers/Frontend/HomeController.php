<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\ProjectStory;
use App\Models\ProjectCategory;

class HomeController
{
    public function index()
    {
        $categoria1=ProjectCategory::find(1);
        $categoria2=ProjectCategory::find(2);
        $categoria3=ProjectCategory::find(3);
        $categoria4=ProjectCategory::find(4);
        $categoria5=ProjectCategory::find(5);
        $categoria6=ProjectCategory::find(6);
        return view('frontend.inicio',compact('categoria1','categoria2','categoria3','categoria4','categoria5','categoria6'));
    }
}
