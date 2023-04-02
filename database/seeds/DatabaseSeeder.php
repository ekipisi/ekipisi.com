<?php

use App\Models\TicketModel;
use App\Models\UserProductModel;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // for ($i = 1; $i <= 3500; $i++) {
        //     TicketModel::create([
        //         'user_id' => 8591,
        //         'status_id' => 3,
        //         'department_id' => 3,
        //         'priority_id' => 3,
        //         'type_id' => 0,
        //         'title' => str_random(30),
        //         'message' => str_random(130),
        //         'notes' => '',
        //         'ip' => '::1'
        //     ]);
        // }


        for ($i = 1; $i <= 180; $i++) {
            BillingModel::create([
                'service_id' => 14,
                'user_id' => 8591,
                'domain' => "deneme.com",
                'invoice_no' => "123123",
                'price' => 1,
                'currency_id' => 1,
                'payment_date' => date('Y-m-d'),
                'status' => 0,
                'is_paid' => 0
            ]);
        }

    }
}
