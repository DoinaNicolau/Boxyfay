<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Mail\BecomeRevisor;
use Illuminate\Http\Request;
use App\Mail\BecomeRevisorRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResponseToRevisorRequest;
use Illuminate\Support\Facades\Artisan;
use Algolia\AlgoliaSearch\Http\Psr7\Response;

class RevisorController extends Controller
{
    public function index()
    {
        // Controlla se c'è un articolo specifico da caricare dalla sessione
        $load_id = session('load_article_id');
        
        if ($load_id) {
            $article_to_check = Article::find($load_id);
        } else {
            // Se no, prende il primo articolo in coda (modificati o nuovi)
            $article_to_check = Article::whereNull('is_accepted')->orderBy('updated_at', 'desc')->first();
        }
        
        // Recupera la lista degli articoli modificati (escludendo quello principale)
        $reedited_articles = Article::whereNull('is_accepted')
        ->where('updated_at', '>', DB::raw('created_at'))
        ->when($article_to_check, function ($query, $article) {
            return $query->where('id', '!=', $article->id);
        })
        ->get();
        
        $revised_articles = Article::whereNotNull('is_accepted')->latest()->paginate(6);
        
        return view('revisor.index', compact('article_to_check', 'revised_articles', 'reedited_articles'));
    }
    public function accept(Article $article) {
        $article->setAccepted(true);
        return redirect()
        ->back()
        ->with('message', "Hai accettato l'articolo $article->title");
    }
    
    public function reject(Article $article) {
        $article->setAccepted(false);
        return redirect()
        ->back()
        ->with('message', "Hai rifiutato l'articolo $article->title");
    }
    
    // public function becomeRevisor() {
    //     if (Auth::user()->is_revisor) {
    //         return redirect(route('homepage'))->with('errorMessage', 'Sei già revisore!');
    //     }
    //     Mail::to('presto2@nextgencoders.it')->send(new BecomeRevisor(Auth::user()));
    //     return redirect(route('homepage'))->with('message', 'Complimenti, hai richiesto di diventare revisore! Riceverai una mail di conferma entro 24h');
    // }
    
    public function changeStatus (Article $article) {
        if ($article->is_accepted) {
            $article->is_accepted = false;
            $article->save();
        } elseif (!$article->is_accepted) {
            $article->is_accepted = true;
            $article->save();
        }
        return redirect()->back()->with('message', 'Hai cambiato lo stato dell\'articolo');
    }
    
    public function makeRevisor (User $user) {
        Artisan::call('app:make-user-revisor', ['email' => $user->email]);
        return redirect()->back();
    }
    
    public function submitRevisorRequest(Request $request)
    {
        $presentation = $request->input('presentation', 'Nessuna presentazione fornita.');
        
        try {
            Mail::to('presto2@nextgencoders.it')->send(new BecomeRevisorRequest(Auth::user(), $presentation));
            return redirect()->route('homepage')->with('message', __('ui.success_request_sent'));
        } catch (\Exception $e) {
            Log::error("Errore invio email candidatura revisore: " . $e->getMessage());
            return redirect()->route('homepage')->with('errorMessage', __('ui.error_request_failed'));
        }
    }
}

