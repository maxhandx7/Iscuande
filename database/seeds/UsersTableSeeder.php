<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Alan Ferney',
            'apellido' => 'Carabali Paz',
            'username' => '@alancarabali',
            'tipo_documento' => 'cc',
            'no_documento' => '1143982071',
            'telefono' => '3145561727',
            'email' => 'alancarabali@gmail.com',
            'tipo' => 'ADMIN',
            'estado' => 'ACTIVO',
            'password'=>'$2y$10$liZl2fBn4wBbJEAzsUobLuArOrEgurYORgMMPIw8J2yUU/BVSs/4y',
        ]);
    }
}
