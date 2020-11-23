<?php


namespace App\Services;

use App\Http\Requests\Projects\OrderRequest;
use App\Models\Orders\Order;
use App\Models\Orders\ProjectAttribute;
use App\Models\Orders\ProjectData;
use App\Models\Projects\Project;
use App\Services\Projects\SmetaGateway;
use Auth;
use DB;

class OrderService
{

    private $gateway;

    public function __construct(SmetaGateway $gateway) {
        $this->gateway = $gateway;
    }

    public function order($id, OrderRequest $request) {

        $user = Auth::user();
        $project = $this->getProject($id);

        $price = $this->getCalculatedPrice($project, $request);

        DB::transaction(function () use ($project, $request, $price, $user) {

            $order = Order::make([
                'user_id' => $user->id,
                'project_id' => $project->id,

                'order_name' => $request['order_name'],
                'order_email' => $request['order_phone'],
                'order_phone' => $request['order_phone'],
                'price' => $price
            ]);
            $order->save();

            $projectData = ProjectData::make([
                'order_id' => $order->id,
                'project_id' => $project->id,
                'data' => '',
                'total_price' => $price
            ]);
            $projectData->save();

            foreach (ProjectAttribute::all() as $attribute) {
                $value = $request['order_attributes'][$attribute->id] ?? null;
                if (!empty($value)) {
                    $order->values()->create([
                        'attribute_id' => $attribute->id,
                        'value' => $value
                    ]);
                }
            }

            return $order;
        });
    }

    public function cancel($id) {
        $order = $this->getOrder($id);

//        todo: cancel order
    }

    private function getOrder($id): Order
    {
        return Order::findOrFail($id);
    }

    private function getProject($id): Project
    {
        return Project::findOrFail($id);
    }

    private function getCalculatedPrice(Project $project, OrderRequest $request) {
        return $project->price;
//        return $this->gateway->calculatePrice($project, $request);
    }
}
