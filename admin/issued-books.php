<div class="container">
<div class="d-flex justify-content-between">
    <h2 class="text-center mb-0">Issued Books</h2>
</div>

<hr class="border border-success border-1 opacity-50">

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/library-management-system/admin/index.php?page=all-books">Books</a></li>
    <li class="breadcrumb-item active" aria-current="page">Issued Books</li>
  </ol>
</nav>

<?php
    if(count($issued_books)==0){
        echo "<h3 class='text-center'>No Books Found</h3>";
    }
    else{
?>
<div class="table-responsive">
    <table class="table table-hover table-success table-striped">
        <thead class="table-dark">
            <tr>
                <th scope="col">S.NO</th>
                <th scope="col">Book Name</th>
                <th scope="col">Borrower Name</th>
                <th scope="col">Issued Date</th>
                <th scope="col">Due Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i=1;
                foreach($issued_books as $book){   
            ?>
            <tr>
                <th scope="row"><?php echo $i; $i++; ?></th>
                <?php
                    $book_info=getBookInfo($book['book_id']);
                ?>
                <td><?php echo $book_info['title']; ?></td>
                <?php
                    $borrower_info=getBorrowerInfo($book['borrower_id']);
                ?>
                <td><?php echo $borrower_info['name']; ?></td>
                <td><?php echo $book['transaction_date']; ?></td>
                <td><?php echo $book['due_date']; ?></td>
                <td class="d-flex flex-wrap gap-2">
                    <form action="<?php echo $_SERVER['PHP_SELF'].'?page=issued-books'?>" method="post">
                        <input type="text" name="transaction_id" value="<?php echo $book['transaction_id'];?>" style="display: none;">
                        <input type="text" name="book_id" value="<?php echo $book_info['book_id'];?>" style="display: none;">
                        <button type='submit' name="returned" class="btn btn-primary">Mark as Returned</button>
                        <button type='submit' name="lost" class="btn btn-danger">Mark as Lost</button>
                    </form>
                </td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</div>
<?php
    }
?>
</div>