<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\BasicData;
use App\Models\ProjectStory;
use App\Models\ProjectCategory;
use App\Models\Client;

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

    public function about()
    {
        $categorias=ProjectCategory::all();
        $clientes=Client::all();
        return view('frontend.nosotros',compact('categorias','clientes'));
    }

    public function contact()
    {
        $datos=BasicData::first()->take(1)->get();
        return view('frontend.contact', compact('datos'));
    }
}
