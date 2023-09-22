<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
            'name' => 'Dominic M. Lariosa',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'rule_id' => 1,
            ],
            [
            'name' => 'Cashier Sample',
            'email' => 'cashier@gmail.com',
            'password' => bcrypt('cashier123'),
            'rule_id' => 2,
            ],
        ];

        User::insert($user);
    }
}
