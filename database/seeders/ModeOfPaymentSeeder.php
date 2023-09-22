<?php

namespace Database\Seeders;

use App\Models\ModeOfPayment;
use Illuminate\Database\Seeder;

class ModeOfPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modeofpayment = [
            [
            'mode_of_payment_name' => 'Cash',
            ],
            [
            'mode_of_payment_name' => 'Check',
            ],
            [
            'mode_of_payment_name' => 'Money Order',
            ],
            [
            'mode_of_payment_name' => 'Other',
            ],
        ];

        ModeOfPayment::insert($modeofpayment);
    }
}
