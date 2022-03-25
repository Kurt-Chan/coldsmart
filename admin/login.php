<?php include "./includes/head.php"; ?>
<form action="functions/login.php" method="post">
    <div class="col-lg-5 shadow mx-auto mt-5 p-2 bg-white">

        <div class="card-title bg-success text-white mt-8">
            <h3 class="text-center py-2">Admin Login</h3>
        </div>
        <input type="text" name="username" class="form-control mb-1" placeholder="Username"><br>
        <input type="password" class="form-control mb-1" name="password" placeholder="Password"><br>

        <div>
            <button class="btn btn-primary" name="login" value="Login">Login</button>
        </div>
    </div>
</form>

<?php require "./includes/foot.php";
