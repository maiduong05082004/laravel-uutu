<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Video;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function getCommentsByArticle($articleId)
    {
        $article = Article::findOrFail($articleId);
        $comments = $article->comments;
        return response()->json($comments);
    }

    public function getCommentsByUser($userId)
    {
        $comments = Comment::where('user_id', $userId)->get();

        $commentedArticles = $comments->where('commentable_type', Article::class)->map->commentable;
        $commentedVideos = $comments->where('commentable_type', Video::class)->map->commentable;
        $commentedImages = $comments->where('commentable_type', Image::class)->map->commentable;

        return response()->json([
            'articles' => $commentedArticles,
            'videos' => $commentedVideos,
            'images' => $commentedImages
        ]);
    }
}
