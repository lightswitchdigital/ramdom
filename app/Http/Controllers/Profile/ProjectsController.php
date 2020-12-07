<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Projects\OrderRequest;
use App\Models\Order;
use App\Models\Projects\Project;
use App\Models\Projects\Purchase\PurchasedProject;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{

    public function index() {
        $user = Auth::user();
        $projects = $user->purchasedProjects()->paginate(env('PROJECTS_PAGINATION'));

        return view('profile.projects.index', compact('projects'));
    }

    public function order(PurchasedProject $project) {
        $developers = User::active()->developers()->paginate(10);

        return view('profile.projects.order', compact('developers', 'project'));
    }

    public function orderSubmit(PurchasedProject $project, User $developer, OrderRequest $request) {

        $user = Auth::user();

        $params = [
            'order_name' => $request['order_name'],
            'order_email' => $request['order_email'],
            'order_phone' => $request['order_phone'],
            'order_city' => $request['order_city'],
            'order_address' => $request['order_address'],
            'order_postal_code' => $request['order_postal_code'],
            'price' => $this->calculatePrice($project)
        ];

        if ($user->isIndividual())
            $params = array_merge($params, [
                'order_passport_serial' => $request['order_passport_serial'],
                'order_passport_number' => $request['order_passport_number'],
                'order_passport_issue' => $request['order_passport_issue'],
                'order_passport_issue_date' => $request['order_passport_issue_date']
            ]);

        elseif ($user->isEntity())
            $params = array_merge($params, [
                'order_company_name' => $request['order_company_name'],
                'order_company_address' => $request['order_company_address'],
                'order_company_inn' => $request['order_company_inn'],
                'order_company_kpp' => $request['order_company_kpp'],
                'order_company_payment_account' => $request['order_company_payment_account'],
                'order_company_correspondent_account' => $request['order_company_correspondent_account']
            ]);


        $order = Order::make($params);

        $order->user()->associate($user);
        $order->developer()->associate($developer);
        $order->project()->associate($project);

        $order->save();

        return redirect()->back()
            ->with('success', 'Заказ на строительство успешно создан и передан застройщику. Скоро он с вами свяжется по телефону');
    }

    public function calculatePrice(PurchasedProject $project) {

//        todo: Подключить смету
        return $project->project->price;
    }

}
