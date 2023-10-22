<?php include('includes/header.php');
if(isset($_SESSION['login']))
{
    redirect("index.php","Logout to register new account");
}
?>
<?php include('includes/navbar.php'); ?>

<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card login-border shadow mt-3">
                    <div class="card-header login-head-border bg-primary">
                        <h2 class="heading fw-bold mb-1 text-center text-white">Register Now</h2>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="">First Name</label>
                                        <input type="text" class="form-control alphaonly" required name="fname">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="">Last Name</label>
                                        <input type="text" class="form-control alphaonly"  required name="lname">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="">Phone</label>
                                        <input type="number" onblur="PhoneNumvalidate()" id="mobilenumber" class="form-control" required name="phone">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="">Email address</label>
                                        <input type="email" required class="form-control" name="email">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="">Choose Gender</label>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" value="Male" id="male">
                                        <label class="form-check-label" for="male">
                                            Male
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" value="Female" id="female">
                                        <label class="form-check-label" for="female">
                                            Female
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="">Password</label>
                                        <input type="password" required class="form-control" name="password">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="">Confirm Password</label>
                                        <input type="password" required class="form-control" name="cpassword">
                                    </div>
                                </div>
                               
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" name="reg_btn" class="btn btn-primary px-5">Register</button>
                                <div class="mt-3">
                                   Already have an account ?  <a href="login.php" class=" rem-ul">Log in Now</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php include('includes/footer.php') ?>