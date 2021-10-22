<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'age', 'gender'];

    protected $searchableFields = ['*'];

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
}
