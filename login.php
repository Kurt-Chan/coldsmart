<?php include "includes/head.php"; ?>
<form action="functions/login.php" method="post">
    <div class="col-lg-5 shadow mx-auto mt-5 p-2 bg-white">

        <div class="card-header" style="background-color: #023859;">
            <h4 class="font-weight-bold text-center lightText">LOGIN</h4>

        </div>
        <p class="p-1"></p>
        <input type="email" name="email" class="form-control mb-1" placeholder="Email Address"><br>
        <input type="password" class="form-control mb-1" name="password" placeholder="Password"><br>

        <div>
            <button class="btn cardHeader" style="background-color: #023859; color: white; display: inline-block; text-align: center" name="login" value="Login">Login</button>
        </div>

        <a href="register.php">Register</a>

    </div>
</form>

<?php include "includes/foot.php";
