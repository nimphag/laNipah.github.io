<?php include('includes/header.php'); ?>
<?php include('includes/navbar.php'); ?>
<?php include('includes/slider.php'); ?>

<section class="py-3 bg-primary">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h4 class="main-heading text-white">La Nipah Hotel</h4>
                <div class="underline bg-white mx-auto"></div>
                <p class="text-white">
                    Get the Best Price on booking your hotel rooms at La Nipha Hotel.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="main-heading">Book Rooms</h4>
                <div class="underline mb-0"></div>
                <hr class="my-0">
            </div>
            
            <div class="col-md-12 mt-4">
                <div class="row">
                    <?php
                        $room_query = " SELECT * FROM rooms WHERE status='0' ";
                        $room_query_run = mysqli_query($con, $room_query);

                        if(mysqli_num_rows($room_query_run) > 0)
                        {
                            foreach($room_query_run as $room)
                            {
                                ?>
                                    <div class="col-md-4">
                                        <a href="view.php?room=<?= $room['id']; ?>" class="text-decoration-none">
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

<section class="section bg-lightgray">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mb-3 text-center">
                <h4 class="main-heading">What Clients Say</h4>
                <div class="underline mx-auto"></div>
                <p>
                    What people tell about our La Nipha Hotel
                </p>
            </div>

            <div class="col-md-8">
                    <div class="owl-carousel testimonials owl-theme">

                        <div class="item text-center">
                            <div class="testi-card">
                                <div class="testi-content">
                                    <p>
                                        <i class="left-q-icon text-white fa fa-quote-left "> </i>
                                        I have been using their service a couple of time. La Nipah Hotel are one of the best hotel in Cauayan Isabela.
                                    </p>
                                    <h5 class="testi-title">Kate</h5>
                                </div>
                            </div>
                        </div>

                        <div class="item text-center">
                            <div class="testi-card">
                                <div class="testi-content">
                                    <p>
                                        <i class="left-q-icon text-white fa fa-quote-left "> </i>
                                        …I really love the hotel and everything it looks amazing, and the swimming pool. And it's very peaceful here and also moonpools. It's very beautiful, so I really love this place. It's amazing.
                                    </p>
                                    <h5 class="testi-title">Jessie</h5>
                                </div>
                            </div>
                        </div>

                        <div class="item text-center">
                            <div class="testi-card">
                                <div class="testi-content">
                                    <p>
                                        <i class="left-q-icon text-white fa fa-quote-left "> </i>
                                        It was a lovely experience, we enjoyed our stay here everything was clean and tidy, food was lovely, staff were great we will stay again if we are ever in the area!
                                    </p>
                                    <h5 class="testi-title">Jenifer</h5>
                                </div>
                            </div>
                        </div>
                        
                    </div>
            </div>
        </div>
    </div>
</section>


<?php include('includes/footer.php'); ?>

<script>
$(document).ready(function () {
        
    $('.testimonials').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        dots:false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    })

});
</script>