<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Mail\BuildRequestStatusChanged;
use App\Mail\FeedbackMail;
use App\Models\BuildRequest;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Mail;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $calculator = json_decode(file_get_contents(public_path('internal/calculator.json')), true);
        $rate = $calculator['rate'];

        return view('profile.index', compact('user', 'rate'));
    }

    public function developer()
    {
        $user = Auth::user();
//        if (!$user->isDeveloper()) {
//            abort(403);
//        }

        $statuses = BuildRequest::statusesList();
        $requests = BuildRequest::where('developer_id', $user->id)->with('user')->orderBy('id', 'DESC')->get();

        return view('profile.developer', compact('requests', 'statuses'));
    }

    public function changeStatus(Request $request)
    {
        $this->validate($request, [
            'request_id' => ['required', 'numeric'],
            'status' => ['required', 'string']
        ]);
        $user = Auth::user();

        $br = BuildRequest::where('id', $request['request_id'])->where('developer_id', $user->id)->first();
        if (!$br) abort(404);

        if (!in_array($request['status'], array_keys(BuildRequest::statusesList()))) {
            abort(404);
        }

        $br->update([
            'status' => $request['status']
        ]);

        Mail::to(User::find($br->user_id)->email)->send(new BuildRequestStatusChanged(User::find($br->user_id), $br));

        return [
            'success' => true,
            'status' => $br->status
        ];
    }

    public function feedback(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'message' => ['required', 'string', 'max:1000']
        ]);

        $settings = json_decode(file_get_contents(public_path('internal/main.json')), true);

        if ($settings['feedback_email']) {
            Mail::to($settings['feedback_email'])
                ->send(new FeedbackMail(Auth::id(), $request['name'], $request['email'], $request['message']));
        }

        return redirect()->back()
            ->with('success', 'Ваше сообщение успешно отправлено');
    }
}
