<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentCollection;
use App\Models\Comment;
use App\Services\CommentSorterService;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    private CommentSorterService $commentSorterService;

    public function __construct(CommentSorterService $commentSorterService)
    {
        $this->commentSorterService = $commentSorterService;
    }

    /**
     * @return CommentCollection
     */
    public function show(Request $request): CommentCollection
    {
        $commentsQuery = $this->commentSorterService->sortBy($request->toArray());
        return new CommentCollection($commentsQuery->paginate(10));
    }
}
