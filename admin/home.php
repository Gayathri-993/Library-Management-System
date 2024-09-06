<div class="container">
<h2 class="text-center">Welcome Back <span class="text-nowrap"><?php echo $_SESSION['username']; ?></span></h2>

<hr class="border border-success border-1 opacity-50">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
  </ol>
</nav>
<div class="row m-4" style="gap:20px;">
    <div class="card border border-dark border-2 col-sm-5 col-md-3 col-lg-2 p-0 ">
        <div class="card-header bg-primary text-center text-light">ALL</div>
        <div class="card-body bg-secondary">
            <div class="card-title text-center text-light"><?php echo $dashboard_info[0]?></div>
        </div>
    </div>
    <div class="card border-dark border-2 col-sm-5 col-md-3 col-lg-2 p-0 ">
        <div class="card-header bg-dark text-light text-center">AVAILABLE</div>
        <div class="card-body bg-secondary">
            <div class="card-title text-center text-light"><?php echo $dashboard_info[1]?></div>
        </div>
    </div>
    <div class="card border-dark border-2 col-sm-5 col-md-3 col-lg-2 p-0 ">
        <div class="card-header bg-warning text-center text-light">ISSUED</div>
        <div class="card-body bg-secondary">
            <div class="card-title text-center text-light"><?php echo $dashboard_info[2]?></div>
        </div>
    </div>
    <div class="card border-dark border-2 col-sm-5 col-md-3 col-lg-2 p-0 ">
        <div class="card-header bg-info text-center text-light">LOST</div>
        <div class="card-body bg-secondary">
            <div class="card-title text-center text-light"><?php echo $dashboard_info[3]?></div>
        </div>
    </div>
    <div class="card border-dark border-2 col-sm-5 col-md-3 col-lg-2 p-0 ">
        <div class="card-header bg-danger text-center text-light">OVER DUE</div>
        <div class="card-body bg-secondary">
            <div class="card-title text-center text-light"><?php echo $dashboard_info[4]?></div>
        </div>
    </div>
</div>
</div>