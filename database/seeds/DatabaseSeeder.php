<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        // $this->call(UsersTableSeeder::class);
        //factory(App\User::class, 3)->create()->
        factory(App\User::class, 3)->create()->each( function(App\User $u, $key){
            /**
             * @var $u App\User
             */
            $u->questions()
                ->saveMany(
                    factory(App\Question::class, rand(1, 5))->make()
                    );
            
        });
        
        
    }
}
