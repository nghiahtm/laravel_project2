<?php

namespace App\Http\Controllers\Api\V1\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RevenueController extends Controller
{
    public function getAllRevenue(Request $request)
    {
        $years = $request->year;
        $monthlyOrders = DB::table('orders')
            ->select(DB::raw('MONTH(updated_at) as month'), DB::raw('SUM(total_bill) as total_revenue'))
            ->whereYear('updated_at', $years)
            ->where("status_order","=","4")
            ->groupBy(DB::raw('MONTH(updated_at)'))
            ->get()
            ->keyBy('month');
        $allMonths = collect(range(1, 12))->mapWithKeys(function($month) use ($monthlyOrders) {
            return [$month => $monthlyOrders->get($month, (object) ['month' => $month, 'total_revenue' => 0])];
        });
        return $this->sentSuccessResponse($allMonths);
    }

    private function calculateOrdersForYear($years)
    {
        for ($i = 1; $i < 12; $i++){
            $orders = Order::
            whereYear('updated_at', $years)
                ->whereMonth('updated_at', $i)->get();

        }
    }
}
