<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Golden Sands Hotel Booking Services</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            line-height: 1.6;
            background-color: #f4f1ed;
            color: #2c3e50;
        }

        header {
            background-color: #2c3e50;
            color: #f4e3c1;
            padding: 30px 0;
            text-align: center;
        }

        header h1 {
            font-size: 36px;
            font-weight: bold;
        }

        header p {
            font-size: 18px;
            margin-top: 5px;
        }

        .container {
            width: 90%;
            max-width: 1100px;
            margin: 0 auto;
            padding: 40px 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 40px;
            font-size: 30px;
            font-weight: bold;
            color: #a67c52;
        }

        .content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 60px;
        }

        .content img {
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.08);
        }

        .text {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .text h2 {
            font-size: 24px;
            color: #a67c52;
            margin-bottom: 10px;
        }

        .text p {
            font-size: 17px;
            margin-bottom: 14px;
            color: #555;
        }

        footer {
            background-color: #2c3e50;
            color: #ddd;
            padding: 20px;
            text-align: center;
            font-size: 14px;
        }

        footer a {
            color: #f4e3c1;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .content {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <header>
        <h1>Golden Sands Hotel Booking Services</h1>
        <p>Your Journey Starts Here</p>
    </header>

    <div class="container">
        <section>
            <h2 class="section-title">About Us</h2>
            <div class="content">
                <div class="text">
                    <h2>Our Story</h2>
                    <p>Founded with a passion for travel and hospitality, Golden Sands was established to offer a platform where guests can easily find the perfect accommodation for their needs. We partner with top-rated hotels to ensure our guests enjoy luxury, affordability, and reliability.</p>

                    <h2>What We Offer</h2>
                    <p><strong>Wide Range of Hotels:</strong> From cozy budget stays to stunning luxury resorts.</p>
                    <p><strong>Exclusive Deals:</strong> Enjoy special offers curated just for you.</p>
                    <p><strong>Simple Booking:</strong> Reserve your stay in minutes, anytime, anywhere.</p>
                    <p><strong>Reliable Support:</strong> Our team is here to guide you every step of the way.</p>
                </div>
            </div>
        </section>

        <section>
            <h2 class="section-title">Our Values</h2>
            <div class="content">
                <div class="text">
                    <h2>Why Choose Us?</h2>
                    <p><strong>Trust & Transparency:</strong> Clear pricing with no hidden fees.</p>
                    <p><strong>Quality Assurance:</strong> Only verified, top-rated hotels are featured.</p>
                    <p><strong>Customer First:</strong> We value your satisfaction above all else.</p>
                    <p><strong>Global Reach:</strong> Discover stays in both local gems and international hotspots.</p>
                </div>
            </div>
        </section>
    </div>

    <footer>
        <p>© 2025 Golden Sands Hotel Booking Services. All rights reserved.</p>
        <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
    </footer>

</body>
</html>
