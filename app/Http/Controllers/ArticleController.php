<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function create(){
        return view('article.create');
    }
    
    public function show(Article $article){
        $images = $article->images;
        return view('article.show', compact('article','images'));
    }
   
    public function index(){
        $maxPrice = Article::where('is_accepted', true)->max('price'); 
        $minPrice = Article::where('is_accepted', true)->min('price');
        
        $filterminPrice=request()->input('minPrice', $minPrice);
        $filtermaxPrice=request()->input('maxPrice', $maxPrice);

        $articles = Article::where('is_accepted', true)->whereBetween('price', [$filterminPrice, $filtermaxPrice]) ->orderBy('created_at', 'desc')->paginate(8);
       
        return view('article.index', compact('articles','maxPrice', 'minPrice', 'filterminPrice', 'filtermaxPrice'));
    }

    public function bycategory(Category $category){
         $articles = $category->articles()->where('is_accepted', true)->orderBy('created_at', 'desc')->paginate(8);
         return view('article.category-index', compact('articles', 'category'));
    }


    // creata per implementare la cancellazione o la modifica dei articoli
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:50',
            'price' => 'required|numeric|min:0.01',
            'description' => 'required|string|min:10',
        ]);

        // Sicurezza: solo l’autore può modificare
        if (Auth::id() !== $article->user_id) {
            abort(403, 'Non autorizzato');
        }
            $was_accepted = $article->is_accepted; // Salva lo stato VECCHIO dell'articolo
            
        $article->update([
            'title' => $request->title,
            'price' => $request->price,
            'description' => $request->description,
        ]);

            // 3. Controlla se l'articolo era stato approvato (is_accepted era true)
    if ($was_accepted === true) {
        // Se sì, resettalo a "da revisionare"
        $article->is_accepted = null;
        $article->save(); // Salva questa modifica di stato
        
        // Invia un messaggio specifico
        return redirect()->back()->with('message', 'Articolo aggiornato. Poiché era già approvato, verrà sottoposto a nuova revisione.');
    }

        return redirect()->back()->with('message', 'Articolo aggiornato con successo!');
    }

    public function destroy(Article $article)
    {
        // Controllo sicurezza: solo chi ha creato l'articolo può cancellarlo
        if (Auth::id() !== $article->user_id) {
            abort(403, 'Non autorizzato');
        }

        // Cancella articolo e immagini collegate (se hai relazione con cascade)
        $article->delete();

        return redirect()->route('article.index')->with('message', 'Articolo cancellato con successo!');
    }

}
