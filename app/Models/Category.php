<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    /**
     * The roles that belong to the user.
     */
    public function books()
    {
        return $this->belongsToMany(Book::class)->withTimestamps();
    }
}
