<?php include('includes/footer-top.php'); ?>


<script src="assets/js/jquery-3.5.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/owl.carousel.js"></script>
<script src="assets/js/popper.min.js"></script>

<script>

function cvvvalidate()
  {
    var filter = /^[0-9][0-9]{2}$/; //PATTERN FOR Card Number
      
      var a = $("#cvvnumber").val();     
      if (!(filter.test(a))) {
            swal("Enter valid 3 digit cvv number");
            $("#cvvnumber").val('');
      }
  }
  function cardvalidate()
  {
    var filter = /^[0-9][0-9]{15}$/; //PATTERN FOR Card Number
      
      var a = $("#cardnumber").val();     
      if (!(filter.test(a))) {
            swal("Enter valid 16 digit card number");
            $("#cardnumber").val('');
      }
  }
  
  function PhoneNumvalidate()
  {
      var filter = /^[0-9][0-9]{9}$/; //PATTERN FOR MOBILE NUMBER
      
      var a = $("#mobilenumber").val();     
      if (!(filter.test(a))) {
            alert("Enter valid mobile number");
            $("#mobilenumber").val('');
      }
  }

  $('.alphaonly').bind('keyup blur',function(){ 
    var node = $(this);
    node.val(node.val().replace(/[^a-z]/g,'') ); 
  });
</script>

<!-- DataTables -->
<script src="admin/assets/js/jquery.dataTables.min.js"></script>
<script src="admin/assets/js/dataTables.bootstrap5.min.js"></script>

<script src="assets/js/jquery-ui.js"></script>
<script>
    $(document).ready( function () {
        $('.myTable').DataTable();
    });
  $( function() {
    $( ".datepicker" ).datepicker({
        dateFormat:'dd/mm/yy',
    });
  } );
</script>

<script src="assets/js/sweetalert.min.js"></script>
<script>
        <?php if(isset($_SESSION['status'])): ?>
            swal('<?= $_SESSION['status']; ?>');
        <?php unset($_SESSION['status']); endif; ?>
</script>

</body>
</html>