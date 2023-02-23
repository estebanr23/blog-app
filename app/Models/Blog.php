<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'area_id',
        'image_url',
        'user_id'
    ];

    public function area() {
        return $this->BelongsTo(Area::class);
    }

    public function user() {
        return $this->BelongsTo(User::class);
    }
}
