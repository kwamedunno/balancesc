<?php

use Illuminate\Database\Seeder;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('staff')->insert([
        [    'name' => "Kwame Acquah",
            'email' => 'eka@myzeepay.com',
            'department' => '1',
            'password' => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi", //password
            'role' => "1"
        ],
        [
            'name' => "Felicity Jaforktuk",
            'email' => 'fj@myzeepay.com',
            'department' => '2',
            'password' => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi", //password
            'role' => "3"
        ],
        [
            'name' => "Ernest Adu Owusu",
            'email' => 'eao@myzeepay.com',
            'department' => '2',
            'password' => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi", //password
            'role' => "3"
        ],
        [
            'name' => "Dede Quarshie",
            'email' => 'dq@myzeepay.com',
            'department' => '2',
            'password' => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi", //password
            'role' => "2"
        ]
        ]);
    }
}
