<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Contact Us - Golden Sands Hotel Booking Services</title>
    <style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f4f1ed;
        margin: 0;
        padding: 0;
        color: #2c3e50;
    }

    header {
        background-color: #2c3e50;
        color: #f4e3c1;
        padding: 30px 0;
        text-align: center;
    }

    header h1 {
        font-size: 34px;
        margin-bottom: 10px;
    }

    .container {
        max-width: 1100px;
        margin: auto;
        padding: 40px 20px;
    }

    .section-title {
        text-align: center;
        font-size: 28px;
        margin-bottom: 40px;
        color: #a67c52;
    }

    .contact-wrapper {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
    }

    .contact-info {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .contact-info h2 {
        font-size: 22px;
        margin-bottom: 20px;
        color: #a67c52;
    }

    .contact-info p {
        margin-bottom: 15px;
        font-size: 16px;
    }

    .contact-info strong {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .contact-form{
        padding-right: 70px;
    }

    form {
        background-color: #ffffff;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    form input,
    form textarea {
        width: 100%;
        padding: 12px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 16px;
    }

    form button {
        background-color: #a67c52;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
    }

    form button:hover {
        background-color: #916846;
    }

    footer {
        background-color: #2c3e50;
        color: #ddd;
        text-align: center;
        padding: 20px;
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
        .contact-wrapper {
          grid-template-columns: 1fr;
        }
    }
    </style>
</head>
<body>

    <header>
        <h1>Contact Golden Sands</h1>
        <p>We'd love to hear from you</p>
    </header>

    <div class="container">
        <h2 class="section-title">Get In Touch</h2>
        <div class="contact-wrapper">
            <!-- Contact Info -->
            <div class="contact-info">

                <h2>Contact Details</h2>

                <p><strong>Address:</strong>Golden Sands HQ, Seaside Road, Beach City, CA 90210</p>

                <p><strong>Phone:</strong>+1 (800) 123-4567</p>

                <p><strong>Email:</strong>support@goldensandshotels.com</p>

                <p><strong>Working Hours:</strong>Mon – Fri: 9am – 6pm</p>

            </div>

            <!-- Contact Form -->
            <form class="contact-form">
                <input type="text"placeholder="Your Name" required />
                <input type="email" placeholder="Your Email" required />
                <input type="text" placeholder="Subject" />
                <textarea rows="6" placeholder="Your Message" required></textarea>
                <button type="submit">Send Message</button>
            </form>
        </div>
    </div>

      
    <footer>
        <p>© 2025 Golden Sands Hotel Booking Services. All rights reserved.</p>
        <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
    </footer>

</body>
</html>
