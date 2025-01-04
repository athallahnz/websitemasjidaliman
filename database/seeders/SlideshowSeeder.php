<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slideshow;

class SlideshowSeeder extends Seeder
{
    public function run()
    {
        Slideshow::create([
            'title' => 'Sholat Ied',
            'description' => 'Kegiatan Sholat Ied di Masjid Al Iman.',
            'image' => 'images/sholat-ied.JPG',
        ]);

        Slideshow::create([
            'title' => 'View Masjid',
            'description' => 'Pemandangan Masjid yang indah.',
            'image' => 'images/view-masjid.JPG',
        ]);

        Slideshow::create([
            'title' => 'Ceramah',
            'description' => 'Ceramah mingguan oleh Ustadz.',
            'image' => 'images/ceramah.jpg',
        ]);
    }
}

