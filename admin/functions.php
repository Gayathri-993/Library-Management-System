<?php
include '../db.php';
function check_login(){
    session_start();
    if(!$_SESSION['loggedin']){
        header("location:../login.php");
    }
}
function getDashboardInfo(){
    include '../db.php';
    $query = "SELECT * FROM books";
    $result=mysqli_query($conn,$query);
    $total_books=0;
    $available_books=0;
    $issued=0;
    $lost=0;
    $return_expired=0;
    if(!$result){
        die("Query Failed");
    }
    else{
        $total_books = mysqli_num_rows($result);
        if($total_books==0){
            $total_books = 0;
        }
        else{
            while($row = mysqli_fetch_assoc($result)){
                if($row['status']=='available'){
                    $available_books++;
                }
                else if($row['status']=='checkedout'){
                    $issued++;
                }
                else if($row['status']=='lost'){
                    $lost++;
                }

            }
            
        }
    }
    $query = "SELECT * FROM booktransactions";
    $result=mysqli_query($conn,$query);
    if(!$result){
        die("Query Failed");
    }
    else{
        while($row = mysqli_fetch_assoc($result)){
            if($row['due_date']<date('Y-m-d')&& $row['transaction_type']=='checkout'){
                $return_expired++;
            }
        }
    }
    return array($total_books, $available_books, $issued,$lost,$return_expired);
}

function getAllBooks(){
    include '../db.php';
    $query = "SELECT * FROM books";
    $result=mysqli_query($conn,$query);
    if(!$result){
        die("Query Failed");
    }
    else{
        $books = array();
        while($row = mysqli_fetch_assoc($result)){
            $row['status']=='checkedout'?$row['status']='Issued':$row['status']=$row['status'];
            array_push($books,$row);
        }
        return $books;
    }
}

function getIssuedBooks(){
    include '../db.php';
    $query = "SELECT * FROM booktransactions WHERE transaction_type='checkout'";
    $result=mysqli_query($conn,$query);
    if(!$result){
        die("Query Failed");
    }
    else{
        $books = array();
        while($row = mysqli_fetch_assoc($result)){
            $row['transaction_type']='Issued';
            array_push($books,$row);
        }
        return $books;
    }
}

function getBookInfo($book_id){
    include '../db.php';
    $query = "SELECT * FROM books WHERE book_id='$book_id'";
    $result=mysqli_query($conn,$query);
    if(!$result){
        die("Query Failed");
    }
    else{
        $book = mysqli_fetch_assoc($result);
        return $book;
    }
}

function getBorrowerInfo($borrower_id){
    include '../db.php';
    $query = "SELECT * FROM borrowers WHERE borrower_id='$borrower_id'";
    $result=mysqli_query($conn,$query);
    if(!$result){
        die("Query Failed");
    }
    else{
        $borrower = mysqli_fetch_assoc($result);
        return $borrower;
    }
}


function deleteBook($book_id){
    include '../db.php';
    $query = "DELETE FROM books WHERE book_id='$book_id'";
    $result=mysqli_query($conn,$query);
    if(!$result){
        return false;
    }
    else{
        return true;
    }
}

function markReturned($transaction_id,$book_id){
    include '../db.php';
    $query = "DELETE FROM booktransactions WHERE transaction_id='$transaction_id'"; 
    $result=mysqli_query($conn,$query);
    $query = "UPDATE books SET status='available' WHERE book_id='$book_id'";
    $result1=mysqli_query($conn,$query);
    if(!$result || !$result1){
        return false;
    }
    else{
        return true;
    }
}

function markLost($transaction_id,$book_id){
    include '../db.php';
    $query = "UPDATE booktransactions SET transaction_type='lost' WHERE transaction_id='$transaction_id'";
    $result=mysqli_query($conn,$query);
    $query = "UPDATE books SET status='lost' WHERE book_id='$book_id'";
    $result1=mysqli_query($conn,$query);
    if(!$result || !$result1){
        return false;
    }
    else{
        return true;
    }
}
?>