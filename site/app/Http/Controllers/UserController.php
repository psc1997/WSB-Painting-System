<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['users'] = User::orderBy('id', 'asc')->paginate(50);
   
        return view('admin.users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
   
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'city' => ($request->city) ? $request->city : null,
            'description' => ($request->description) ? $request->description : null,
            'is_administrator' => ($request->is_administrator) ? true : false,
        ]);
    
        return Redirect::to('/admin/users')->with('message', 'Użytkownik "'.$request->name.'" został pomyślnie utworzony!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::where(['id' => $id])->first();
 
        return view('admin.users.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $update = [
            'name' => $request->name,
            'email' => $request->email,
            'city' => ($request->city) ? $request->city : null,
            'description' => ($request->description) ? $request->description : null,
            'is_administrator' => ($request->is_administrator) ? true : false,
        ];

        // Aktualizujemy hasło tylko, jeżeli zostało wypełnione
        if (!empty($request->password)) {
            $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $update['password'] = Hash::make($request->password);
        }

        User::where('id', $id)->update($update);
   
        return Redirect::to('/admin/users')->with('message', 'Zmiany w profilu użytkownika "'.$request->name.'" zostały pomyślnie zapisane!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();
   
        return Redirect::to('/admin/users')->with('message', 'User deleted successfully');
    }
}
