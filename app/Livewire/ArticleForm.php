<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;
use App\Models\Category;
use App\Jobs\RemoveFaces;
use App\Jobs\ResizeImage;

use Livewire\WithFileUploads;
use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionSafeSearch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ArticleForm extends Component
{
    use WithFileUploads;
    public $title;
    public $price;
    public $category;
    public $description;
    public $category_id;
    public $user_id;
    public $categories;
    public $images = [];
    public $temporary_images;
    public $article;


    protected $rules=[
        'title' => 'required|string|max:50',
        'price' => 'required|numeric|min:0.01',
        'description' => 'required|string|min:10',
        'category_id' => 'required',
        
    ];
    public function messages(){
        return[
            'title.required' => 'Il titolo è obbligatorio',
            'price.required' => 'Il prezzo è obbligatorio',
            'description.required' => 'La descrizione è obbligatoria',
            'description.min' => 'La descrizione deve avere almeno 10 caratteri',
            'price.min' => 'Il prezzo deve essere maggiore di zero',
            'title.max' => 'Il titolo deve avere meno di 50 caratteri',
            'title.string' => 'Il titolo deve contenere delle lettere',
            'price.numeric' => 'Il prezzo deve essere un numero',
            'category_id.required' => 'La categoria è obbligatoria',
        ];
    }

    public function store(){
        $this->validate();
        $this ->article = Article::create([
            'title' => $this->title,
            'price' => $this->price,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'user_id' => Auth::user()->id,
        ]);
        if(count($this->images) > 0){
            foreach($this->images as $image){
                $newFileName="articles/{$this->article->id}";
                $newImage=$this->article->images()->create(['path' => $image->store($newFileName, 'public')]);
                RemoveFaces::withChain([
                new ResizeImage($newImage->path, 600, 600),
                new GoogleVisionSafeSearch($newImage->id),
                new GoogleVisionLabelImage($newImage->id)])->dispatch($newImage->id);
            }
            File::deleteDirectory(storage_path('app/livewire-tmp'));

        }
        session()->flash('message', 'Articolo caricato con successo');
        $this->cleanForm();

        return redirect(route('homepage'))->with('message', 'Articolo caricato con successo');
    }
    public function mount(){
        $this->categories = Category::all();
    }
    public function render()
    {
        return view('livewire.article-form');
    }

    public function updatedTemporaryImages(){
        if($this->validate([
            'temporary_images.*' => 'image|max:1024',
            'temporary_images'=>'max:6'
        ])){
            foreach($this->temporary_images as $image){
                $this->images[] = $image;
            }
        }
    }
    public function removeImage($key){
        if(in_array($key,array_keys($this->images))){
            unset($this->images[$key]);
        }
    }

    public function cleanForm()
{
    $this->title = '';
    $this->price = '';
    $this->description = '';
    $this->category_id = '';
    $this->images = [];
    $this->temporary_images = [];
}
}    

   

