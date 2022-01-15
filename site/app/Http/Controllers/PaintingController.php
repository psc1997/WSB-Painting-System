<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PaintingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($id)
    {
        $painting_data = DB::table('paintings')
        ->find($id);

        $painting_fn = DB::table('users')
        ->where('id', $painting_data->user_id)->value('first_name');

        $painting_ln = DB::table('users')
        ->where('id', $painting_data->user_id)->value('last_name');

        $painting_cat = DB::table('categories')
        ->where('id', $painting_data->category_id)->value('name');
        
        return view('painting', [
            'painting_data' => $painting_data,
            'painting_fn' => $painting_fn,
            'painting_ln' => $painting_ln,
            'painting_cat' => $painting_cat

        ]);
    }
}

