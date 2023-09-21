<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Http\Livewire\Traits\FuncionesGenerales;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class PicksSeeder extends Seeder
{
    use FuncionesGenerales;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::role('participante')->get();
        foreach($users as $user){
            $this->create_missing_picks_user($user);
        }
        $this->create_positions_to_user_with_role();
    }
}
