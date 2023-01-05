<?php

namespace App\Models;


use Database\Factories\LikeFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    use HasFactory;

    /**
     * Create a new factory instance for the model.
     *
     * @return Factory
     */
    protected static function newFactory(): Factory
    {
        return LikeFactory::new();
    }

    protected $fillable = ['user_id', 'comment_id'];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function comment(): BelongsTo {
        return $this->belongsTo(Comment::class);
    }
}
