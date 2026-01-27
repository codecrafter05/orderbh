<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>زهور الشفاء - Zohoor Al Shafa</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="logo-container">
            <div class="logo-circle">
                <img src="{{ asset('assets/imag/logo.png') }}" alt="زهور الشفاء - Flowers of Healing" />
            </div>
        </div>
    </div>

    <!-- Top Bar with Cart -->
    <div class="top-bar">
        <div class="language-selector">
            <button class="language-btn" id="languageBtn" onclick="toggleLanguage()">
                <span lang="ar">English</span>
                <span lang="en" class="hidden">العربية</span>
            </button>
        </div>
        <div class="cart-icon-top" onclick="goToCart()" id="cartIconTop">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M7 18c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12L8.1 13h7.45c.75 0 1.41-.41 1.75-1.03L21.7 4H5.21l-.94-2H1zm16 16c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
            </svg>
            <div class="cart-badge-top hidden" id="cartBadgeTop">0</div>
        </div>
    </div>

    <!-- Categories -->
    <div class="categories-section">
        <div class="categories-scroll" id="categoriesScroll">
            <div class="category-item active" data-category="all" data-title-ar="قائمة الطعام" data-title-en="Menu" onclick="filterCategory('all')">
                <img src="{{ asset('assets/imag/all.jpeg') }}" alt="الكل" class="category-image">
                <div class="category-name">
                    <span lang="ar">الكل</span>
                    <span lang="en" class="hidden">All</span>
                </div>
            </div>
            @foreach ($categories as $category)
                @php
                    $categoryImage = $category->image_path
                        ? Storage::url($category->image_path)
                        : 'https://www.zohooralshafa.site/storage/products/images/01K3P2F8H6ZPWJ9MA0BY3BX18K.jpg';
                @endphp
                <div class="category-item" data-category="{{ $category->id }}" data-title-ar="{{ $category->name_ar }}" data-title-en="{{ $category->name_en }}" onclick="filterCategory('{{ $category->id }}')">
                    <img src="{{ $categoryImage }}" alt="{{ $category->name_ar }}" class="category-image" onerror="this.src='https://images.unsplash.com/photo-1621996346565-e3dbc646d9a9?w=400&h=300&fit=crop'">
                <div class="category-name">
                        <span lang="ar">{{ $category->name_ar }}</span>
                        <span lang="en" class="hidden">{{ $category->name_en }}</span>
            </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Menu Section -->
    <div class="menu-section">
        <div class="section-header">
            <h2 class="section-title" id="sectionTitle" data-title-ar="قائمة الطعام" data-title-en="Menu">
                <span lang="ar">قائمة الطعام</span>
                <span lang="en" class="hidden">Menu</span>
            </h2>
            <div class="view-toggle">
                <div class="view-btn active" data-view="list" onclick="setView('list')">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M3 6h18v2H3V6m0 5h18v2H3v-2m0 5h18v2H3v-2z"/>
                    </svg>
                </div>
                <div class="view-btn" data-view="grid" onclick="setView('grid')">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M3 3v8h8V3H3m10 0v8h8V3h-8M3 13v8h8v-8H3m10 0v8h8v-8h-8z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="menu-items-list" id="menuItemsList">
            @foreach ($dishes as $dish)
                @php
                    $dishImage = $dish->image_path
                        ? Storage::url($dish->image_path)
                        : 'https://www.zohooralshafa.site/storage/products/images/01K3P2F8H6ZPWJ9MA0BY3BX18K.jpg';
                    $priceOptions = is_array($dish->prices) ? $dish->prices : [];
                    $firstPrice = !empty($priceOptions) && isset($priceOptions[0]['price']) ? (float) $priceOptions[0]['price'] : 0;
                @endphp
                <div class="menu-item-card" data-category="{{ $dish->category_id }}" data-id="{{ $dish->id }}" data-price="{{ $firstPrice }}" data-name-ar="{{ $dish->name_ar }}" data-name-en="{{ $dish->name_en }}">
                    <img src="{{ $dishImage }}" alt="{{ $dish->name_ar }}" class="menu-item-image" onerror="this.src='https://images.unsplash.com/photo-1604503468506-a8da13d82791?w=400&h=300&fit=crop'">
                <div class="menu-item-content">
                    <div class="menu-item-header">
                        <div class="menu-item-name">
                                <span lang="ar">{{ $dish->name_ar }}</span>
                                <span lang="en" class="hidden">{{ $dish->name_en }}</span>
                        </div>
                            @if (!empty($dish->description_ar) || !empty($dish->description_en))
                        <div class="menu-item-description">
                                    <span lang="ar">{{ $dish->description_ar }}</span>
                                    <span lang="en" class="hidden">{{ $dish->description_en }}</span>
                        </div>
                            @endif
                    </div>
                    <div class="menu-item-footer">
                            @if (!empty($priceOptions))
                                <div class="menu-item-price">
                                    @if (count($priceOptions) === 1 && empty($priceOptions[0]['size_ar']) && empty($priceOptions[0]['size_en']))
                                        {{ number_format($firstPrice, 2) }} <span lang="ar">د.ب</span><span lang="en" class="hidden">BHD</span>
                                    @else
                                        <span lang="ar">من {{ number_format($firstPrice, 2) }} د.ب</span>
                                        <span lang="en" class="hidden">From {{ number_format($firstPrice, 2) }} BHD</span>
                                    @endif
                    </div>
                            @endif
                            <button class="add-to-cart-btn" onclick="addToCart({{ $dish->id }}, {{ json_encode($dish->name_ar) }}, {{ json_encode($dish->name_en) }}, {{ $firstPrice }}, {{ json_encode($dishImage) }}, {{ json_encode($priceOptions) }})">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7 18c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12L8.1 13h7.45c.75 0 1.41-.41 1.75-1.03L21.7 4H5.21l-.94-2H1zm16 16c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z" fill="white"/>
                            </svg>
                            <span lang="ar">أضف للسلة</span>
                            <span lang="en" class="hidden">Add to Cart</span>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

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
                <button class="price-modal-close" id="priceModalClose" onclick="closePriceModal()">
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
        let currentLanguage = 'ar';
        let currentCategory = 'all';
        let currentView = 'list';
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
            const badge = document.getElementById('cartBadgeTop');
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            
            if (totalItems > 0) {
                badge.textContent = totalItems;
                badge.classList.remove('hidden');
            } else {
                badge.classList.add('hidden');
            }
        }

        // Set language (used for initialization)
        function setLanguage(lang) {
            currentLanguage = lang;
            localStorage.setItem('language', lang);
            document.documentElement.lang = lang;
            document.documentElement.dir = lang === 'ar' ? 'rtl' : 'ltr';
            document.body.setAttribute('dir', lang === 'ar' ? 'rtl' : 'ltr');

            // Show/hide language-specific elements
            document.querySelectorAll('[lang="ar"]').forEach(el => {
                el.classList.toggle('hidden', lang !== 'ar');
            });
            document.querySelectorAll('[lang="en"]').forEach(el => {
                el.classList.toggle('hidden', lang !== 'en');
            });

            // Update categories active state
            updateCategoriesActive();
            filterMenu();
            
            // Update price modal if open
            const modal = document.getElementById('priceModalOverlay');
            if (modal.classList.contains('show')) {
                const modalBody = document.getElementById('priceModalBody');
                const priceOptions = Array.from(modalBody.querySelectorAll('.price-option')).map(option => {
                    const sizeDiv = option.querySelector('.price-option-size');
                    const priceDiv = option.querySelector('.price-option-price');
                    return {
                        size: sizeDiv ? sizeDiv.textContent : '',
                        price: priceDiv ? parseFloat(priceDiv.textContent) : 0
                    };
                });
                // Rebuild modal with new language
                if (pendingCartItem) {
                    showPriceModal(pendingCartItem.itemId, pendingCartItem.nameAr, pendingCartItem.nameEn, pendingCartItem.image, pendingCartItem.priceOptions);
                }
            }
        }

        // Toggle language (used for button click)
        function toggleLanguage() {
            const newLang = currentLanguage === 'ar' ? 'en' : 'ar';
            setLanguage(newLang);
        }

        // Update categories active state
        function updateCategoriesActive() {
            document.querySelectorAll('.category-item').forEach(item => {
                const category = item.getAttribute('data-category');
                if (category === currentCategory) {
                    item.classList.add('active');
                } else {
                    item.classList.remove('active');
                }
            });
        }

        // Filter by category
        function filterCategory(category) {
            currentCategory = category;
            updateCategoriesActive();
            filterMenu();
        }

        // Filter menu items
        function filterMenu() {
            const menuItems = document.querySelectorAll('.menu-item-card');
            menuItems.forEach(item => {
                const itemCategory = item.getAttribute('data-category');
                item.style.display = (currentCategory === 'all' || itemCategory === currentCategory) ? '' : 'none';
            });

            // Update section title from category data
            const categoryItem = document.querySelector(`[data-category="${currentCategory}"]`);
            const sectionTitle = document.getElementById('sectionTitle');
            if (categoryItem) {
                sectionTitle.innerHTML = currentLanguage === 'ar' 
                    ? categoryItem.getAttribute('data-title-ar')
                    : categoryItem.getAttribute('data-title-en');
            }
        }

        // Set view mode
        function setView(view) {
            currentView = view;
            document.querySelectorAll('.view-btn').forEach(btn => {
                btn.classList.toggle('active', btn.getAttribute('data-view') === view);
            });
            const menuItemsList = document.getElementById('menuItemsList');
            menuItemsList.className = view === 'grid' ? 'menu-items-list grid-view' : 'menu-items-list';
        }

        // Variables for price selection modal
        let pendingCartItem = null;

        // Show price selection modal
        function showPriceModal(itemId, nameAr, nameEn, image, priceOptions) {
            const modal = document.getElementById('priceModalOverlay');
            const modalBody = document.getElementById('priceModalBody');
            
            // Store pending cart item for language switching
            pendingCartItem = { itemId, nameAr, nameEn, image, priceOptions };
            
            modalBody.innerHTML = '';
            
            priceOptions.forEach((option, index) => {
                const sizeAr = option.size_ar || '';
                const sizeEn = option.size_en || '';
                const priceValue = option.price || 0;
                const sizeLabel = currentLanguage === 'ar' ? sizeAr : sizeEn;
                
                const optionDiv = document.createElement('div');
                optionDiv.className = 'price-option';
                optionDiv.onclick = () => selectPriceOption(itemId, nameAr, nameEn, image, option, index);
                
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

        // Close price modal
        function closePriceModal() {
            const modal = document.getElementById('priceModalOverlay');
            modal.classList.remove('show');
            pendingCartItem = null;
        }

        // Select price option
        function selectPriceOption(itemId, nameAr, nameEn, image, selectedOption, selectedIndex) {
            const price = parseFloat(selectedOption.price);
            const sizeAr = selectedOption.size_ar || '';
            const sizeEn = selectedOption.size_en || '';
            const sizeLabel = currentLanguage === 'ar' ? sizeAr : sizeEn;
            const finalName = sizeLabel ? `${currentLanguage === 'ar' ? nameAr : nameEn} - ${sizeLabel}` : (currentLanguage === 'ar' ? nameAr : nameEn);
            
            // Check if item already exists in cart
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
                    restaurantId: 'zohoor',
                    restaurantName: currentLanguage === 'ar' ? 'زهور الشفاء' : 'Zohoor Al Shafa',
                    restaurantNameAr: 'زهور الشفاء',
                    restaurantNameEn: 'Zohoor Al Shafa'
                });
            }
            
            // Close modal
            closePriceModal();
            
            // Save to localStorage
            saveCart();
            
            // Show notification
            const notification = document.getElementById('cartNotification');
            notification.classList.add('show');
            
            // Hide after 3 seconds
            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000);
        }

        // Add to cart
        function addToCart(itemId, nameAr, nameEn, price, image, priceOptions = []) {
            const notification = document.getElementById('cartNotification');
            
            // If multiple prices, show selection modal
            if (priceOptions && priceOptions.length > 1) {
                showPriceModal(itemId, nameAr, nameEn, image, priceOptions);
                return;
            }
            
            // Single price
            const baseName = currentLanguage === 'ar' ? nameAr : nameEn;
            const finalPrice = priceOptions && priceOptions.length === 1 ? parseFloat(priceOptions[0].price) : price;
            
            // Check if item already exists in cart
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
                    restaurantId: 'zohoor',
                    restaurantName: currentLanguage === 'ar' ? 'زهور الشفاء' : 'Zohoor Al Shafa',
                    restaurantNameAr: 'زهور الشفاء',
                    restaurantNameEn: 'Zohoor Al Shafa'
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
                alert(currentLanguage === 'ar' ? 'السلة فارغة' : 'Cart is empty');
            } else {
                window.location.href = '{{ route('cart.index') }}';
            }
        }

        // Close modal when clicking overlay
        document.getElementById('priceModalOverlay').addEventListener('click', function(e) {
            if (e.target === this) {
                closePriceModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closePriceModal();
            }
        });

        // Initialize
        loadCart();
        const savedLang = localStorage.getItem('language') || 'ar';
        setLanguage(savedLang);
        updateCategoriesActive();
        filterMenu();
        setView('list');
    </script>
    
</body>
</html>