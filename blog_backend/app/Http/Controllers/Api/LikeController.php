<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggle(Request $request)
    {
        $request->validate([
            'likeable_id' => 'required|integer',
            'likeable_type' => 'required|string', // post أو comment
            'is_like' => 'required|boolean'
        ]);

        $modelMap = [
            'post' => Post::class,
            'comment' => Comment::class,
        ];

        $likeableType = strtolower($request->likeable_type);

        if (!isset($modelMap[$likeableType])) {
            return response()->json(['error' => 'Invalid likeable type'], 400);
        }

        $modelClass = $modelMap[$likeableType];

        $likeable = $modelClass::findOrFail($request->likeable_id);

        $like = $likeable->likes()->updateOrCreate(
            ['user_id' => $request->user()->id],
            ['is_like' => $request->is_like]
        );

        return response()->json($like);
    }
}
