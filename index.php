<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PTI Hostel Allocation Management System</title>
    <link rel="icon" type="image/png" href="assets/images/favicon.png">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            color: #43e97b;
        }
        .hero {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 80px 24px 40px 24px;
            background: #fff;
        }
        .hero h1 {
            font-size: 2.8rem;
            font-weight: 700;
            /* color: #5f76e8; */
            margin-bottom: 18px;
        }
        .hero p {
            font-size: 1.25rem;
            color: #444;
            margin-bottom: 32px;
            max-width: 600px;
            text-align: center;
        }
        .hero .cta-btn {
            background: linear-gradient(to right, #8971ea, #7f72ea, #7574ea, #6a75e9, #5f76e8);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 14px 36px;
            font-size: 1.1rem;
            font-weight: 500;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(10,35,66,0.08);
            transition: background 0.2s;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .hero .cta-btn:hover {
            background: #5f76e8;
        }
        .features {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 32px;
            margin: 60px 0 40px 0;
        }
        .feature-card {
            background: #f7f9fc;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(10,35,66,0.06);
            padding: 32px 24px;
            width: 320px;
            text-align: center;
            transition: box-shadow 0.2s;
        }
        .feature-card:hover {
            box-shadow: 0 4px 16px rgba(10,35,66,0.12);
        }
        .feature-card i {
            font-size: 2.5rem;
            color: #5f76e8;
            margin-bottom: 16px;
        }
        .feature-card h3 {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 12px;
            color: #5f76e8;
        }
        .feature-card p {
            color: #444;
            font-size: 1rem;
        }
        .footer {
            background: linear-gradient(to right, #8971ea, #7f72ea, #7574ea, #6a75e9, #5f76e8);
            color: #fff;
            text-align: center;
            padding: 32px 16px 16px 16px;
            margin-top: 60px;
        }
        .footer .footer-links {
            margin-bottom: 12px;
        }
        .footer .footer-links a {
            color: #fff;
            margin: 0 12px;
            text-decoration: none;
            font-weight: 500;
            font-size: 15px;
            transition: color 0.2s;
        }
        .footer .footer-links a:hover {
            color: #43e97b;
        }
        @media (max-width: 900px) {
            .features {
                flex-direction: column;
                align-items: center;
            }
            .feature-card {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <?php include('includes/header.php');?>
    <section class="hero">
        <h1>Welcome to PTI Hostel Allocation Management System</h1>
        <p>Effortlessly manage hostel bookings, allocations, and payments for PTI students. Fast, secure, and easy to use for both students and administrators.</p>
        <button class="cta-btn" onclick="window.location.href='login.php'">
            <i class="fas fa-sign-in-alt"></i> Get Started
        </button>
    </section>
    <section class="features" id="features">
        <div class="feature-card">
            <i class="fas fa-bed"></i>
            <h3>Flexible Room Allocation</h3>
            <p>Flexible and fair room assignment based on preferences and availability.</p>
        </div>
        <div class="feature-card">
            <i class="fas fa-credit-card"></i>
            <h3>Online Payments</h3>
            <p>Secure Remita payment integration for hassle-free hostel fee transactions.</p>
        </div>
        <div class="feature-card">
            <i class="fas fa-user-shield"></i>
            <h3>Admin Dashboard</h3>
            <p>Powerful tools for administrators to manage students, rooms, and reports.</p>
        </div>
        <div class="feature-card">
            <i class="fas fa-mobile-alt"></i>
            <h3>Mobile Friendly</h3>
            <p>Responsive design for seamless access on any device, anywhere.</p>
        </div>
    </section>
    <?php include('includes/footer-2.php');?>
</body>
</html>
