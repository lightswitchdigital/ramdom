<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Advice;
use App\Services\AdviceService;

class AdviceController extends Controller
{
    private $service;

    public function __construct(AdviceService $service) {
        $this->service = $service;
    }

    public function index() {
        $advice = Advice::paginate(env('ADVICE_PAGINATION'));

        return view('advice.index', compact('advice'));
    }

    public function addComment(Advice $advice, CommentRequest $request) {
        $this->service->addComment($advice->id, $request);

        return redirect()->back();
    }

}
