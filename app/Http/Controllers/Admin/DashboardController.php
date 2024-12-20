<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Today's date
        $today = Carbon::today();
        
        // Fetch today's sales total
        $todaySales = Order::whereDate('created_at', $today)->sum('amount');

        // Fetch this month's sales total
        $thisMonthSales = Order::whereMonth('created_at', $today->month)
                               ->whereYear('created_at', $today->year)
                               ->sum('amount');

        // Fetch this year's sales total
        $thisYearSales = Order::whereYear('created_at', $today->year)->sum('amount');
        
        // Fetch last year's sales total
        $lastYearSales = Order::whereYear('created_at', $today->subYear()->year)->sum('amount');

        // Fetch month-wise orders for current year
        $currentYearRevenue = Order::whereYear('created_at', $today->year)
            ->selectRaw('MONTH(created_at) as month, SUM(amount) as total_revenue')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        
        // Fetch month-wise total revenue for last year
        $lastYearRevenue = Order::whereYear('created_at', $today->subYear()->year)
            ->selectRaw('MONTH(created_at) as month, SUM(amount) as total_revenue')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Reformat data for the frontend chart
        $currentYearData = [];
        $lastYearData = [];

        for ($i = 1; $i <= 12; $i++) {
            // For current year
            $currentYearData[] = $currentYearRevenue->where('month', $i)->first()->total_revenue ?? 0;

            // For last year
            $lastYearData[] = $lastYearRevenue->where('month', $i)->first()->total_revenue ?? 0;
        }

        $growthPercentage = 0;
        if ($lastYearSales > 0) {
            // Calculate percentage growth
            $growthPercentage = (($thisYearSales - $lastYearSales) / $lastYearSales) * 100;
        } elseif ($lastYearSales == 0 && $thisYearSales > 0) {
            // If last year's sales were 0, and this year has sales, consider 100% growth
            $growthPercentage = 100;
        }
        return view('admin.dashboard', compact('todaySales', 'thisMonthSales', 'thisYearSales', 'lastYearSales', 'currentYearData', 'lastYearData','growthPercentage'));
    }

    /**
     * Helper function to reorganize the month-wise data
     */
    private function getMonthwiseData($orders)
    {
        $monthwise = [];

        // Fill the months with 0 if there are no orders for that month
        for ($i = 1; $i <= 12; $i++) {
            $monthwise[$i] = 0;  // Default to 0 orders for each month
        }

        // Populate the data from the query results
        foreach ($orders as $order) {
            $monthwise[$order->month] = $order->order_count;
        }

        return $monthwise;
    }
}
