<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\UpdatePasswordRequest;
use App\Http\Requests\Settings\UpdateRequest;
use Auth;

class SettingsController extends Controller
{
    public function index() {
        $user = Auth::user();

        return view('profile.settings.index', compact('user'));
    }

    public function update(UpdateRequest $request) {
        $user = Auth::user();

        $data = [
            'name' => $request['name'],
            'last_name' => $request['last_name'],
            'middle_name' => $request['middle_name'],
            'phone' => $request['phone'],
        ];

        $data = $user->isIndividual() ? array_merge($data, [
            'passport_serial' => $request['passport_serial'],
            'passport_code' => $request['passport_code'],
            'passport_issue' => $request['passport_issue'],
            'passport_issue_date' => $request['passport_issue_date']
        ]) : array_merge($data, [
            'company_name' => $request['company_name'],
            'company_address' => $request['company_address'],
            'company_inn' => $request['company_inn'],
            'company_account' => $request['company_account']
        ]);
        $user->update($data);

        return redirect()->back()
            ->with('success', 'Информация успешно обновлена');
    }

    public function updatePassword(UpdatePasswordRequest $request) {
        $user = Auth::user();

        $user->update([
            'password' => bcrypt($request['password'])
        ]);

        return redirect()->back()
            ->with('success', 'Пароль успешно изменен');
    }
}
