<?php

namespace App\Console\Commands;

use App\Enums\CommonEnums;
use App\Http\Controllers\GeoController;
use App\Http\Controllers\InventoryController;
use App\Models\InventoryPrice;
use App\Models\Organization;
use App\Models\Settings;
use Illuminate\Console\Command;

class checkprice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'economic:price';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Economic Price estomat calculation';

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
        $data=[
            "inventory_items"=>[
                ["name"=>"Air Cooler", "inventory_id"=>3, "material"=>"Desert", "size"=>"< 10 L", "quantity"=>1],
                ["name"=>"Dishwasher", "inventory_id"=>33, "material"=>"Built In", "size"=>"regular", "quantity"=>1]
            ],
            "source"=>["lat"=>"12.906237915227", "lng"=>"80.023958254606"],
            "destination"=>["lat"=>"12.95881728352", "lng"=>"79.978661108762"]
        ];
        foreach (Settings::get() as $setting) {
            switch ($setting['key']) {
                case "tax":
                    $cost_structure['tax'] = $setting['value'];
                    break;

                case "surge_charge":
                    $cost_structure['surge_charge'] = $setting['value'];
                    break;

                case "buffer_amount":
                    $cost_structure['buffer_amount'] = $setting['value'];
                    break;
            }
        }
        $distance = (double)GeoController::distance($data['source']['lat'], $data['source']['lng'], $data['destination']['lat'], $data['destination']['lng']);
        $economic = InventoryController::getEconomicPrice($data, "0",  1,);
        $economic_price =$economic + $cost_structure["surge_charge"] + $cost_structure["buffer_amount"];
        $economic_price += $economic_price * ($cost_structure["tax"] / 100);

        $count=1;
        foreach ($data["inventory_items"] as $item){
            $minprice= InventoryPrice::where(["inventory_id"=>$item['inventory_id'],
                "size"=>$item['size'],
                "material"=>$item['material'], "status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])
                ->whereIn("organization_id", Organization::where("zone_id", 1)->pluck('id'))->min('price_economics');

            $this->info('Inventory Name '.$count.': '.$item['name']);
            $this->info('Inventory Material '.$count.': '.$item['material']);
            $this->info('Inventory Size '.$count.': '.$item['size']);
            $this->info('Economic Min price '.$count.': '.$minprice);

            $this->info('');
            $count+=1;
        }
        $this->info('Distance: '.$distance);
        $this->info('Economic Price: '.$economic);
        $this->info('Surge Charge: '.$cost_structure["surge_charge"]);
        $this->info('Buffer Amount: '.$cost_structure["buffer_amount"]);
        $this->info('Tax: '.$cost_structure["tax"]);
        $this->info('Economic Estimate Price: '.$economic_price);
    }
}
