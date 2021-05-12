<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\RestoCategoryValidate;
use App\Models\Menu;
use App\Models\Category;
use App\Services\MenuService;

class MenuController extends Controller
{
    public function index($id){
        $restoId = $id;
        $service = new MenuService;
        $categories = $service->getMenuWithCategory($restoId);
        return view('menu.menu-index', ['menus'=> $categories, 'restoId'=>$restoId]);
    }

    public function saveMenuItem(Request $request){
        //return $request->all();
        $postData = $this->validate($request,[
           'restoId'=>'required |numeric',
           'price'=>'required|numeric',
           'item'=>'required', 
           'description'=>'required|min:3',
           'category'=>['required', new RestoCategoryValidate($request->input('restoId'))],
        ]);
       // return $postData;
       $category = Category::where('resto_id', $postData['restoId'])->where('name', $postData['category'])->first();
       $menu = Menu::create([
           'name'=>$postData['item'],
           'price'=>$postData['price'],
           'description'=>$postData['description'],
           'resto_id'=>$postData['restoId'],
           'category_id'=>$category->id,
       ]);
       return response()->json($menu, 201);
    }

    public function getRestoMenu(Request $request){
        $this->validate($request, [
            'restoId' => 'required|exists:restaurants,id'
        ]);
        $menuItems = Menu::where('resto_id', $request->input('restoId'))
        ->orderBy('category_id')
        ->get();
        return response()->json($menuItems, 200);
        //return $request->all();
    }
}
