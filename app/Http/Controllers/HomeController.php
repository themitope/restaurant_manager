<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Services\MenuService;
use App\Services\RestoService;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(MenuService $service, RestoService $restoService)
    {   
        $restoId = 1;
        //$categories = Menu::whereIn('resto_id', $resto_id)->get()->groupBy('category.name');
       // $menus = Menu::all();
       $categories = $service->getMenuWithCategory($restoId);
       $restos = $restoService->userRestoAndTables();
        return view('home', [
            'menus'=> $categories, 
            'restoId'=>$restoId,
            'restos'=>$restos
        ]);
        //dd($restos);
    }
}
