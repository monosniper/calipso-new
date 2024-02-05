<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
//        $avatars = Storage::files('avatars');
//        foreach (User::latest()->get() as $user) {
        foreach (User::all() as $user) {
            if(Str::endsWith($user->email, [
                "example.net",
                "example.com",
                "example.org",
            ])) $user->delete();
//        foreach (User::latest()->skip(1000)->limit(500)->get() as $user) {
//            $user->roles()->save($role);
//            $user->created_at = Carbon::today()->subDays(rand(0, 365 * 3));
//            $user->save();

//            $user->addMediaFromDisk($avatars[array_rand($avatars)], 'local')->preservingOriginal()->toMediaCollection('avatar');

//            $user->delete();
        }
    }
}
