<?php

namespace Database\Factories;

use App\Models\SubService;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubService::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
//        $service = \App\Models\Service::all()->random(1)->first()->pluck('id');
        return [
            "name"=>$this->faker->word,
            "image"=>"abcd.png",
            "service_id"=>$service
        ];
    }
}
