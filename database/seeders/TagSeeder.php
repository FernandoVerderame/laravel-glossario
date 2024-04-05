<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['label' => 'Fullstack', 'color' => 'danger'],
            ['label' => 'Backend', 'color' => 'warning'],
            ['label' => 'Frontend', 'color' => 'success'],
        ];

        foreach ($tags as $tag) {
            $new_tag = new Tag();

            $new_tag->label = $tag['label'];
            $new_tag->color = $tag['color'];
            $new_tag->save();
        }
    }
}
