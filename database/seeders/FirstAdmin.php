<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class FirstAdmin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create($this->adminData());
    }
    public function adminData(){
        return [
          'name'=>'admin',
          'email' => 'admin@gmail.com',
          'password' => Hash::make ('12345678'),
          'email_verified_at'=> Carbon::now()
        ];
    }
}
