<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\CreateRequest;
use App\Http\Requests\Admin\Users\UpdateRequest;
use App\Models\User;
use App\Services\UsersService;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    private $service;

    public function __construct(UsersService $service) {
        $this->service = $service;
    }

    public function index(Request $request)
    {

        $query = User::orderByDesc('id');

        if (!empty($value = $request->get('id'))) {
            $query->where('id', $value);
        }

        if (!empty($value = $request->get('name'))) {
            $query->where('name', 'like', '%' . $value . '%');
        }

        if (!empty($value = $request->get('last_name'))) {
            $query->where('last_name', 'like', '%' . $value . '%');
        }

        if (!empty($value = $request->get('email'))) {
            $query->where('email', 'like', '%' . $value . '%');
        }

        if (!empty($value = $request->get('status'))) {
            $query->where('status', $value);
        }

        if (!empty($value = $request->get('role'))) {
            $query->where('role', $value);
        }

        if (!empty($value = $request->get('type'))) {
            $query->where('type', $value);
        }

        $users = $query->paginate(config('ADMIN_PAGINATION'));


        $statuses = User::statusesList();
        $roles = User::rolesList();
        $types = User::typesList();

        return view('admin.users.index', compact('users', 'statuses', 'roles', 'types'));
    }


    public function create()
    {
        $statuses = User::statusesList();
        $roles = User::rolesList();
        $types = User::typesList();

        return view('admin.users.create', compact('statuses', 'roles', 'types'));
    }


    public function store(CreateRequest $request)
    {
        $user = $this->service->create($request);

        return redirect()->route('admin.users.show', $user);
    }


    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }


    public function edit(User $user)
    {
        $statuses = User::statusesList();
        $roles = User::rolesList();
        $types = User::typesList();

        return view('admin.users.show', compact('user', 'statuses', 'roles', 'types'));
    }


    public function update(UpdateRequest $request, User $user)
    {
        $user->update($request->all());

        return redirect()->route('admin.users.show', $user)
            ->with('success', 'Пользователь успешно обновлен.');
    }


    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Пользователь успешно удален.');
    }
}
