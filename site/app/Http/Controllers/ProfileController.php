<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Profile;
use App\User;

class ProfileController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, string $username)
    {
        $user = DB::table('users')
            ->where('name', $username)
            ->pluck('id');
        $user_id = (isset($user[0])) ? $user[0] : null;

        // Jeżeli user istnieje to zaciągamy jego profil
        if (isset($user_id)) :
            // ================
            // = INFO PROFILOWE
            $user_profile = DB::table('users')
                ->select('name')
                ->where('id', $user_id)
                ->first();

            $user_paintings = ProfileController::getPaintings($user_id);

            // ================
            // = AVATAR I TŁO
            $user_images = [
                'avatar' => (file_exists(public_path('storage/profile-avatar/'.$user_id.'.png'))) ? '/storage/profile-avatar/'.$user_id.'.png' : '/dist/img/profile-default-avatar.png',
            ];

            // Zwracamy widok
            return view('profile.index', [
                'username' => $username,
                'user_profile' => $user_profile,
                'user_paintings' => $user_paintings,
                'user_images' => $user_images,
            ]);
        else:
            abort(404);
        endif;
    }

    /**
     * Edycja profilu użytkownika - zwraca widok.
     *
     * @param Request $request
     * @param string $username
     * @return void
     */
    public function edit(Request $request, string $username)
    {
        $user = DB::table('users')
            ->where('name', $username)
            ->pluck('id');
        $user_id = $user[0];

        // Jeżeli user istnieje to zaciągamy jego profil
        if (isset($user_id) && isset(Auth::user()->id) && $user_id == Auth::user()->id) {
            $user_profile =  DB::table('users')
                ->where('id', $user_id)
                ->first();

            // TODO:
        } else {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, string $username)
    {
        if (Auth::user()->name == $username) {
            // TODO:

            // Wracamy do ekranu edycji
            return redirect()->route('profile.edit', ['username' => $username])->with('message', $message);
        } else {
            abort(404);
        }
    }

    public function update(Request $request, string $username)
    {
        $is_success = false;

        if (Auth::user()->name == $username) {
            if (isset($_POST['form_type'])) {

                // TODO:
            }

            if ($is_success) {
                return redirect()->route('profile.edit', ['username' => $username])->with('message', 'Pomyślnie zapisano zmiany!');
            } else {
                return redirect()->route('profile.edit', ['username' => $username])->with('message', 'Podczas edycji wystąpił błąd - brak odpowiedniego przeznaczenia danych!');
            }
        } else {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Profile::where('id', $id)->delete();

        return Redirect::to('/profile/'.Auth::user()->name.'/edit')->with('message', 'Pomyślnie usunięto grę z Twojego profilu!');
    }

    /**
     * [...]
     *
     * @param integer $id_user
     * @return void
     */
    public static function getPaintings (int $id_user) {
        $user_paintings = DB::table('paintings')
            ->select(
                'paintings.id',
                'paintings.name',
                'paintings.painting_technique',
                'paintings.height',
                'paintings.width',
                'categories.name',
            )
            ->join('categories', 'paintings.category_id', '=', 'categories.id')
            ->where('user_id', $id_user)
            ->orderBy('paintings.created_at', 'asc')
            ->get();

        return $user_paintings;
    }
}
