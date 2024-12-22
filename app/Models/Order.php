<?php 
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const PLACED = 1, DISPATCHED = 2, SHIPPED = 3, APPROVED = 4, CANCELED = 5;
    const COD = 1, ONLINE = 2;

    const STATUS = [
        self::PLACED => 'Placed',
        self::DISPATCHED => 'Dispatched', 
        self::SHIPPED => 'Shipped',
        self::APPROVED => 'Approved',
        self::CANCELED => 'Canceled'
    ];

    protected $casts = [
        'address' => 'object'
    ];

    protected $fillable = [
        'user_id', 'tracking_number', 'address', 'payment_mode', 'payment_id', 'status', 'remarks', 'total', 'discount_amount', 'amount', 'shipped_at', 'dispatched_at', 'approved_at', 'canceled_at'
    ];

    // Relationship with User
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Relationship with OrderItem
    public function items(){
        return $this->hasMany(OrderItem::class);
    }


    public function getStatusAttribute($value){
        return self::STATUS[$value];
    }
    /**
     * Calculate the percentage change in sales compared to the previous day,
     * and return a status indicating if it's higher or lower.
     *
     * @return array
     */
    public static function salesPercentageChange()
    {
        // Get today's date and the previous day's date
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        // Get today's total sales
        $todaySales = self::whereDate('created_at', $today)
                          ->where('status', self::APPROVED) // Ensure only approved orders are counted
                          ->sum('total'); // Sum the 'total' field for today

        // Get yesterday's total sales
        $yesterdaySales = self::whereDate('created_at', $yesterday)
                              ->where('status', self::APPROVED) // Ensure only approved orders are counted
                              ->sum('total'); // Sum the 'total' field for yesterday

        // Initialize result
        $result = [
            'percentage_change' => 0,
            'status' => 'No change' // Default status if no sales data
        ];

        // Prevent division by zero if there were no sales yesterday
        if ($yesterdaySales == 0) {
            if ($todaySales > 0) {
                $result['percentage_change'] = 100; // 100% increase if there were sales today but none yesterday
                $result['status'] = 'Higher';
            } else {
                $result['percentage_change'] = 0; // No change if no sales today and no sales yesterday
                $result['status'] = 'No sales';
            }
        } else {
            // Calculate percentage change: (Today's Sales - Yesterday's Sales) / Yesterday's Sales * 100
            $percentageChange = (($todaySales - $yesterdaySales) / $yesterdaySales) * 100;
            $result['percentage_change'] = round($percentageChange, 2); // Round to 2 decimal places

            // Set the status based on the percentage change
            if ($percentageChange > 0) {
                $result['status'] = 'Higher'; // Sales increased
            } elseif ($percentageChange < 0) {
                $result['status'] = 'Lower'; // Sales decreased
            } else {
                $result['status'] = 'No change'; // No change in sales
            }
        }

        return $result;
    }

}

