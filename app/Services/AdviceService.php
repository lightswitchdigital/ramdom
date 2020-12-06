<?php


namespace App\Services;


use App\Http\Requests\CommentRequest;
use App\Models\Advice;
use Auth;

class AdviceService
{

    public function addComment($advice_id, CommentRequest $request) {

        $advice = $this->getAdvice($advice_id);
        $authenticated = Auth::check();

        $comment = $advice->comments()->make([
            'text' => $request['text'],
            'anonymous' => $authenticated? $request['anonymous'] : false
        ]);

        if ($authenticated) {
            $user = Auth::user();
            $comment->user()->associate($user);
        }

        $comment->save();

        return $comment;
    }


    private function getAdvice($advice_id) {
        return Advice::findOrFail($advice_id);
    }
}
