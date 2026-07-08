<?php

namespace Database\Seeders;

use App\Models\BiryaniDish;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BiryaniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BiryaniDish::query()->delete();

        $this->copyImages();

        BiryaniDish::create([
            'order' => 1,
            'name_ar' => 'أرز مقلي بالروبيان',
            'name_en' => 'Shrimp Fried Rice',
            'description_ar' => null,
            'description_en' => null,
            'image_path' => 'biryani-dishes/shrimp-fried-rice.png',
            'prices' => [
                ['size_ar' => '', 'size_en' => '', 'price' => 5.500],
            ],
        ]);

        BiryaniDish::create([
            'order' => 2,
            'name_ar' => 'بريانى عوزي لحم',
            'name_en' => 'Beef Ouzi Biryani',
            'description_ar' => null,
            'description_en' => null,
            'image_path' => 'biryani-dishes/beef-ouzi-biryani.png',
            'prices' => [
                ['size_ar' => '', 'size_en' => '', 'price' => 8.000],
            ],
        ]);

        $this->command->info('Biryani seed data created successfully.');
        $this->command->info('Dishes: ' . BiryaniDish::count());
    }

    private function copyImages(): void
    {
        $source = public_path('assets/imag/Biryani.png');
        $disk = Storage::disk('public');

        if (! $disk->exists('biryani-dishes')) {
            $disk->makeDirectory('biryani-dishes');
        }

        if (File::exists($source)) {
            $contents = File::get($source);
            $disk->put('biryani-dishes/shrimp-fried-rice.png', $contents);
            $disk->put('biryani-dishes/beef-ouzi-biryani.png', $contents);
        }

        $this->ensureWebServerOwnership('biryani-dishes');
    }

    private function ensureWebServerOwnership(string $directory): void
    {
        $path = storage_path('app/public/' . $directory);

        if (! File::isDirectory($path)) {
            return;
        }

        if (function_exists('posix_geteuid') && posix_geteuid() === 0) {
            File::chmod($path, 0775);
            exec('chown -R www-data:www-data ' . escapeshellarg($path));
        }
    }
}
