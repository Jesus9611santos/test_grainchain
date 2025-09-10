<?php

namespace Tests\Feature;

use Exception;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class LoadTest extends TestCase
{
    #[Test]
    public function it_can_calculates_loads()
    {
        $loads = [
            ["id" => 233, "quantity" => 12350, "moisture" => 15.7],
            ["id" => 234, "quantity" => 2300, "moisture" => 12.6],
            ["id" => 236, "quantity" => 5045, "moisture" => 13.1],
            ["id" => 235, "quantity" => 6700, "moisture" => 13.9]
        ];

        $response = $this->postJson(route('v1.loads.calculate'), ['loads' => $loads]);
        $response->assertStatus(201)
            ->assertJson([
                'loads' => [
                    ['id'=>233,'quantity'=>12350,'adjust'=>1235,'total'=>11115,'value'=>66690],
                    ['id'=>234,'quantity'=>2300,'adjust'=>46,'total'=>2254,'value'=>13524],
                    ['id'=>236,'quantity'=>5045,'adjust'=>201.8,'total'=>4843.2,'value'=>29059.2],
                    ['id'=>235,'quantity'=>6700,'adjust'=>402,'total'=>6298,'value'=>37788],
                ]
            ]);
    }

    #[Test]
    public function it_cannot_calculate_loads_by_moisture()
    {
        $response = $this->postJson(route('v1.loads.calculate'), [
            'loads' => [["id"=>300,"quantity"=>1000,"moisture"=>18]]
        ]);

        $response->assertStatus(400)
                 ->assertJson([
                    'message' => 'Humedad fuera del rango permitido (12-17%).'
                ]);
    }
}
