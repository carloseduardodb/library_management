<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'surname', 'birth_date', 'gender'];

    protected $searchableFields = ['*'];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function borrow()
    {
        return $this->hasOne(Borrow::class);
    }
}
