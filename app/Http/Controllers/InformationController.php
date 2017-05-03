<?php

namespace App\Http\Controllers;

use App\Meal;
use App\Officiant;
use App\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class InformationController extends Controller
{
    public function infuse(){


        $names = array('Ivan Petrov','Anna Zubova','Nikolay Tolstoy', 'Peter Jeckson', 'Bendjamin Doroshenko', 'Edvin Lamar', 'Sonya Petrova', 'Jessica Nubels', 'Tanya Golden');
        $meals = array('Vinegret','Omelette','Big Mac','Borsch','Pizza','Pie','Pudding','Ragout','Vermicelli','Sandwich' );

        foreach ($names as $name){

             $query = new Officiant;
             $name = explode(' ',$name);
             $query->name = $name[0];
             $query->second_name = $name[1];

             $query->save();
        }

        foreach($meals as $meal){

            $query = new Meal;
            $price = mt_rand(40,100);
            $query->name = $meal;
            $query->price = $price;

            $query->save();
        }

        for ($i=0; $i<20; $i++){

            $query = new Order;

            $query->officiant_id = mt_rand(1,6);

            $query->save();

            for($j=0;$j<5;$j++){

                $meal = Meal::find(mt_rand(1,10));

                $query->meals()->save($meal);
            }
        }

    }

    public function getProfit(){

        $day = date('d');

        $orders = Order:: whereDay('created_at', $day)->get();

        $profit = 0;

        foreach ($orders as $order){

            $meals = $order->meals()->get();

            foreach ($meals as $meal){

                $profit = $profit + $meal->price;
            }
        }

        return response()->json($profit);

    }

    public function getOrders(){

        $orders = Order::latest()->limit(5)->get();

        $sum = 0 ;
        $i=0;

        foreach ($orders as $order){

            $result_orders[$i]['id'] = $order->id;

            $officiant = $order->officiant()->first();

            $result_orders[$i]['officiant'] = $officiant->second_name;

            $meals = $order->meals()->get();

            foreach ($meals as $meal){

                $sum = $meal->price + $sum;
                $result_orders[$i]['meals'][] = $meal->name;
                $result_orders[$i]['meals_price'][] = $meal->price;

            }
            $result_orders[$i]['sum'] = $sum;
            $result_orders[$i]['date'] = $order->created_at->toDateTimeString();
            $i++;
        }

        return response()->json($result_orders);
    }

    public function getMeals(){

        $meals = DB::table('meal_order')->pluck('meal_id')->toArray();
        $cnt=1;
        for ($i = 1; $i < count($meals); $i++) {
            if ($meals[$i-1] == $meals[$i]){
                $arr2[$meals[$i]] = $cnt;
                $cnt++;
            }
            else{
                $cnt=1;
            }
        }
        asort($arr2);

        $cnt = 0;

        foreach ($arr2 as $key => $value){

            if($cnt > (count($arr2)-6) ){
                $ids[]=$key;
            }
            $cnt++;
        }

        $meals = Meal::find($ids);

        foreach ($meals as $key => $meal){

            $popular_meals[$key]['id'] = $meal->id;
            $popular_meals[$key]['name'] = $meal->name;
            $popular_meals[$key]['quantity'] = $meal->orders()->count();
            $popular_meals[$key]['price']= $meal->price;
        }

        return response()->json($popular_meals);

    }

    public function getOfficiants(){

        $orders = DB::table('orders')->pluck('officiant_id')->toArray();
        $cnt=1;
        for ($i = 1; $i < count($orders); $i++) {
            if ($orders[$i-1] == $orders[$i]){
                $arr2[$orders[$i]] = $cnt;
                $cnt++;
            }
            else{
                $cnt=1;
            }
        }
        asort($arr2);

        $cnt = 0;

        foreach ($arr2 as $key => $value){

            if($cnt > (count($arr2)-6) ){
                $ids[]=$key;

            }
            $cnt++;
        }


        $officiants = Officiant::find($ids);

        foreach ($officiants as $key => $officiant){

            $best_officiant[$key]['id'] = $officiant->id;
            $best_officiant[$key]['name'] = $officiant->name;
            $best_officiant[$key]['second_name'] = $officiant->second_name;
            $best_officiant[$key]['orders'] = $officiant->orders()->count();

        }

        return response()->json($best_officiant);

    }
}
