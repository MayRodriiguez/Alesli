<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Flores - Tienda Online</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- AOS Animations -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fef5f7 0%, #fce4ec 50%, #f3e5f5 100%);
            min-height: 100vh;
        }

        /* Navbar Premium */
        .navbar {
            background: linear-gradient(135deg, #c2185b, #6a1b9a);
            padding: 1rem 2rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-family: 'Dancing Script', cursive;
            font-size: 2rem;
            font-weight: 700;
            color: white !important;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .navbar-brand i {
            margin-right: 10px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .nav-link {
            color: white !important;
            font-weight: 500;
            transition: all 0.3s ease;
            margin: 0 10px;
        }

        .nav-link:hover {
            transform: translateY(-2px);
            text-shadow: 0 0 10px rgba(255,255,255,0.5);
        }

        /* Search Bar */
        .search-section {
            padding: 30px 0;
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(10px);
            border-radius: 0 0 30px 30px;
            margin-bottom: 30px;
        }

        .search-box {
            position: relative;
            max-width: 500px;
            margin: 0 auto;
        }

        .search-box input {
            width: 100%;
            padding: 15px 25px;
            border: none;
            border-radius: 50px;
            background: white;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            outline: none;
            box-shadow: 0 8px 25px rgba(194,24,91,0.2);
            transform: translateY(-2px);
        }

        .search-box i {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #c2185b;
            font-size: 1.2rem;
        }

        /* Category Filters */
        .categories {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .category-btn {
            padding: 8px 20px;
            border: none;
            border-radius: 50px;
            background: white;
            color: #c2185b;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        .category-btn.active,
        .category-btn:hover {
            background: linear-gradient(135deg, #c2185b, #6a1b9a);
            color: white;
            transform: translateY(-2px);
        }

        /* Product Cards Premium */
        .products-section {
            padding: 20px 0 60px;
        }

        .section-title {
            text-align: center;
            margin-bottom: 50px;
            position: relative;
        }

        .section-title h2 {
            font-family: 'Dancing Script', cursive;
            font-size: 2.8rem;
            background: linear-gradient(135deg, #c2185b, #6a1b9a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }

        .section-title::after {
            content: '🌸';
            font-size: 2rem;
            position: absolute;
            bottom: -25px;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0.5;
        }

        .product-card {
            background: white;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            margin-bottom: 30px;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .product-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            z-index: 10;
        }

        .badge-stock {
            background: linear-gradient(135deg, #2e7d32, #43a047);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .product-image {
            height: 250px;
            overflow: hidden;
            position: relative;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .product-card:hover .product-image img {
            transform: scale(1.1);
        }

        .product-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .product-card:hover .product-overlay {
            opacity: 1;
        }

        .quick-view {
            background: white;
            border: none;
            padding: 10px 20px;
            border-radius: 30px;
            color: #c2185b;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .quick-view:hover {
            background: #c2185b;
            color: white;
            transform: scale(1.05);
        }

        .product-info {
            padding: 20px;
            text-align: center;
        }

        .product-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #2d2d2d;
            margin-bottom: 5px;
        }

        .product-desc {
            font-size: 0.8rem;
            color: #888;
            margin-bottom: 10px;
            line-height: 1.4;
        }

        .product-price {
            font-size: 1.3rem;
            font-weight: 700;
            background: linear-gradient(135deg, #c2185b, #6a1b9a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 10px;
        }

        .product-stock {
            font-size: 0.7rem;
            margin-bottom: 15px;
        }

        .stock-available {
            color: #2e7d32;
        }

        .stock-low {
            color: #ff9800;
        }

        .btn-add-cart {
            background: linear-gradient(135deg, #c2185b, #6a1b9a);
            border: none;
            border-radius: 30px;
            padding: 10px 20px;
            color: white;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-add-cart:hover {
            transform: scale(1.02);
            box-shadow: 0 5px 15px rgba(194,24,91,0.4);
        }

        .btn-add-cart:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
        }

        /* Cart Sidebar */
        .cart-sidebar {
            position: fixed;
            right: -400px;
            top: 0;
            width: 400px;
            height: 100%;
            background: white;
            box-shadow: -5px 0 30px rgba(0,0,0,0.2);
            z-index: 1050;
            transition: right 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .cart-sidebar.open {
            right: 0;
        }

        .cart-header {
            background: linear-gradient(135deg, #c2185b, #6a1b9a);
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-items {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
        }

        .cart-item {
            display: flex;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .cart-item img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 10px;
        }

        .cart-item-details {
            flex: 1;
        }

        .cart-item-title {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .cart-item-price {
            color: #c2185b;
            font-weight: 600;
        }

        .cart-item-quantity {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 5px;
        }

        .cart-item-quantity button {
            background: #f0f0f0;
            border: none;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            cursor: pointer;
        }

        .cart-footer {
            padding: 20px;
            border-top: 1px solid #eee;
        }

        .cart-total {
            display: flex;
            justify-content: space-between;
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 15px;
        }

        .btn-checkout {
            background: linear-gradient(135deg, #2e7d32, #43a047);
            border: none;
            border-radius: 30px;
            padding: 12px;
            color: white;
            font-weight: 600;
            width: 100%;
            cursor: pointer;
        }

        .cart-toggle {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(135deg, #c2185b, #6a1b9a);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
            z-index: 1040;
            transition: all 0.3s ease;
        }

        .cart-toggle:hover {
            transform: scale(1.1);
        }

        .cart-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ff9800;
            color: white;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Footer */
        .footer {
            background: linear-gradient(135deg, #6a1b9a, #c2185b);
            color: white;
            padding: 40px 0;
            margin-top: 60px;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .product-card {
            animation: fadeInUp 0.6s ease forwards;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .cart-sidebar {
                width: 100%;
                right: -100%;
            }
            
            .product-image {
                height: 200px;
            }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="fas fa-flower"></i> Flores
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#productos">Productos</a></li>
                <li class="nav-item"><a class="nav-link" href="#cursos">Cursos</a></li>
                <li class="nav-item"><a class="nav-link" href="#contacto">Contacto</a></li>
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle"></i> {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('perfil') }}"><i class="fas fa-user"></i> Mi Perfil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}"><i class="fas fa-user-plus"></i> Registrarse</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Search Section -->
<div class="search-section" style="margin-top: 80px;">
    <div class="container">
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Buscar flores, arreglos..." onkeyup="filterProducts()">
        </div>
        <div class="categories">
            <button class="category-btn active" onclick="filterCategory('all')">Todos</button>
            <button class="category-btn" onclick="filterCategory('rosas')">🌹 Rosas</button>
            <button class="category-btn" onclick="filterCategory('orquideas')">🌸 Orquídeas</button>
            <button class="category-btn" onclick="filterCategory('girasoles')">🌻 Girasoles</button>
            <button class="category-btn" onclick="filterCategory('ramos')">💐 Ramos</button>
        </div>
    </div>
</div>

<!-- Products Section -->
<div class="products-section" id="productos">
    <div class="container">
        <div class="section-title">
            <h2>Nuestras Flores</h2>
            <p class="text-muted">Arreglos frescos disponibles para entrega</p>
        </div>
        
        <div class="row" id="productsGrid">
            @foreach($productos as $producto)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4 product-item" data-name="{{ strtolower($producto->nombre) }}" data-category="{{ strtolower($producto->categoria ?? 'flores') }}">
                <div class="product-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    @if($producto->stock <= 5 && $producto->stock > 0)
                    <div class="product-badge">
                        <span class="badge-stock">⚠️ Últimas unidades</span>
                    </div>
                    @endif
                    <div class="product-image">
                        @if($producto->imagen)
                            <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}">
                        @else
                            <img src="https://via.placeholder.com/300x250/fce4ec/c2185b?text=Flores" alt="{{ $producto->nombre }}">
                        @endif
                        <div class="product-overlay">
                            <button class="quick-view" onclick="quickView({{ $producto->id }})">
                                <i class="fas fa-eye"></i> Vista rápida
                            </button>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3 class="product-title">{{ $producto->nombre }}</h3>
                        <p class="product-desc">{{ Str::limit($producto->descripcion, 60) ?: 'Hermoso arreglo floral' }}</p>
                        <div class="product-price">Bs. {{ number_format($producto->precio, 2) }}</div>
                        <div class="product-stock">
                            @if($producto->stock > 0)
                                <span class="stock-available"><i class="fas fa-check-circle"></i> Disponible</span>
                            @else
                                <span class="stock-low"><i class="fas fa-times-circle"></i> Agotado</span>
                            @endif
                        </div>
                        @if($producto->stock > 0)
                            <button class="btn-add-cart" onclick="addToCart({{ $producto->id }})">
                                <i class="fas fa-cart-plus"></i> Agregar al carrito
                            </button>
                        @else
                            <button class="btn-add-cart" disabled style="background: #ccc;">
                                <i class="fas fa-ban"></i> Agotado
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Cart Sidebar -->
<div class="cart-toggle" onclick="toggleCart()">
    <i class="fas fa-shopping-cart"></i>
    <span class="cart-count" id="cartCount">0</span>
</div>

<div class="cart-sidebar" id="cartSidebar">
    <div class="cart-header">
        <h5 class="mb-0"><i class="fas fa-shopping-cart"></i> Mi Carrito</h5>
        <button class="btn-close btn-close-white" onclick="toggleCart()"></button>
    </div>
    <div class="cart-items" id="cartItems">
        <p class="text-center text-muted mt-4">Tu carrito está vacío</p>
    </div>
    <div class="cart-footer">
        <div class="cart-total">
            <span>Total:</span>
            <span id="cartTotal">Bs. 0.00</span>
        </div>
        <button class="btn-checkout" onclick="checkout()">
            <i class="fas fa-credit-card"></i> Proceder al pago
        </button>
    </div>
</div>

<!-- Footer -->
<footer class="footer" id="contacto">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4 mb-md-0">
                <h5><i class="fas fa-flower"></i> Flores</h5>
                <p>Arreglos florales únicos para momentos especiales. Emprendimiento familiar desde 2020.</p>
                <div class="social-icons mt-3">
                    <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-whatsapp"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
            <div class="col-md-4 mb-4 mb-md-0">
                <h5>Enlaces rápidos</h5>
                <ul class="list-unstyled">
                    <li><a href="#productos" class="text-white text-decoration-none">Productos</a></li>
                    <li><a href="#cursos" class="text-white text-decoration-none">Cursos</a></li>
                    <li><a href="{{ route('login') }}" class="text-white text-decoration-none">Iniciar Sesión</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Contacto</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-map-marker-alt me-2"></i> Ciudad, País</li>
                    <li><i class="fas fa-phone me-2"></i> +123 456 7890</li>
                    <li><i class="fas fa-envelope me-2"></i> info@flores.com</li>
                    <li><i class="fas fa-clock me-2"></i> Lun-Sáb: 9am - 8pm</li>
                </ul>
            </div>
        </div>
        <hr class="my-3" style="background: rgba(255,255,255,0.3);">
        <div class="text-center">
            <p class="mb-0">&copy; 2024 Flores - Todos los derechos reservados. 🌸</p>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    AOS.init({
        duration: 1000,
        once: true
    });

    // Filter products by search
    function filterProducts() {
        let searchTerm = document.getElementById('searchInput').value.toLowerCase();
        let products = document.querySelectorAll('.product-item');
        
        products.forEach(product => {
            let name = product.getAttribute('data-name');
            if (name.includes(searchTerm)) {
                product.style.display = 'block';
            } else {
                product.style.display = 'none';
            }
        });
    }

    // Filter by category
    function filterCategory(category) {
        let products = document.querySelectorAll('.product-item');
        let buttons = document.querySelectorAll('.category-btn');
        
        buttons.forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');
        
        if (category === 'all') {
            products.forEach(product => product.style.display = 'block');
        } else {
            products.forEach(product => {
                let productCategory = product.getAttribute('data-category');
                if (productCategory.includes(category)) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        }
    }

    // Cart functions
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    
    function updateCartUI() {
        let cartItems = document.getElementById('cartItems');
        let cartTotal = document.getElementById('cartTotal');
        let cartCount = document.getElementById('cartCount');
        
        if (cart.length === 0) {
            cartItems.innerHTML = '<p class="text-center text-muted mt-4">Tu carrito está vacío</p>';
            cartTotal.innerText = 'Bs. 0.00';
            cartCount.innerText = '0';
            return;
        }
        
        let total = 0;
        let itemsHtml = '';
        
        cart.forEach((item, index) => {
            total += item.precio * item.cantidad;
            itemsHtml += `
                <div class="cart-item">
                    <img src="${item.imagen || 'https://via.placeholder.com/60/fce4ec/c2185b?text=Flor'}" alt="${item.nombre}">
                    <div class="cart-item-details">
                        <div class="cart-item-title">${item.nombre}</div>
                        <div class="cart-item-price">Bs. ${item.precio.toFixed(2)}</div>
                        <div class="cart-item-quantity">
                            <button onclick="updateQuantity(${index}, -1)">-</button>
                            <span>${item.cantidad}</span>
                            <button onclick="updateQuantity(${index}, 1)">+</button>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-danger" onclick="removeFromCart(${index})"><i class="fas fa-trash"></i></button>
                </div>
            `;
        });
        
        cartItems.innerHTML = itemsHtml;
        cartTotal.innerText = `Bs. ${total.toFixed(2)}`;
        cartCount.innerText = cart.reduce((sum, item) => sum + item.cantidad, 0);
        
        localStorage.setItem('cart', JSON.stringify(cart));
    }
    
    function addToCart(productId) {
        fetch('/tienda/carrito/agregar', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ producto_id: productId, cantidad: 1 })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                cart = data.cart;
                updateCartUI();
                Swal.fire({
                    icon: 'success',
                    title: 'Agregado',
                    text: 'Producto agregado al carrito',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    }
    
    function updateQuantity(index, change) {
        let newQuantity = cart[index].cantidad + change;
        if (newQuantity < 1) {
            cart.splice(index, 1);
        } else {
            cart[index].cantidad = newQuantity;
        }
        updateCartUI();
        
        // Sync with server
        fetch('/tienda/carrito/update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ cart: cart })
        });
    }
    
    function removeFromCart(index) {
        cart.splice(index, 1);
        updateCartUI();
    }
    
    function toggleCart() {
        document.getElementById('cartSidebar').classList.toggle('open');
    }
    
    function checkout() {
        if (cart.length === 0) {
            Swal.fire('Error', 'Tu carrito está vacío', 'error');
            return;
        }
        window.location.href = '/tienda/checkout';
    }
    
    function quickView(id) {
        Swal.fire({
            title: 'Detalles del producto',
            text: 'Próximamente',
            icon: 'info'
        });
    }
    
    updateCartUI();
</script>
</body>
</html>