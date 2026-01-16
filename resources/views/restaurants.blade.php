<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>المطاعم - Restaurants</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/restaurants.css') }}">
</head>
<body>
    <!-- Restaurants List -->
    <div class="restaurants-list">
        @foreach ($restaurants as $restaurant)
            <div class="restaurant-card" onclick="goToMenu('{{ $restaurant->id }}')">
                <div class="restaurant-image-container">
                    <img src="{{ $restaurant->image_path ? Storage::url($restaurant->image_path) : 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=400&h=300&fit=crop' }}"
                         alt="{{ $restaurant->name_ar }}"
                         class="restaurant-image"
                         onerror="this.src='https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=400&h=300&fit=crop'">
                </div>
                <div class="restaurant-info">
                    <div class="restaurant-header">
                        <h2 class="restaurant-name" data-lang="ar">{{ $restaurant->name_ar }}</h2>
                        <h2 class="restaurant-name hidden" data-lang="en">{{ $restaurant->name_en }}</h2>
                    </div>
                    <div class="restaurant-category" data-lang="ar">{{ $restaurant->type_ar }}</div>
                    <div class="restaurant-category hidden" data-lang="en">{{ $restaurant->type_en }}</div>
                    <div class="restaurant-details">
                        <div class="detail-item" data-lang="ar">
                            <i class="fa fa-clock-o"></i>
                            <span>وقت التوصيل: {{ $restaurant->delivery_time_ar }}</span>
                        </div>
                        <div class="detail-item hidden" data-lang="en">
                            <i class="fa fa-clock-o"></i>
                            <span>Delivery Time: {{ $restaurant->delivery_time_en }}</span>
                        </div>
                        <div class="detail-item" data-lang="ar">
                            <i class="fa fa-clock-o"></i>
                            <span>ساعات العمل: {{ $restaurant->working_hours_ar }}</span>
                        </div>
                        <div class="detail-item hidden" data-lang="en">
                            <i class="fa fa-clock-o"></i>
                            <span>Working Hours: {{ $restaurant->working_hours_en }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Language Selector -->
    <div class="language-selector">
        <button class="language-btn" onclick="toggleLanguage()">
            <i class="fa fa-globe" id="langIcon"></i>
            <span id="langText" lang="ar" class="hidden">English</span>
            <span id="langTextEn" lang="en">العربية</span>
        </button>
    </div>

    <script>
        let currentLanguage = localStorage.getItem('language') || 'ar';

        function switchLanguage(lang) {
            currentLanguage = lang;
            localStorage.setItem('language', lang);
            document.documentElement.lang = lang;
            document.documentElement.dir = lang === 'ar' ? 'rtl' : 'ltr';
            document.body.setAttribute('dir', lang === 'ar' ? 'rtl' : 'ltr');

            // Update language button - show the language we can switch TO
            const langText = document.getElementById('langText');
            const langTextEn = document.getElementById('langTextEn');
            if (lang === 'ar') {
                // Current language is Arabic, show English button
                langText.classList.remove('hidden');
                langTextEn.classList.add('hidden');
            } else {
                // Current language is English, show Arabic button
                langText.classList.add('hidden');
                langTextEn.classList.remove('hidden');
            }

            // Show/hide elements based on language
            document.querySelectorAll('[data-lang]').forEach(el => {
                if (el.getAttribute('data-lang') === lang) {
                    el.classList.remove('hidden');
                } else {
                    el.classList.add('hidden');
                }
            });
        }

        function toggleLanguage() {
            const newLang = currentLanguage === 'ar' ? 'en' : 'ar';
            switchLanguage(newLang);
        }

        function goToMenu(restaurant) {
            localStorage.setItem('selectedRestaurant', restaurant);
            window.location.href = '{{ route('menu.index') }}';
        }

        // Initialize
        switchLanguage(currentLanguage);
    </script>
</body>
</html>

