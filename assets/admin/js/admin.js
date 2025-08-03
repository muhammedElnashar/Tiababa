jQuery(function($) {

	"use strict";

  var loading_html = '<div class="container text-center" style="padding: 200px"><div class="spinner-md"></div></div>';
  var base_url = $('#base_url').val();
  var success = $('#success').val();
  var error = $('#error').val();



  var msg_opps = $('.msg_opps').val();
  var msg_error = $('.msg_error').val();
  var msg_success = $('.msg_success').val();
  var msg_sorry = $('.msg_sorry').val();
  var msg_yes = $('.msg_yes').val();
  var msg_congratulations = $('.msg_congratulations').val();
  var msg_something_wrong = $('.msg_something_wrong').val();
  var msg_try_again = $('.msg_try_again').val();
  var msg_password_reset_success_msg = $('.msg_password_reset_success_msg').val();
  var msg_confirm_pass_not_match_msg = $('.msg_confirm_pass_not_match_msg').val();
  var msg_old_password_doesnt_match = $('.msg_old_password_doesnt_match').val();
  var msg_inserted = $('.msg_inserted').val();
  var msg_made_changes_not_saved = $('.msg_made_changes_not_saved').val();
  var msg_no_data_founds = $('.msg_no_data_founds').val();
  var msg_del_success = $('.msg_del_success').val();
  var msg_account_suspend_msg = $('.msg_account_suspend_msg').val();
  var msg_are_you_sure = $('.msg_are_you_sure').val();
  var msg_get_started = $('.msg_get_started').val();
  var msg_not_recover_file = $('.msg_not_recover_file').val();
  var msg_deleted_successfully = $('.msg_deleted_successfully').val();
  var msg_data_limit_over = $('.msg_data_limit_over').val();
  var msg_email_exist = $('.msg_email_exist').val();
  var msg_recaptcha_is_required = $('.msg_recaptcha_is_required').val();

  var msg_serial_cancel_success = $('.msg_serial_cancel_success').val();
  var msg_cancel_this_user_serial = $('.msg_cancel_this_user_serial').val();
  var msg_set_this_chamber_default = $('.msg_set_this_chamber_default').val();
  var msg_yes_start = $('.msg_yes_start').val();
  var msg_ready_to_start_a_live = $('.msg_ready_to_start_a_live').val();
  var msg_prescription_created_successfully = $('.msg_prescription_created_successfully').val();
  var msg_added_successfully = $('.msg_added_successfully').val();

  var msg_beforeafter_meals = $('.msg_beforeafter_meals').val();
  var msg_after_meal = $('.msg_after_meal').val();
  var msg_before_meal = $('.msg_before_meal').val();
  var msg_day = $('.msg_day').val();
  var msg_month = $('.msg_month').val();
  var msg_year = $('.msg_year').val();
  var msg_continue = $('.msg_continue').val();
  var msg_time = $('.msg_time').val();
  var msg_enter_note = $('.msg_enter_note').val();





  $('[data-toggle="tooltip"]').tooltip(); 
	
  $('.datatable').dataTable();


    $(document).ready(function() {
        
        AOS.init();

        if ($('#success').val()) {
            $.toast({
                heading: msg_success,
                text: success,
                position: 'top-right',
                loaderBg:'#fff',
                icon: 'success',
                hideAfter: 4500
            });
        }

        if($('#error').val() ) {
            $.toast({
                heading: msg_error,
                text: error,
                position: 'top-right',
                loaderBg:'#fff',
                icon: 'error',
                hideAfter: 4500
            });
        }

        $('.print_tbl').on('click', function() {
          $('.hide_pnt').hide();
          var divName= "print_tbl";
          var printContents = document.getElementById(divName).innerHTML;
          var originalContents = document.body.innerHTML;
          document.body.innerHTML = printContents;
          window.print();
          document.body.innerHTML = originalContents;
          $('.hide_pnt').show();
          window.location.reload();
          return false;
        });


        $('.upload-wrap input[type=file]').change(function(){
          var id = $(this).attr("id");
          var newimage = new FileReader();
          newimage.readAsDataURL(this.files[0]);
          newimage.onload = function(e){
            $('.uploadpreview.' + id ).css('background-image', 'url(' + e.target.result + ')' );
          }
        });


        $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
        var radioswitch = function() {
            var bt = function() {
                $(".radio-switch").on("switch-change", function() {
                    $(".radio-switch").bootstrapSwitch("toggleRadioState")
                }), $(".radio-switch").on("switch-change", function() {
                    $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck")
                }), $(".radio-switch").on("switch-change", function() {
                    $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck", !1)
                })
            };
            return {
                init: function() {
                    bt()
                }
            }
        }();

       
        radioswitch.init()
        // jQuery('.datepicker').datepicker({
        //     format: 'yyyy-mm-dd'
        // });

        // $('.datepicker').on('changeDate', function(ev){
        //     $(this).datepicker('hide');
        // });

        $("body").on('click','.time_btn',function(){
            $('.time_btn').removeClass('active');
            $(this).addClass('active');
        });


        $('.select2').select2();
        $('.single_select').select2();


        CKEDITOR.replace('ckEditor', {
            language: 'en'
        });
        CKEDITOR.replace('ckEditor1', {
            language: 'en'
        });

    })

    

    

    //form validation
    !function(window, document, $) {
      "use strict";
        $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
    }(window, document, jQuery);


    $(document).on('change', '.btn-file :file', function() {
      var input = $(this),
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
      input.trigger('fileselect', [label]);
    });


    function readimgURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#img-upload').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }


    $("#imgInp").on('change', function() {
        readimgURL(this);
    });   


     $(".switch_business").on('click', function() {
      //new WOW().init();
      $(".business_switch_panel").show();
    });

    $(".business_close").on('click', function() {
      $(".business_switch_panel").hide();
    });



    $(".custom-btngp").on('click', function() {
        var priceVal = $(this).find('.switch_price').val();

        if (priceVal == 'monthly') {
            $('.monthly_price').show();
            $('.yearly_price').hide();
            $('.billing_type').val('monthly');
        } else {
            $('.yearly_price').show();
            $('.monthly_price').hide();            
            $('.billing_type').val('yearly');
        }
    });


    $(document).ready(function(){
        $(".add_time_row").on('click', function() {
            var val = $(this).attr("data-id");
            $('.houritem_'+val).append(`
                <div class="row new_item_row_`+val+`">
                    <div class="col-sm-5 pr-0 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="icon-clock"></i></span>
                            </div>
                            <input type="text" class="form-control timepicker" name="start_time_`+val+`[]" value="" autocomplete="off">
                        </div>
                    </div>

                    <div class="col-sm-5 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="icon-clock"></i></span>
                            </div>
                            <input type="text" class="form-control timepicker" name="end_time_`+val+`[]" value="" autocomplete="off">
                        </div>
                    </div>

                    <div class="col-sm-2 mb-2">
                        <a href="javascript:void(0);" class="remove_time_row text-danger"><i class="icon-trash"></i></a>
                    </div>
                </div>
            `);
        });

        $(".main_item").on('click','.remove_time_row',function(){
            $(this).parent().parent().remove();
        });
    });


    $(document).ready(function(){
        $(".add_verification_row").on('click', function() {
         
            $('.houritem').append(`
                <div class="row new_item_row">
                    <div class="col-sm-5 pr-0 mb-2">
                        <div class="input-group">
                            <input type="text" class="form-control" name="verification_items[]" value="" required autocomplete="off" placeholder="Cerfificate / document name">
                        </div>
                    </div>

                    <div class="col-sm-2 mb-2">
                        <a href="javascript:void(0);" class="remove_time_row text-danger"><i class="icon-trash"></i></a>
                    </div>
                </div>
            `);
        });

        $(".main_item").on('click','.remove_time_row',function(){
            $(this).parent().parent().remove();
        });
    });


    $('.day_option').on('change', function () {
        var val = $(this).val();

        if ($(this).prop('checked')) {
          $('.hideable_'+val).slideDown();
          console.log(val);
        }else{
          $('.hideable_'+val).slideUp();
          console.log(val);
        }
        return false;
    });


    $(document).on('click', ".package_btn", function() {
      var billType = $('.billing_type').val();
      var url = $(this).attr('href')+'/'+billType;
      window.location.href=url;
      return false;
    });


    //avatar upload
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageUpload").change(function() {
        readURL(this);
    });


    $(document).on('click', ".monthly_btn", function() {
      $('.yearly_btn').removeClass('active');
      $(this).addClass('active');
      $('.monthly_area').fadeIn();
      $('.yearly_area').hide();
      return false;
    });

    $(document).ready(function(){
        $(".filter-action").click(function(){
            //alert ('hi');
          $(".filter_popup").toggleClass("showFilter");
        });

        

    });


    $(document).on('click', ".yearly_btn", function() {
      $('.monthly_btn').removeClass('active');
      $(this).addClass('active');
      $('.yearly_area').fadeIn();
      $('.monthly_area').hide();
      return false;
    });
  

    $(".checkcolor").on('click', function() {
      var $box = $(this);
      if ($box.is(":checked")) {
        var group = "input:checkbox[name='" + $box.attr("name") + "']";
        $(group).prop("checked", false);
        $box.prop("checked", true);
      } else {
        $box.prop("checked", false);
      }
    });


    $(".check_all").on('click', function() {

        $('input:checkbox').not(this).prop('checked', this.checked);
        
        if ($(".check_all").is(":checked")) {
            $(".multiple_delete_btn").show()
        } else {
            $(".multiple_delete_btn").hide()
        }
    });



    $(".checkItem").on('click', function() {
        if ($(".checkItem").is(":checked")) {
            $(".multiple_delete_btn").show()
        } else {
            $(".multiple_delete_btn").hide()
        }
    });


    $(".patient_type").on('click', function() {
        if ($(this).val() == 1) {
            $(".new_patient_area").slideDown();
            $(".old_patient_area").hide();
        } else {
            $(".old_patient_area").slideDown();
            $(".new_patient_area").hide();
        }
    });
    

    $(function(){

        $(document).on('submit', "#cahage_pass_form", function() {

            $.post($('#cahage_pass_form').attr('action'), $('#cahage_pass_form').serialize(), function(json){

                if (json.st == 1) {
                    $('#cahage_pass_form')[0].reset();
                    swal({
                          title: msg_congratulations,
                          text: msg_password_reset_success_msg,
                          type: "success",
                          showConfirmButton: true
                    });
                }else if (json.st == 2) {
                    $('#cahage_pass_form')[0].reset();
                    swal({
                      title: msg_opps,
                      text: msg_confirm_pass_not_match_msg,
                      type: "error",
                      showConfirmButton: true
                    });
                }else {
                    $('#cahage_pass_form')[0].reset();
                    swal({
                      title: msg_error,
                      text: msg_old_password_doesnt_match,
                      type: "error",
                      showConfirmButton: true
                    });
                }
            },'json');
            return false;
        });

    });




    $(document).on('click', "#make_embaded", function() {

        var url = $("#video_url").val();
        var post_data = {
            'url': url,
            'csrf_test_name' : csrf_token
        };

        $.ajax({
            type: "POST",
            url: base_url + "admin/video/generate_embed_code",
            data: post_data,
            success: function (response) {
                $("#video_embed_code").html(response);
                if (response != "Invalid Url") {
                    $("#video_preview").attr('src', response);
                    $("#video_play_icon").hide();
                }
            }
        });


        $.ajax({
            type: "POST",
            url: base_url + "admin/video/get_video_thumbnails",
            data: post_data,
            success: function (response) {
                $("#video_thumbnails_url").val(response);
                $("#video_thumbnails_img").attr('src', response);
            }
        });

    });



    $(document).on('click', ".plan_status", function() {
        var pkgId = $(this).attr('data-id');
        var status = $(this).val();

        var url = base_url+'admin/package/status_update/'+status+'/'+pkgId;
        $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
           if(json.st == 1){
                window.location.reload();
            }
        }, 'json' );
        return false;
    });


    $(document).on('click', ".rating_system", function() {
        var status = $(this).val();
        var url = base_url+'admin/dashboard/rating_update/'+status;
        $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
           if(json.st == 1){
                window.location.reload();
            }
        }, 'json' );
        return false;
    });


    $(document).on('click', ".layout", function() {
        $('.layout_form').submit();
    });


    $(document).on('change', ".sort", function() {
        $('.sort_form').submit();
    });

    $(document).on('change', ".sort_package", function() {
        $('.sort_package_form').submit();
    });

    
    $(document).on('click', ".add_btn", function() {
        $('.add_area').show();
        $('.list_area').hide();
        return false;
    });

    $(document).on('click', ".cancel_btn", function() {
        $('.add_area').hide();
        $('.list_area').show();
        return false;
    });


    $(document).on('click', ".add_btn2", function() {
        $('.add_area2').show();
        $('.list_area2').hide();
        return false;
    });

    $(document).on('click', ".cancel_btn2", function() {
        $('.add_area2').hide();
        $('.list_area2').show();
        return false;
    });


    $(document).on('click', ".scheduled_post", function() {
        $('.date_area').slideToggle();
        $('this').checked();
        return false;
    });


    $(document).on('click', ".check_zoom_api", function() {

        var url = base_url+'admin/settings/test_zoom_connection';
        $.post(url,{ data: 'value', 'csrf_test_name': csrf_token },function(json){
            if (json.st == 1) {
                $('.conn_info').html(json.msg).show();
            }else{
                $('.conn_error').html(json.msg).show();
            }
        },'json');
        return false;
    });


    $(document).on('change', "#category", function() {
        var catId = $(this).val();
        if(catId != ''){
            var url = base_url+'admin/post/load_subcategory/'+catId;
                $.post(url,{ data: 'value', 'csrf_test_name': csrf_token },function(data){
                    $('#sub_category').html(data);
                    $('#sub_category').prop('disabled', false);
                }
            );
        }  
    });
  
   $(function(){

        $(document).on('submit', "#pateint_form", function() {
            $.post($('#pateint_form').attr('action'), $('#pateint_form').serialize(), function(json){
                if (json.st == 1) {
                   $('.select2').select2();
                  $(function(){
                      var url = base_url+'admin/prescription/get_patient_name';
                      $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
                         if(json.status == 1){
                            $('#pateintModal').modal('hide');
                              $('.pateint_name').html(json.data);
                              $('.select2').select2();
                          }
                      }, 'json' );
                      return false; 
                    })
                    $('#pateint_form')[0].reset();
                    swal({
                          title: msg_congratulations,
                          text: json.msg,
                          type: "success",
                          showConfirmButton: true
                    });
                    
                }else {
                    swal({
                      title: msg_error,
                      text: json.msg,
                      type: "error",
                      showConfirmButton: true
                    });
                }
            },'json');
            return false;
        });
    });


   $(function(){
    
      // add drugs
        $(document).on('submit', "#drug_form", function() {
            $.post($('#drug_form').attr('action'), $('#drug_form').serialize(), function(json){
                if (json.st == 1) {
                  $('.ajax_drug').html(json.data);
                  $('#drugModal').modal('hide');
                  $('.select2').select2();
                    // $('#prescription_form')[0].reset();
                }
            },'json');
            return false;
        });


        $(document).on('change', "#patients", function() {
          $(".patient_error_text").hide();
        });

        $(document).on('change', ".drugs", function() {
          $(".drug_error_text").hide();
        });


        $(document).on('submit', "#prescription_form", function() {

            var patient = $('#patients').val();
            var drugs = $('.drugs').val();

            if (patient == '' && drugs == '') {
              $(".patient_error_text").show();
              $(".drug_error_text").show();
              return false;
            }
            if (patient == '') {
              $(".patient_error_text").show();
              return false;
            }
            if (drugs == '') {
              $(".drug_error_text").show();
              return false;
            }

            $('.patient_form_section').hide();
            $('.loader').html(loading_html).show();
            $.post($('#prescription_form').attr('action'), $('#prescription_form').serialize(), function(json){
                if (json.st == 1) {
                  $('.loader').hide();  
                  $('.prescription_preview').html(json.data).show();
                }
            },'json');
            return false;
        });


        $(document).on('submit', "#preview", function() {
            
            $('.loader').html(loading_html).show();
            $('.patient_form_section, .add_area, .alert').hide();

            $.post($('#preview').attr('action'), $('#preview').serialize(), function(json){
                if (json.st == 1) {
                    
                  $.toast({
                    heading: msg_success,
                    text: msg_prescription_created_successfully,
                    position: 'top-right',
                    loaderBg:'#fff',
                    icon: 'success',
                    hideAfter: 8000
                  });

                  $('.loader').hide();
                  $('.prescription_preview').html(json.data).show();
                    //printDiv('print_area');
                }
            },'json');
            return false;
        });
    });


   $(function(){
      $(document).on('click', '.prescription_edit', function(event) {
        event.preventDefault();
        $('.patient_form_section').show();
        $('.prescription_preview').hide();
      });
   });


    $(document).on('click', ".delete_item", function() {

        var del_url = $(this).attr('href');
        var Id = $(this).attr('data-id');


            swal({
              title: msg_are_you_sure,
              text: msg_not_recover_file,
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: msg_yes,
              closeOnConfirm: false
            },
            function(){ 

                $.post(del_url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
                    if(json.st == 1){     
                        swal({
                          title: msg_success,
                          text: msg_del_success,
                          type: "success",
                          showCancelButton: false
                        }),                
                        $("#row_"+Id).slideUp();
                    }
                },'json');

            });

        return false;

    });


    $(document).on('click', ".start_meeting", function() {

        var action_url = $(this).attr('href');

            swal({
              title: msg_are_you_sure,
              text: 'After clicking the start button your patient will see the joining button for this consultation, Before start a meeting you can send a notify email to your patient to clicking the notify button in actions tab',
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#28a745",
              confirmButtonText: msg_yes_start,
              closeOnConfirm: false
            },   
              function(){              
               window.location = action_url;
            });

        return false;

    });


    $(document).on('click', ".create_meeting", function() {

        var action_url = $(this).attr('href');

            swal({
              title: msg_are_you_sure,
              text: 'Create a zoom meeting for this consultation',
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#28a745",
              confirmButtonText: msg_yes,
              closeOnConfirm: false
            },   
              function(){              
               window.location = action_url;
            });

        return false;

    });


    $(document).on('click', ".confirm_verify", function() {

        var action_url = $(this).attr('href');

            swal({
              title: msg_are_you_sure,
              text: 'I have checked and want to mark as verified for this account',
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#28a745",
              confirmButtonText: msg_yes,
              closeOnConfirm: false
            },   
              function(){              
               window.location = action_url;
            });

        return false;

    });


    $(document).on('click', ".primary_item", function() {

        var action_url = $(this).attr('href');

            swal({
              title: msg_are_you_sure,
              text: msg_set_this_chamber_default,
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: msg_yes,
              closeOnConfirm: false
            },
            function(){ 

                $.post(action_url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
                    if(json.st == 1){     
                        swal({
                          title: msg_success,
                          text: msg_added_successfully,
                          type: "success",
                          showCancelButton: false
                        },   
                          function(){              
                           window.location.reload();
                        });
                    }
                },'json');

            });

        return false;

    });



    $(document).on('click', ".cancel_serial", function() {

        var del_url = $(this).attr('href');
        var imgId = $(this).attr('data-id');


            swal({
              title: msg_are_you_sure,
              text: msg_cancel_this_user_serial,
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: msg_yes,
              closeOnConfirm: false
            },
            function(){ 

                $.post(del_url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
                    if(json.st == 1){     
                        swal({
                          title: msg_success,
                          text: msg_serial_cancel_success,
                          type: "success",
                          showCancelButton: false
                        }),                
                        $("#row_"+imgId).slideUp();
                    }
                },'json');

            });

        return false;

    });
    
    


    $(document).on('click', ".change_pass", function() {
        $('.change_password_area').slideDown();
        $('.edit_account_area').hide();
        $("html, body").animate({ scrollTop: 200 }, "slow");
        return false;
    });

    $(document).on('click', ".cancel_pass", function() {
        $('.change_password_area').hide();
        $('.edit_account_area').slideDown();
        return false;
    });


