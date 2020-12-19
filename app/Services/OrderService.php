<?php


namespace App\Services;

use App\Http\Requests\Projects\OrderRequest;
use App\Models\Order;
use App\Models\Projects\Project;
use App\Models\User;
use App\Services\Projects\SmetaGateway;

class OrderService
{

    private $gateway;

    public function __construct(SmetaGateway $gateway) {
        $this->gateway = $gateway;
    }

    public function order($user_id, $project_id, OrderRequest $request) {

        $user = $this->getUser($user_id);
        $project = $this->getProject($project_id);
        $developer = $this->getUser($request['developer_id']);

        $params = [
            'order_name' => $request['order_name'],
            'order_email' => $request['order_email'],
            'order_phone' => $request['order_phone'],
            'order_city' => $request['order_city'],
            'order_address' => $request['order_address'],
            'order_postal_code' => $request['order_postal_code'],
            'price' => $this->getCalculatedPrice($project)
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

        return $order->save();
    }

    public function getCalculatedPrice(Project $project) {
        return $project->price;
    }

    public function getUser($id): User
    {
        return User::findOrFail($id);
    }

    private function getProject($id): Project
    {
        return Project::findOrFail($id);
    }
}
