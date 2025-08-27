    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            background: #fff;
            margin: 0;
            color: #222;
        }
        .header {
            background: linear-gradient(to right, #8971ea, #7f72ea, #7574ea, #6a75e9, #5f76e8);
            color: #fff;
            padding: 0 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 72px;
            box-shadow: 0 2px 8px rgba(10,35,66,0.05);
        }
        .header .logo {
            display: flex;
            align-items: center;
        }
        .header .logo img {
            height: 40px;
            margin-right: 12px;
            border-radius: 20px;
        }
        .header nav {
            display: flex;
            gap: 32px;
            align-items: center;
        }
        .header nav a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            font-size: 16px;
            transition: color 0.2s;
        }
        .header nav a:hover {
            color: #6789s;
        }
        .btn-customf {
            background: linear-gradient(to right, #8971ea, #7f72ea, #7574ea, #6a75e9, #5f76e8);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(10,35,66,0.08);
            transition: background 0.2s;
        }
    </style>
    <header class="header">
        <div class="logo">
            <img src="/hostel/assets/images/logo-icon-nav.png" alt="PTI Hostel Logo">
            <span style="font-size:1.5rem;font-weight:700;letter-spacing:1px;">PTI Hostel Allocation</span>
        </div>
        <nav>
            <a href="/hostel/index.php#features">Features</a>
            <a href="/hostel/index.php#about">About</a>
            <a href="/hostel/index.php#contact">Contact</a>
            <a href="/hostel/admin/index.php">Admin</a>
            <a href="/hostel/login.php" class="cta-btn" style="background:#fff;color:#000;padding:8px 18px;border-radius:8px;font-size:1rem;">Login</a>
        </nav>
    </header>
