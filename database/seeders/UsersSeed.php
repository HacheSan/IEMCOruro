<?php


namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UsersSeed extends Seeder
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
                'name'=>'Hache Admin',
                'surname'=>'Chino',
                'gender'=>'Masculino',
                'marital_status'=>'Soltero',
                'address'=>'San Franz',
                'status'=>'Bautizado',
                'phone'=>'14237344',
                'email'=>'hache@gmail.com',
                'password'=> Hash::make('ñlkjhgfd'),
                'role'=>1,
            ],
            [
                'name'=>'Hache Moderador',
                'surname'=>'Chino',
                'gender'=>'Masculino',
                'marital_status'=>'Soltero',
                'address'=>'San Franz',
                'status'=>'Bautizado',
                'phone'=>'14237344',
                'email'=>'hachemoder@gmail.com',
                'password'=> Hash::make('ñlkjhgfd'),
                'role'=>2,
            ],
            [
                'name'=>'Hache Eco',
                'surname'=>'Chino',
                'gender'=>'Masculino',
                'marital_status'=>'Soltero',
                'address'=>'San Franz',
                'status'=>'Bautizado',
                'phone'=>'14237344',
                'email'=>'hacheeco@gmail.com',
                'password'=> Hash::make('ñlkjhgfd'),
                'role'=>3,
            ],
        ];
        foreach ($user as $key => $value){
            User::create($value);
        }
    }
}
