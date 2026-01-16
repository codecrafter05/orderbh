<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\Dish;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Copy images to storage
        $this->copyImages();

        // Restaurant 1: مطعم بيتزا إيطالي
        $restaurant1 = Restaurant::create([
            'order' => 1,
            'name_ar' => 'بيتزا إيطاليا',
            'name_en' => 'Pizza Italia',
            'type_ar' => 'مطعم إيطالي',
            'type_en' => 'Italian Restaurant',
            'delivery_time_ar' => '25-35 دقيقة',
            'delivery_time_en' => '25-35 minutes',
            'working_hours_ar' => '(10:00 - 23:00)',
            'working_hours_en' => '(10:00 - 23:00)',
            'image_path' => 'restaurants/restaurant1.png',
        ]);

        // Dishes for Restaurant 1
        $this->createDishesForRestaurant1($restaurant1->id);

        // Restaurant 2: مطعم برجر
        $restaurant2 = Restaurant::create([
            'order' => 2,
            'name_ar' => 'برجر هاوس',
            'name_en' => 'Burger House',
            'type_ar' => 'مطعم برجر',
            'type_en' => 'Burger Restaurant',
            'delivery_time_ar' => '20-30 دقيقة',
            'delivery_time_en' => '20-30 minutes',
            'working_hours_ar' => '(11:00 - 24:00)',
            'working_hours_en' => '(11:00 - 24:00)',
            'image_path' => 'restaurants/restaurant2.png',
        ]);

        // Dishes for Restaurant 2
        $this->createDishesForRestaurant2($restaurant2->id);

        // Restaurant 3: مطعم وجبات سريعة
        $restaurant3 = Restaurant::create([
            'order' => 3,
            'name_ar' => 'فاست فود ديلوكس',
            'name_en' => 'Fast Food Deluxe',
            'type_ar' => 'مطعم وجبات سريعة',
            'type_en' => 'Fast Food Restaurant',
            'delivery_time_ar' => '15-25 دقيقة',
            'delivery_time_en' => '15-25 minutes',
            'working_hours_ar' => '(9:00 - 22:00)',
            'working_hours_en' => '(9:00 - 22:00)',
            'image_path' => 'restaurants/restaurant3.png',
        ]);

        // Dishes for Restaurant 3
        $this->createDishesForRestaurant3($restaurant3->id);
    }

    private function copyImages()
    {
        $sourceDir = public_path('assets/imag');
        $restaurantDir = storage_path('app/public/restaurants');
        $dishDir = storage_path('app/public/dishes');

        if (!File::exists($restaurantDir)) {
            File::makeDirectory($restaurantDir, 0755, true);
        }
        if (!File::exists($dishDir)) {
            File::makeDirectory($dishDir, 0755, true);
        }

        // Copy restaurant images
        if (File::exists($sourceDir . '/image.png')) {
            File::copy($sourceDir . '/image.png', $restaurantDir . '/restaurant1.png');
            File::copy($sourceDir . '/image.png', $restaurantDir . '/restaurant3.png');
        }
        if (File::exists($sourceDir . '/image1.png')) {
            File::copy($sourceDir . '/image1.png', $restaurantDir . '/restaurant2.png');
        }

        // Copy dish images (using same images)
        if (File::exists($sourceDir . '/image.png')) {
            File::copy($sourceDir . '/image.png', $dishDir . '/pizza1.png');
            File::copy($sourceDir . '/image.png', $dishDir . '/pasta1.png');
            File::copy($sourceDir . '/image.png', $dishDir . '/salad1.png');
        }
        if (File::exists($sourceDir . '/image1.png')) {
            File::copy($sourceDir . '/image1.png', $dishDir . '/burger1.png');
            File::copy($sourceDir . '/image1.png', $dishDir . '/burger2.png');
            File::copy($sourceDir . '/image1.png', $dishDir . '/fries1.png');
        }
    }

    private function createDishesForRestaurant1($restaurantId)
    {
        // بيتزا مارغريتا
        Dish::create([
            'restaurant_id' => $restaurantId,
            'order' => 1,
            'name_ar' => 'بيتزا مارغريتا',
            'name_en' => 'Margherita Pizza',
            'description_ar' => 'بيتزا إيطالية كلاسيكية مع جبنة موتزاريلا طازجة وطماطم وريحان',
            'description_en' => 'Classic Italian pizza with fresh mozzarella, tomatoes, and basil',
            'image_path' => 'dishes/pizza1.png',
            'prices' => [
                ['size_ar' => 'صغير (25 سم)', 'size_en' => 'Small (25 cm)', 'price' => 4.500],
                ['size_ar' => 'متوسط (30 سم)', 'size_en' => 'Medium (30 cm)', 'price' => 6.500],
                ['size_ar' => 'كبير (35 سم)', 'size_en' => 'Large (35 cm)', 'price' => 8.500],
            ],
        ]);

        // بيتزا بيبروني
        Dish::create([
            'restaurant_id' => $restaurantId,
            'order' => 2,
            'name_ar' => 'بيتزا بيبروني',
            'name_en' => 'Pepperoni Pizza',
            'description_ar' => 'بيتزا مع بيبروني حار وجبنة موتزاريلا',
            'description_en' => 'Pizza with spicy pepperoni and mozzarella cheese',
            'image_path' => 'dishes/pizza1.png',
            'prices' => [
                ['size_ar' => 'صغير (25 سم)', 'size_en' => 'Small (25 cm)', 'price' => 5.000],
                ['size_ar' => 'متوسط (30 سم)', 'size_en' => 'Medium (30 cm)', 'price' => 7.000],
                ['size_ar' => 'كبير (35 سم)', 'size_en' => 'Large (35 cm)', 'price' => 9.000],
            ],
        ]);

        // بيتزا هاواي
        Dish::create([
            'restaurant_id' => $restaurantId,
            'order' => 3,
            'name_ar' => 'بيتزا هاواي',
            'name_en' => 'Hawaiian Pizza',
            'description_ar' => 'بيتزا مع لحم الخنزير المقدد والأناناس',
            'description_en' => 'Pizza with ham and pineapple',
            'image_path' => 'dishes/pizza1.png',
            'prices' => [
                ['size_ar' => 'صغير (25 سم)', 'size_en' => 'Small (25 cm)', 'price' => 5.500],
                ['size_ar' => 'متوسط (30 سم)', 'size_en' => 'Medium (30 cm)', 'price' => 7.500],
                ['size_ar' => 'كبير (35 سم)', 'size_en' => 'Large (35 cm)', 'price' => 9.500],
            ],
        ]);

        // باستا كاربونارا
        Dish::create([
            'restaurant_id' => $restaurantId,
            'order' => 4,
            'name_ar' => 'باستا كاربونارا',
            'name_en' => 'Carbonara Pasta',
            'description_ar' => 'باستا مع صلصة الكريمة والبيض واللحم المقدد',
            'description_en' => 'Pasta with cream sauce, egg, and bacon',
            'image_path' => 'dishes/pasta1.png',
            'prices' => [
                ['size_ar' => 'شخص واحد', 'size_en' => 'Single portion', 'price' => 6.000],
                ['size_ar' => 'شخصين', 'size_en' => 'Two portions', 'price' => 11.000],
            ],
        ]);

        // سلطة إيطالية
        Dish::create([
            'restaurant_id' => $restaurantId,
            'order' => 5,
            'name_ar' => 'سلطة إيطالية',
            'name_en' => 'Italian Salad',
            'description_ar' => 'سلطة طازجة مع الخضار والجبنة الإيطالية',
            'description_en' => 'Fresh salad with vegetables and Italian cheese',
            'image_path' => 'dishes/salad1.png',
            'prices' => [
                ['price' => 4.000],
            ],
        ]);
    }

    private function createDishesForRestaurant2($restaurantId)
    {
        // برجر كلاسيكي
        Dish::create([
            'restaurant_id' => $restaurantId,
            'order' => 1,
            'name_ar' => 'برجر كلاسيكي',
            'name_en' => 'Classic Burger',
            'description_ar' => 'برجر مع لحم بقري طازج وخضار طازجة',
            'description_en' => 'Burger with fresh beef patty and fresh vegetables',
            'image_path' => 'dishes/burger1.png',
            'prices' => [
                ['size_ar' => 'برجر واحد', 'size_en' => 'Single burger', 'price' => 3.500],
                ['size_ar' => 'برجر مزدوج', 'size_en' => 'Double burger', 'price' => 5.500],
            ],
        ]);

        // برجر دجاج
        Dish::create([
            'restaurant_id' => $restaurantId,
            'order' => 2,
            'name_ar' => 'برجر دجاج',
            'name_en' => 'Chicken Burger',
            'description_ar' => 'برجر مع صدر دجاج مشوي وخضار',
            'description_en' => 'Burger with grilled chicken breast and vegetables',
            'image_path' => 'dishes/burger1.png',
            'prices' => [
                ['size_ar' => 'برجر واحد', 'size_en' => 'Single burger', 'price' => 3.000],
                ['size_ar' => 'برجر مزدوج', 'size_en' => 'Double burger', 'price' => 5.000],
            ],
        ]);

        // برجر خاص
        Dish::create([
            'restaurant_id' => $restaurantId,
            'order' => 3,
            'name_ar' => 'برجر خاص',
            'name_en' => 'Special Burger',
            'description_ar' => 'برجر مع لحم بقري وجبنة شيدر ولحم مقدد',
            'description_en' => 'Burger with beef, cheddar cheese, and bacon',
            'image_path' => 'dishes/burger2.png',
            'prices' => [
                ['size_ar' => 'برجر واحد', 'size_en' => 'Single burger', 'price' => 4.500],
                ['size_ar' => 'برجر مزدوج', 'size_en' => 'Double burger', 'price' => 7.000],
            ],
        ]);

        // بطاطس مقلية
        Dish::create([
            'restaurant_id' => $restaurantId,
            'order' => 4,
            'name_ar' => 'بطاطس مقلية',
            'name_en' => 'French Fries',
            'description_ar' => 'بطاطس مقلية طازجة ومقرمشة',
            'description_en' => 'Fresh and crispy french fries',
            'image_path' => 'dishes/fries1.png',
            'prices' => [
                ['size_ar' => 'صغير', 'size_en' => 'Small', 'price' => 1.500],
                ['size_ar' => 'متوسط', 'size_en' => 'Medium', 'price' => 2.500],
                ['size_ar' => 'كبير', 'size_en' => 'Large', 'price' => 3.500],
            ],
        ]);

        // وجبة برجر كاملة
        Dish::create([
            'restaurant_id' => $restaurantId,
            'order' => 5,
            'name_ar' => 'وجبة برجر كاملة',
            'name_en' => 'Burger Meal',
            'description_ar' => 'برجر مع بطاطس مقلية ومشروب',
            'description_en' => 'Burger with fries and drink',
            'image_path' => 'dishes/burger2.png',
            'prices' => [
                ['price' => 6.000],
            ],
        ]);
    }

    private function createDishesForRestaurant3($restaurantId)
    {
        // هوت دوج
        Dish::create([
            'restaurant_id' => $restaurantId,
            'order' => 1,
            'name_ar' => 'هوت دوج',
            'name_en' => 'Hot Dog',
            'description_ar' => 'هوت دوج مع خضار وصلصة',
            'description_en' => 'Hot dog with vegetables and sauce',
            'image_path' => 'dishes/burger1.png',
            'prices' => [
                ['size_ar' => 'هوت دوج واحد', 'size_en' => 'Single hot dog', 'price' => 2.500],
                ['size_ar' => 'هوت دوج مزدوج', 'size_en' => 'Double hot dog', 'price' => 4.000],
            ],
        ]);

        // شاورما دجاج
        Dish::create([
            'restaurant_id' => $restaurantId,
            'order' => 2,
            'name_ar' => 'شاورما دجاج',
            'name_en' => 'Chicken Shawarma',
            'description_ar' => 'شاورما دجاج طازجة مع خضار وصلصة',
            'description_en' => 'Fresh chicken shawarma with vegetables and sauce',
            'image_path' => 'dishes/burger2.png',
            'prices' => [
                ['size_ar' => 'صغير', 'size_en' => 'Small', 'price' => 3.000],
                ['size_ar' => 'كبير', 'size_en' => 'Large', 'price' => 5.000],
            ],
        ]);

        // شاورما لحم
        Dish::create([
            'restaurant_id' => $restaurantId,
            'order' => 3,
            'name_ar' => 'شاورما لحم',
            'name_en' => 'Beef Shawarma',
            'description_ar' => 'شاورما لحم طازجة مع خضار وصلصة',
            'description_en' => 'Fresh beef shawarma with vegetables and sauce',
            'image_path' => 'dishes/burger2.png',
            'prices' => [
                ['size_ar' => 'صغير', 'size_en' => 'Small', 'price' => 3.500],
                ['size_ar' => 'كبير', 'size_en' => 'Large', 'price' => 5.500],
            ],
        ]);

        // بطاطس مقلية
        Dish::create([
            'restaurant_id' => $restaurantId,
            'order' => 4,
            'name_ar' => 'بطاطس مقلية',
            'name_en' => 'French Fries',
            'description_ar' => 'بطاطس مقلية طازجة',
            'description_en' => 'Fresh french fries',
            'image_path' => 'dishes/fries1.png',
            'prices' => [
                ['size_ar' => 'صغير', 'size_en' => 'Small', 'price' => 1.500],
                ['size_ar' => 'متوسط', 'size_en' => 'Medium', 'price' => 2.000],
                ['size_ar' => 'كبير', 'size_en' => 'Large', 'price' => 2.500],
            ],
        ]);

        // وجبة سريعة
        Dish::create([
            'restaurant_id' => $restaurantId,
            'order' => 5,
            'name_ar' => 'وجبة سريعة',
            'name_en' => 'Fast Meal',
            'description_ar' => 'هوت دوج مع بطاطس ومشروب',
            'description_en' => 'Hot dog with fries and drink',
            'image_path' => 'dishes/burger1.png',
            'prices' => [
                ['price' => 4.500],
            ],
        ]);
    }
}
