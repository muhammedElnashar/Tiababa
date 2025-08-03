(function ($) {
  "use strict";

  var loading_html =
    '<div class="container text-center" style="padding: 200px"><div class="spinner-md"></div></div>';
  var loader_md =
    '<div class="container text-center" style="padding: 100px"><div class="spinner-md"></div></div>';
  var loader_btn =
    '<div class="spinners"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>';
  var base_url = $("#base_url").val();

  var success = $("#success").val();
  var error = $("#error").val();

  var msg_opps = $(".msg_opps").val();
  var msg_error = $(".msg_error").val();
  var msg_success = $(".msg_success").val();
  var msg_sorry = $(".msg_sorry").val();
  var msg_yes = $(".msg_yes").val();
  var msg_congratulations = $(".msg_congratulations").val();
  var msg_something_wrong = $(".msg_something_wrong").val();
  var msg_try_again = $(".msg_try_again").val();
  var msg_password_reset_success_msg = $(
    ".msg_password_reset_success_msg"
  ).val();
  var msg_confirm_pass_not_match_msg = $(
    ".msg_confirm_pass_not_match_msg"
  ).val();
  var msg_old_password_doesnt_match = $(".msg_old_password_doesnt_match").val();
  var msg_inserted = $(".msg_inserted").val();
  var msg_made_changes_not_saved = $(".msg_made_changes_not_saved").val();
  var msg_no_data_founds = $(".msg_no_data_founds").val();
  var msg_del_success = $(".msg_del_success").val();
  var msg_account_suspend_msg = $(".msg_account_suspend_msg").val();
  var msg_are_you_sure = $(".msg_are_you_sure").val();
  var msg_get_started = $(".msg_get_started").val();
  var msg_not_recover_file = $(".msg_not_recover_file").val();
  var msg_deleted_successfully = $(".msg_deleted_successfully").val();
  var msg_data_limit_over = $(".msg_data_limit_over").val();
  var msg_email_exist = $(".msg_email_exist").val();
  var msg_recaptcha_is_required = $(".msg_recaptcha_is_required").val();
  var msg_not_active = $(".msg_not_active").val();
  var msg_signin = $(".msg_signin").val();
  var msg_signing_in = $(".msg_signing_in").val();
  var msg_wrong_access = $(".msg_wrong_access").val();
  var msg_email_not_verified = $(".msg_email_not_verified").val();
  var msg_pass_sent_email = $(".msg_pass_sent_email").val();
  var msg_pass_reset_succ = $(".msg_pass_reset_succ").val();
  var msg_not_valid_user = $(".msg_not_valid_user").val();

  var msg_apptype_is_required = $(".msg_apptype_is_required").val();
  var msg_booking_date_required = $(".msg_booking_date_required").val();
  var msg_booking_time_required = $(".msg_booking_time_required").val();
  var msg_processing = $(".msg_processing").val();
  var msg_app_booked_successfully = $(".msg_app_booked_successfully").val();
  var msg_book_appointment = $(".msg_book_appointment").val();
  var msg_enter_valid_date = $(".msg_enter_valid_date").val();
  var msg_registared_successfully = $(".msg_registared_successfully").val();
  var msg_preparing_environment = $(".msg_preparing_environment").val();
  var msg_email_resend_successfully = $(".msg_email_resend_successfully").val();
  var msg_signing_in = $(".msg_signing_in").val();
  var msg_register = $(".msg_register").val();
  var msg_your_accoun_verified_successfully = $(
    ".msg_your_accoun_verified_successfully"
  ).val();
  var msg_verify_code_is_not_matched = $(
    ".msg_verify_code_is_not_matched"
  ).val();

  var needToConfirm = false;
  var form_original_data = $(".leave_con").serialize();

  $('[data-toggle="tooltip"]').tooltip();

  $(".checkItem").on("click", function () {
    if ($(".checkItem").is(":checked")) {
      $(".multiple_delete_btn").show();
    } else {
      $(".multiple_delete_btn").hide();
    }
  });

  $("body").on("click", ".time_btn", function () {
    $(".time_btn").removeClass("active");
    $(this).addClass("active");
  });

  $(document).ready(function () {
    AOS.init();

    if ($("#success").val()) {
      $.toast({
        heading: msg_success,
        text: success,
        position: "top-right",
        loaderBg: "#fff",
        icon: "success",
        hideAfter: 4500,
      });
    }

    if ($("#error").val()) {
      $.toast({
        heading: msg_error,
        text: error,
        position: "top-right",
        loaderBg: "#fff",
        icon: "error",
        hideAfter: 4500,
      });
    }

    $("#status").fadeOut();
    $("#preloader").delay(350).fadeOut("slow");
    $("body").delay(350).css({ overflow: "visible" });
    $(".log_alert").delay(2000).slideUp();
  });

  $(".agree_btn").on("click", function () {
    if ($(".agree_btn").is(":checked")) {
      $(".submit_btn").prop("disabled", false);
    } else {
      $(".submit_btn").prop("disabled", true);
    }
  });

  $(".click_new").on("click", function () {
    $(".check_patient").val(0);
  });

  $(".click_old").on("click", function () {
    $(".check_patient").val(1);
  });

  $(".custom-btngp").on("click", function () {
    var priceVal = $(this).find(".switch_price").val();

    if (priceVal == "monthly") {
      $(".monthly_price").show();
      $(".yearly_price").hide();
      $(".billing_type").val("monthly");
    } else {
      $(".yearly_price").show();
      $(".monthly_price").hide();
      $(".billing_type").val("yearly");
    }
  });

  $(document).on("click", ".package_btn", function () {
    var billType = $(".billing_type").val();
    var url = $(this).attr("href") + "&billing=" + billType;
    window.location.href = url;
    return false;
  });

  $(".confirm_step").on("click", function () {
    if (!$("#app_type").val()) {
      $(".error")
        .show()
        .html(
          '<i class="fa fa-exclamation-circle"></i> ' + msg_apptype_is_required
        );
      return false;
    } else {
      $(".error").hide();
    }

    if (!$("#datepicker").val()) {
      $(".error")
        .show()
        .html(
          '<i class="fa fa-exclamation-circle"></i> ' +
            msg_booking_date_required
        );
      return false;
    } else {
      $(".error").hide();
    }

    if (!$(".time_inp").is(":checked")) {
      $(".error")
        .show()
        .html(
          '<i class="fa fa-exclamation-circle"></i> ' +
            msg_booking_time_required
        );
      return false;
    } else {
      $(".error").hide();
    }

    $(".step1").hide();
    $(".step2").fadeIn();
    return false;
  });

  $(".back_step").on("click", function () {
    $(".step1").fadeIn();
    $(".step2").hide();
    return false;
  });

  $(document).on("submit", "#booking_form", function () {
    $(".booking_btn").html(
      '<span class="spinner-border spinner-border-sm"></span> &nbsp; ' +
        msg_processing
    );
    $(".booking_btn").prop("disabled", true);
    $.post(
      $("#booking_form").attr("action"),
      $("#booking_form").serialize(),
      function (json) {
        if (json.st == 1) {
          $(".error").hide();
          $(".success").html(
            '<i class="fa fa-check-circle"></i> ' + msg_app_booked_successfully
          );
          window.location = json.url;
        } else if (json.st == 0) {
          $(".booking_btn").prop("disabled", false);
          $(".booking_btn").html(
            '<i class="fas fa-calendar-check"></i> ' + msg_book_appointment
          );
          $(".error")
            .show()
            .html(
              '<i class="fa fa-exclamation-circle"></i> ' + msg_wrong_access
            );
        } else if (json.st == 2) {
          $(".step1").show();
          $(".step2").hide();
          $(".booking_btn").prop("disabled", false);
          $(".booking_btn").html(
            '<i class="fas fa-calendar-check"></i> ' + msg_book_appointment
          );
          $(".error")
            .show()
            .html('<i class="icon-exclamation"></i> Please enter a valid date');
        } else if (json.st == 3) {
          $(".booking_btn").prop("disabled", false);
          $(".booking_btn").html(
            '<i class="fas fa-calendar-check"></i> ' + msg_book_appointment
          );
          $(".error")
            .show()
            .html('<i class="icon-exclamation"></i> ' + json.error);
        } else if (json.st == 4) {
          $(".booking_btn").prop("disabled", false);
          $(".booking_btn").html(
            '<i class="fas fa-calendar-check"></i> ' + msg_book_appointment
          );
          $(".error")
            .show()
            .html(
              '<i class="icon-exclamation"></i> ' + msg_recaptcha_is_required
            );
        } else if (json.st == 5) {
          $(".booking_btn").prop("disabled", false);
          $(".booking_btn").html(
            '<i class="fas fa-calendar-check"></i> ' + msg_book_appointment
          );
          $(".error")
            .show()
            .html('<i class="icon-exclamation"></i> ' + json.msg);
        }
      },
      "json"
    );
    return false;
  });

  $(document).on("submit", "#login-form", function () {
    $(".signin_btn").html(
      '<span class="spinner-border spinner-border-sm"></span> &nbsp; ' +
        msg_signing_in
    );
    $(".signin_btn").prop("disabled", true);
    $.post(
      $("#login-form").attr("action"),
      $("#login-form").serialize(),
      function (json) {
        if (json.st == 1) {
          window.location = json.url;
        } else if (json.st == 0) {
          $(".signin_btn").prop("disabled", false);
          $(".signin_btn").html(msg_signin);
          $(".error").html(
            '<i class="fa fa-exclamation-circle"></i> ' + msg_wrong_access
          );
          $("#login_pass").val("");
        } else if (json.st == 2) {
          $(".signin_btn").prop("disabled", false);
          $(".signin_btn").html(msg_signin);
          $(".error").html(
            '<i class="icon-exclamation"></i> ' + msg_not_active
          );
        } else if (json.st == 3) {
          $(".signin_btn").prop("disabled", false);
          $(".signin_btn").html(msg_signin);
          $(".error").html(
            '<i class="fa fa-ban"></i> ' + msg_account_suspend_msg
          );
        } else if (json.st == 4) {
          $(".signin_btn").prop("disabled", false);
          $(".signin_btn").html(msg_signin);
          $(".error").html(
            '<i class="fa exclamation-circle"></i> ' + msg_email_not_verified
          );
        }
      },
      "json"
    );
    return false;
  });

  $(function () {
    $(document).on("submit", "#register_form", function () {
      $(".register_button").html(
        '<span class="spinner-border spinner-border-sm"></span> &nbsp; ' +
          msg_processing
      );
      $(".register_button").prop("disabled", true);
      $.post(
        $("#register_form").attr("action"),
        $("#register_form").serialize(),
        function (json) {
          if (json.st == 1) {
            $(".error").hide();
            $(".success").html(
              `<i class="fa fa-check"></i> ` +
                msg_registared_successfully +
                ` <br> 
                      <span class="spinner-border spinner-border-sm"></span> ` +
                msg_preparing_environment
            );

            setTimeout(function () {
              window.location.href = json.url;
            }, 3500);
          } else if (json.st == 2) {
            $(".register_button").prop("disabled", false);
            $(".register_button").html(msg_register);
            $(".error").html(
              '<i class="icon-exclamation"></i> ' + msg_email_exist
            );
          } else if (json.st == 3) {
            $(".register_button").prop("disabled", false);
            $(".register_button").html(msg_register);
            $(".error").html(
              '<i class="icon-exclamation"></i> ' + msg_recaptcha_is_required
            );
          } else {
            $(".register_button").prop("disabled", false);
            $(".register_button").html(msg_register);
            $("#register_form")[0].reset();
            $(".error").html('<i class="icon-exclamation"></i> ' + json.msg);
          }
        },
        "json"
      );
      return false;
    });
  });

  $(document).on("click", ".resend_mail", function () {
    var url = $(this).attr("href");

    $(".loader").show();
    $.post(
      url,
      { data: "value", csrf_test_name: csrf_token },
      function (json) {
        if (json.st == 1) {
          $(".loader").hide();
          swal({
            title: msg_success,
            text: msg_email_resend_successfully,
            type: "success",
            showConfirmButton: true,
          });
        } else {
          $(".loader").html(msg_something_wrong);
        }
      },
      "json"
    );
    return false;
  });

  //recover password form
  $(document).on("submit", "#lost-form", function () {
    $.post(
      $("#lost-form").attr("action"),
      $("#lost-form").serialize(),
      function (json) {
        if (json.st == 1) {
          swal(
            {
              title: msg_pass_reset_succ,
              text: msg_pass_sent_email,
              type: "success",
              showConfirmButton: true,
            },
            function () {
              window.location = json.url;
            }
          );
        } else {
          swal({
            title: msg_sorry,
            text: msg_not_valid_user,
            type: "error",
            confirmButtonText: msg_try_again,
          });
        }
      },
      "json"
    );
    return false;
  });

  //recover password form
  $(document).on("submit", "#verify_from", function () {
    $(".verify_btn").html(loader_btn); // تغيير شكل الزر أثناء التحميل

    $.post(
        $("#verify_from").attr("action"),
        $("#verify_from").serialize(),
        function (json) {
          console.log(json); // 🔍 لمراقبة البيانات القادمة من السيرفر

          if (json.st == 1) {
            swal(
                {
                  title: msg_success,
                  text: msg_your_accoun_verified_successfully,
                  type: "success",
                  showConfirmButton: true,
                },
                function () {
                  window.location = json.url;
                }
            );
          } else if (json.st == 2) {

            $(".verify_btn").html(
                '<i class="ficon flaticon-check"></i> ' + (typeof msg_verify_code !== 'undefined' ? msg_verify_code : "تحقق من الكود")
            );

            swal({
              title: typeof msg_error !== 'undefined' ? msg_error : "خطأ!",
              text: typeof msg_verify_code_is_not_matched !== 'undefined' ? msg_verify_code_is_not_matched : "كود التحقق غير متطابق",
              type: "error",
              confirmButtonText: typeof msg_try_again !== 'undefined' ? msg_try_again : "حاول مرة أخرى",
            });
          }
        },
        "json"
    );

    return false;
  });

  $(document).on("click", ".forgot_pass", function () {
    $("#login-area").hide();
    $("#forgot-area").show();
  });

  $(document).on("click", ".back_login", function () {
    $("#login-area").show();
    $("#forgot-area").hide();
  });

  $(document).on("click", ".package_btn", function () {
    form_original_data = $(".leave_con").serialize();
    var billType = $(".billing_type").val();
    var url = $(this).attr("href") + "/" + billType;

    $(".pricing_area").hide();
    $(".loader").html(loading_html);
    $.post(
      url,
      { data: "value", csrf_test_name: csrf_token },
      function (json) {
        if (json.st == 1) {
          window.location.href = json.url;
        } else {
          $(".pricing_area").show();
        }
      },
      "json"
    );
    return false;
  });

  $(function () {
    $(document).on("submit", "#business_form", function () {
      form_original_data = $(".leave_con").serialize();

      $.post(
        $("#business_form").attr("action"),
        $("#business_form").serialize(),
        function (json) {
          if (json.st == 1) {
            $("#business_form")[0].reset();
            $(".account_area").hide();
            $(".business_area").hide();
            $(".step_3").addClass("active");
            $(".pricing_area").show();
          } else if (json.st == 3) {
            window.location.href = base_url + "admin/dashboard/business";
          } else {
            $("#register_form")[0].reset();
            swal({
              title: msg_error,
              text: json.st,
              type: "error",
              showConfirmButton: true,
            });
          }
        },
        "json"
      );
      return false;
    });
  });

  $(function () {
    $(document).on("submit", "#cahage_pass_form", function () {
      $.post(
        $("#cahage_pass_form").attr("action"),
        $("#cahage_pass_form").serialize(),
        function (json) {
          if (json.st == 1) {
            $("#cahage_pass_form")[0].reset();
            swal({
              title: msg_congratulations,
              text: msg_password_reset_success_msg,
              type: "success",
              showConfirmButton: true,
            });
          } else if (json.st == 2) {
            $("#cahage_pass_form")[0].reset();
            swal({
              title: msg_opps,
              text: msg_confirm_pass_not_match_msg,
              type: "error",
              showConfirmButton: true,
            });
          } else {
            $("#cahage_pass_form")[0].reset();
            swal({
              title: msg_error,
              text: msg_old_password_doesnt_match,
              type: "error",
              showConfirmButton: true,
            });
          }
        },
        "json"
      );
      return false;
    });
  });

  $(document).on("change", ".sort_department", function () {
    $(".sort_form").submit();
  });

  $(document).on("change", ".sort_experience", function () {
    $(".sort_form").submit();
  });

  $(document).on("click", ".add_btn", function () {
    $(".add_area").show();
    $(".list_area").hide();
    return false;
  });

  $(document).on("click", ".cancel_btn", function () {
    $(".add_area").hide();
    $(".list_area").show();
    return false;
  });

  $(document).on("click", ".change_pass", function () {
    $(".change_password_area").slideDown();
    $(".edit_account_area").hide();
    $("html, body").animate({ scrollTop: 200 }, "slow");
    return false;
  });

  $(document).on("click", ".cancel_pass", function () {
    $(".change_password_area").hide();
    $(".edit_account_area").slideDown();
    return false;
  });

  $(window).on("bind", "beforeunload", function (e) {
    if ($(".leave_con").serialize() != form_original_data) {
      var needToConfirm = true;
    }
    if (needToConfirm) return msg_made_changes_not_saved;
    else e = null; // i.e; if form state change show warning box, else don't show it.
  });
})(jQuery);
