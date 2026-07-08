<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بريانى تو قو - Biryani To Go</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/biryani.css') }}">
    <script>
        (function () {
            var lang = localStorage.getItem('language') || 'ar';
            document.documentElement.lang = lang;
            document.documentElement.dir = lang === 'ar' ? 'rtl' : 'ltr';
        })();
    </script>
</head>
<body class="biryani-brand">
    <header class="biryani-header">
        <div class="biryani-header-top">
            <button class="language-btn" id="languageBtn" type="button" onclick="toggleLanguage()">
                <span lang="ar">English</span>
                <span lang="en" class="hidden">العربية</span>
            </button>
            <div class="cart-icon-top" onclick="goToCart()" id="cartIconTop" role="button" tabindex="0" aria-label="Cart">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M7 18c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12L8.1 13h7.45c.75 0 1.41-.41 1.75-1.03L21.7 4H5.21l-.94-2H1zm16 16c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                </svg>
                <div class="cart-badge-top hidden" id="cartBadgeTop">0</div>
            </div>
        </div>

        <div class="biryani-brand-block">
            <div class="logo-circle">
                <img src="{{ asset('assets/imag/Biryani1.jpeg') }}" alt="بريانى تو قو - Biryani To Go" />
            </div>
            <h1 class="brand-name">
                <span lang="ar">بريانى تو قو</span>
                <span lang="en" class="hidden">Biryani To Go</span>
            </h1>
            <p class="brand-tagline">
                <span lang="ar">Biryani To Go</span>
                <span lang="en" class="hidden">بريانى تو قو</span>
            </p>
        </div>

        <hr class="biryani-divider">
    </header>

    <main class="biryani-menu">
        <h2 class="menu-section-title">
            <span lang="ar">قائمة الطعام</span>
            <span lang="en" class="hidden">Menu</span>
        </h2>

        <div class="biryani-dishes-grid" id="menuItemsList">
            @foreach ($dishes as $dish)
                @php
                    $dishImage = $dish->image_path
                        ? Storage::url($dish->image_path)
                        : asset('assets/imag/Biryani1.jpeg');
                    $priceOptions = is_array($dish->prices) ? $dish->prices : [];
                    $firstPrice = !empty($priceOptions) && isset($priceOptions[0]['price']) ? (float) $priceOptions[0]['price'] : 0;
                    $hasMultiplePrices = count($priceOptions) > 1
                        || (count($priceOptions) === 1 && (! empty($priceOptions[0]['size_ar']) || ! empty($priceOptions[0]['size_en'])));
                @endphp
                <article class="biryani-dish-card menu-item-card" data-id="{{ $dish->id }}" data-price="{{ $firstPrice }}" data-name-ar="{{ $dish->name_ar }}" data-name-en="{{ $dish->name_en }}">
                    <div class="dish-image-wrap">
                        <img src="{{ $dishImage }}" alt="{{ $dish->name_ar }}" class="dish-image" onerror="this.src='{{ asset('assets/imag/Biryani1.jpeg') }}'">
                        @if (! empty($priceOptions))
                            <div class="dish-price-badge">
                                @if (! $hasMultiplePrices)
                                    {{ number_format($firstPrice, 2) }}
                                    <span lang="ar"> د.ب</span><span lang="en" class="hidden"> BHD</span>
                                @else
                                    <span lang="ar">من {{ number_format($firstPrice, 2) }} د.ب</span>
                                    <span lang="en" class="hidden">From {{ number_format($firstPrice, 2) }} BHD</span>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="dish-info">
                        <h3 class="dish-name-ar">{{ $dish->name_ar }}</h3>
                        <p class="dish-name-en">{{ $dish->name_en }}</p>

                        @if (! empty($dish->description_ar) || ! empty($dish->description_en))
                            <p class="dish-description">
                                <span lang="ar">{{ $dish->description_ar }}</span>
                                <span lang="en" class="hidden">{{ $dish->description_en }}</span>
                            </p>
                        @endif

                        <button class="add-to-cart-btn" type="button" onclick="addToCart({{ $dish->id }}, {{ json_encode($dish->name_ar) }}, {{ json_encode($dish->name_en) }}, {{ $firstPrice }}, {{ json_encode($dishImage) }}, {{ json_encode($priceOptions) }})">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path d="M7 18c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12L8.1 13h7.45c.75 0 1.41-.41 1.75-1.03L21.7 4H5.21l-.94-2H1zm16 16c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z" fill="currentColor"/>
                            </svg>
                            <span lang="ar">أضف للسلة</span>
                            <span lang="en" class="hidden">Add to Cart</span>
                        </button>
                    </div>
                </article>
            @endforeach
        </div>
    </main>

    <!-- Cart Notification -->
    <div class="cart-notification" id="cartNotification">
        <span lang="ar">تمت الإضافة إلى السلة بنجاح!</span>
        <span lang="en" class="hidden">Added to cart successfully!</span>
    </div>

    <!-- Price Selection Modal -->
    <div class="price-modal-overlay" id="priceModalOverlay">
        <div class="price-modal">
            <div class="price-modal-header">
                <h3 class="price-modal-title" id="priceModalTitle">
                    <span lang="ar">اختر السعر</span>
                    <span lang="en" class="hidden">Select Price</span>
                </h3>
                <button class="price-modal-close" id="priceModalClose" type="button" onclick="closePriceModal()">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>
            <div class="price-modal-body" id="priceModalBody">
                <!-- Price options will be inserted here -->
            </div>
        </div>
    </div>

    <script>
        let currentLanguage = localStorage.getItem('language') || 'ar';
        let cart = [];

        const BIRYANI_BRAND = {
            id: 'biryani',
            nameAr: 'بريانى تو قو',
            nameEn: 'Biryani To Go',
        };

        function getBrandCartMeta() {
            return {
                restaurantId: BIRYANI_BRAND.id,
                restaurantName: currentLanguage === 'ar' ? BIRYANI_BRAND.nameAr : BIRYANI_BRAND.nameEn,
                restaurantNameAr: BIRYANI_BRAND.nameAr,
                restaurantNameEn: BIRYANI_BRAND.nameEn,
            };
        }

        function loadCart() {
            const savedCart = localStorage.getItem('restaurantCart');
            if (savedCart) {
                cart = JSON.parse(savedCart);
            }
            updateCartBadge();
        }

        function saveCart() {
            localStorage.setItem('restaurantCart', JSON.stringify(cart));
            updateCartBadge();
        }

        function updateCartBadge() {
            const badge = document.getElementById('cartBadgeTop');
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);

            if (totalItems > 0) {
                badge.textContent = totalItems;
                badge.classList.remove('hidden');
            } else {
                badge.classList.add('hidden');
            }
        }

        function setLanguage(lang) {
            currentLanguage = lang;
            localStorage.setItem('language', lang);
            document.documentElement.lang = lang;
            document.documentElement.dir = lang === 'ar' ? 'rtl' : 'ltr';
            document.body.setAttribute('dir', lang === 'ar' ? 'rtl' : 'ltr');

            document.querySelectorAll('[lang="ar"]').forEach(el => {
                el.classList.toggle('hidden', lang !== 'ar');
            });
            document.querySelectorAll('[lang="en"]').forEach(el => {
                el.classList.toggle('hidden', lang !== 'en');
            });

            document.title = lang === 'ar'
                ? 'بريانى تو قو - Biryani To Go'
                : 'Biryani To Go - بريانى تو قو';

            const modal = document.getElementById('priceModalOverlay');
            if (modal.classList.contains('show') && pendingCartItem) {
                showPriceModal(pendingCartItem.itemId, pendingCartItem.nameAr, pendingCartItem.nameEn, pendingCartItem.image, pendingCartItem.priceOptions);
            }
        }

        function toggleLanguage() {
            const newLang = currentLanguage === 'ar' ? 'en' : 'ar';
            setLanguage(newLang);
        }

        let pendingCartItem = null;

        function showPriceModal(itemId, nameAr, nameEn, image, priceOptions) {
            const modal = document.getElementById('priceModalOverlay');
            const modalBody = document.getElementById('priceModalBody');

            pendingCartItem = { itemId, nameAr, nameEn, image, priceOptions };

            modalBody.innerHTML = '';

            priceOptions.forEach((option) => {
                const sizeAr = option.size_ar || '';
                const sizeEn = option.size_en || '';
                const priceValue = option.price || 0;
                const sizeLabel = currentLanguage === 'ar' ? sizeAr : sizeEn;

                const optionDiv = document.createElement('div');
                optionDiv.className = 'price-option';
                optionDiv.onclick = () => selectPriceOption(itemId, nameAr, nameEn, image, option);

                optionDiv.innerHTML = `
                    <div class="price-option-content">
                        <div class="price-option-info">
                            ${sizeLabel ? `<div class="price-option-size">${sizeLabel}</div>` : ''}
                            <div class="price-option-price">${priceValue.toFixed(2)} <span>${currentLanguage === 'ar' ? 'د.ب' : 'BHD'}</span></div>
                        </div>
                        <div class="price-option-check">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 6L9 17L4 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                `;

                modalBody.appendChild(optionDiv);
            });

            modal.classList.add('show');
        }

        function closePriceModal() {
            const modal = document.getElementById('priceModalOverlay');
            modal.classList.remove('show');
            pendingCartItem = null;
        }

        function selectPriceOption(itemId, nameAr, nameEn, image, selectedOption) {
            const price = parseFloat(selectedOption.price);
            const sizeAr = selectedOption.size_ar || '';
            const sizeEn = selectedOption.size_en || '';
            const sizeLabel = currentLanguage === 'ar' ? sizeAr : sizeEn;
            const finalName = sizeLabel ? `${currentLanguage === 'ar' ? nameAr : nameEn} - ${sizeLabel}` : (currentLanguage === 'ar' ? nameAr : nameEn);
            const brandMeta = getBrandCartMeta();

            const existingItem = cart.find(cartItem => cartItem.id === itemId && cartItem.name === finalName && cartItem.price === price);

            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({
                    id: itemId,
                    name: finalName,
                    nameAr: nameAr,
                    nameEn: nameEn,
                    price: price,
                    image: image,
                    quantity: 1,
                    ...brandMeta,
                });
            }

            closePriceModal();
            saveCart();

            const notification = document.getElementById('cartNotification');
            notification.classList.add('show');
            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000);
        }

        function addToCart(itemId, nameAr, nameEn, price, image, priceOptions = []) {
            const notification = document.getElementById('cartNotification');

            if (priceOptions && priceOptions.length > 1) {
                showPriceModal(itemId, nameAr, nameEn, image, priceOptions);
                return;
            }

            const baseName = currentLanguage === 'ar' ? nameAr : nameEn;
            const finalPrice = priceOptions && priceOptions.length === 1 ? parseFloat(priceOptions[0].price) : price;
            const brandMeta = getBrandCartMeta();

            const existingItem = cart.find(cartItem => cartItem.id === itemId && cartItem.name === baseName && cartItem.price === finalPrice);

            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({
                    id: itemId,
                    name: baseName,
                    nameAr: nameAr,
                    nameEn: nameEn,
                    price: finalPrice,
                    image: image,
                    quantity: 1,
                    ...brandMeta,
                });
            }

            saveCart();

            notification.classList.add('show');
            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000);
        }

        function goToCart() {
            if (cart.length === 0) {
                alert(currentLanguage === 'ar' ? 'السلة فارغة' : 'Cart is empty');
            } else {
                window.location.href = '{{ route('cart.index') }}';
            }
        }

        document.getElementById('priceModalOverlay').addEventListener('click', function(e) {
            if (e.target === this) {
                closePriceModal();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closePriceModal();
            }
        });

        loadCart();
        setLanguage(currentLanguage);
    </script>

</body>
</html>
