<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
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
//        $role = Role::where('name', 'freelancer')->first();
        $avatars = Storage::files('avatars');
//        foreach (User::latest()->get() as $user) {
        foreach (User::latest()->limit(367)->get() as $user) {
//            $user->roles()->save($role);
//            $user->created_at = Carbon::today()->subDays(rand(0, 365 * 3));
//            $user->save();

            $user->addMediaFromDisk($avatars[array_rand($avatars)], 'local')->preservingOriginal()->toMediaCollection('avatar');

//            $user->delete();
        }
    }
}
