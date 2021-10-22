<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Borrow extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'taken_date',
        'brought_date',
        'book_id',
        'student_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'taken_date' => 'datetime',
        'brought_date' => 'datetime',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
