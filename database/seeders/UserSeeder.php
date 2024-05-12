<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user =[
            [
                'name'=>'penyewa',
                'email'=>'penyewa@gmail.com',
                'role'=>'penyewa',
                'alamat'=>'Jl.riau',
                'notelp'=>'04535353',
                'nosim'=>'33222111',
                'password'=>bcrypt('12345'),
            ],
              [
                'name'=>'admin',
                'email'=>'admin@gmail.com',
                'role'=>'pemilik',
                'alamat'=>'Jl.riau',
                'notelp'=>'04535353',
                'nosim'=>'33222111',
                'password'=>bcrypt('12345'),
              ],
              ];

              foreach($user as $key=>$val){
                User::create($val);

              }
    }
}
