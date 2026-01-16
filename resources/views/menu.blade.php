<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>القائمة - Menu</title>
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
                                    : 'https://images.unsplash.com/photo-1604503468506-a8da13d82791?w=400&h=300&fit=crop';
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
            const defaultRestaurantId = {{ json_encode(optional($restaurants->first())->id) }};
            const selectedRestaurant = localStorage.getItem('selectedRestaurant') || (defaultRestaurantId ? String(defaultRestaurantId) : null);

            document.querySelectorAll('.restaurant-content').forEach(restaurant => {
                if (selectedRestaurant && restaurant.getAttribute('data-restaurant') === selectedRestaurant) {
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
