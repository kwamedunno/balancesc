<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        [
            'name' => "Andrew Takyi-Appiah",
            'email' => 'akta@myzeepay.com',
            'department' => '11',
            'password' => Hash::make("Z33Pay@theFront"), //password
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
            'name' => "Maureen Molly Basemera",
            'email' => 'mb@myzeepay.com',
            'department' => '2',
            'password' => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi", //password
            'role' => "3"
        ],
        [
            'name' => "Siisi Forson",
            'email' => 'sf@myzeepay.com',
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
        ],
        [
            'name' => "Samuel Lee Ninson",
            'email' => 'sl@myzeepay.com',
            'department' => '3',
            'password' => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi", //password
            'role' => "2"
        ],
        [
            'name' => "Isaac Agyemang",
            'email' => 'is@myzeepay.com',
            'department' => '5',
            'password' => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi", //password
            'role' => "2"
        ],
        [
            'name' => "Celestina Tembo",
            'email' => 'ct@myzeepay.com',
            'department' => '4',
            'password' => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi", //password
            'role' => "3"
        ],
        [
            'name' => "Gloria Kumi",
            'email' => 'gk@myzeepay.com',
            'department' => '4',
            'password' => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi", //password
            'role' => "3"
        ],
        [
            'name' => "Cecil Fixon-Owoo",
            'email' => 'cf@myzeepay.com',
            'department' => '8',
            'password' => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi", //password
            'role' => "2"
        ],
        [
            'name' => "Samuel Kwadwo Tuffuor",
            'email' => 'skt@myzeepay.com',
            'department' => '8',
            'password' => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi", //password
            'role' => "3"
        ],
        [
            'name' => "Emmanuel Osei Frimpong",
            'email' => 'ef@myzeepay.com',
            'department' => '7',
            'password' => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi", //password
            'role' => "2"
        ],
        [
            'name' => "Nii Odoi Charway",
            'email' => 'nic@myzeepay.com',
            'department' => '7',
            'password' => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi", //password
            'role' => "3"
        ],
        [
            'name' => "Christiana Otuko Miyante Odonkor",
            'email' => 'como@myzeepay.com',
            'department' => '7',
            'password' => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi", //password
            'role' => "3"
        ],
        [
            'name' => "Maria Sam",
            'email' => 'ms@myzeepay.com',
            'department' => '9',
            'password' => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi", //password
            'role' => "2"
        ],
        [
            'name' => "Jessica Lillian Naakai Armah",
            'email' => 'jlna@myzeepay.com',
            'department' => '9',
            'password' => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi", //password
            'role' => "3"
        ],
        [
            'name' => "Anita Osei-Wusu",
            'email' => 'aow@myzeepay.com',
            'department' => '3',
            'password' => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi", //password
            'role' => "3"
        ],
        [    'name' => "Kwame Acquah",
            'email' => 'eka@myzeepay.com',
            'department' => '1',
            'password' => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi", //password
            'role' => "1"
        ],
        [
            'name' => "Stephanie Amegashie ",
            'email' => 'seaa@myzeepay.com',
            'department' => '10',
            'password' => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi", //password
            'role' => "2"
        ],
        [
            'name' => "Michael Ekow Selby",
            'email' => 'm.selby@myzeepay.com',
            'department' => '1',
            'password' => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi", //password
            'role' => "3"
        ],
        [
            'name' => "Adwoa Konadu Appiah",
            'email' => 'aak@myzeepay.com',
            'department' => '1',
            'password' => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi", //password
            'role' => "3"
        ],
        [
            'name' => "Kingsley Nabla",
            'email' => 'kn@myzeepay.com',
            'department' => '1',
            'password' => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi", //password
            'role' => "3"
        ],
        [
            'name' => "Yaa Serwaa Seidu",
            'email' => 'yss@myzeepay.com',
            'department' => '6',
            'password' => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi", //password
            'role' => "2"
        ]

        ]);
    }
}
