<?php

use Illuminate\Database\Seeder;

class UsersQuestionsAnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('answers')->delete();
        \DB::table('questions')->delete();
        \DB::table('users')->delete();        
        
        factory(App\User::class, 10)->create()->each( function(App\User $u, $key){
            /**
             * @var $u App\User
             */
            $u->questions()
            ->saveMany(
                factory(App\Question::class, rand(10, 50))->make()
                )
                ->each(function($q) {
                    $q->answers()->saveMany(factory(App\Answer::class, rand(1, 5))->make());
                });
                    
        });
    }
}
