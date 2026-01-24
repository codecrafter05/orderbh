<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\ZohoorDish;
use Illuminate\Database\Seeder;

class ZohoorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // حذف البيانات القديمة إن وجدت (حذف الأطباق أولاً بسبب foreign key)
        ZohoorDish::query()->delete();
        Category::query()->delete();

        // إنشاء الفئات (Categories)
        $category1 = Category::create([
            'order' => 1,
            'name_ar' => 'المقبلات الباردة والساخنة',
            'name_en' => 'Cold & Hot Appetizers',
            'image_path' => null,
        ]);

        $category2 = Category::create([
            'order' => 2,
            'name_ar' => 'المشاوي',
            'name_en' => 'Grilled Dishes',
            'image_path' => null,
        ]);

        $category3 = Category::create([
            'order' => 3,
            'name_ar' => 'الصواني والقلايات',
            'name_en' => 'Trays & Pans',
            'image_path' => null,
        ]);

        $category4 = Category::create([
            'order' => 4,
            'name_ar' => 'المطبخ العربي',
            'name_en' => 'Arabic Cuisine',
            'image_path' => null,
        ]);

        $category5 = Category::create([
            'order' => 5,
            'name_ar' => 'مشروبات',
            'name_en' => 'Drinks',
            'image_path' => null,
        ]);

        // إنشاء أطباق زهور - المقبلات الباردة والساخنة (Category 1)
        $dishesCategory1 = [
            ['name_ar' => 'سلطة تركية', 'name_en' => 'Turkish salad', 'description_ar' => '', 'description_en' => '', 'price' => 2.500],
            ['name_ar' => 'سلطة جرجير', 'name_en' => 'Rocca salad', 'description_ar' => '', 'description_en' => '', 'price' => 2.500],
            ['name_ar' => 'ورق عنب', 'name_en' => 'Vine Leaves', 'description_ar' => '', 'description_en' => '', 'price' => 2.500],
            ['name_ar' => 'سلطة عربية', 'name_en' => 'Arabic salad', 'description_ar' => '', 'description_en' => '', 'price' => 2.500],
            ['name_ar' => 'ثومية', 'name_en' => 'Garlic Sauce', 'description_ar' => '', 'description_en' => '', 'price' => 1.500],
            ['name_ar' => 'تبولة', 'name_en' => 'Tabbouleh', 'description_ar' => '', 'description_en' => '', 'price' => 2.500],
            ['name_ar' => 'متبل شمندر', 'name_en' => 'Beetroot Moutabbal', 'description_ar' => '', 'description_en' => '', 'price' => 2.500],
            ['name_ar' => 'بابا غنوج', 'name_en' => 'Baba Ghanoush', 'description_ar' => '', 'description_en' => '', 'price' => 2.500],
            ['name_ar' => 'باذنجان', 'name_en' => 'Eggplant', 'description_ar' => '', 'description_en' => '', 'price' => 2.500],
            ['name_ar' => 'متبل', 'name_en' => 'Mtabbal', 'description_ar' => '', 'description_en' => '', 'price' => 2.500],
            ['name_ar' => 'حمص', 'name_en' => 'Hummus', 'description_ar' => '', 'description_en' => '', 'price' => 2.500],
            ['name_ar' => 'مقبلات مشكلة', 'name_en' => 'Assorted Appetizer', 'description_ar' => '', 'description_en' => '', 'price' => 5.800],
            ['name_ar' => 'سلطة فتوش', 'name_en' => 'Fattoush Salad', 'description_ar' => '', 'description_en' => '', 'price' => 2.500],
            ['name_ar' => 'سلطة زيتون', 'name_en' => 'Olive Salad', 'description_ar' => '', 'description_en' => '', 'price' => 2.500],
            ['name_ar' => 'حمص باللحم', 'name_en' => 'Hummus with meat', 'description_ar' => '', 'description_en' => '', 'price' => 3.800],
            ['name_ar' => 'بطاطس مقلية', 'name_en' => 'French Fries', 'description_ar' => '', 'description_en' => '', 'price' => 1.800],
            ['name_ar' => 'برك جبنة', 'name_en' => 'Cheese Baraak', 'description_ar' => '', 'description_en' => '', 'price' => 2.850],
            ['name_ar' => 'كبة مقلية', 'name_en' => 'Fried Kibbeا', 'description_ar' => '', 'description_en' => '', 'price' => 2.950],
        ];

        foreach ($dishesCategory1 as $index => $dish) {
            ZohoorDish::create([
                'category_id' => $category1->id,
                'order' => $index + 1,
                'name_ar' => $dish['name_ar'],
                'name_en' => $dish['name_en'],
                'description_ar' => $dish['description_ar'] ?: null,
                'description_en' => $dish['description_en'] ?: null,
                'image_path' => null,
                'prices' => [
                    ['size_ar' => '', 'size_en' => '', 'price' => (float)$dish['price']],
                ],
            ]);
        }

        // إنشاء أطباق زهور - المشاوي (Category 2)
        $dishesCategory2 = [
            ['name_ar' => 'دجاج مسحب', 'name_en' => 'Pulled Chicken', 'description_ar' => '', 'description_en' => '', 'price' => 4.400],
            ['name_ar' => 'صحن مشاوي مشكل', 'name_en' => 'Mix Grill Platter', 'description_ar' => '', 'description_en' => '', 'price' => 6.500],
            ['name_ar' => 'صحن كباب لحم', 'name_en' => 'Meat Kebab Platter', 'description_ar' => '', 'description_en' => '', 'price' => 6.900],
            ['name_ar' => 'صحن ريش غنم', 'name_en' => 'LAMP Chops Platter', 'description_ar' => '', 'description_en' => '', 'price' => 7.800],
            ['name_ar' => 'صحن تكة لحم', 'name_en' => 'Meat Tikka Platter', 'description_ar' => '', 'description_en' => '', 'price' => 7.800],
            ['name_ar' => 'صحن شيش طاووق', 'name_en' => 'Chicken Shish Platter', 'description_ar' => '', 'description_en' => '', 'price' => 4.900],
            ['name_ar' => 'صحن كباب دجاج', 'name_en' => 'Chicken Kebab Platter', 'description_ar' => '', 'description_en' => '', 'price' => 4.900],
            ['name_ar' => 'دجاج مسحب', 'name_en' => 'Pulled Chicken', 'description_ar' => '', 'description_en' => '', 'price' => 4.900],
            ['name_ar' => 'كبدة مشوية', 'name_en' => 'Liver Grill', 'description_ar' => '', 'description_en' => '', 'price' => 4.900],
            ['name_ar' => 'كلاوي مشوي', 'name_en' => 'Kidney Grill', 'description_ar' => '', 'description_en' => '', 'price' => 4.900],
            ['name_ar' => 'بيض غنم', 'name_en' => 'Sheep Testicals', 'description_ar' => '', 'description_en' => '', 'price' => 4.900],
            ['name_ar' => 'قلب مشوي', 'name_en' => 'Heart Grill', 'description_ar' => '', 'description_en' => '', 'price' => 4.900],
            ['name_ar' => 'مشكل مشوي', 'name_en' => 'Mixed Grilled', 'description_ar' => 'كبدة - كلاوي - بيض غنم', 'description_en' => 'Kidney - sheep Testicals - Liver', 'price' => 4.900],
            ['name_ar' => 'نص كيلو مشاوي مشكل', 'name_en' => '1/2 Mixed Grills', 'description_ar' => '', 'description_en' => '', 'price' => 11.800],
            ['name_ar' => 'كيلو مشاوي مشكل', 'name_en' => '1 K Mixed Grill', 'description_ar' => '', 'description_en' => '', 'price' => 19.500],
        ];

        foreach ($dishesCategory2 as $index => $dish) {
            ZohoorDish::create([
                'category_id' => $category2->id,
                'order' => $index + 1,
                'name_ar' => $dish['name_ar'],
                'name_en' => $dish['name_en'],
                'description_ar' => $dish['description_ar'] ?: null,
                'description_en' => $dish['description_en'] ?: null,
                'image_path' => null,
                'prices' => [
                    ['size_ar' => '', 'size_en' => '', 'price' => (float)$dish['price']],
                ],
            ]);
        }

        // إنشاء أطباق زهور - الصواني والقلايات (Category 3)
        $dishesCategory3 = [
            ['name_ar' => 'عرايس', 'name_en' => 'Arayes', 'description_ar' => '', 'description_en' => '', 'price' => 2.750],
            ['name_ar' => 'نخعات', 'name_en' => 'Brain', 'description_ar' => '', 'description_en' => '', 'price' => 4.400],
            ['name_ar' => 'بيض غنم', 'name_en' => 'Sheep Testicle', 'description_ar' => '', 'description_en' => '', 'price' => 4.900],
            ['name_ar' => 'كلاوي', 'name_en' => 'Kidney', 'description_ar' => '', 'description_en' => '', 'price' => 4.900],
            ['name_ar' => 'قلب', 'name_en' => 'Heart', 'description_ar' => '', 'description_en' => '', 'price' => 4.900],
            ['name_ar' => 'كبدة', 'name_en' => 'Liver', 'description_ar' => '', 'description_en' => '', 'price' => 4.900],
            ['name_ar' => 'قلايه لحمه بالبصل ٢٥٠ جرام', 'name_en' => 'Meat With Onion 250GM', 'description_ar' => '', 'description_en' => '', 'price' => 5.900],
            ['name_ar' => 'قلايه لحمه بالطماطم ٢٥٠ جرام', 'name_en' => 'Meat With tomato 250GM', 'description_ar' => '', 'description_en' => '', 'price' => 5.900],
            ['name_ar' => 'كفتة بالطماطم', 'name_en' => 'Kofta With Tomatoes', 'description_ar' => '', 'description_en' => '', 'price' => 6.050],
            ['name_ar' => 'كفتة بالطحينة', 'name_en' => 'Kofta With Tahini', 'description_ar' => '', 'description_en' => '', 'price' => 6.050],
        ];

        foreach ($dishesCategory3 as $index => $dish) {
            ZohoorDish::create([
                'category_id' => $category3->id,
                'order' => $index + 1,
                'name_ar' => $dish['name_ar'],
                'name_en' => $dish['name_en'],
                'description_ar' => $dish['description_ar'] ?: null,
                'description_en' => $dish['description_en'] ?: null,
                'image_path' => null,
                'prices' => [
                    ['size_ar' => '', 'size_en' => '', 'price' => (float)$dish['price']],
                ],
            ]);
        }

        // إنشاء أطباق زهور - المطبخ العربي (Category 4)
        $dishesCategory4 = [
            ['name_ar' => 'ضلع غوزي', 'name_en' => 'Gozi RIB', 'description_ar' => '', 'description_en' => '', 'price' => 15.900],
            ['name_ar' => 'رقبة غوزي', 'name_en' => 'Gozi Neck', 'description_ar' => '', 'description_en' => '', 'price' => 13.950],
            ['name_ar' => 'منسف لحم شخص واحد', 'name_en' => '1 Per Mansaf Meat', 'description_ar' => '', 'description_en' => '', 'price' => 7.900],
            ['name_ar' => '١ كيلو منسف لحم', 'name_en' => '1 kg Of Mansaf Meat', 'description_ar' => '', 'description_en' => '', 'price' => 22.800],
        ];

        foreach ($dishesCategory4 as $index => $dish) {
            ZohoorDish::create([
                'category_id' => $category4->id,
                'order' => $index + 1,
                'name_ar' => $dish['name_ar'],
                'name_en' => $dish['name_en'],
                'description_ar' => $dish['description_ar'] ?: null,
                'description_en' => $dish['description_en'] ?: null,
                'image_path' => null,
                'prices' => [
                    ['size_ar' => '', 'size_en' => '', 'price' => (float)$dish['price']],
                ],
            ]);
        }

        // إنشاء أطباق زهور - المشروبات (Category 5)
        $dishesCategory5 = [
            ['name_ar' => 'فانتا فراولة', 'name_en' => 'Fanta Strawberry', 'description_ar' => '', 'description_en' => '', 'price' => 0.880],
            ['name_ar' => 'سبرايت', 'name_en' => 'Sprite', 'description_ar' => '', 'description_en' => '', 'price' => 0.880],
            ['name_ar' => 'كينزا كولا', 'name_en' => 'Kinza Cola', 'description_ar' => '', 'description_en' => '', 'price' => 0.880],
            ['name_ar' => 'كينزا ليمون', 'name_en' => 'Kinza Lemon', 'description_ar' => '', 'description_en' => '', 'price' => 0.880],
            ['name_ar' => 'كينزا برتقال', 'name_en' => 'Kinza Orange', 'description_ar' => '', 'description_en' => '', 'price' => 0.880],
            ['name_ar' => 'كينزا دايت كولا', 'name_en' => 'Kinza Diet Cola', 'description_ar' => '', 'description_en' => '', 'price' => 0.880],
            ['name_ar' => 'كوكاكولا لايت', 'name_en' => 'Coca-Cola Light', 'description_ar' => '', 'description_en' => '', 'price' => 0.880],
            ['name_ar' => 'كوكاكولا زيرو', 'name_en' => 'Coca-Cola Zero', 'description_ar' => '', 'description_en' => '', 'price' => 0.880],
            ['name_ar' => 'سبرايت زيرو', 'name_en' => 'Sprite Zero', 'description_ar' => '', 'description_en' => '', 'price' => 0.880],
            ['name_ar' => 'عصير برتقال طبيعي', 'name_en' => 'Fresh Orange Juice', 'description_ar' => '', 'description_en' => '', 'price' => 2.200],
            ['name_ar' => 'عصير ليمون بالنعناع', 'name_en' => 'Lemon Mint Juice', 'description_ar' => '', 'description_en' => '', 'price' => 2.200],
            ['name_ar' => 'لبن', 'name_en' => 'Laban', 'description_ar' => '', 'description_en' => '', 'price' => 1.650],
            ['name_ar' => 'ماء 350 مل', 'name_en' => 'Water 350ml', 'description_ar' => '', 'description_en' => '', 'price' => 1.320],
            ['name_ar' => 'ماء ٧٥٠ مل', 'name_en' => 'Water 750ml', 'description_ar' => '', 'description_en' => '', 'price' => 1.870],
            ['name_ar' => 'مياه غازية', 'name_en' => 'Sparkling water', 'description_ar' => '', 'description_en' => '', 'price' => 1.200],
        ];

        foreach ($dishesCategory5 as $index => $dish) {
            ZohoorDish::create([
                'category_id' => $category5->id,
                'order' => $index + 1,
                'name_ar' => $dish['name_ar'],
                'name_en' => $dish['name_en'],
                'description_ar' => $dish['description_ar'] ?: null,
                'description_en' => $dish['description_en'] ?: null,
                'image_path' => null,
                'prices' => [
                    ['size_ar' => '', 'size_en' => '', 'price' => (float)$dish['price']],
                ],
            ]);
        }

        $this->command->info('تم إنشاء البيانات بنجاح!');
        $this->command->info('تم إنشاء ' . Category::count() . ' فئة');
        $this->command->info('تم إنشاء ' . ZohoorDish::count() . ' طبق');
    }
}
