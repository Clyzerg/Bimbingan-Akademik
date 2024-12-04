<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bimbingan Akademik</title>
    <link rel="icon" href="<?= base_url('assets/img/sttp.png')?>" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
        /* Basic Reset */
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Arial', sans-serif;
            overflow: hidden;
        }

        /* Background Style */
        .background {
            background: url('https://plus.unsplash.com/premium_photo-1661610795623-d3174b326b2b?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: relative;
        }

        /* Card Container */
        .welcome-card {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            padding: 10px;
            max-width: 500px;
            text-align: center;
            position: absolute;
            top: 10%;
            animation: colorChange 1s infinite alternate;
        }

        @keyframes colorChange {
            0% {
                background-color: rgba(60, 173, 80, 0.8);
            }
            50% {
                background-color: rgba(255, 255, 255, 0.9);
            }
            100% {
                background-color: rgba(255, 255, 255, 1);
            }
        }

        /* Form Container */
        .login-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            padding: 40px;
            width: 100%;
            max-width: 400px;
            animation: zoomIn 1s ease-out;
            position: relative;
            z-index: 1;
        }

        @keyframes zoomIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Form Elements */
        .form-group {
            position: relative;
        }

        .form-control {
            border-radius: 25px;
            border: 1px solid #ddd;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            padding: 15px 15px 15px 40px;
            font-size: 16px;
        }

        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 10px rgba(52, 152, 219, 0.6);
            outline: none;
        }

        .form-control::placeholder {
            color: #999;
        }

        .form-group i {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #aaa;
        }

        .login-btn {
            border: none;
            border-radius: 25px;
            padding: 15px;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            animation: colorShift 1s infinite;
        }

        @keyframes colorShift {
            0% {
                background-color: #3498db;
            }
            50% {
                background-color: #2ecc71;
            }
            100% {
                background-color: #e74c3c;
            }
        }

        .login-title {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
            animation: fadeIn 1s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert {
            margin-top: 20px;
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <script src="https://www.google.com/recaptcha/enterprise.js" async defer></script>
     <!-- Your code -->
</head>
<body>

    <div class="background">
        <div class="welcome-card">
            <h2>Selamat datang di website Bimbingan Akademik</h2>
        </div>
        <div class="login-container">
            <div class="login-title">
                Silahkan Login
            </div>
            <?php if ($this->session->flashdata('login_error')): ?>
                <div class="alert alert-danger">
                    <?= $this->session->flashdata('login_error'); ?>
                </div>
            <?php endif; ?>
            <form method="post" action="<?= base_url('auth_process') ?>">
                <div class="form-group">
                    <i class="fas fa-user"></i>
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <!-- Tambahkan reCAPTCHA di sini -->
                <div class="form-group">
                    <div class="g-recaptcha" data-sitekey="6Lfmr1QqAAAAAItR09VdYM9Pz8cAjUHRYSFkl9oo"></div>
                </div>
                <button type="submit" class="login-btn btn btn-primary btn-block">Login</button>
            </form>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>
