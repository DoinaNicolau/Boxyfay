<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class CartController extends Controller
{
     // Funzione helper per prendere il carrello dalla sessione
    private function getCart()
    {
        return session()->get('cart', []); // Se non c'è, restituisce un array vuoto
    }

    // Funzione helper per salvare il carrello nella sessione
    private function saveCart($cart)
    {
        session()->put('cart', $cart);
    }

    // Metodo per aggiungere un articolo
    public function add(Request $request, Article $article)
    {   
         $article->load('images');

      // Prepariamo il percorso dell'immagine
        $imagePath = null; // Partiamo da null
        if ($article->images->isNotEmpty()) {
            $imagePath = $article->images->first()->path;
        }

        
        $cart = $this->getCart();
        $quantity = $request->input('quantity', 1);
        $articleId = $article->id;

    if (isset($cart[$articleId])) {
        $cart[$articleId]['quantity'] += $quantity;
    } else { $cart[$articleId] = [
            "id" => $article->id,
            "name" => $article->title,
            "quantity" => $quantity,
            "price" => $article->price,
            "image_path" => $imagePath // Salviamo il percorso, non l'URL completo
        ];
    }



    $this->saveCart($cart);
    
    return redirect()->back()->with('success', 'Articolo aggiunto al carrello!');
    }

    // Metodo per mostrare la pagina del carrello
    public function show()
    {
        $cart = $this->getCart();
        return view('cart.show', compact('cart'));
    }

    // Metodo per rimuovere un articolo
    public function remove(Request $request)
    {
        $cart = $this->getCart();
        $articleId = $request->article_id;

        if (isset($cart[$articleId])) {
            unset($cart[$articleId]);
        }

        $this->saveCart($cart);
        return redirect()->back()->with('success', 'Articolo rimosso dal carrello.');
    }

    // Metodo per svuotare il carrello
    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Carrello svuotato.');
    }

    public function checkout()
    {
        // Qui in futuro potresti salvare l'ordine nel database.
        
        // 1. Svuotiamo il carrello
        session()->forget('cart');
        
        // 2. Reindirizziamo di nuovo alla pagina del carrello con un messaggio di successo
        return redirect()->route('cart.show')->with('success', 'Acquisto simulato completato con successo! Grazie.');
    }

}
