<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'pagecount',
        'category',
        'authors',
        'category_id',
    ];

    protected $searchableFields = ['*'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function borrow()
    {
        return $this->hasOne(Borrow::class);
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }
}
