<?php

namespace Ozgurince\Simpleforum\Seeds;

use Illuminate\Database\Seeder;
use Ozgurince\Simpleforum\Models\User;
use Ozgurince\Simpleforum\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User;
        $admin->id = 100;
        $admin->role_id = Role::where('name', 'admin')->first()->id;
        $admin->name = "Özgür Halil İNCE";
        $admin->email = "ozgurhalilince@gmail.com";
        $admin->username = "ozgurhalilince";
        $admin->password = bcrypt('oooooo');
        $admin->photo_path = "/vendor/simpleforum/img/user-avatar.png";
        $admin->remember_token = uniqid();
        $admin->phone_number = 0;
        $admin->is_active = 0;
        $admin->api_token = str_random(60);
        $admin->deleted_at = NULL;
        $admin->save();

        $member = new User;
        $member->id = 1000;
        $member->role_id = Role::where('name', 'member')->first()->id;  //
        $member->name = "Hadise Açıkgöz";
        $member->email = "hadiseacikgoz@gmail.com";
        $member->username = "hacikgoz";
        $member->password = bcrypt('hhhhhh');
        $member->photo_path = "/vendor/simpleforum/img/user-avatar.png";
        $member->remember_token = uniqid();
        $member->phone_number = 0;
        $member->is_active = 0;
        $member->api_token = str_random(60);
        $member->deleted_at = NULL;
        $member->save();

        $member = new User;
        $member->id = 1001;
        $member->role_id = Role::where('name', 'member')->first()->id;  //
        $member->name = "Cem Yılmaz";
        $member->email = "cemyilmaz@gmail.com";
        $member->username = "cyilmaz";
        $member->password = bcrypt('cccccc');
        $member->photo_path = "/vendor/simpleforum/img/user-avatar.png";
        $member->remember_token = uniqid();
        $member->phone_number = 0;
        $member->is_active = 0;
        $member->api_token = str_random(60);
        $member->deleted_at = NULL;
        $member->save();

        $member = new User;
        $member->id = 1002;
        $member->role_id = Role::where('name', 'member')->first()->id;  //
        $member->name = "Acun Ilıcalı";
        $member->email = "acunilicali@gmail.com";
        $member->username = "ailicali";
        $member->password = bcrypt('aaaaaa');
        $member->photo_path = "/vendor/simpleforum/img/user-avatar.png";
        $member->remember_token = uniqid();
        $member->phone_number = 0;
        $member->is_active = 0;
        $member->api_token = str_random(60);
        $member->deleted_at = NULL;
        $member->save();

        $member = new User;
        $member->id = 1003;
        $member->role_id = Role::where('name', 'member')->first()->id;  //
        $member->name = "Simge Yankı";
        $member->email = "simgeyanki@gmail.com";
        $member->username = "syanki";
        $member->password = bcrypt('ssssss');
        $member->photo_path = "/vendor/simpleforum/img/user-avatar.png";
        $member->remember_token = uniqid();
        $member->phone_number = 0;
        $member->is_active = 0;
        $member->api_token = str_random(60);
        $member->deleted_at = NULL;
        $member->save();

        $bannedUser = new User;
        $bannedUser->id = 2000;
        $bannedUser->role_id = Role::where('name', 'banned')->first()->id;  //
        $bannedUser->name = "Cristiano Ronaldo";
        $bannedUser->email = "cristianoronaldo@gmail.com";
        $bannedUser->username = "cronaldo";
        $bannedUser->password = bcrypt('cccccc');
        $bannedUser->photo_path = "/vendor/simpleforum/img/user-avatar.png";
        $bannedUser->remember_token = uniqid();
        $bannedUser->phone_number = 0;
        $bannedUser->is_active = 0;
        $bannedUser->api_token = str_random(60);
        $bannedUser->deleted_at = NULL;
        $bannedUser->save();

        $bannedUser = new User;
        $bannedUser->id = 2001;
        $bannedUser->role_id = Role::where('name', 'banned')->first()->id;  //
        $bannedUser->name = "Lionel Messi";
        $bannedUser->email = "lionelmessi@gmail.com";
        $bannedUser->username = "lmessi";
        $bannedUser->password = bcrypt('llllll');
        $bannedUser->photo_path = "/vendor/simpleforum/img/user-avatar.png";
        $bannedUser->remember_token = uniqid();
        $bannedUser->phone_number = 0;
        $bannedUser->is_active = 0;
        $bannedUser->api_token = str_random(60);
        $bannedUser->deleted_at = NULL;
        $bannedUser->save();
    }
}
