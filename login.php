<?php
    include 'db.php';
    $showAlert=false;
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $username=$_POST['username'];
        $password=$_POST['password'];
        if(empty($username) || empty($password) ){
            $showAlert=true;
            $errormsg="Credentials cannot be empty.";
        }
        $sql="SELECT * FROM admin WHERE username='$username' LIMIT 1";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)==1){
            $row=mysqli_fetch_assoc($result);
            $isvalid_password=password_verify($password,$row['password']);
            if($isvalid_password){
                session_start();
                $_SESSION['loggedin']=true;
                if($row['gender']==='female'){
                    $_SESSION['username']='Ms. '.$username;
                }
                else{
                    $_SESSION['username']='Mr. '.$username;
                }
                header("Location:admin/index.php");
            }
            else{
                $showAlert=true;
                $errormsg="Invalid Credentials.";
            }
        }
        else{
            $showAlert=true;
            $errormsg="Invalid Credentials.";
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN - E-LIBRARY MANAGEMENT</title>
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
            background: url('./images/background.jpg');
            background-attachment: fixed;
            background-size: cover;
        }
    </style>
</head>
<body >

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php" style='color: #BBBE64; white-space:wrap'>E-LIB MANAGE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="home.php">Home</a>
                </li>
            </ul>
            <div>
                <a class="nav-link text-secondary link-active" href="login.php">Login</a>
            </div>
            </div>
        </div>
    </nav>
    
    <main class="py-3">
        <div class="alertbox" style='min-height: 60px;'>
            <?php
                // TODO: SHOW ALERT ONLY WHEN ERROR IS THERE
                if($showAlert){
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Error!! </strong>'.$errormsg
                        .'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
            ?>
        </div>
        <div class="container">
            <form class='container bg-dark text-light p-4 rounded' data-bs-theme="dark" action="<?php echo $_SERVER['PHP_SELF']; ?>" method='POST' autocomplete="on">
                <h1 class='text-center'>
                    <span class='text-primary'>WELCOME BACK TO </span>
                    <span style="white-space: nowrap">E-LIB MANAGE</span>
                </h1>
                <h4 class='text-center'>
                    <span class="text-secondary">PLEASE LOGIN TO CONTINUE</span>
                </h4>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" aria-describedby="usernamehelp" name="username" autocomplete="on">
                    <div id="usernamehelp" class="form-text">We'll never share your username with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" autocomplete="on">
                    <div id="usernamehelp" class="form-text">
                        <button type="button" class="bg-transparent text-secondary p-0" style=" border: none; outline: none;" id="showPass">Show password</button>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Login</button>
            </form>
        </div>
        <div style='min-height: 40px;'> </div>
    </main>

    <script>
        const showPassButton=document.getElementById("showPass");
        showPassButton.addEventListener("click",()=>{
        const passInput=document.getElementById("password");
            if(showPassButton.innerText==='Show password'){
                passInput.type='text';
                showPassButton.innerText='Hide password'
            }
            else{
                passInput.type='password';
                showPassButton.innerText='Show password'
            }
        })
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>