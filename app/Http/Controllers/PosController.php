<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function index(){
        $items = Item::all();
        return view('pos',['items'=>$items]);
    }
    public function order(){

    }
}
