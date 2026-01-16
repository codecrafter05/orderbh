@php
    // تحديد المطعم للـ SEO
    $seoRestaurant = $selectedRestaurant ?? $restaurants->first();
    $siteUrl = config('app.url', 'https://orderbh.site');
    $currentUrl = $siteUrl . request()->getPathInfo();
    
    // بيانات المطعم للـ SEO
    $restaurantName = $seoRestaurant ? ($seoRestaurant->name_ar . ' - ' . $seoRestaurant->name_en) : 'القائمة - Menu';
    
    // استخدام الوصف من قاعدة البيانات أو إنشاء وصف تلقائي
    if ($seoRestaurant) {
        // استخدام الوصف المخصص إذا كان موجوداً
        if (!empty($seoRestaurant->description_ar) || !empty($seoRestaurant->description_en)) {
            $restaurantDescription = $seoRestaurant->description_ar ?? $seoRestaurant->description_en;
        } else {
            // إنشاء وصف تلقائي
            $descriptionParts = [];
            $descriptionParts[] = $seoRestaurant->type_ar . ' - ' . $seoRestaurant->type_en;
            if ($seoRestaurant->dishes->count() > 0) {
                $descriptionParts[] = 'متوفر ' . $seoRestaurant->dishes->count() . ' طبق للطلب';
            }
            $descriptionParts[] = 'وقت التوصيل: ' . $seoRestaurant->delivery_time_ar;
            $restaurantDescription = implode('. ', $descriptionParts);
        }
    } else {
        $restaurantDescription = 'اطلب من أفضل المطاعم في البحرين - توصيل سريع وطازج';
    }
    
    // استخدام الكلمات المفتاحية من قاعدة البيانات أو إنشاء كلمات مفتاحية تلقائية
    if ($seoRestaurant) {
        if (!empty($seoRestaurant->keywords_ar) || !empty($seoRestaurant->keywords_en)) {
            $restaurantKeywords = $seoRestaurant->keywords_ar ?? $seoRestaurant->keywords_en;
        } else {
            // كلمات مفتاحية تلقائية
            $restaurantKeywords = $seoRestaurant->name_ar . ', ' . $seoRestaurant->name_en . ', ' . 
                                  $seoRestaurant->type_ar . ', ' . $seoRestaurant->type_en . ', مطاعم البحرين, طلب طعام, توصيل طعام';
        }
    } else {
        $restaurantKeywords = 'مطاعم البحرين, طلب طعام, توصيل طعام';
    }
    
    $restaurantImage = $seoRestaurant && $seoRestaurant->image_path 
        ? $siteUrl . Storage::url($seoRestaurant->image_path) 
        : $siteUrl . '/images/default-restaurant.jpg';
    
    // تنظيف الوصف والكلمات المفتاحية
    $restaurantDescription = strip_tags($restaurantDescription);
    $restaurantDescription = mb_substr($restaurantDescription, 0, 160);
    $restaurantKeywords = strip_tags($restaurantKeywords);
