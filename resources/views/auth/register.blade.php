<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registro - Alesli</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #ffd1dc 0%, #9370db 50%, #8b008b 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow-x: hidden;
        }

        .floating-flower {
            position: absolute;
            font-size: 2rem;
            opacity: 0.15;
            pointer-events: none;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(10deg); }
        }

        .flower-1 { top: 10%; left: 5%; font-size: 4rem; animation-delay: 0s; }
        .flower-2 { bottom: 15%; right: 8%; font-size: 5rem; animation-delay: 1s; }
        .flower-3 { top: 20%; right: 15%; font-size: 3rem; animation-delay: 2s; }
        .flower-4 { bottom: 25%; left: 10%; font-size: 3.5rem; animation-delay: 1.5s; }
        .flower-5 { top: 50%; left: 20%; font-size: 2.5rem; animation-delay: 0.5s; }
        .flower-6 { bottom: 40%; right: 20%; font-size: 2.8rem; animation-delay: 2.5s; }

        .register-container {
            width: 100%;
            max-width: 550px;
            padding: 20px;
            position: relative;
            z-index: 10;
        }

        .register-card {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 40px;
            padding: 45px 40px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            animation: slideUp 0.6s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .register-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 35px 60px rgba(0, 0, 0, 0.25);
        }

        .logo-area {
            text-align: center;
            margin-bottom: 35px;
        }

        .logo-icon {
            width: 85px;
            height: 85px;
            background: linear-gradient(135deg, #ff1493, #8b008b);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(255,20,147,0.4); }
            50% { transform: scale(1.05); box-shadow: 0 0 0 15px rgba(255,20,147,0); }
        }

        .logo-icon i {
            font-size: 3rem;
            color: white;
        }

        .logo-area h1 {
            font-family: 'Dancing Script', cursive;
            font-size: 2rem;
            background: linear-gradient(135deg, #ff1493, #8b008b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
        }

        .logo-area p {
            color: #888;
            font-size: 0.85rem;
        }

        .input-group-custom {
            margin-bottom: 20px;
        }

        .input-group-custom label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
            font-size: 0.9rem;
        }

        .input-group-custom label i {
            color: #ff1493;
            margin-right: 8px;
        }

        .input-group-custom input {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #f0f0f0;
            border-radius: 30px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: #fafafa;
        }

        .input-group-custom input:focus {
            outline: none;
            border-color: #ff1493;
            background: white;
            box-shadow: 0 0 0 3px rgba(255,20,147,0.1);
        }

        .btn-register {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #ff1493, #8b008b);
            border: none;
            border-radius: 30px;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn-register:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 20px rgba(255,20,147,0.3);
        }

        .btn-register i {
            margin-right: 10px;
        }

        .divider {
            text-align: center;
            margin: 25px 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, #ddd, transparent);
        }

        .divider span {
            background: white;
            padding: 0 15px;
            position: relative;
            color: #999;
            font-size: 0.8rem;
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #f0f0f0;
        }

        .login-link a {
            color: #ff1493;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            color: #8b008b;
            text-decoration: underline;
        }

        .alert-custom {
            background: linear-gradient(135deg, #ffe5e5, #ffd1dc);
            border-left: 4px solid #ff1493;
            border-radius: 15px;
            padding: 12px 18px;
            margin-bottom: 20px;
            color: #c7254e;
            font-size: 0.85rem;
        }

        @media (max-width: 480px) {
            .register-card {
                padding: 30px 25px;
            }
            
            .logo-icon {
                width: 65px;
                height: 65px;
            }
            
            .logo-icon i {
                font-size: 2.2rem;
            }
        }
    </style>
</head>
<body>
    <div class="floating-flower flower-1">🌸</div>
    <div class="floating-flower flower-2">🌹</div>
    <div class="floating-flower flower-3">🌺</div>
    <div class="floating-flower flower-4">🌷</div>
    <div class="floating-flower flower-5">💐</div>
    <div class="floating-flower flower-6">🌻</div>

    <div class="register-container">
        <div class="register-card">
            <div class="logo-area">
                <div class="logo-icon">
                    <i class="fas fa-flower"></i>
                </div>
                <h1>🌸 Crear Cuenta</h1>
                <p>Únete a Alesli</p>
            </div>

            @if($errors->any())
                <div class="alert-custom">
                    <i class="fas fa-exclamation-circle"></i>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <div class="input-group-custom">
                    <label><i class="fas fa-user"></i> Nombre Completo</label>
                    <input type="text" name="name" placeholder="Tu nombre completo" required autofocus>
                </div>

                <div class="input-group-custom">
                    <label><i class="fas fa-envelope"></i> Correo Electrónico</label>
                    <input type="email" name="email" placeholder="tú@ejemplo.com" required>
                </div>

                <div class="input-group-custom">
                    <label><i class="fas fa-lock"></i> Contraseña</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>

                <div class="input-group-custom">
                    <label><i class="fas fa-check-circle"></i> Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn-register">
                    <i class="fas fa-user-plus"></i> Registrarse
                </button>

                <div class="divider">
                    <span>¿Ya tienes cuenta?</span>
                </div>

                <div class="login-link">
                    <a href="{{ route('login') }}">Iniciar Sesión</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>