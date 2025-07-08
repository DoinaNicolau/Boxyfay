<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Actions\Fortify\UpdateUserProfileInformation;

class UserController extends Controller
{
    public function index(){
        $articles = Auth::user()->articles()->where('is_accepted', true)->orderBy('created_at', 'desc')->paginate(8);
        $pending_articles = Auth::user()->articles()->where('is_accepted', null)->orderBy('created_at', 'desc')->paginate(8);
        return view('auth.index', compact('articles', 'pending_articles'));
    }

    public function edit(){
        return view('auth.edit');
    }
    public function update(Request $request ,UpdateUserProfileInformation $user){
        $user->update(Auth::user(), $request->all());
        return redirect(route('user.index'))->with('success', 'Profilo aggiornato con successo');
    }

    public function delete(User $user){
        $user->delete();
        return redirect(route('register'));
    }
}
