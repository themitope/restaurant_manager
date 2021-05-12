<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Order;
use App\Models\Menu;
use\Illuminate\Support\Facades\Auth;
use\Illuminate\Support\Facades\DB;

class RestaurantOrderController extends Controller
{
    public function index($id){
        $resto = Restaurant::find($id);
        if(!$resto){
            abort(404, 'The restaurant you are looking for is not present');
        }

        $orders = Order::where('resto_id', $id)
        ->orderBy('isComplete')
        ->orderByDesc('created_at')
        ->paginate(20);

        return view('orders.order-index', [
            "orders"=> $orders,
            "resto" => $resto
        ]);
    }

    public function add($id){
        $resto = Restaurant::findorFail($id);
        return view('orders.order-add', [
            "resto" => $resto,
        ]);
    }

    public function store (Request $request){
        $orderTotal = 0;
        // logger($request->all());
        // return $request->all();
        $postData = $this->validate($request,[
            'resto_id'=> 'required|exists:restaurants,id',
            'order_data'=>'required|array'
        ]);
        $itemIds = $postData['order_data']['orderDetails'];
        try{
            DB::beginTransaction();
            foreach($itemIds as $id){
                $menu = Menu::query()
                ->where('resto_id', $postData['resto_id'])
                ->where('id', $id)
                ->first();
                if($menu){
                    $orderTotal+=$menu->price;
                }
            }
            // $order = Order::create([
            //     'resto_id'=>$postData['resto_id'],
            //     'user_id'=>Auth::user()->id,
            //     'amount' => $orderTotal,
            //     'isComplete' => 0,
            //     'order_details'=>[
            //         'items' => $postData['order_data']['orderDetails'],
            //         'customer_name'=> $postData['order_data']['customerDetails']['name'],
            //         'customer_phone' => $postData['order_data']['customerDetails']['phone'],
            //         'customer_address' => $postData['order_data']['customerDetails']['address']

            //     ]
            // ]);
             $order = DB::insert('insert into orders  
             (resto_id, user_id, amount, isComplete, order_details)
             values(?, ?, ?, ?, ?)', 
             [
                $postData['resto_id'], 
                Auth::user()->id,
                $orderTotal, 
                0, 
                json_encode(
                    [
                        'items' => $postData['order_data']['orderDetails'],
                        'customer_name'=> $postData['order_data']['customerDetails']['name'],
                        'customer_phone' => $postData['order_data']['customerDetails']['phone'],
                        'customer_address' => $postData['order_data']['customerDetails']['address']
    
                    ]
                )
             ]);
            DB::commit();
        }catch(\Exception $e){
            logger($e->getMessage());
            DB::rollBack();
            return response()->json(['message'=> $e->getMessage()], 500);
        }
        return response()->json($order, 201);
    }
}
