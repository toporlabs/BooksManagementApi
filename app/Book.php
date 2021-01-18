<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Get the phone associated with the user.
     */
    public function category()
    {
        return $this->belongsTo(BookCategory::class);
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category' => $this->category,
        ];
    }
}
