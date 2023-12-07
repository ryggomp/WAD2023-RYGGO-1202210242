<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\showroom;

class ShowroomController extends Controller
{
    //
    public function create (){
        return view ('showroom.create');
    }

    public function store(Request $request){
        $data=$request->all();

        showroom::create([
            'nama_mobil' => $data['name'],
            'brand_mobil' => $data['brand'],
            'warna_mobil' => $data['warna'],
            'tipe_mobil' => $data['tipe'],
            'harga_mobil' => $data['harga'],
        ]);
        return redirect()-> route('showroom.index');
    }
    public function index(){
        $showroom = showroom::all();

        return view('showroom.index', compact('showroom'));
    }
}
