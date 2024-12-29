<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BooksModel extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = [
        'title',
        'author',
        'publisher',
        'published_date',
        'genre',
        'number_of_pages',
        'available_copies',
    ];

    public function member()
    {
        return $this->belongsTo(MembersModel::class, 'member_id'); // Pastikan nama relasi adalah 'member'
    }
    
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
