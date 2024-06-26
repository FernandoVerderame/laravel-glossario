<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Glossario',
            'email' => 'glossario@ciao.com',
        ]);

        $this->call([TagSeeder::class]);

        \App\Models\Word::factory(10)->create();

        \App\Models\Link::factory(5)->create();
    }
}
