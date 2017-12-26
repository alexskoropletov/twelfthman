<?php

use Illuminate\Database\Seeder;

class PhotosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insert = [
            [
                'name' => 'Wheelchair basketball',
                'original_file_name' => 'wheelchair-basketball.jpg',
                'image' => 'image-1.jpg',
                'thumbnail' => 'image-1.png',
                'status' => 1
            ],
            [
                'name' => 'Hockey',
                'original_file_name' => 'hockey.jpg',
                'image' => 'image-2.jpg',
                'thumbnail' => 'image-2.png',
                'status' => 1
            ],
            [
                'name' => 'Sprint',
                'original_file_name' => 'sprint.jpg',
                'image' => 'image-3.jpg',
                'thumbnail' => 'image-3.png',
                'status' => 1
            ],
            [
                'name' => 'Snowboarding',
                'original_file_name' => 'snowboarding.jpg',
                'image' => 'image-4.jpg',
                'thumbnail' => 'image-4.png',
                'status' => 1
            ],
            [
                'name' => 'Cycling',
                'original_file_name' => 'cycling.jpg',
                'image' => 'image-5.jpg',
                'thumbnail' => 'image-5.png',
                'status' => 1
            ],
        ];
        foreach ($insert as $dataSet) {
            DB::table('photo')->insert($dataSet);
        }
    }
}
