<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    protected $table = 'book_categories';
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

}
