<?php

namespace Database\Seeders;

use App\Models\PaymentCategories;
use Illuminate\Database\Seeder;

class PaymentCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paymentcategories = [
            [ 
            'payment_categories_name' => 'T-164',
            ],
            [ 
            'payment_categories_name' => 'M-164',
            ],
            [ 
            'payment_categories_name' => 'M-163',
            ],
        ];

        PaymentCategories::insert($paymentcategories);
    }
}