@endphp
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Primary Meta Tags -->
    <title>{{ $restaurantName }}</title>
    <meta name="title" content="{{ $restaurantName }}">
    <meta name="description" content="{{ $restaurantDescription }}">
    <meta name="keywords" content="{{ $restaurantKeywords }}">
    <meta name="author" content="OrderBH">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ $currentUrl }}">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $currentUrl }}">
    <meta property="og:title" content="{{ $restaurantName }}">
    <meta property="og:description" content="{{ $restaurantDescription }}">
    <meta property="og:image" content="{{ $restaurantImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="ar_BH">
    <meta property="og:locale:alternate" content="en_US">
    <meta property="og:site_name" content="OrderBH">
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ $currentUrl }}">
    <meta name="twitter:title" content="{{ $restaurantName }}">
    <meta name="twitter:description" content="{{ $restaurantDescription }}">
    <meta name="twitter:image" content="{{ $restaurantImage }}">
    
    <!-- Additional Meta Tags -->
    <meta name="theme-color" content="#ffffff">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    
    <!-- Structured Data (JSON-LD) -->
    @if($seoRestaurant)
    <script type="application/ld+json">
    @php
        $menuItems = [];
        foreach($seoRestaurant->dishes->take(10) as $dish) {
            $dishData = [
                "@type" => "MenuItem",
                "name" => $dish->name_en,
                "alternateName" => $dish->name_ar
            ];
            
            if (!empty($dish->description_en) || !empty($dish->description_ar)) {
                $dishData["description"] = strip_tags($dish->description_en ?? $dish->description_ar ?? '');
            }
            
            if ($dish->image_path) {
                $dishImageUrl = Storage::url($dish->image_path);
                $dishData["image"] = $siteUrl . $dishImageUrl;
            }
            
            if (!empty($dish->prices) && is_array($dish->prices)) {
                $firstPrice = is_array($dish->prices[0]) ? ($dish->prices[0]['price'] ?? null) : ($dish->prices[0] ?? null);
                if ($firstPrice !== null) {
                    $dishData["offers"] = [
                        "@type" => "Offer",
                        "price" => (string)$firstPrice,
                        "priceCurrency" => "BHD"
                    ];
                }
            }
            
            $menuItems[] = $dishData;
        }
        
        $structuredData = [
            "@context" => "https://schema.org",
            "@type" => "Restaurant",
            "name" => $seoRestaurant->name_en,
            "alternateName" => $seoRestaurant->name_ar,
            "description" => $restaurantDescription,
            "image" => $restaurantImage,
            "url" => $currentUrl,
            "servesCuisine" => $seoRestaurant->type_en,
            "address" => [
                "@type" => "PostalAddress",
                "addressCountry" => "BH",
                "addressLocality" => "Bahrain"
            ],
            "menu" => $currentUrl
        ];
        
        if (count($menuItems) > 0) {
            $structuredData["hasMenu"] = [
                "@type" => "Menu",
                "hasMenuSection" => [
                    "@type" => "MenuSection",
                    "name" => "Main Menu",
                    "hasMenuItem" => $menuItems
                ]
            ];
        }
    @endphp
    {!! json_encode($structuredData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
    @endif
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/menu.css') }}">
</head>
<body>
    @foreach ($restaurants as $restaurant)
        @php
            $heroImage = $restaurant->image_path
                ? Storage::url($restaurant->image_path)
                : 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=800&h=400&fit=crop';
        @endphp
        <div class="restaurant-content {{ $loop->first ? '' : 'hidden' }}" data-restaurant="{{ $restaurant->id }}">
            <!-- Hero Section -->
            <div class="hero-section">
                <img src="{{ $heroImage }}" alt="{{ $restaurant->name_ar }}" class="hero-image" onerror="this.src='https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=800&h=400&fit=crop'">
            </div>

            <!-- Restaurant Info Section -->
            <div class="restaurant-info-section">
                <div class="restaurant-header-info">
                    <h1 class="restaurant-name-header" data-lang="ar">{{ $restaurant->name_ar }}</h1>
                    <h1 class="restaurant-name-header hidden" data-lang="en">{{ $restaurant->name_en }}</h1>
                </div>
                <div class="restaurant-details-info">
                    <div class="detail-line" data-lang="ar">البحرين</div>
                    <div class="detail-line hidden" data-lang="en">Bahrain</div>
                    <div class="detail-line" data-lang="ar">المطبخ - {{ $restaurant->type_ar }}</div>
                    <div class="detail-line hidden" data-lang="en">Cuisine - {{ $restaurant->type_en }}</div>
                    <div class="detail-line">
                        <span class="open-status" data-lang="ar">مفتوح الآن</span>
                        <span class="open-status hidden" data-lang="en">Open Now</span>
                        <span>
                            • <span data-lang="ar">{{ $restaurant->working_hours_ar }}</span><span data-lang="en" class="hidden">{{ $restaurant->working_hours_en }}</span>
                            (<span data-lang="ar">اليوم</span><span data-lang="en" class="hidden">Today</span>)
                        </span>
                    </div>
                </div>
            </div>

            <!-- Menu Section -->
            <div class="menu-section">
                <h2 class="menu-title" data-lang="ar">الأطباق المتاحة للطلب</h2>
                <h2 class="menu-title hidden" data-lang="en">Here's the Food to order</h2>

                <div class="category-section">
                    <div class="dishes-grid">
                        @foreach ($restaurant->dishes as $dish)
                            @php
                                $dishImage = $dish->image_path
                                    ? Storage::url($dish->image_path)
                                    : 'https://www.zohooralshafa.site/storage/products/images/01K3P2F8H6ZPWJ9MA0BY3BX18K.jpg';
                                $priceOptions = is_array($dish->prices) ? $dish->prices : [];
                            @endphp
                            <div class="dish-card">
                                <img src="{{ $dishImage }}" alt="{{ $dish->name_ar }}" class="dish-image">
                                <div class="dish-info">
                                    <h3 class="dish-name" data-lang="ar">{{ $dish->name_ar }}</h3>
                                    <h3 class="dish-name hidden" data-lang="en">{{ $dish->name_en }}</h3>

                                    @if (!empty($dish->description_ar))
                                        <p class="dish-subtitle" data-lang="ar">{{ $dish->description_ar }}</p>
                                    @endif
                                    @if (!empty($dish->description_en))
                                        <p class="dish-subtitle hidden" data-lang="en">{{ $dish->description_en }}</p>
                                    @endif

                                    @if (!empty($priceOptions))
                                        <div class="dish-prices">
                                            @foreach ($priceOptions as $option)
                                                @php
                                                    $sizeAr = $option['size_ar'] ?? '';
                                                    $sizeEn = $option['size_en'] ?? '';
                                                    $priceValue = isset($option['price']) ? (float) $option['price'] : null;
                                                @endphp
                                                @if ($priceValue !== null)
                                                    <div class="dish-price-row">
                                                        <div class="dish-price-info">
                                                            @if (!empty($sizeAr))
                                                                <span class="dish-price-label" data-lang="ar">{{ $sizeAr }}</span>
                                                            @endif
                                                            @if (!empty($sizeEn))
                                                                <span class="dish-price-label hidden" data-lang="en">{{ $sizeEn }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="dish-price-amount">
                                                            {{ number_format($priceValue, 2) }}
                                                            <span data-lang="ar">د.ب</span>
                                                            <span data-lang="en" class="hidden">BHD</span>
                                                        </div>
                                                        <button class="add-to-cart-btn" onclick="addToCart({{ $dish->id }}, {{ json_encode($dish->name_ar) }}, {{ json_encode($dish->name_en) }}, {{ $priceValue }}, {{ json_encode($dishImage) }}, {{ json_encode($sizeAr) }}, {{ json_encode($sizeEn) }}, {{ $restaurant->id }}, {{ json_encode($restaurant->name_ar) }}, {{ json_encode($restaurant->name_en) }})">
                                                            <i class="fa fa-shopping-cart"></i>
                                                        </button>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Cart Notification -->
    <div class="cart-notification" id="cartNotification">
        <span data-lang="ar">تمت الإضافة إلى السلة بنجاح!</span>
        <span data-lang="en" class="hidden">Added to cart successfully!</span>
    </div>

    <!-- Bottom Action Buttons -->
    <div class="bottom-actions">
        <button class="action-btn" onclick="goToCart()">
            <i class="fa fa-shopping-cart"></i>
            <span id="cartText" lang="ar">السلة</span>
            <span id="cartTextEn" lang="en" class="hidden">Cart</span>
            <div class="cart-badge hidden" id="cartBadge">0</div>
        </button>
        <button class="action-btn" onclick="toggleLanguage()">
            <i class="fa fa-globe"></i>
            <span id="langText" lang="ar" class="hidden">English</span>
            <span id="langTextEn" lang="en">العربية</span>
        </button>
    </div>

    <script>
        let cart = [];

        // Load cart from localStorage
        function loadCart() {
            const savedCart = localStorage.getItem('restaurantCart');
            if (savedCart) {
                cart = JSON.parse(savedCart);
            }
            updateCartBadge();
        }

        // Save cart to localStorage
        function saveCart() {
            localStorage.setItem('restaurantCart', JSON.stringify(cart));
            updateCartBadge();
        }

        // Update cart badge
        function updateCartBadge() {
            const badge = document.getElementById('cartBadge');
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);

            if (totalItems > 0) {
                badge.textContent = totalItems;
                badge.classList.remove('hidden');
            } else {
                badge.classList.add('hidden');
            }
        }

        // Add to cart
        function addToCart(id, nameAr, nameEn, price, image, sizeAr = '', sizeEn = '', restaurantId, restaurantNameAr, restaurantNameEn) {
            const notification = document.getElementById('cartNotification');
            const baseName = currentLanguage === 'ar' ? nameAr : nameEn;
            const sizeLabel = currentLanguage === 'ar' ? sizeAr : sizeEn;
            const finalName = sizeLabel ? `${baseName} - ${sizeLabel}` : baseName;
            const restaurantName = currentLanguage === 'ar' ? restaurantNameAr : restaurantNameEn;

            // Check if item already exists in cart
            const existingItem = cart.find(cartItem => cartItem.id === id && cartItem.name === finalName && cartItem.price === price);

            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({
                    id: id,
                    name: finalName,
                    price: Number(price),
                    image: image,
                    quantity: 1,
                    restaurantId: restaurantId,
                    restaurantName: restaurantName,
                    restaurantNameAr: restaurantNameAr,
                    restaurantNameEn: restaurantNameEn
                });
            }

            // Save to localStorage
            saveCart();

            // Show notification
            notification.classList.add('show');

            // Hide after 3 seconds
            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000);
        }

        // Go to cart page
        function goToCart() {
            if (cart.length === 0) {
                const emptyCartMsg = currentLanguage === 'ar' ? 'السلة فارغة' : 'Cart is empty';
                alert(emptyCartMsg);
            } else {
                window.location.href = '{{ route('cart.index') }}';
            }
        }

        // Language support
        let currentLanguage = localStorage.getItem('language') || 'ar';

        function toggleLanguage() {
            const newLang = currentLanguage === 'ar' ? 'en' : 'ar';
            switchLanguage(newLang);
        }

        function switchLanguage(lang) {
            currentLanguage = lang;
            localStorage.setItem('language', lang);
            document.documentElement.lang = lang;
            document.documentElement.dir = lang === 'ar' ? 'rtl' : 'ltr';
            document.body.setAttribute('dir', lang === 'ar' ? 'rtl' : 'ltr');

            // Update language button - show the language we can switch TO
            const langText = document.getElementById('langText');
            const langTextEn = document.getElementById('langTextEn');
            const cartText = document.getElementById('cartText');
            const cartTextEn = document.getElementById('cartTextEn');

            if (lang === 'ar') {
                // Current language is Arabic, show English button
                langText.classList.remove('hidden');
                langTextEn.classList.add('hidden');
                cartText.classList.remove('hidden');
                cartTextEn.classList.add('hidden');
            } else {
                // Current language is English, show Arabic button
                langText.classList.add('hidden');
                langTextEn.classList.remove('hidden');
                cartText.classList.add('hidden');
                cartTextEn.classList.remove('hidden');
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

        // Show selected restaurant
        function showRestaurant() {
            @if(isset($selectedRestaurant))
                const selectedRestaurantId = {{ $selectedRestaurant->id }};
            @else
                const selectedRestaurantId = {{ json_encode(optional($restaurants->first())->id) }};
            @endif

            document.querySelectorAll('.restaurant-content').forEach(restaurant => {
                if (selectedRestaurantId && restaurant.getAttribute('data-restaurant') == selectedRestaurantId) {
                    restaurant.classList.remove('hidden');
                } else {
                    restaurant.classList.add('hidden');
                }
            });
        }

        // Initialize
        loadCart();
        showRestaurant();
        switchLanguage(currentLanguage);
    </script>
</body>
</html>
