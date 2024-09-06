<?php
    session_start();
    if(!$_SESSION['loggedin']){
        header("location:../login.php");
    }

    // $showSuccessAlert=false;
    // $showErrorAlert=false;

    include 'functions.php';
    if(isset($_GET['page'])){
        if($_GET['page']==='home'){
            $dashboard_info=getDashboardInfo();
        }
        else if($_GET['page']==='all-books'){
            $all_books=getAllBooks();
        }
        else if($_GET['page']==='issued-books'){
            $issued_books=getIssuedBooks();
        }
    }
    else{
        $dashboard_info=getDashboardInfo();
    }
    // print_r($dashboard_info);

    if(isset($_POST['delete'])){
        $book_id=$_POST['book_id'];
        $result=deleteBook($book_id);
        if($result){
            $_SESSION['showSuccessAlert']=true;
            $_SESSION['successmsg']="Book Deleted Successfully";
        }
        else{
            $_SESSION['showErrorAlert']=true;
            $_SESSION['errormsg']="Error Deleting Book";
        }
        header("Location: /library-management-system/admin/index.php?page=all-books");
        exit();
    }
    if(isset($_POST['returned'])){
        $book_id=$_POST['book_id'];
        $transaction_id=$_POST['transaction_id'];
        $result=markReturned($transaction_id,$book_id);
        if($result){
            $_SESSION['showSuccessAlert']=true;
            $_SESSION['successmsg']="Book Returned Successfully";
        }
        else{
            $_SESSION['showErrorAlert']=true;
            $_SESSION['errormsg']="Error Marking Book as Returned";
        }
        header("Location: /library-management-system/admin/index.php?page=issued-books");
        exit();
    }
    
    if(isset($_POST['lost'])){
        $book_id=$_POST['book_id'];
        $transaction_id=$_POST['transaction_id'];
        $result=markLost($transaction_id,$book_id);
        if($result){
            $_SESSION['showSuccessAlert']=true;
            $_SESSION['successmsg']="Book Marked as Lost Successfully";
        }
        else{
            $_SESSION['showErrorAlert']=true;
            $_SESSION['errormsg']="Error Marking Book as Lost";
        }
        header("Location: /library-management-system/admin/index.php?page=issued-books");
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
        table th {
            text-wrap: nowrap !important;
        }
        table th:not(:nth-child(1)) {
            min-width: 150px !important;
        }
    </style>
</head>
<body>
    <?php
        include '_navbar.php';
    ?>
    <main>
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
                    ;
                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    unset($_SESSION['showSuccessAlert']);
                    unset($_SESSION['successmsg']);
                }
            ?>
        </div>
        <?php
            if(isset($_GET['page'])){
                if($_GET['page']==='home'){
                    include 'home.php';
                }
                else if($_GET['page']==='all-books'){
                    include 'all-books.php';
                }
                else if($_GET['page']==='issued-books'){
                    include 'issued-books.php';
                }
            }
            else{
                include 'home.php';
            }
        ?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>