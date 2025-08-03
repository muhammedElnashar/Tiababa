
<!-- The Modal -->
<div class="modal" id="verifyModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title"> <?php echo trans('verify-your-account') ?></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <p><?php echo trans('verify-account-hints') ?></p>
        <a class="btn btn-primary mt-10" href="<?php echo base_url('admin/profile/verify') ?>"><i class="fa fa-check-circle"></i> <?php echo trans('verify-profile') ?></a>
      </div>

    </div>
  </div>
</div>

<footer class="main-footer">
  <div class="pull-right d-none d-sm-inline-block">
    <div class="version"><?php echo trans('version') ?>: <?php echo html_escape($settings->version) ?></div>
  </div>
  <a href="<?php echo base_url() ?>"><?php echo html_escape($settings->copyright) ?></a>
</footer>

<?php include'js_msg_list.php'; ?>

<?php $success = $this->session->flashdata('msg'); ?>
<?php $error = $this->session->flashdata('error'); ?>
<input type="hidden" id="success" value="<?php echo html_escape($success); ?>">
<input type="hidden" id="error" value="<?php echo html_escape($error);?>">
<input type="hidden" id="base_url" value="<?php echo base_url(); ?>">

<?php echo $this->session->unset_userdata('msg');
 $this->session->unset_userdata('error'); ?>

<!-- jQuery 3 -->
<script src="<?php echo base_url() ?>assets/admin/js/jquery3.min.js"></script>
<!-- popper -->
<script src="<?php echo base_url() ?>assets/admin/js/popper.min.js"></script>
<!-- bootstrap 4 -->
<script src="<?php echo base_url() ?>assets/admin/js/bootstrap.min.js"></script>
<!-- Custom js -->
<script src="<?php echo base_url() ?>assets/admin/js/admin.js?var=<?php echo settings()->version ?>&time=<?=time();?>"></script>
<script src="<?php echo base_url() ?>assets/admin/js/toast.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/bootstrap-tagsinput.min.js"></script>
<script src="<?php echo base_url()?>assets/admin/js/sweet-alert.min.js"></script>
<!-- Datatables-->
<script src="<?php echo base_url() ?>assets/admin/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/validation.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url() ?>assets/admin/js/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/ckeditor/ckeditor.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url() ?>assets/admin/js/fastclick.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/template.js"></script><!-- 
<script src="<?php echo base_url() ?>assets/admin/js/bootstrap-datepicker.min.js"></script> -->
<script src="<?php echo base_url() ?>assets/admin/js/demo.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/printThis.js"></script>
<!-- select 2 -->
<script src="<?php echo base_url() ?>assets/admin/js/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/bootstrap4-toggle.min.js"> </script>
<script src="<?php echo base_url() ?>assets/front/js/aos.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/bootstrap-switch.min.js"></script>
<!-- <script src="<?php echo base_url() ?>assets/admin/js/timepicki.js"></script> -->
<script src="<?php echo base_url() ?>assets/admin/js/lightbox.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/croppie.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>

<script>
  // Initialize the clipboard instance
  var clipboard = new ClipboardJS('.copy_button', {
    target: function() {
      return document.querySelector('.copy_url');
    }
  });
  
  // Add event listener to the copy button
  clipboard.on('success', function(e) {
      $("#successMsg").html('Copied text to clipboard!').delay(3000).slideUp('slow');

    e.clearSelection();
  });
</script>


<script>
  $(document).on('change', ".show_method", function() {
      //
        $('.method_details').slideDown();
    });
</script>

