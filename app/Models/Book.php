<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'text',
        'description',
        'pages',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * The roles that belong to the user.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps()->withPivot('created_at');
    }

    public function scopeSearchTitle($query, $s)
    {
        if ($s) {
            $query->orWhere('title', 'LIKE', '%' . $s . '%');
        }
    }

    public function scopeSearchDescription($query, $s)
    {
        if ($s) {
            $query->orWhere('description', 'LIKE', '%' . $s . '%');
        }
    }
}
