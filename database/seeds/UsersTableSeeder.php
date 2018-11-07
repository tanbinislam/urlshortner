<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 20)->create()->each(function ($u) {
            factory(App\Links::class, 100)->create([
                'user_id' => $u->id,
                'unauthed' => '0',
            ]);
        });
        factory(App\Links::class, 200)->create();
        $user = User::find(1);
        $user->email = 'test@example.com';
        $user->save();
    }
}
