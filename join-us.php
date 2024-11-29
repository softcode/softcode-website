<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Softcode - Join Us</title>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/script.js"></script>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="container">
        <header class="header">
            <div class="top-area">
                <a href="index.html" class="logo"><img src="images/softcode-logo.png" alt=""></a>
                <div class="menu-icon" id="menu-icon"></div>
                <ul class="menu">
                    <li><a href="about-us.html">About us</a></li>
                    <li><a href="services.html">Services</a></li>
                    <li><a href="cases.html">Cases</a></li>
                    <li class="active"><a href="join-us.php">Join us</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </div>
        </header>
        <nav class="mobile-menu" id="mobile-menu">
            <ul>
                <li><a href="about-us.html">About us</a></li>
                <li><a href="services.html">Services</a></li>
                <li><a href="cases.html">Cases</a></li>
                <li><a href="join-us.php">Join us</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </nav>
        <div class="overlay" id="overlay"></div>
        <main>
            <div class="content-area">
                <h2>Join Us</h2>
                <p>We are always looking for like-minded, passionate and talented people that make the difference.</p>
                <img src="images/join-us-banner.jpg" alt="">
            </div>
            <div class="bottom-box">
                <div class="left-area">
                    <h3>Open positions</h3>
                    <p>Currently there are no open positions announced, but please don’t hesitate to send a spontaneous application via the form below.</p>
                </div>
            </div>            
        </main>
    </div>
    <div class="black-box">
        <div class="container">
            <h2 class="bottom-title"><strong>Spontaneous application</strong>
                Are you passionate about making the difference?<br />
                Say hello!
            </h2>
            <div class="message-area">
                <?php
                if (isset($_GET['message'])) {
                    echo "<p style='color: green;'>" . htmlspecialchars($_GET['message']) . "</p>";
                }
                if (isset($_GET['error'])) {
                    echo "<p style='color: red;'>" . htmlspecialchars($_GET['error']) . "</p>";
                }
                ?>
            </div>
            <div class="form-area">
                <div class="form-container">
                    <form action="submit_form.php" method="POST" enctype="multipart/form-data">
                        <div class="form-grid">
                            <div>
                                <input type="text" id="first_name" name="first_name" placeholder="First name" required>
                            </div>
                            <div>
                                <input type="text" id="last_name" name="last_name" placeholder="Last name" required>
                            </div>
                            <div>                  
                                <input type="email" id="email" name="email" placeholder="Email" required>
                            </div>
                            <div>
                                <input type="text" id="phone" placeholder="Phone" name="phone">
                            </div>
                            <div>
                                <input type="text" id="country" name="country" placeholder="Country" required>
                            </div>            
                            <div>
                                <input type="text" id="city" placeholder="City" name="city">
                            </div>
                            <div>
                                <label for="file-upload" class="custom-file-upload">
                                    Attach resume
                                </label>
                                <input type="file" id="file-upload" name="resume" accept=".pdf,.doc,.docx" />
                                <span class="file-name" id="file-name"></span>
                            </div>
                            <div>
                                <input type="url" id="linkedin" placeholder="LinkedIn profile link" name="linkedin">
                            </div>
                            <div class="full-width">
                                <textarea id="additional_info" name="additional_info" rows="5" placeholder="Additional information"></textarea>
                            </div>
                            <button class="arrow-button" type="submit">Submit</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="bottom-container">
            <div class="address">
                Softcode<br />
                Älvgatan 5 B, 652 25 Karlstad<br />
                <a href="mailto:contact@softcode.se">contact@softcode.se</a><br />
                <a href="tel:+46(0)54150600">+46 (0) 54 150 600</a>
            </div>
            <div class="footer-menu">
                <ul>
                    <li><a href="about-us.html">About us</a></li>
                    <li><a href="services.html">Services</a></li>
                    <li><a href="cases.html">Cases</a></li>
                    <li><a href="join-us.php">Join us</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </div>
            <div class="copyright">
                <p>Softcode i Sverige AB © 2024 All rights reserved</p>
            </div>
        </div>
    </footer>
</body>
</html>