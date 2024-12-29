<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoansModel extends Model
{
    use HasFactory;

    protected $table = 'loans';

    protected $fillable = [
        'member_id', 
        'book_id',
        'loan_date',
        'due_date',
    ];

    protected $dates = ['loan_date', 'due_date'];
    

    public function member()
    {
        return $this->belongsTo(MembersModel::class);
    }

    public function book()
    {
        return $this->belongsTo(BooksModel::class);
    }

}
