<div class="container">
<div class="d-flex justify-content-between">
    <h2 class="text-center mb-0">All Books</h2>
    <a href="add-book.php" class="btn btn-primary">Add Book</a>
</div>

<hr class="border border-success border-1 opacity-50">

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/library-management-system/admin/index.php?page=all-books">Books</a></li>
    <li class="breadcrumb-item active" aria-current="page">All Books</li>
  </ol>
</nav>

<?php
    if(count($all_books)==0){
        echo "<h3 class='text-center'>No Books Found</h3>";
    }
    else{
?>
<div class="table-responsive">
    <table class="table table-hover table-info table-striped">
        <thead class="table-dark">
            <tr>
                <th scope="col">S.NO</th>
                <th scope="col">Book Name</th>
                <th scope="col">Author</th>
                <th scope="col">Category</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count=1;
                foreach($all_books as $book){   
            ?>
            <tr>
                <th scope="row"><?php echo $count; $count++; ?></th>
                <td><?php echo $book['title']; ?></td>
                <td><?php echo $book['author']; ?></td>
                <td><?php echo $book['genre']; ?></td>
                <td><?php echo $book['status']; ?></td>
                <td class="d-flex flex-wrap gap-2">
                    <?php
                        if($book['status']=='available'){
                            ?>
                    <a href="edit-book.php?book_id=<?php echo $book['book_id']?>" class="btn btn-primary">Edit</a>
                    <a href="issue-book.php?book_id=<?php echo $book['book_id']?>" class="btn btn-success">Issue</a>
                    <form action="<?php echo $_SERVER['PHP_SELF'].'?page=all-books'?>" method="post">
                    <input type="text" name="book_id" value="<?php echo $book['book_id'];?>" style="display: none;">
                        <button type='submit' name="delete" class="btn btn-danger">Delete</button>
                    </form>
                    <?php
                        }
                        else{
                    ?>
                        No actions available
                    <?php
                        }
                    ?>
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