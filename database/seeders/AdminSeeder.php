<?php

namespace Database\Seeders\Backoffice;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creacion del usuario administrador
        $password = '*Pw0'.Str::random(9);

        $user = User::updateOrCreate(['name' => 'Admin'],[
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make($password),
            'email_verified_at' => Carbon::now()->toDateTimeString()
        ]);
        
        //Asignacion del rol de superusuario
        $user->assignRole('superadmin');

        return var_dump('Admin user created and the password is: '.$password."\n".'I would recommend to not lose that password');
    }
}
