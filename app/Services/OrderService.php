<?php


namespace App\Services;

use App\Http\Requests\Projects\OrderRequest;
use App\Jobs\SendEmailJob;
use App\Mail\DeveloperNewOrderMail;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Projects\Purchase\PurchasedProject;
use App\Models\User;

class OrderService
{

    public function order(User $user, PurchasedProject $project, OrderRequest $request)
    {


        if (!$developer = User::developers()->whereId($request['developer_id'])->first()) {
            throw new \DomainException('Застройщик не найден');
        }

        $params = [
            'order_name' => $request['order_name'],
            'order_email' => $request['order_email'],
            'order_phone' => $request['order_phone'],
            'order_city' => $request['order_city'],
            'order_address' => $request['order_address'],
            'order_postal_code' => $request['order_postal_code'],
            'price' => $project->price
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

        SendEmailJob::dispatch($developer, new DeveloperNewOrderMail($project, $developer));
        Notification::generate([
            'user_id' => $developer->id,
            'title' => 'Новый заказ',
            'content' => 'Новый заказ на строительство проекта ' . $project->project->title . ' на сумму ' . $project->price
        ]);

        return $order->save();
    }
}
