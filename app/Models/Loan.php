<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use function Laravel\Prompts\select;

class Loan extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'borrow_date',
        'due_date',
        'return_date',
        'status',
        'fine',
    ];
    protected static function booted()
    {
        static::created(function ($loan) {
            $loan->book->decrement('stock');
        });  
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function books()
    {
        return $this->belongsTo(Book::class);
    }
}