<script type="text/javascript">
  var base_url = $('#base_url').val();
  $uploadCrop = $('#upload-demo').croppie({
      enableExif: true,
      viewport: {
          width: 300,
          height: 300
      },
      boundary: {
          width: 400,
          height: 400
      }
  });
     
  $('#upload').on('change', function () { 
    var reader = new FileReader();
      reader.onload = function (e) {
        $uploadCrop.croppie('bind', {
          url: e.target.result
        }).then(function(){
          console.log('jQuery bind complete');
        });
      }
      reader.readAsDataURL(this.files[0]);
  });
       
  $('.upload-result').on('click', function (ev) {

      $uploadCrop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
      }).then(function (resp) {
      
      var post_data = {
        'image': resp,
        'csrf_test_name' : csrf_token
      };

      $.ajax({
        url: base_url+"admin/profile/upload_avatar",
        type: "POST",
        data: post_data,
        success: function (data) {
          $('.profile-user-img').attr("src", resp);
          $('.crop_area').hide();
          $('.profile_form').show();
        }
      });
    });
  });

  $(document).on("click",".crop_avatar", function () {
      $('.crop_area').show();
      $('.profile_form').hide();
  });

  $(document).on("click",".crop_back", function () {
      $('.crop_area').hide();
      $('.profile_form').show();
  });
    
</script>



<?php if (isset($page) && $page == 'Appointment'): ?>

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>

<input type="hidden" id="user_id" value="<?php if(user()->role == 'staff'){echo $user_id = user()->user_id;}else{echo $user_id = user()->id;} ?>">

<script>

    var base_url = $('#base_url').val();
    var user_id = $('#user_id').val();
    var arrayFromPHP = <?php echo json_encode($not_available) ?>;

    $("#datepicker").datepicker({
        // changeMonth: true,
        // changeYear: true,
        showOtherMonths: true,
        selectOtherMonths: true,
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        minDate: 0,
        dateFormat: 'yy-mm-dd',
        onSelect: function(){
            var date = $(this).val();
            
            var url = base_url+'home/get_time/'+date+'/'+user_id;
            var post_data = {
                'csrf_test_name' : csrf_token
            };

            $('#load_data').html('<span class="spinner-border spinner-border-sm"></span>');

            $.ajax({
                type: "POST",
                url: url,
                dataType: 'json',
                data: post_data,
                success: function(data) {
                    $('#load_data').html(data.result);
                }
            })

        },

        beforeShowDay: function(date) {
           var show = true;
            //foreach
            $.each(arrayFromPHP, function (i, elem) {
                if(date.getDay() == elem-1) show = false
            });
           
           return [show];
        }

    });

</script>

<script>
  // Initialize the clipboard instance
  var clipboard = new ClipboardJS('.copy_button', {
    target: function() {
      return document.querySelector('.copy_url');
    }
  });
  
  // Add event listener to the copy button
  clipboard.on('success', function(e) {
      $("#successMsg").html('Copied text to clipboard!').delay(3000).slideUp('slow');

    e.clearSelection();
  });
</script>







<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script>
    $(document).on("focusin",".timepicker", function () {
        $('input.timepicker').timepicker({interval: <?php echo get_interval() ?>});
    });
</script>
<?php endif ?>

<!-- stripe js -->
<?php $this->load->view('admin/include/stripe-js'); ?>

<!-- admin chart js -->
<?php if (isset($page_title) && $page_title == 'Dashboard'): ?>
  <?php $this->load->view('admin/include/charts'); ?>
<?php endif ?>

<!-- user chart js -->
<?php if (isset($page_title) && $page_title == 'User Dashboard'): ?>
  <?php $this->load->view('admin/include/charts_user'); ?>
<?php endif ?>


<?php if (is_user() && user()->is_verified == 0 && check_user_verification($user->id) == FALSE && settings()->profile_verification == 1): ?>
  <?php if (isset($page_title) && $page_title != 'Verify'): ?>
  <script type="text/javascript">
      $(window).on('load', function() {
          $('#verifyModal').modal('show');
      });
  </script>
  <?php endif ?>
<?php endif ?>

<!-- <script>
	$('.timepicker').timepicki();
	
	lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true
    })
</script> -->

</body>
</html>
