<?php include "includes/head.php"; ?>
<form action="functions/register.php" method="post">
    <div class="col-lg-5 shadow mx-auto mt-5 p-2 bg-white">

        <div class="card-title bg-success text-white mt-8">
            <h3 class="text-center py-2">SIGN UP</h3>
        </div>

        <input type="text" name="first_name" class="form-control mb-1 text-capitalize" placeholder="First Name"><br>
        <input type="text" name="last_name" class="form-control mb-1 text-capitalize" placeholder="Last Name"><br>

        <input type="email" name="email" class="form-control mb-1" placeholder="Email Address"><br>
        <input type="password" class="form-control mb-1" name="password" placeholder="Password"><br>

        <input type="password" class="form-control mb-1" name="confirm_password" placeholder="Confirm Password">

        <div>
            <button class="btn btn-primary" name="register" value="Submit">Submit</button>
        </div>

        <a href="login.php" class="ca">Already have an account?</a>
    </div>
</form>

<?php include "includes/foot.php";
