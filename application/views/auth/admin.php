<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Inline CSS */
        body {
            background: url('https://images.unsplash.com/photo-1515847049296-a281d6401047?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') no-repeat center center fixed;
            background-size: cover;
           
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            padding: 20px;
            position: relative;
            animation: fadeIn 1s ease-in-out, colorChange 3s ease-in-out infinite;
            transform: scale(0.95);
            transition: transform 0.3s ease;
        }

        .login-card:hover {
            transform: scale(1);
        }

        .login-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #3498db, #2ecc71);
            opacity: 0.1;
            border-radius: 15px;
            z-index: -1;
            animation: pulse 2s infinite;
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

        @keyframes pulse {
            0% {
                opacity: 0.1;
            }
            50% {
                opacity: 0.3;
            }
            100% {
                opacity: 0.1;
            }
        }

        @keyframes colorChange {
            0% {
                background-color: #ffffff;
            }
            50% {
                background-color: #f9f9f9;
            }
            100% {
                background-color: #ffffff;
            }
        }

        .btn-primary {
            background-color: #3498db;
            border: none;
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .alert {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6 col-lg-4">
                <div class="login-card">
                    <h2 class="text-center mb-4">Admin Login</h2>
                    <?php if ($this->session->flashdata('login_error')): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $this->session->flashdata('login_error'); ?>
                        </div>
                    <?php endif; ?>
                    <form method="post" action="<?= base_url('Auth/admin_auth_process'); ?>">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
