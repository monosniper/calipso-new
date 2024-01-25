<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class FreelancersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('name', 'freelancer')->first();
//        $avatars = Storage::files('avatars');
        foreach (User::latest()->limit(300)->get() as $user) {
            $user->roles()->save($role);

//            $user->addMediaFromDisk($avatars[array_rand($avatars)], 'local')->preservingOriginal()->toMediaCollection('avatar');

//            $user->delete();
        }
    }
}
