<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembersModel extends Model
{
    protected $table = 'members'; 

    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    public function books()
    {
        return $this->hasMany(BooksModel::class, 'member_id'); // 'member_id' adalah foreign key di tabel books
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
    
}
