<?php include('includes/header.php'); ?>
<?php include('includes/navbar.php'); ?>
<?php include('includes/banner.php'); ?>


<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="main-heading">Book Rooms</h4>
                    </div>
                    <div class="col-md-6">
                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="card-label">Check In:</label>
                                    <input type="date" id="checkin" required value="<?= isset($_GET['checkin']) ? $_GET['checkin'] : ''; ?>" class="checkinclass form-control" name="checkin">
                                </div>
                                <div class="col-md-4">
                                    <label class="card-label">Check out:</label>
                                    <input type="date" id="checkout"  value="<?= isset($_GET['checkout']) ? $_GET['checkout'] : ''; ?>"required class="checkoutclass form-control" name="checkout">
                                </div>
                                <div class="col-md-4">
                                    <label class="card-label">Check Availability by date</label>
                                    <button type="submit" class="btn btn-primary w-100">Check Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="underline mb-0"></div>
                <hr class="my-0">
            </div>
            
            <div class="col-md-12 mt-4">
                <div class="row">
                    <?php

                        if(isset($_GET['checkin']) && isset($_GET['checkout']))
                        {
                            
                            $checkin = $_GET['checkin'];
                            $checkout = $_GET['checkout'];
                            
                            $avlrooms="SELECT DISTINCT rooms.id FROM rooms WHERE rooms.id NOT IN (SELECT DISTINCT room_id FROM bookings WHERE 
                            (checkin <= '$checkin' AND checkout >='$checkout') OR 
                            (checkin >= '$checkin' AND checkin <='$checkout') OR 
                            (checkin <= '$checkin' AND checkout >='$checkin') )";
                           
                            $room_query ="SELECT * FROM rooms WHERE id IN ($avlrooms)";
                            $room_query_run = mysqli_query($con, $room_query);


                        }
                        else
                        {
                            $room_query = " SELECT * FROM rooms WHERE status='0' ";
                            $room_query_run = mysqli_query($con, $room_query);
                        }
                        if(mysqli_num_rows($room_query_run) > 0)
                        {
                            foreach($room_query_run as $room)
                            {

                                ?>
                                    <div class="col-md-4">
                                        <a href="view.php?room=<?= $room['id'];?><?php if(isset($_GET['checkin'])&&isset($_GET['checkout'])){ echo'&checkin='.$_GET['checkin'].'&checkout='.$_GET['checkout']; }?>"
                                            class="text-decoration-none">
                                            <div class="card-box">
                                                <div class="roomimage">
                                                    <img src="uploads/<?= $room['room_image']; ?>" class="" alt="<?= $room['room_name'] ?>">
                                                </div>
                                                <div class="card-box-body">
                                                    
                                                        <h4 class="card-heading"><?= $room['room_name']; ?>
                                                            <button class="btn btn-sm btn-primary float-end text-white">₱ <?= $room['price']; ?></button>
                                                        </h4>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <?php
                            }
                        }
                        else
                        {
                            ?>
                                <h2 class="heading">No rooms found</h2>
                            <?php
                        }
                    ?>

                </div>
            </div>
        </div>    
    </div>
</section>


<?php include('includes/footer.php'); ?>


<script>

$(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;
    $('#checkin').attr('min', maxDate);
    $('#checkout').attr('min', maxDate);
    <?php
    if(!isset($_GET['checkin']))
    { ?>
        $('.checkinclass').val(maxDate);
        $('.checkoutclass').val(maxDate);
    <?php
    } ?>

});


$('#checkin').blur(function (e) { 
    e.preventDefault();

    var cin = $(this).val();
    var maxDate = cin;
    $('#checkout').attr('min', maxDate);
    $('.checkoutclass').val(maxDate);
});

</script>
