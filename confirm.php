<?php 
include('includes/header.php'); ?>
<?php include('includes/navbar.php'); ?>
<?php include('includes/banner.php'); ?>

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="main-heading">Check Room Availability</h4>
                <div class="underline mb-0"></div>
                <hr class="my-0">
            </div>
            <div class="col-md-12">
                <div class="card-box">
                    <div class="card-body">
                        <?php
                            if(isset($_GET['checkin']) && isset($_GET['checkout']) && isset($_GET['roomid']))
                            {
                                $roomid = $_GET['roomid'];
                                $checkin = $_GET['checkin'];
                                $checkout = $_GET['checkout'];

                                $chk_aval ="SELECT room_id FROM bookings WHERE room_id='$roomid'AND( 
                                (checkin <= '$checkin' AND checkout >='$checkout') OR 
                                (checkin >= '$checkin' AND checkin <='$checkout') OR 
                                (checkin <= '$checkin' AND checkout >='$checkin')  )";

                                $chk_aval_run = mysqli_query($con, $chk_aval);
                                
                                $roomqty_query = "SELECT * FROM rooms WHERE id='$roomid' LIMIT 1";
                                $roomqty_query_run = mysqli_query($con, $roomqty_query);
                                $omrow = mysqli_fetch_array($roomqty_query_run);
                                $roomqty = $omrow['room_qty'];
                                $roomprice = $omrow['price'];
                                $roomname = $omrow['room_name'];
                                $room_image = $omrow['room_image'];
                                $total_beds = $omrow['no_of_beds'];

                                $chkin = date('Y-m-d',strtotime($checkin));
                                $chkout = date('Y-m-d',strtotime($checkout));
                                $date1=date_create($chkin);
                                $date2=date_create($chkout);
                                $difference=date_diff($date1,$date2);
                                $sub_diff = $difference->format("%a");
                                $diff = $sub_diff + 1;
                                $totalprice = $roomprice * $diff;


                                if(mysqli_num_rows($chk_aval_run) < $roomqty)
                                {
                                    ?>
                                                                        
                                    <!-- Payment Modal -->
                                    <div class="modal fade" id="CheckoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Checkout</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                   

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">User Name</label>
                                                                    <h5 class="form-control"><?php if(isset($_SESSION['login'])){ echo $_SESSION['auth']['fname'].' '. $_SESSION['auth']['lname']; } ?></h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for="">Room Price</label>
                                                                <h5 class="form-control"><?= $roomprice ?></h5>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="">No of Days</label>
                                                                <h5 class="form-control"><?= $diff ?></h5>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="">Total Price</label>
                                                                <h5 class="form-control"><?= $totalprice ?></h5>
                                                            </div>
                                                            <div class="col-md-12 mt-3">
                                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                                    <li class="nav-item" role="presentation">
                                                                        <button class="nav-link active" id="cashon-tab" data-bs-toggle="tab" data-bs-target="#cashon" type="button" role="tab" aria-controls="cashon" aria-selected="true">Cash Payment</button>
                                                                    </li>
                                                                    <li class="nav-item" role="presentation">
                                                                        <button class="nav-link" id="payonline-tab" data-bs-toggle="tab" data-bs-target="#payonline" type="button" role="tab" aria-controls="payonline" aria-selected="false">Pay Online</button>
                                                                    </li>
                                                                </ul>
                                                                <div class="tab-content" id="myTabContent">
                                                                    <div class="tab-pane border fade show active" id="cashon" role="tabpanel" aria-labelledby="cashon-tab">
                                                                        <div class="p-3">
                                                                            <form action="code.php" method="POST">
                                                                                <input type="hidden" name="bookroomid" value="<?= $roomid ?>">
                                                                                <input type="hidden" name="checkin" value="<?= $checkin ?>">
                                                                                <input type="hidden" name="checkout" value="<?= $checkout ?>">
                                                                                <input type="hidden" name="totalprice" value="<?= $totalprice ?>">
                                                                                
                                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                                                                <button type="submit" name="confirm_book_btn" value="1" class="btn btn-primary">Confirm your Booking</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                    <div class="tab-pane border fade" id="payonline" role="tabpanel" aria-labelledby="payonline-tab">
                                                                        <div class="p-3">
                                                                            <form action="code.php" method="POST">
                                                                                <input type="hidden" name="bookroomid" value="<?= $roomid ?>">
                                                                                <input type="hidden" name="checkin" value="<?= $checkin ?>">
                                                                                <input type="hidden" name="checkout" value="<?= $checkout ?>">
                                                                                <input type="hidden" name="totalprice" value="<?= $totalprice ?>">
                                                                                <div class="row">
                                                                                    <div class="col-md-6 mb-2">
                                                                                        <label class="f-12">Card Holder's Name</label>
                                                                                        <input type="text" required class="form-control alphaonly" placeholder="Card Holder's Name">
                                                                                    </div>
                                                                                    <div class="col-md-6 mb-2">
                                                                                        <label class="f-12">Card Number</label>
                                                                                        <input type="number" required class="form-control onlynumber" id="cardnumber" onblur="cardvalidate()" onfocus="Numvalidate()" placeholder="Enter the 16 digit card number">
                                                                                    </div>
                                                                                    <div class="col-md-4 mb-2">
                                                                                        <label class="f-12">CVV Number</label>
                                                                                        <input type="password" required class="form-control" placeholder="CVV number" id="cvvnumber" onblur="cvvvalidate()" >
                                                                                    </div>
                                                                                    <div class="col-md-4 mb-2">
                                                                                        <label class="f-12">Valid From</label>
                                                                                        <input type="text" required class="form-control monthPicker" placeholder="Valid From">
                                                                                    </div>
                                                                                    <div class="col-md-4 mb-2">
                                                                                        <label class="f-12">Valid till</label>
                                                                                        <input type="text" required class="form-control monthPicker" placeholder="Valid Till">
                                                                                    </div>
                                                                                    <div class="col-md-12">
                                                                                        <div class="pt-2 text-end">
                                                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                                                                            <button type="submit" name="confirm_book_btn" value="2" class="btn btn-primary">Confirm your Booking</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Payment Modal -->

                                        <div class="row">
                                            <div class="col-md-6 border-end">
                                                <img src="uploads/<?= $room_image ?>" alt="<?= $roomname ?> Image" class="w-100">
                                            </div>
                                            <div class="col-md-6">
                                       

                                                    <h2 class="main-heading">Room is available</h2>
                                                    <h6 class="form-control bg-white"> Room:  <?= $roomname ?> </h6>
                                                    <h6 class="form-control bg-white"> No of beds: <?= $total_beds ?></h6>
                                                   
                                                    <h6 class="form-control bg-white"> Price: <?= $roomprice." x ". $diff ."days = ".$roomprice * $diff ?></h6>
                                                    <h6 class="form-control bg-white"> Check In: <?= date('d-m-Y', strtotime($checkin)) ?></h6>
                                                    <h6 class="form-control bg-white"> Check Out: <?= date('d-m-Y', strtotime($checkout)) ?></h6>
                                                    <div class="text-end">
                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#CheckoutModal" class="btn btn-primary">Book Now</button>
                                                    </div>
                                            </div>
                                        </div>
                                    <?php
                                        
                                }
                                else
                                {
                                    ?>
                                        <div class="row justify-content-center">
                                            <div class="col-md-6 text-center">
                                                <h2 class="heading">
                                                    All rooms of this Category are booked on the selected dates
                                                    <br>
                                                        <?= date('d-m-Y', strtotime($checkin)) ?>
                                                    <br>
                                                    <a href="all-rooms.php" class="btn btn-primary px-4 mt-2">Back</a>
                                                </h2>
                                            </div>
                                        </div>
                                    <?php
                                }
                            }
                            else
                            {
                                redirect("index.php","Page Expired");
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</section>

<?php include('includes/footer.php'); ?>
<script>
$(document).ready(function()
{   
    $(".monthPicker").datepicker({
        dateFormat: 'MM yy',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,

        onClose: function(dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).val($.datepicker.formatDate('m/y', new Date(year, month, 1)));
        }
    });

    $(".monthPicker").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });
    });
});
</script>
