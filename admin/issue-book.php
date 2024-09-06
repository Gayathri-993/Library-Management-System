<?php
    include '../db.php';
    session_start();
    if(!$_SESSION['loggedin']){
        header("location:../login.php");
    }

    include 'functions.php';
    $book_id=$_GET['book_id'];
    $book_info=getBookInfo($book_id);

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $bname=mysqli_real_escape_string($conn,$_POST['bname']);
        $bemail=mysqli_real_escape_string($conn,$_POST['bemail']);
        $bphone=mysqli_real_escape_string($conn,$_POST['bphone']);
        $duedate=mysqli_real_escape_string($conn,$_POST['duedate']);
        if(empty($bname) || empty($bemail) || empty($bphone) || empty($duedate)){
            $_SESSION['showErrorAlert']=true;
            $_SESSION['errormsg']="Some Fields are missing.";
        }
        else{
            $query="SELECT * FROM `borrowers` WHERE email='$bemail'";
            $result=mysqli_query($conn,$query);
            if(!$result){
                die("Query Failed");
            }
            else{
                $row=mysqli_fetch_assoc($result);
                if($row){
                    $borrower_id=$row['borrower_id'];
                }
                else{
                    $sql="INSERT INTO `borrowers`(`name`, `email`, `phone`) VALUES ('$bname','$bemail','$bphone')";
                    $result=mysqli_query($conn,$sql);
                    if($result){
                        $borrower_id=mysqli_insert_id($conn);
                    }
                    else{
                        $_SESSION['showErrorAlert']=true;
                        $_SESSION['errormsg']="Cannot Update Book. Please try again later.";
                        exit();
                    }
                }
            }
            $sql="INSERT INTO `booktransactions`(book_id,borrower_id,transaction_type,due_date) VALUES ('$book_id','$borrower_id','checkout','$duedate')";
            $result=mysqli_query($conn,$sql);
            $sql="UPDATE `books` SET status='checkedout' WHERE book_id='$book_id'";
            $result1=mysqli_query($conn,$sql);
            if($result && $result1){
                $_SESSION['showSuccessAlert']=true;
                $_SESSION['successmsg']="Book Issued Successfully.";
            }
            else{
                $_SESSION['showErrorAlert']=true;
                $_SESSION['errormsg']="Cannot Issue Book. Please try again later.";
            }
        }
        header("Location: /library-management-system/admin/issue-book.php?book_id=".$book_id);
        exit();
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-LIBRARY MANAGEMENT</title>
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
    </style>
</head>
<body >
    <?php
        include '_navbar.php';  
    ?>
    
    <main class="mb-2">
        <div class="alertbox mb-1" style='min-height: 60px;'>
        <?php
                // TODO: SHOW ALERT ONLY WHEN ERROR IS THERE
                if(isset($_SESSION['showErrorAlert'])){
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Error!! </strong>';
                        if(isset($_SESSION['errormsg'])){
                            echo $_SESSION['errormsg'];
                        }
                        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    unset($_SESSION['showErrorAlert']);
                    unset($_SESSION['errormsg']);
                }
                if(isset($_SESSION['showSuccessAlert'])){
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!! </strong>';
                    if(isset($_SESSION['successmsg'])){
                        echo $_SESSION['successmsg'];

                    }
                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    unset($_SESSION['showSuccessAlert']);
                    unset($_SESSION['successmsg']);
                }
            ?>
        </div>
        <div class="container">
            <h2 class=" mb-0">Issue Book</h2>
            <hr class="border border-success border-1 opacity-50">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/library-management-system/admin/index.php?page=all-books">Books</a></li>
                    <li class="breadcrumb-item"><a href="/library-management-system/admin/index.php?page=all-books">All Books</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Issue Book</li>
                </ol>
            </nav>
            <form action="<?php echo $_SERVER['PHP_SELF'].'?book_id='.$book_id; ?>" method='POST' autocomplete="on">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control border-1 border-dark" id="title" value='<?php echo $book_info['title']; ?>' name="title" autocomplete="on" required readonly>
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Author</label>
                    <input type="text" class="form-control border-1 border-dark" id="author" value='<?php echo $book_info['author']; ?>' name="author" autocomplete="on" required readonly>    
                </div>
                <div class="mb-3">
                    <label for="bname" class="form-label">Borrower Name</label>
                    <input type="text" class="form-control border-1 border-dark" id="bname" name="bname" autocomplete="on" required>    
                </div>
                <div class="mb-3">
                    <label for="bemail" class="form-label">Borrower Email</label>
                    <input type="email" class="form-control border-1 border-dark" id="bemail" name="bemail" autocomplete="on" required>    
                </div>
                
                <div class="mb-3">
                    <label for="bphone" class="form-label">Borrower Phone Number</label>
                    <input type="tel" class="form-control border-1 border-dark" id="bphone" name="bphone" autocomplete="on" required>    
                </div>
                <div class="mb-3">
                    <label for="duedate" class="form-label">Due Date</label>
                    <input type="date" class="form-control border-1 border-dark" id="duedate" name="duedate" autocomplete="on" required>    
                </div>
                <button type="submit" class="btn btn-success">Issue Book</button>
            </form>
        </div>
    </main>

    <script>
        (function () {
            const link_highlight = document.querySelectorAll('.nav-link');
            link_highlight.forEach((link) => {
                link.classList.remove('link-active');
            });
            link_highlight[1].classList.add('link-active');
        })();
        const year=new Date().getFullYear();
        let month=new Date().getMonth()+1;
        if(month<10){
            month="0"+month;
        }
        let date=new Date().getDate()+2;
        if(date<10){
            date="0"+date;
        }
        document.getElementById("duedate").min = year+"-"+month+"-"+date;
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>