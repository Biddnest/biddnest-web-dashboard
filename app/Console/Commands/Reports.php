<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Report;
use App\Models\Booking;
use App\Models\User;
use App\Models\Bid;
use App\Models\Payment;
use App\Models\ReviewSentiment;
use App\Enums\BookingEnums;
use App\Enums\PaymentEnums;
use App\Enums\BidEnums;
use App\Enums\ReviewSentimentEnum;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonInterval;

class Reports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reports:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $this->alert("Analyzing Data to generate reports");
            /*LEad to opportunity */
        $booked_users = Booking::where("status",'>',BookingEnums::$STATUS['payment_pending'])
            ->whereNotIn("status",[BookingEnums::$STATUS['hold'],BookingEnums::$STATUS['bounced'],BookingEnums::$STATUS['cancelled']])
            ->groupBy('user_id')
            ->count();

        $total_users = User::count();
        $lead_to_opportunity_percentage = ((float) $booked_users/(float)$total_users) * 100;

        $this->comment("Avg Lead To opportunity: ".$lead_to_opportunity_percentage);

        /*Opportunity to Order*/
        $enquiry_count = Booking::where("status",'<',BookingEnums::$STATUS['payment_pending'])
            ->count();

        $order_count = Booking::where("status",'>',BookingEnums::$STATUS['payment_pending'])
            ->whereNotIn("status",[BookingEnums::$STATUS['hold'],BookingEnums::$STATUS['bounced'],BookingEnums::$STATUS['cancelled']])
            ->count();

        $opp_to_order_percentage = ((float)$order_count/(float)$enquiry_count)*100;
//        $this->comment("Enquiries: ".$enquiry_count);
//        $this->comment("Placed Orders: ".$order_count);
        $this->comment("Avg Opportunity to Order: ".$opp_to_order_percentage);

        /*average revenue per (participated) customer*/
        $total_sales = Payment::where("status",PaymentEnums::$STATUS['completed'])->avg('grand_total');
        $average_revenue_per_customer = (float) $total_sales / (float) $booked_users;
        $this->comment("Average revenue per Customer: ".$average_revenue_per_customer);

        /*Average Order Value*/
        $average_order_value = (float)$total_sales/(float)$order_count;
        $this->comment("Avg Order Value: for $order_count orders: ".$average_order_value);


        /*average First Response time*/
        $average_first_response = Bid::whereNotIn("status",[BidEnums::$STATUS['rejected'], BidEnums::$STATUS['lost'], BidEnums::$STATUS['expired']])->avg(DB::raw("created_at - submit_at"));
//        $average_first_response = Carbon::parse($average_first_response)->diffForHumans();
        $this->comment("Avg First Response Time: ".$average_first_response);

        /*Average CSAT*/
        $positive_review_count = ReviewSentiment::where("summary", ReviewSentimentEnum::$REVIEW_SUMMARY['pos'])->count();
        $total_review_count = ReviewSentiment::count();
        $average_csat = ((float)$positive_review_count/(float)$total_review_count)*100;
        $this->comment("Avg CSAT: ".$average_csat);

        /*Inserting  to db*/
        $report = new Report;
        $report->avg_lead_to_opportunity = $lead_to_opportunity_percentage;
        $report->avg_opportunity_to_order = $opp_to_order_percentage;
        $report->avg_order_value = $average_order_value;
        $report->avg_revenue_per_customer = $average_revenue_per_customer;
        $report->avg_frt = $average_first_response;
        $report->avg_csat = $average_csat;

        if($report->save())
            $this->info("Saved to db");
        else
            $this->error("Coudln't save to db");
    }
}
