<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PaintingsController extends Controller
{
    public function index()
    {
        $paintings_data = DB::table('paintings')
            ->join('categories', 'paintings.category_id', '=', 'categories.id')
            ->join('users', 'paintings.user_id', '=', 'users.id')
            ->select(
                'paintings.id',
                'paintings.name',
                'paintings.painting_technique',
                'paintings.height',
                'paintings.width',
                'categories.name as category',
                'users.first_name',
                'users.last_name',
            )
            ->orderBy('paintings.created_at', 'desc')
            ->get();
        
        return view('paintings', [
            'paintings_data' => $paintings_data,
        ]);
    }

}