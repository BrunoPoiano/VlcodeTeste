<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PopulateTables extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => "Anna",
                'email' => "Anna@email",
                'password' => Hash::make('anna'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => "Pedro",
                'email' => "pedro@pedro",
                'password' => Hash::make('pedro'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => "Bruno",
                'email' => "bruno@bruno",
                'password' => Hash::make('bruno'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => "Maria",
                'email' => "maria@maria",
                'password' => Hash::make('maria'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        $users = User::all();

        foreach ($users as $user) {
            Todo::insert([
                [
                    'user_id' => $user->id,
                    'name' => 'Lavar Roupa',
                    'date' => Carbon::now()->addWeeks(1),
                ],
                [
                    'user_id' => $user->id,
                    'name' => 'Fazer Compras',
                    'date' => Carbon::now()->addWeeks(2),
                ],
                [
                    'user_id' => $user->id,
                    'name' => 'Terminar Projeto',
                    'date' => Carbon::now()->addWeeks(2),
                ],
                [
                    'user_id' => $user->id,
                    'name' => 'Visitar hospital',
                    'date' => Carbon::now()->addWeeks(2),
                ],
            ]);
        }
    }
}
