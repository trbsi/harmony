<?php

use Illuminate\Database\Seeder;
use App\Models\Number;

class NumbersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numbers = [
            [
                'number' => '33444441122222',
                'device_id' => 'aaa111bbb222',
            ],
            [
                'number' => '11222223344444',
                'device_id' => 'aaa111bbb222',
            ]
        ];

        foreach ($numbers as $number) {
            Number::create($number);
        }
    }
}
