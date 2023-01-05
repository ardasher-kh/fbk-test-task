<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Builder;

class CommentSorterService
{
    private array $sortable = ['user_name', 'created_at', 'likes_count'];

    /**
     * @param $columns
     * @return Builder
     */
    public function sortBy($columns): Builder
    {
        $commentsQuery = Comment::query()->withAggregate('user', 'name')->withCount('likes');
        foreach ($columns as $requestCol => $order) {
            $col = substr($requestCol, 8);
            if (in_array($col, $this->sortable) && ($order === 'DESC' || $order === 'ASC')) {
                $commentsQuery->orderBy($col, $order);
            }
        }

        return $commentsQuery;
    }

}
