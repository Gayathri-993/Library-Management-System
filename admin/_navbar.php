<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/library-management-system/admin/index.php?page=home" style='color: #BBBE64; white-space:wrap'>E-LIB MANAGE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link <?php if(!isset($_GET['page']) || $_GET['page']==='home') echo "link-active"; ?>" aria-current="page" href="/library-management-system/admin/index.php?page=home">Dashboard</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?php if(isset($_GET['page'])&&$_GET['page']!='home' && $_GET['page']!='settings') echo "link-active"; ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Books
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/library-management-system/admin/index.php?page=all-books">All Books</a></li>
                    <li><a class="dropdown-item" href="add-book.php">Add Book</a></li>
                    <li><a class="dropdown-item" href="/library-management-system/admin/index.php?page=issued-books">Issued Books</a></li>
                </ul>
            </li>
        </ul>
        <div class='d-flex align-items-center'>
            <p class="admin-name m-0 me-4 text-light">Logged in as : <?php echo $_SESSION['username']; ?></p>
            <button type="button" class="btn btn-outline-success"><a class="nav-link" href="logout.php">Logout</a></button>
        </div>
        </div>
    </div>
</nav>