$(function(){
    var wrapper = $(".input_fields_wrap"); //Fields wrapper
    var x = $(".total_item").val(); 
    $(document).on("click",'.add_field_button', function(e){
        e.preventDefault();
        var url = base_url+'admin/prescription/add_fields/'+x;
        $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
           if(json.st == 1){
                 x++;
                $(wrapper).append(json.data); 
                 $('.select2').select2();
            }
        }, 'json' );
      return false; 
    });
    
    $(wrapper).on("click",".remove_field", function(e){ 
        e.preventDefault();
        var id = $(this).attr('data-id');
        $('.hide_'+id).remove();
        x--;
    });

    $(document).on("click",".remove_field_group", function(e){ 
        e.preventDefault();
        var id = $(this).attr('data-id');
        $('#load_hide_id').append('<input type="hidden" name="hide[]" value="'+id+'">');
        $('#group_'+id).hide();
    });

});


$(function(){
    var y = 1; 
    $(document).on("click",'.add_increase_button', function(e){
      y++;
      var in_id = $(this).data('id');
      //alert(in_id);
        e.preventDefault();
         $('.drug_details_increase_field_'+in_id).append(`<div class="row hide_increase_${y}"> 
          <div class="form-group col-sm-4">
              <div class="d_flex_input">
                <select name="time_periods${in_id}[]" class="form-control" id="">
                  <option value=""></option>
                  <option value="0">0 </option>
                  <option value="½">½ </option>
                  <option value="1">1 </option>
                  <option value="2">2 </option>
                  <option value="3">3</option>
                  <option value="4">4 </option>
                </select>

                <select name="time_periods${in_id}[]" class="form-control" id="">
                  <option value=""></option>
                  <option value="0">0 </option>
                  <option value="½">½ </option>
                  <option value="1">1 </option>
                  <option value="2">2 </option>
                  <option value="3">3</option>
                  <option value="4">4 </option>
                </select>

                <select name="time_periods${in_id}[]" class="form-control" id="">
                  <option value=""></option>
                  <option value="0">0 </option>
                  <option value="½">½ </option>
                  <option value="1">1 </option>
                  <option value="2">2 </option>
                  <option value="3">3</option>
                  <option value="4">4 </option>
                </select>

                <select name="time_periods${in_id}[]" class="form-control" id="">
                  <option value=""></option>
                  <option value="0">0 </option>
                  <option value="½">½ </option>
                  <option value="1">1 </option>
                  <option value="2">2 </option>
                  <option value="3">3</option>
                  <option value="4">4 </option>
                </select>
              </div>
          </div>

          <div class="form-group col-sm-3">
            <div class="d_flex">

              <select name="duration_text${in_id}[]" class="form-control" id="" aria-invalid="false">
                  <option value="">Select</option>
                  <option value="1">1 </option>
                  <option value="2">2 </option>
                  <option value="3">3 </option>
                  <option value="4">4 </option>
                  <option value="5">5 </option>
                  <option value="6">6 </option>
                  <option value="7">7 </option>
                  <option value="8">8 </option>
                  <option value="9">9 </option>
                  <option value="10">10 </option>
                  <option value="11">11 </option>
                  <option value="12">12 </option>
                  <option value="13">13 </option>
                  <option value="14">14 </option>
                  <option value="15">15 </option>
                  <option value="16">16 </option>
                  <option value="17">17 </option>
                  <option value="18">18 </option>
                  <option value="19">19 </option>
                  <option value="20">20 </option>
                  <option value="21">21 </option>
                  <option value="22">22 </option>
                  <option value="23">23 </option>
                  <option value="24">24 </option>
                  <option value="25">25 </option>
                  <option value="26">26 </option>
                  <option value="27">27 </option>
                  <option value="28">28 </option>
                  <option value="29">29 </option>
                  <option value="30">30 </option>
              </select>

              <select name="duration${in_id}[]" class="form-control" id="">
                <option value="">`+msg_time+`</option>
                <option value="Continue">`+msg_continue+` </option>
                <option value="Day">`+msg_day+` </option>
                <option value="Month">`+msg_month+`</option>
                <option value="Year">`+msg_year+` </option>
              </select>
            </div>
          </div>

          <div class="form-group col-sm-2">
            <select name="medicine_time${in_id}[]" class="form-control" id="">
              <option value="">`+msg_beforeafter_meals+`</option>
              <option value="After Meal">`+msg_after_meal+`</option>
              <option value="Before Meal">`+msg_before_meal+`</option>
            </select>
          </div>

          <div class="form-group col-sm-3">
            <div class="d_flex">
              <input type="text" name="note${in_id}[]" class="form-control" placeholder="`+msg_enter_note+`">
              <button  class="btn btn-light-danger remove_increase_field" data-id='${y}'><i class="fa fa-close"></i></button>
            </div>
          </div>
      </div><!-- row -->`); 
    });
    
    $(document).on("click",".remove_increase_field", function(e){ 
        e.preventDefault();
        var id = $(this).attr('data-id');
        $('.hide_increase_'+id).remove();
        y--;
    });

});

$(document).on("click",".remove_this_row", function(e){ 
    e.preventDefault();
    var id = $(this).attr('data-id');
    $('#row_'+id).remove();
});


$(function(){
     $(document).on("click", '.print_apn_list',function () {
        $('.hide_pnt').hide();
        printDiv('print_area');
        $('.hide_pnt').show();
      });
});

$(function(){
     $(document).on("click", '.print_prescription',function () {
      
        printDiv('print_area');
      });
});


$(function(){
    $(document).on("click", '.print_btn',function () {
        printDiv('print_area');
    });
});

function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}

});