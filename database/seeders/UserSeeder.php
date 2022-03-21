<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        User::factory(10)
            ->create()
            ->each(function (User $user, int $index) {
                $key = $index % count(Role::TYPES);
                $key = $key == 0 ? 1 : $key;
                $user->roles()->sync([$key]);
            });
    }
}
