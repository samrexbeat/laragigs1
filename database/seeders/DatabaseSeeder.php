<?php

namespace Database\Seeders;

 

use App\Models\User;
use App\Models\Listing;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * 
     *  @return void
     */
    public function run()
    {
        //  User::factory(10)->create();

        $user=User::factory()->create([
            'name'=> 'John Doe',
            'email'=> 'john@gmail.com'
        ]);

         Listing::factory(10)->create([
            'user_id' => $user->id
         ]);

         \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
         ]);

        // Listing::create([
        //     'title' => 'Laravel Senior Developer', 
        //     'tags' => 'laravel javascript',
        //     'company' => 'Acme Corp',
        //     'location' => 'Boston MA',
        //     'email' => 'email1@email.com',
        //     'website' => 'https://www.acme.com',
        //     'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam minima et illo reprehenderit quas possimus voluptas repudiandae cum expedita, eveniet aliquid, quam illum quaerat consequatur! Expedita ab consectetur tenetur delensiti?',
        //     'updated_at' => '2023-04-04 14:53:23 ', 
        //     'created_at' => '2023-04-04 14:53:23 '
        // ]);

        // Listing::create([
        //     'title' => 'Full-Stack Engineer',
        //     'tags' => 'laravel backend api',
        //     'company' => 'Stark Industries',
        //     'location' => 'New York NY',
        //     'email' => 'email2@email.com',
        //     'website' => 'https://www.starkindustries.com',
        //     'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam minima et illo reprehenderit quas possimus voluptas repudiandae cum expedita, eveniet aliquid, quam illum quaerat consequatur! Expedita ab consectetur tenetur delensiti?',
        //     'updated_at' => '2023-04-04 14:53:23 ', 
        //     'created_at' => '2023-04-04 14:53:23 '
        // ]);
    }
}