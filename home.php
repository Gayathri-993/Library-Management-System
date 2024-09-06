<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME - E-LIBRARY MANAGEMENT</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        *{
            font-family: "Poppins", sans-serif;
        }
        .link-active{
            color: white !important;
        }
        main{
            padding: 20px 30px;
        }
        section{
            margin-bottom: 20px;
            text-align: justify;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php" style='color: #BBBE64; white-space:wrap;'>E-LIB MANAGE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link link-active" aria-current="page" href="home.php">Home</a>
                </li>
            </ul>
            <div>
                <a class="nav-link text-secondary" href="login.php">Login</a>
            </div>
            </div>
        </div>
    </nav>
    <main style="background-color: #f1f3f6">
        <section class="banner-image shadow">
            <center><img class="rounded " src="images/banner.jpg" alt="Library Image Banner" width="100%"></center>
        </section>

        <section>
            <h2>Welcome to E-LIB MANAGE</h2>
            <p>
            E-LIB MANAGE is your comprehensive solution for efficient book management and record keeping. Designed specifically for library incharges, our platform streamlines the process of issuing books and maintaining accurate records, allowing you to focus on providing the best service to your library patrons.
            </p>
        </section>
        <section>
            <h2>Effortless Book Management</h2>
            <p>
            With E-LIB MANAGE, you can easily manage the entire lifecycle of books in your library. From cataloging new acquisitions to tracking loan status and managing returns, our platform simplifies every aspect of book management.
            </p>
        </section>
        <section>
            <h2>Streamlined Record Keeping</h2>
            <p>
            Say goodbye to cumbersome paperwork and manual record keeping. E-LIB MANAGE automates the process of maintaining detailed records of book transactions, ensuring accuracy and efficiency in your library operations.
            </p>
        </section>
        <section>
            <h2>Customizable Settings</h2>
            <p>
            Tailor E-LIB MANAGE to suit the specific needs of your library. Customize settings, define lending policies, and generate detailed reports to gain insights into book circulation and usage patterns.
            </p>
        </section>
        <section>
            <h2>User-Friendly Interface</h2>
            <p>
            Our intuitive interface makes it easy for library incharges to navigate and utilize all the features of E-LIB MANAGE. Spend less time managing administrative tasks and more time engaging with your library community.
            </p>
        </section>
        <section>
            <h2>Secure and Reliable</h2>
            <p>
            Rest assured knowing that your library data is secure and backed up. E-LIB MANAGE employs robust security measures to safeguard sensitive information and ensure uninterrupted access to your library records.
            </p>
        </section>
    </main>
    
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>