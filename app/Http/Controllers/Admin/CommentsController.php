<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advice;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index(Request $request) {
        $query = Comment::ofAdvice()->orderByDesc('id');

        if (!empty($value = $request->get('id'))) {
            $query->where('id', $value);
        }

        if (!empty($value = $request->get('user_id'))) {
            $query->where('user_id', $value);
        }

        if (!empty($value = $request->get('advice_id'))) {
            $query->where('commentable_id', $value);
        }

        if (!empty($value = $request->get('active'))) {
            $query->where('active', $value);
        }

        if (!empty($value = $request->get('anonymous'))) {
            $query->where('anonymous', $value);
        }

        $comments = $query->paginate(config('ADMIN_PAGINATION'));

        return view('admin.comments.index', compact('comments'));
    }
}
