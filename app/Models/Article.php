<?php

namespace App\Models;

use App\Models\Image;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    use Searchable;
    
    protected $fillable = ['title', 'description', 'price', 'category_id', 'user_id'];

     protected $casts = [
        'is_accepted' => 'boolean',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function setAccepted($value)
    {
        $this->is_accepted = $value;
        $this->save();
        return true;
    }
    public function toSearchableArray(){
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'category' => $this->category,
            'price' => $this->price

        ];
    }
    public static function toBeRevisedCount()
    {
        return Article::where('is_accepted', null)->count();
    }
    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }
}