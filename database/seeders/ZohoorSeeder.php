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
        // إنشاء الفئات (Categories)
        $category1 = Category::create([
            'order' => 1,
            'name_ar' => 'المشروبات الساخنة',
            'name_en' => 'Hot Beverages',
            'image_path' => null,
        ]);

        $category2 = Category::create([
            'order' => 2,
            'name_ar' => 'المشروبات الباردة',
            'name_en' => 'Cold Beverages',
            'image_path' => null,
        ]);

        $category3 = Category::create([
            'order' => 3,
            'name_ar' => 'الحلويات',
            'name_en' => 'Desserts',
            'image_path' => null,
        ]);

        $category4 = Category::create([
            'order' => 4,
            'name_ar' => 'الأطباق الرئيسية',
            'name_en' => 'Main Dishes',
            'image_path' => null,
        ]);

        $category5 = Category::create([
            'order' => 5,
            'name_ar' => 'المقبلات',
            'name_en' => 'Appetizers',
            'image_path' => null,
        ]);

        // إنشاء أطباق زهور - المشروبات الساخنة
        ZohoorDish::create([
            'category_id' => $category1->id,
            'order' => 1,
            'name_ar' => 'شاي الأعشاب',
            'name_en' => 'Herbal Tea',
            'description_ar' => 'شاي طبيعي من الأعشاب الطبية المختارة',
            'description_en' => 'Natural tea from selected medicinal herbs',
            'image_path' => null,
            'prices' => [
                ['size_ar' => 'كوب صغير', 'size_en' => 'Small Cup', 'price' => 1.500],
                ['size_ar' => 'كوب كبير', 'size_en' => 'Large Cup', 'price' => 2.500],
            ],
        ]);

        ZohoorDish::create([
            'category_id' => $category1->id,
            'order' => 2,
            'name_ar' => 'قهوة عربية',
            'name_en' => 'Arabic Coffee',
            'description_ar' => 'قهوة عربية أصيلة مع الهيل',
            'description_en' => 'Authentic Arabic coffee with cardamom',
            'image_path' => null,
            'prices' => [
                ['size_ar' => '', 'size_en' => '', 'price' => 2.000],
            ],
        ]);

        ZohoorDish::create([
            'category_id' => $category1->id,
            'order' => 3,
            'name_ar' => 'شاي الزعتر',
            'name_en' => 'Thyme Tea',
            'description_ar' => 'شاي الزعتر الطبيعي المهدئ',
            'description_en' => 'Natural soothing thyme tea',
            'image_path' => null,
            'prices' => [
                ['size_ar' => '', 'size_en' => '', 'price' => 1.750],
            ],
        ]);

        // إنشاء أطباق زهور - المشروبات الباردة
        ZohoorDish::create([
            'category_id' => $category2->id,
            'order' => 1,
            'name_ar' => 'عصير الليمون بالنعناع',
            'name_en' => 'Lemon Mint Juice',
            'description_ar' => 'عصير ليمون طازج مع النعناع',
            'description_en' => 'Fresh lemon juice with mint',
            'image_path' => null,
            'prices' => [
                ['size_ar' => 'كوب صغير', 'size_en' => 'Small Cup', 'price' => 2.000],
                ['size_ar' => 'كوب كبير', 'size_en' => 'Large Cup', 'price' => 3.500],
            ],
        ]);

        ZohoorDish::create([
            'category_id' => $category2->id,
            'order' => 2,
            'name_ar' => 'عصير البرتقال الطازج',
            'name_en' => 'Fresh Orange Juice',
            'description_ar' => 'عصير برتقال طازج 100%',
            'description_en' => '100% fresh orange juice',
            'image_path' => null,
            'prices' => [
                ['size_ar' => '', 'size_en' => '', 'price' => 2.500],
            ],
        ]);

        ZohoorDish::create([
            'category_id' => $category2->id,
            'order' => 3,
            'name_ar' => 'مشروب الورد',
            'name_en' => 'Rose Drink',
            'description_ar' => 'مشروب الورد الطبيعي المنعش',
            'description_en' => 'Natural refreshing rose drink',
            'image_path' => null,
            'prices' => [
                ['size_ar' => '', 'size_en' => '', 'price' => 3.000],
            ],
        ]);

        // إنشاء أطباق زهور - الحلويات
        ZohoorDish::create([
            'category_id' => $category3->id,
            'order' => 1,
            'name_ar' => 'كنافة نابلسية',
            'name_en' => 'Nabulsi Knafeh',
            'description_ar' => 'كنافة نابلسية تقليدية مع الجبن',
            'description_en' => 'Traditional Nabulsi knafeh with cheese',
            'image_path' => null,
            'prices' => [
                ['size_ar' => 'قطعة صغيرة', 'size_en' => 'Small Piece', 'price' => 2.500],
                ['size_ar' => 'قطعة كبيرة', 'size_en' => 'Large Piece', 'price' => 4.500],
            ],
        ]);

        ZohoorDish::create([
            'category_id' => $category3->id,
            'order' => 2,
            'name_ar' => 'بقلاوة',
            'name_en' => 'Baklava',
            'description_ar' => 'بقلاوة محشوة بالفستق',
            'description_en' => 'Baklava stuffed with pistachios',
            'image_path' => null,
            'prices' => [
                ['size_ar' => '', 'size_en' => '', 'price' => 3.000],
            ],
        ]);

        ZohoorDish::create([
            'category_id' => $category3->id,
            'order' => 3,
            'name_ar' => 'حلاوة طحينية',
            'name_en' => 'Halva',
            'description_ar' => 'حلاوة طحينية طبيعية',
            'description_en' => 'Natural halva',
            'image_path' => null,
            'prices' => [
                ['size_ar' => '100 جرام', 'size_en' => '100g', 'price' => 2.000],
                ['size_ar' => '250 جرام', 'size_en' => '250g', 'price' => 4.500],
            ],
        ]);

        // إنشاء أطباق زهور - الأطباق الرئيسية
        ZohoorDish::create([
            'category_id' => $category4->id,
            'order' => 1,
            'name_ar' => 'منسف',
            'name_en' => 'Mansaf',
            'description_ar' => 'منسف لحم مع الأرز واللبن',
            'description_en' => 'Mansaf with meat, rice and yogurt',
            'image_path' => null,
            'prices' => [
                ['size_ar' => 'وجبة فردية', 'size_en' => 'Single Serving', 'price' => 8.500],
                ['size_ar' => 'وجبة عائلية', 'size_en' => 'Family Serving', 'price' => 25.000],
            ],
        ]);

        ZohoorDish::create([
            'category_id' => $category4->id,
            'order' => 2,
            'name_ar' => 'مقلوبة',
            'name_en' => 'Maqluba',
            'description_ar' => 'مقلوبة دجاج مع الأرز والخضار',
            'description_en' => 'Maqluba with chicken, rice and vegetables',
            'image_path' => null,
            'prices' => [
                ['size_ar' => '', 'size_en' => '', 'price' => 7.500],
            ],
        ]);

        ZohoorDish::create([
            'category_id' => $category4->id,
            'order' => 3,
            'name_ar' => 'كبسة',
            'name_en' => 'Kabsa',
            'description_ar' => 'كبسة لحم مع الأرز المتبل',
            'description_en' => 'Kabsa with meat and spiced rice',
            'image_path' => null,
            'prices' => [
                ['size_ar' => 'وجبة فردية', 'size_en' => 'Single Serving', 'price' => 9.000],
                ['size_ar' => 'وجبة عائلية', 'size_en' => 'Family Serving', 'price' => 28.000],
            ],
        ]);

        // إنشاء أطباق زهور - المقبلات
        ZohoorDish::create([
            'category_id' => $category5->id,
            'order' => 1,
            'name_ar' => 'حمص',
            'name_en' => 'Hummus',
            'description_ar' => 'حمص طازج مع زيت الزيتون',
            'description_en' => 'Fresh hummus with olive oil',
            'image_path' => null,
            'prices' => [
                ['size_ar' => '', 'size_en' => '', 'price' => 2.500],
            ],
        ]);

        ZohoorDish::create([
            'category_id' => $category5->id,
            'order' => 2,
            'name_ar' => 'متبل',
            'name_en' => 'Mutabal',
            'description_ar' => 'متبل الباذنجان المشوي',
            'description_en' => 'Roasted eggplant mutabal',
            'image_path' => null,
            'prices' => [
                ['size_ar' => '', 'size_en' => '', 'price' => 2.750],
            ],
        ]);

        ZohoorDish::create([
            'category_id' => $category5->id,
            'order' => 3,
            'name_ar' => 'فتوش',
            'name_en' => 'Fattoush',
            'description_ar' => 'سلطة فتوش مع الخبز المحمص',
            'description_en' => 'Fattoush salad with toasted bread',
            'image_path' => null,
            'prices' => [
                ['size_ar' => 'طبق صغير', 'size_en' => 'Small Plate', 'price' => 3.500],
                ['size_ar' => 'طبق كبير', 'size_en' => 'Large Plate', 'price' => 6.000],
            ],
        ]);

        $this->command->info('تم إنشاء البيانات التجريبية بنجاح!');
        $this->command->info('تم إنشاء ' . Category::count() . ' فئة');
        $this->command->info('تم إنشاء ' . ZohoorDish::count() . ' طبق');
    }
}
