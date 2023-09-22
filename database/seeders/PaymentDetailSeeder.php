<?php

namespace Database\Seeders;

use App\Models\PaymentDetail;
use Illuminate\Database\Seeder;

class PaymentDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paymentdetail = [
            [
            'payment_categories_id' => 1,
            'payment_detail_name'   => 'Certification',
            'purpose'               => null,
            'price'                 => 50,
            ],
            [
            'payment_categories_id' => 1,
            'payment_detail_name'   => 'Authentication',
            'purpose'               => null,
            'price'                 => 25,
            ],
            [
            'payment_categories_id' => 1,
            'payment_detail_name'   => 'Evaluation',
            'purpose'               => null,
            'price'                 => 100,
            ],
            [
            'payment_categories_id' => 1,
            'payment_detail_name'   => 'TOR',
            'purpose'               => null,
            'price'                 => null,
            ],
            // [
            // 'payment_categories_id' => 1,
            // 'payment_detail_name'   => 'TOR',
            // 'purpose'               => 'Board Exam',
            // 'price'                 => 200,
            // ],
            // [
            // 'payment_categories_id' => 1,
            // 'payment_detail_name'   => 'TOR',
            // 'purpose'               => 'Travel Abroad',
            // 'price'                 => 100,
            // ],
            // [
            // 'payment_categories_id' => 1,
            // 'payment_detail_name'   => 'TOR',
            // 'purpose'               => 'Study Abroad',
            // 'price'                 => 100,
            // ],
            // [
            // 'payment_categories_id' => 1,
            // 'payment_detail_name'   => 'TOR',
            // 'purpose'               => 'Promotion',
            // 'price'                 => 100,
            // ],
            // [
            // 'payment_categories_id' => 1,
            // 'payment_detail_name'   => 'TOR',
            // 'purpose'               => 'Ranking',
            // 'price'                 => 100,
            // ],
            // [
            // 'payment_categories_id' => 1,
            // 'payment_detail_name'   => 'TOR',
            // 'purpose'               => 'Scholarship',
            // 'price'                 => 100,
            // ],
            // [
            // 'payment_categories_id' => 1,
            // 'payment_detail_name'   => 'TOR',
            // 'purpose'               => 'Employment Abroad',
            // 'price'                 => 200,
            // ],
            // [
            // 'payment_categories_id' => 1,
            // 'payment_detail_name'   => 'TOR',
            // 'purpose'               => 'Further Study',
            // 'price'                 => 400,
            // ],
            // [
            // 'payment_categories_id' => 1,
            // 'payment_detail_name'   => 'TOR',
            // 'purpose'               => 'Transfer',
            // 'price'                 => 400,
            // ],
            [
            'payment_categories_id' => 1,
            'payment_detail_name'   => 'Tuition Fees',
            'purpose'               => null,
            'price'                 => null,
            ],
            [
            'payment_categories_id' => 1,
            'payment_detail_name'   => 'Completion',
            'purpose'               => null,
            'price'                 => 25,
            ],
            [
            'payment_categories_id' => 1,
            'payment_detail_name'   => 'Diploma',
            'purpose'               => null,
            'price'                 => 300,
            ],
            [
            'payment_categories_id' => 1,
            'payment_detail_name'   => 'Adding and Dropping',
            'purpose'               => null,
            'price'                 => 25,
            ],
            [
            'payment_categories_id' => 1,
            'payment_detail_name'   => 'Changing of Grades',
            'purpose'               => null,
            'price'                 => 25,
            ],
            [
            'payment_categories_id' => 1,
            'payment_detail_name'   => 'Recommendation',
            'purpose'               => null,
            'price'                 => 25,
            ],
            [
            'payment_categories_id' => 1,
            'payment_detail_name'   => 'Registraion',
            'purpose'               => null,
            'price'                 => 25,
            ],





            [
            'payment_categories_id' => 2,
            'payment_detail_name'   => 'Toga',
            'purpose'               => null,
            'price'                 => 150,
            ],
            [
            'payment_categories_id' => 2,
            'payment_detail_name'   => 'Alumni(200.00)',
            'purpose'               => null,
            'price'                 => 200,
            ],
            [
            'payment_categories_id' => 2,
            'payment_detail_name'   => 'Alumni(500.00)',
            'purpose'               => null,
            'price'                 => 500,
            ],
            [
            'payment_categories_id' => 2,
            'payment_detail_name'   => 'Graduation Fee',
            'purpose'               => null,
            'price'                 => 250,
            ],
            [
            'payment_categories_id' => 2,
            'payment_detail_name'   => 'Student Teaching',
            'purpose'               => null,
            'price'                 => 1500,
            ],
            [
            'payment_categories_id' => 2,
            'payment_detail_name'   => 'NSTP/ROTC',
            'purpose'               => null,
            'price'                 => 200,
            ],
            [
            'payment_categories_id' => 2,
            'payment_detail_name'   => 'RLE',
            'purpose'               => null,
            'price'                 => 2000,
            ],
            [
            'payment_categories_id' => 2,
            'payment_detail_name'   => 'IGP',
            'purpose'               => null,
            'price'                 => null,
            ],
            [
            'payment_categories_id' => 2,
            'payment_detail_name'   => 'Miscellaneous Fee',
            'purpose'               => null,
            'price'                 => null,
            ],


            [
            'payment_categories_id' => 3,
            'payment_detail_name'   => 'Scholarship',
            'purpose'               => null,
            'price'                 => null,
            ],
        ];

        PaymentDetail::insert($paymentdetail);
    }
}
