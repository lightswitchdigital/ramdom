<?php


namespace App\Services;


use App\Http\Requests\CommentRequest;
use App\Models\Advice;
use App\Models\User;

class AdviceService
{
    public function add($user_id, $advice_id, CommentRequest $request) {
        $user = $this->getUser($user_id);
        $advice = $this->getAdvice($advice_id);


    }

    public function delete($comment_id) {

    }


    private function getUser($user_id) {
        return User::findOrFail($user_id);
    }

    private function getAdvice($advice_id) {
        return Advice::findOrFail($advice_id);
    }

    public function getComment($comment_id) {

    }
}
