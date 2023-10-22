<?php include('includes/header.php'); ?>
<?php include('includes/navbar.php'); ?>
<?php include('includes/banner.php'); ?>

<?php
    if(isset($_SESSION['login']))
    {
        ?>
            <section class="section">
                <div class="container">
          
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card-box myprofile mt-3">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <h4 class="main-heading">My Profile</h4>
                                        <div class="underline mb-0"></div>
                                        <hr class="my-0">
                                    </div>

                                    <?php 
                                        $uid = $_SESSION['auth']['auth_id'];
                                        $userquery = "SELECT * FROM users where id='$uid' LIMIT 1";
                                        $userquery_run = mysqli_query($con, $userquery); 
                                        $data = mysqli_fetch_array($userquery_run);
                                        
                                        if(mysqli_num_rows($userquery_run) > 0)
                                        {
                                            ?>
                                            <form action="code.php" method="POST">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-4">
                                                            <label class="">First Name</label>
                                                            <input type="text" class="form-control" value="<?= $data['fname']; ?>" required name="fname">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-4">
                                                            <label class="">Last Name</label>
                                                            <input type="text" class="form-control" value="<?= $data['lname']; ?>" required name="lname">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-4">
                                                            <label class="">Phone</label>
                                                            <input type="text" onblur="PhoneNumvalidate()" id="mobilenumber" class="form-control" value="<?= $data['phone']; ?>" required name="phone">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-4">
                                                            <label class="">Email address</label>
                                                            <input type="email" required class="form-control" value="<?= $data['email']; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="border-bottom pb-1 mb-1">Choose Gender</label>
                                                        <div class="row">

                                                            <div class="col-md-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="gender" <?= $data['gender'] == "Male"?'checked':''; ?> value="Male" id="male">
                                                                    <label class="form-check-label" for="male">
                                                                        Male
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="gender" <?= $data['gender'] == "Female"?'checked':''; ?> value="Female" id="female">
                                                                    <label class="form-check-label" for="female">
                                                                        Female
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 my-auto">
                                                        <div class="text-end">
                                                            <button type="submit" name="update_profile_btn" class="btn btn-primary mt-2">Update Profile</button>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </form>
                                    <?php }else{ ?>
                                        <h4>Something Went Wrong</h4>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php
    }
    else
    {
        redirect("login.php","Login to access profile page");
    }
?>

<?php include('includes/footer.php'); ?>
