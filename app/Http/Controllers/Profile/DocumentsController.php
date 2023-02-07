<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Mail\UserDocumentsMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentsController extends Controller
{
    public function index()
    {
        return view('profile.documents');
    }

    public function uploadDocs(Request $request)
    {
        $this->validate($request, [
            'passport_1' => ['required', 'mimes:pdf,png,jpg,jpeg', 'max:2000'],
            'passport_2' => ['required', 'mimes:pdf,png,jpg,jpeg', 'max:2000'],
            'snils' => ['required', 'mimes:pdf,png,jpg,jpeg', 'max:2000'],
        ]);

        $user = Auth::user();
        if ($user->docs_verified) {
            return redirect()->back()->with('error', 'Вы уже подтвердили документы ранее');
        }

        $user->update([
            'passport_1' => $request['passport_1']->store('user_docs', 'public'),
            'passport_2' => $request['passport_2']->store('user_docs', 'public'),
            'snils' => $request['snils']->store('user_docs', 'public'),
        ]);

        \Mail::to('sireax@yandex.ru')->send(new UserDocumentsMail($user));

        return redirect()->back()->with('success', 'Документы были отправлены на проверку. Вам придет уведомление после рассмотрения');
    }
}
