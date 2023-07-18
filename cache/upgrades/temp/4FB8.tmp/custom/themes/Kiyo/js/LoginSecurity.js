/*********************************************************************************
 * This file is part of package Login Security.
 * 
 * Author : Variance InfoTech PVT LTD (http://www.varianceinfotech.com)
 * All rights (c) 2022 by Variance InfoTech PVT LTD
 *
 * This Version of Login Security is licensed software and may only be used in 
 * alignment with the License Agreement received with this Software.
 * This Software is copyrighted and may not be further distributed without
 * written consent of Variance InfoTech PVT LTD
 * 
 * You can contact via email at info@varianceinfotech.com
 * 
 ********************************************************************************/
$('input[name="Login"]').attr("onclick","customLoginSecurity()");
$('#resendOtp').attr('onclick', "customLoginSecurity()");
$('input[name="continue"]').attr("onclick","customLoginContinue()");

function customLoginSecurity(){
  var randNum = Math.floor(1000 + Math.random() * 9000);
  $('#popup-loading').show();
  var userName = $('#user_name').val();
  var userPassword = $('#username_password').val();
  if(userName != "" && userPassword != ""){
    $.ajax({
      url: "index.php?entryPoint=LoginSecurityAddOTPEntryDetails",
      type: "post",
      data: {userName : userName,
        usernamePassword : userPassword,
        randNum : randNum},
      success: function (response){
        $('#popup-loading').hide();
        var data = JSON.parse(response);
        if((data.ipStatus == 0 && data.otpStatus == 0) ){
          alert(data.validationMsg);
        }else if(data.ipStatus == 1 && data.otpStatus == 0){
          alert(LBL_VALID_EMAIL_ADDRESS);
        }else if(data.ipStatus == 1 && data.otpStatus == 1){
          $('#user_name').attr('disabled', true);
          $('#username_password').attr('disabled', true);
          $('input[name="Login"]').attr('disabled', true);
          timer(120);
          $('#otpRow').css('display', 'block');
          $('input[name="continue"]').css('display', 'block');  
        }else if((data.ipStatus == 1 && data.otpStatus == 2) || (data.ipStatus == 2 && data.otpStatus == 0)){
          $('input[name="Login"]').removeAttr("onclick","customLoginSecurity('Login')");
          $('input[name="Login"]').attr('type', 'submit');
          $('input[name="Login"]').click(); 
        }
      }
    });
  }else{
    $('#popup-loading').hide();
    alert(LBL_VALID_CREDENTIALS);
  }
}//end of function

function customLoginContinue(){
  $('#popup-loading').show();
  var otp = $('#otp').val();
  var userName = $('#user_name').val();
  var usernamePassword = $('#username_password').val();
  if(otp != ""){
    $.ajax({
      url: "index.php?entryPoint=LoginSecurityCheckLoginStatus",
      type: "post",
      data: {userName : userName,
        usernamePassword : usernamePassword,
        otp : otp},
      success: function (response){
        $('#popup-loading').hide();
        var data = JSON.parse(response);
        if(data.status == 1){
          $('#user_name').attr('disabled', false);
          $('#username_password').attr('disabled', false);
          $('input[name="continue"]').removeAttr("onclick","continue()");
          $('input[name="continue"]').attr('type', 'submit');
          $('input[name="continue"]').click();
        }else if(data.status == 0){
          alert(LBL_OTP_EXPIRED);
          $('#resendOtp').css('display', 'block');
        }else if(data.status == 2){
          alert(LBL_WRONG_OTP);
          $('#otp').val('');
        }
      }
    });
  }else{
   $('#popup-loading').hide();
    alert(LBL_VALID_OTP);
  }
}//end of function
  
var obj = document.getElementById('otp');
obj.addEventListener('keydown', stopCarret); 
obj.addEventListener('keyup', stopCarret); 

function stopCarret() {
  if (obj.value.length > 3){
    setCaretPosition(obj, 4);
  }
}//end of function

function setCaretPosition(elem, caretPos) {
  if(elem != null) {
    if(elem.createTextRange) {
      var range = elem.createTextRange();
      range.move('character', caretPos);
      range.select();
    } else {
      if(elem.selectionStart) {
        elem.focus();
        elem.setSelectionRange(caretPos, caretPos);
      }else{
        elem.focus();
      }
    }
  }
}//end of function

let timerOn = true;
function timer(remaining) {
  var minute = Math.floor(remaining / 60);
  var second = remaining % 60;
  
  minute = minute < 10 ? '0' + minute : minute;
  second = second < 10 ? '0' + second : second;
  document.getElementById('timer').innerHTML = minute + ':' + second;
  remaining -= 1;
  
  if(remaining >= 0 && timerOn) {
    setTimeout(function() {
      timer(remaining);
    }, 1000);
    $('input[name="continue"]').css('display', 'block');
    $('#resendOtp').css('display', 'none');
    
    return;
  }

  if(!timerOn) {
    // Do validate stuff here
    return;
  }
  
  // Do timeout stuff here
  $('input[name="continue"]').css('display', 'none');
  $('#resendOtp').css('display', 'block');
  $('#otp').val('');
}//end of function