<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;

class PublicController extends Controller
{
    public function homepage() {
        $articles = Article::where('is_accepted', true)->orderBy('created_at', 'desc')->take(4)->get();
        return view('welcome', compact('articles'));
    }

    public function search(Request $request) {
        $query = $request->input('query');
        $articles = Article::search($query)->where('is_accepted', true)->paginate(10);
        return view('article.search', compact('articles', 'query'));
    }

    public function setLanguage($lang) {
        session()->put('locale', $lang);
        return redirect()->back();
    }

    public function googleLogin () {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback () {
           $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::where('google_id', $googleUser->id)->first();

        if ($user) {
            Auth::login($user);
            return redirect()->route('home');
        }

        $user = User::where('email', $googleUser->email)->first();

        if ($user) {
            $user->update([
                'google_id' => $googleUser->id,
            ]);
        } else {
            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'password' => Hash::make(Str::random(24)),
            ]);
        }

        Auth::login($user);

        return redirect()->route('homepage')->with('status', 'Login effettuato con successo!');
    }
}
