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
var wizardCurrentStep = $('.nav-steps.selected').attr('data-nav-step');
if(wizardCurrentStep == 1){
    $('#btnSave').hide();
    $('#btnBack').hide();
}

if(recordId != ""){
    if(ipBlockingData.ipBlockingType == "Specific Ip"){
        if(ipBlockingData.usersTypeIpBlocking == "All Users"){
            specificIpAllUsersHtml(ipBlockingData.ipBlockingType, ipBlockingData.allowIpAddresses, ipBlockingData.denyIpAddresses);
        }else if(ipBlockingData.usersTypeIpBlocking == "Specific Group or User"){
            $('#specificGroupsUsersRow').css('display', 'contents');
           
            specificGroupUsers(ipBlockingData.users);
            specificIpSelUsersHtml(ipBlockingData.ipBlockingType, ipBlockingData.allowIpAddresses, ipBlockingData.denyIpAddresses);
        }
    }else if(ipBlockingData.ipBlockingType == "All Range"){
        var allowIpAddress = ipBlockingData.allowIpAddresses;
        var allowFromIpAddress = allowIpAddress.split('-')[0];
        var allowToIpAddress = allowIpAddress.split('-')[1];
        
        var denyIpAddress = ipBlockingData.denyIpAddresses;
        var denyFromIpAddress = denyIpAddress.split('-')[0];
        var denyToIpAddress = denyIpAddress.split('-')[1];
        if(ipBlockingData.usersTypeIpBlocking == "All Users"){
            allRangeAllUserHtml(ipBlockingData.ipBlockingType, allowFromIpAddress, allowToIpAddress, denyFromIpAddress, denyToIpAddress);
        }else if(ipBlockingData.usersTypeIpBlocking == "Specific Group or User"){
            $('#specificGroupsUsersRow').css('display', 'contents');
            specificGroupUsers(ipBlockingData.users);
            allRangeSelUsersHtml(ipBlockingData.ipBlockingType, allowFromIpAddress, allowToIpAddress, denyFromIpAddress, denyToIpAddress);
        }   
    }else if(ipBlockingData.ipBlockingType == "Comma Separated"){
        if(ipBlockingData.usersTypeIpBlocking == "All Users"){
            commaSeparatedAllUsersHtml(ipBlockingData.ipBlockingType, ipBlockingData.allowIpAddresses, ipBlockingData.denyIpAddresses);
        }else if(ipBlockingData.usersTypeIpBlocking == "Specific Group or User"){
            $('#specificGroupsUsersRow').css('display', 'contents');
            specificGroupUsers(ipBlockingData.users);
            commaSeparatedSelUsersHtml(ipBlockingData.ipBlockingType, ipBlockingData.allowIpAddresses, ipBlockingData.denyIpAddresses);
        }
    }
}//end of function

//Click Event for Next and Select Template
$('#btnNext, #navStep2').on('click', function(){
    var wizardCurrentStep = $('.nav-steps.selected').attr('data-nav-step');
    if(wizardCurrentStep == 1){
        var blockingType = $('#blockingType').val();
        var ipBlockingUserType = $('#ipBlockingUserType').val();
        var status = $('#status').val();
        var flag = 1;
        if(blockingType != "" || ipBlockingUserType != ""){
            if(blockingType == "Specific Ip"){
               if(ipBlockingUserType == "Specific Group or User"){
                    var specificGroupsUsers = $('#specificGroupsUsers').val();
                    var allowSelUsersSecificIp = $('#allowSelUsersSecificIp').val();
                    var denySelUsersSecificIp = $('#denySelUsersSecificIp').val();
                    if((specificGroupsUsers == null || specificGroupsUsers == "")){
                        flag = 0;
                    }
                }
            }else if(blockingType == "All Range"){
                if(ipBlockingUserType == "Specific Group or User"){
                    var specificGroupsUsers = $('#specificGroupsUsers').val();
                    if((specificGroupsUsers == null || specificGroupsUsers == "")){
                        flag = 0;
                    }
                }
            }else if(blockingType == "Comma Separated"){
                if(ipBlockingUserType == "Specific Group or User"){
                    var specificGroupsUsers = $('#specificGroupsUsers').val();
                    if((specificGroupsUsers == null || specificGroupsUsers == "")){
                        flag = 0;
                    }
                }
            }
        }else{
            flag = 0;
        }
        
        if(flag == 1){
            $('#step1').css("display","none");
            $('#step2').css("display","block");      
            $('#navStep1').removeClass('selected');
            $('#navStep2').addClass('selected');    
            $('#btnBack, #btnSave').show();
            $('#btnNext').hide();
            $('#btnCancel').css('margin-left','20px');
        }else{
            alert(SUGAR.language.get('Administration','LBL_REQUIRE_FIELD'));
        } 
    }//end of if
    
    if(recordId != ""){
        if(otpBasedData.enableOtpBased == 1){
            $('#otpTypeRow').css('display', 'table-row');
            setDisplayOtpType(otpBasedData.otpType);
        }
        if(otpBasedData.smsTrigger == "Days"){
            $('#daysRow').css('display', 'table-row');
        }else if(otpBasedData.smsTrigger == "Minutes"){
            $('#minutesRow').css('display', 'table-row');
            $('#daysRow').css('display', 'none');
        }else{
            $('#daysRow').css('display', 'none');
            $('#minutesRow').css('display', 'none');
        }
    }//end of if
});//end of function

//Click Event for Back Button
$('#btnBack, #navStep1').on('click', function(){
    var wizardCurrentStep = $('.nav-steps.selected').attr('data-nav-step');
    if(wizardCurrentStep == 2){
        $('#btnSave, #btnBack, #step2').hide();
        $('#navStep1').addClass('selected');
        $('#btnNext, #step1').show();
        $('#navStep2').removeClass('selected');
        $('#btnCancel').css('margin-left','0px');
    }
});//end of function

//Click Event for Cancel 
$('#btnCancel').on('click', function(){
    window.location.href = "index.php?module=Administration&action=loginsecuritylistview";
});//end of function

$('#blockingType').on('change', function(){
    $('#ipBlockingUserType').find('option[value=""]').prop('selected', true);
    $('#allowUsersRow, #denyUsersRow, #specificGroupsUsersRow').css('display', 'none');
});//end of function

$('#ipBlockingUserType').on('change', function(){
    var ipBlockingUserType = $(this).val();
    if(ipBlockingUserType == "Specific Group or User"){
        specificGroupUsers('');
    }else{
        $('#specificGroupsUsersRow').css('display', 'none');
    }
    var blockingType = $('#blockingType').val();
    if(blockingType == "Specific Ip"){
        if($(this).val() == "All Users"){
            specificIpAllUsersHtml(blockingType, '', '');
        }else if(ipBlockingUserType == "Specific Group or User"){
            $('#specificGroupsUsersRow').css('display', 'contents');
            specificIpSelUsersHtml(blockingType, '', '');
        }
    }else if(blockingType == "All Range"){
        if($(this).val() == "All Users"){
            allRangeAllUserHtml(blockingType, '', '', '', '');
        }else if(ipBlockingUserType == "Specific Group or User"){  
            allRangeSelUsersHtml(blockingType, '', '', '', '');
        }   
    }else if(blockingType == "Comma Separated"){
        if($(this).val() == "All Users"){
            commaSeparatedAllUsersHtml(blockingType, '', '');
        }else if(ipBlockingUserType == "Specific Group or User"){
            commaSeparatedSelUsersHtml(blockingType, '', '');
        }
    }else{
        alert(SUGAR.language.get('Administration', 'LBL_FIRST_SELECT_IP_BLOCK_TYPE'));
        $('#ipBlockingUserType').find('option[value=""]').prop('selected', true);
        $('#allowUsersRow, #denyUsersRow, #specificGroupsUsersRow').css('display', 'none');
    }
});//end of function

$('#enableOTPLoginSecurity').on('change', function(){
    $('#otpType').find('option:first').prop('selected', true);
    $('#emailSubject').val('');
    tinymce.get('templateEditor').setContent('');
    if($(this).is(':checked')){
        $(this).val("1");
        $('#otpTypeRow').css('display', 'table-row');
    }else{
       $(this).val("0");
        setDisplayOtpBased();
    }
});

$('#otpType').on('change', function(){
    var otpType = $(this).val();
    setDisplayOtpType(otpType);
    $('#smsTrigger').find('option:selected').removeAttr('selected');
        $('#smsTrigger').find('option:first').prop('selected', true);
});

$('#smsTrigger').on('change', function(){
    var smsTrigger = $(this).val();
    if(smsTrigger == "Days"){
        $('#days').find('option:selected').attr('selected', false);
        $('#days').find('option:first').prop('selected', true);
        $('#daysRow').css('display', 'table-row');
        $('#minutesRow').css('display', 'none');
    }else if(smsTrigger == "Minutes"){
        $('#minutes').find('option:selected').attr('selected', false);
        $('#minutes').find('option:first').prop('selected', true);
        $('#minutesRow').css('display', 'table-row');
        $('#daysRow').css('display', 'none');
    }else{
        $('#daysRow').css('display', 'none');
        $('#minutesRow').css('display', 'none');
    }
});

//Save Login Security Records
$('#btnSave').on('click', function(){
    var formData = $('form');
    var disabled = formData.find(':disabled').removeAttr('disabled');
    formData = formData.serialize();
    
    flag = 0;
    var enableOTPLoginSecurity = $('#enableOTPLoginSecurity').val();
    var otpType = $('#otpType').val();
    var body = tinymce.get('templateEditor').getContent();
    var subject = $('#emailSubject').val();
    var usersId = $('#specificGroupsUsers').val();
    var smsTrigger = $('#smsTrigger').val();
    var days = $('#days').val();
    
    var groupUsersData = {};
    groupUsersData.users = [];
    groupUsersData.groups = [];
    
    if(usersId != null){
        $.each(usersId, function(key,value){
            var type = $('#specificGroupsUsers').find('option[value="'+value+'"]').closest("optgroup").attr("label");
            if(type == "Users"){
                groupUsersData.users.push(value);
            }else if(type == "Groups"){
                groupUsersData.groups.push(value);
            }
        });
    }//end of if
    
    if(trim(enableOTPLoginSecurity) != "" && trim(otpType) != ""){
        if(otpType == "Email"){
            if(smsTrigger == "Days"){
                if(trim(subject) != "" && trim(body) != "" && trim(smsTrigger) != "" && trim(days) != ""){
                    flag = 1;
                }
            }else{
                if(trim(subject) != "" && trim(body) != "" && trim(smsTrigger) != ""){
                    flag = 1;
                }
            }
        }
    }//end of if

    if(flag == 1){
        $.ajax({
            url: "index.php?entryPoint=LoginSecurityAddDetails",
            type: "post",
            data: {formData: formData, 
                    recordId : recordId,
                    body : body,
                    groupUsersData : groupUsersData
                },
            success: function (response) {
                var data = JSON.parse(response);
                if(data.configStatus == 1){
                    alert(SUGAR.language.get('Administration', 'LBL_ADDED_RECORD'));
                }else if(data.configStatus == 2){
                    alert(SUGAR.language.get('Administration', 'LBL_UPDATED_RECORD'));
                }else{
                    alert(SUGAR.language.get('Administration', 'LBL_NOT_RECORD'));
                }
                window.location.href = "index.php?module=Administration&action=loginsecuritylistview";
            }
        });
    }else{
        alert(SUGAR.language.get('Administration', 'LBL_REQUIRE_FIELD'));
    }
});//end of function

function specificIpAllUsersHtml(blockingType, allowIpAddress, denyIpAddress){
    var blockingType = "'"+blockingType+"'";

    $('#allowUsersRow, #denyUsersRow').css('display', 'table-row');
    $('#allowUsersRow, #denyUsersRow').empty();
    $('#allowUsersRow').append('<td><b>'+SUGAR.language.get('Administration', 'LBL_ALLOW_ALL_USERS_SPECIFIC_IP')+'<b></td><td><input type="text" name="allowAllUsersSecificIp" id="allowAllUsersSecificIp" value="'+allowIpAddress+'" onkeypress="return (event.charCode == 46) || (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" onblur="allowUserBlur(this)"></td>');
        
    $('#denyUsersRow').append('<td style="padding-top:10px;padding-bottom:10px;"><b>'+SUGAR.language.get('Administration', 'LBL_DENY_ALL_USERS_SPECIFIC_IP')+'<b></td><td style="padding-top:10px;padding-bottom:10px;"><input type="text" name="denyAllUsersSecificIp" id="denyAllUsersSecificIp" value="'+denyIpAddress+'" onkeypress="return (event.charCode == 46) || (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"  onblur="denyUserBlur(this)"></td>');
}//end of function

function specificIpSelUsersHtml(blockingType, allowIpAddress, denyIpAddress){
    var blockingType = "'"+blockingType+"'";

    $('#allowUsersRow, #denyUsersRow').css('display', 'table-row');
    $('#allowUsersRow, #denyUsersRow').empty();
    $('#allowUsersRow').append('<td><b>'+SUGAR.language.get('Administration', 'LBL_ALLOW_SELECTED_USERS_SPECIFIC_IP')+'</b></td><td><input type="text" name="allowSelUsersSecificIp"  id="allowSelUsersSecificIp" value="'+allowIpAddress+'" onkeypress="return (event.charCode == 46) || (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" onblur="allowSelUserBlur(this)"></td>');

    $('#denyUsersRow').append('<td style="padding-top:10px;padding-bottom:10px;"><b>'+SUGAR.language.get('Administration', 'LBL_DENY_SELECTED_USERS_SPECIFIC_IP')+'</b></td><td style="padding-top:10px;padding-bottom:10px;"><input type="text" name="denySelUsersSecificIp" id="denySelUsersSecificIp" value="'+denyIpAddress+'" onkeypress="return (event.charCode == 46) || (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" onblur="denySelUserBlur(this)"></td>');
}//end of function

function commaSeparatedSelUsersHtml(blockingType, allowIpAddress, denyIpAddress){
    var blockingType = "'"+blockingType+"'";
    $('#allowUsersRow, #denyUsersRow').css('display', 'table-row');
    $('#allowUsersRow, #denyUsersRow').empty();
    $('#allowUsersRow').append('<td><b>'+SUGAR.language.get('Administration', 'LBL_ADD_IP_ADDRESSES_ALLOW_SELECTED_USERS')+'</b></td><td><input type="text" name="addIpAllowSelUser" id="addIpAllowSelUser"  value="'+allowIpAddress+'" onkeypress="return (event.charCode == 46 || event.charCode == 44) || (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" onblur="addIpAllowSelUserBlur(this)"></td>');

    $('#denyUsersRow').append('<td style="padding-top:10px;padding-bottom:10px;"><b>'+SUGAR.language.get('Administration', 'LBL_ADD_IP_ADDRESSES_DENY_SELECTED_USERS')+'</b></td><td style="padding-top:10px;padding-bottom:10px;"><input type="text" name="addIpDenySelUser" id="addIpDenySelUser" value="'+denyIpAddress+'" onkeypress="return (event.charCode == 46 || event.charCode == 44) || (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" onblur="addIpDenySelUserBlur(this)"></td>');
}//end of function

function commaSeparatedAllUsersHtml(blockingType, allowIpAddress, denyIpAddress){
    var blockingType = "'"+blockingType+"'";

    $('#allowUsersRow, #denyUsersRow').css('display', 'table-row');
    $('#allowUsersRow, #denyUsersRow').empty();
    $('#allowUsersRow').append('<td><b>'+SUGAR.language.get('Administration', 'LBL_ADD_IP_ADDRESSES_ALLOW_ALL_USERS')+'</b></td><td><input type="text" name="addIpAllowAllUser" value="'+allowIpAddress+'" id="addIpAllowAllUser" onkeypress="return (event.charCode == 46 || event.charCode == 44) || (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" onblur="addIpAllowAllUserBlur(this)"></td>');

    $('#denyUsersRow').append('<td style="padding-top:10px;padding-bottom:10px;"><b>'+SUGAR.language.get('Administration','LBL_ADD_IP_ADDRESSES_DENY_ALL_USERS')+'</b></td><td style="padding-top:10px;padding-bottom:10px;"><input type="text" name="addIpDenyAllUser" value="'+denyIpAddress+'" id="addIpDenyAllUser" onkeypress="return (event.charCode == 46 || event.charCode == 44) || (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" onblur="addIpDenyAllUserBlur(this)"></td>');
}//end of function

function allRangeSelUsersHtml(blockingType, allowFromIpAddress, allowToIpAddress, denyFromIpAddress, denyToIpAddress){
    var blockingType = "'"+blockingType+"'";

    $('#allowUsersRow, #denyUsersRow').css('display', 'table-row');
    $('#allowUsersRow, #denyUsersRow').empty();
    $('#allowUsersRow').append('<td><b>'+SUGAR.language.get('Administration', 'LBL_ALLOW_SELECTED_USERS_SEPCIFIC_RANGE_IP')+'</b></td><td><input type="text" name="allowSelUsersFromSpecificIp" id="allowSelUsersFromSpecificIp" value="'+allowFromIpAddress+'" onkeypress="return (event.charCode == 46) || (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" onblur="allowSelUsersFromSpecificIpBlur(this)">&nbsp;&nbsp;'+SUGAR.language.get('Administration', 'LBL_TO')+'&nbsp;&nbsp;<input type="text" name="allowSelUsersToSpecificIp" id="allowSelUsersToSpecificIp" value="'+allowToIpAddress+'" onkeypress="return (event.charCode == 46) || (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" onblur="allowSelUsersToSpecificIpBlur(this)"></td>');

    $('#denyUsersRow').append('<td style="padding-top:10px;padding-bottom:10px;"><b>'+SUGAR.language.get('Administration', 'LBL_DENY_SELECTED_USERS_SEPCIFIC_RANGE_IP')+'</b></td><td style="padding-top:10px;padding-bottom:10px;"><input type="text" name="denySelUsersFromSpecificIp" id="denySelUsersFromSpecificIp" value="'+denyFromIpAddress+'" onkeypress="return (event.charCode == 46) || (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" onblur="denySelUsersFromSpecificIpBlur(this)">&nbsp;&nbsp;To&nbsp;&nbsp;<input type="text" name="denySelUsersToSpecificIp" id="denySelUsersToSpecificIp" value="'+denyToIpAddress+'" onkeypress="return (event.charCode == 46) || (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" onblur="denySelUsersToSpecificIpBlur(this)"></td>');
}//end of function

function allRangeAllUserHtml(blockingType, allowFromIpAddress, allowToIpAddress, denyFromIpAddress, denyToIpAddress){
    var blockingType = "'"+blockingType+"'";

    $('#allowUsersRow, #denyUsersRow').css('display', 'table-row');
    $('#allowUsersRow, #denyUsersRow').empty();
    $('#allowUsersRow').append('<td><b>'+SUGAR.language.get('Administration', 'LBL_ALLOW_ALL_USERS_SEPCIFIC_RANGE_IP')+'</b></td><td><input type="text" name="allowAllUsersFromSpecificIp" id="allowAllUsersFromSpecificIp"  value="'+allowFromIpAddress+'" onkeypress="return (event.charCode == 46) || (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" onblur="allowAllUsersFromSpecificIpBlur(this)">&nbsp;&nbsp;'+SUGAR.language.get('Administration', 'LBL_TO')+'&nbsp;&nbsp;<input type="text" name="allowAllUsersToSpecificIp" id="allowAllUsersToSpecificIp" value="'+allowToIpAddress+'" onkeypress="return (event.charCode == 46) || (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" onblur="allowAllUsersToSpecificIpBlur(this)"></td>');

    $('#denyUsersRow').append('<td style="padding-top:10px;padding-bottom:10px;"><b>'+SUGAR.language.get('Administration', 'LBL_DENY_ALL_USERS_SEPCIFIC_RANGE_IP')+'</b></td><td style="padding-top:10px;padding-bottom:10px;"><input type="text" name="denyAllUsersFromSpecificIp" id="denyAllUsersFromSpecificIp" value="'+denyFromIpAddress+'"onkeypress="return (event.charCode == 46) || (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" onblur="denyAllUsersFromSpecificIpBlur(this)">&nbsp;&nbsp;To&nbsp;&nbsp;<input type="text" name="denyAllUsersToSpecificIp" id="denyAllUsersToSpecificIp" value="'+denyToIpAddress+'" onkeypress="return (event.charCode == 46) || (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" onblur="denyAllUsersToSpecificIpBlur(this)"></td>');
}//end of function

function specificGroupUsers(usersArray){
    $('#specificGroupsUsersRow').css('display', 'contents');//Get All Users and Groups List
    $.ajax({
        url: "index.php?entryPoint=LoginSecurityGetAllUsersGroups",
        type: "POST",
        dataType : "JSON",
        success: function(response){
            if(response != ''){
                $('#specificGroupsUsers').empty();
                $('#specificGroupsUsers').append("<optgroup label='"+SUGAR.language.get('Administration', 'LBL_USER')+"'>");
                $('#specificGroupsUsers').append("<optgroup label='"+SUGAR.language.get('Administration', 'LBL_GROUP')+"'>");
                $.each(response, function(index, value){
                    if(value.type == 'User'){
                        $('#specificGroupsUsers').find('optgroup[label="'+SUGAR.language.get('Administration', 'LBL_USER')+'"]').append("<option value='"+value.id+"' style='width: 200px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;'>"+value.value+"</option>");
                    }else{
                        $('#specificGroupsUsers').find('optgroup[label="'+SUGAR.language.get('Administration', 'LBL_GROUP')+'"]').append("<option value='"+value.id+"' style='width: 200px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;'>"+value.value+"</option>");
                    }//end of else
                });//end of each

                if(usersArray != ""){
                    var usersGroupsData = usersArray.groups;
                    var usersData = usersArray.users;
                    
                    if(usersGroupsData != undefined){
                        $.each(usersGroupsData, function(key, value){
                           $('#specificGroupsUsers').find('option[value="'+value+'"]').attr('selected', true);
                        });
                    }
                    
                    if(usersData != undefined){
                        $.each(usersData, function(key, value){
                            $('#specificGroupsUsers').find('option[value="'+value+'"]').attr('selected', true);
                        });
                    }//end of if
                }
            }//end of if
        }//end of success
    });//end of ajax
}//end of function

function validateIP(ip) {
    isValid = false;
    ip = ip.replace(/\s+/, "");

    if(ip.indexOf('/')!=-1){
        return false
    }
    
    try {
        var ipb = ip.split('.');
        if (ipb.length == 4) {
            for (i = 0; i < ipb.length; i++) {
                b = parseInt(ipb[i]);    
                if (b >= 0 && b <= 255) {
                    isValid = true;
                } else {
                    isValid = false;
                    break;
                }
            }
        }
    } catch (exception) {
        return false;
    }
    if (!isValid) {
        return false;
    }
    return true;
}//end of funcion

function allowUserBlur(obj){
    var allowAllUsersSecificIp = $('#allowAllUsersSecificIp').val();
    var denyAllUsersSecificIp = $("#denyAllUsersSecificIp").val();

    if(trim(allowAllUsersSecificIp) != ""){
        var validateIp = validateIP(allowAllUsersSecificIp);
        if(validateIp == true){
            if(trim(denyAllUsersSecificIp) != ""){
                if(trim(denyAllUsersSecificIp) == trim(allowAllUsersSecificIp)){
                    alert(SUGAR.language.get('Administration', 'LBL_DIFFERENT_IP_DENY_USERS_IP'));
                    $(obj).val('');
                }
            }//end of if 
        }else{
            alert(SUGAR.language.get('Administration', 'LBL_ADD_VALID_IP'));
            $(obj).val('');
        }
    }
    
}//end of function

function denyUserBlur(obj){
    var allowAllUsersSecificIp = $('#allowAllUsersSecificIp').val();
    var denyAllUsersSecificIp = $('#denyAllUsersSecificIp').val();
    
    if(trim(denyAllUsersSecificIp) != ""){
        var validateIp = validateIP(denyAllUsersSecificIp);
        if(validateIp == true){
            if(trim(allowAllUsersSecificIp) != ""){
                if(trim(denyAllUsersSecificIp) == trim(allowAllUsersSecificIp)){
                    alert(SUGAR.language.get('Administration', 'LBL_DIFFERENT_IP_ALLOW_USERS_IP'));
                    $(obj).val('');
                }
            }//end of if
        }else{
            alert(SUGAR.language.get('Administration', 'LBL_ADD_VALID_IP'));
            $(obj).val('');
        }
    }
}//end of function

function allowSelUserBlur(obj){
    var allowSelUsersSecificIp = $('#allowSelUsersSecificIp').val();
    var denySelUsersSecificIp = $("#denySelUsersSecificIp").val();

    if(trim(allowSelUsersSecificIp) != ""){
        var validateIp = validateIP(allowSelUsersSecificIp);
        if(validateIp == true){
            if(trim(denySelUsersSecificIp) != ""){
                if(trim(denySelUsersSecificIp) == trim(allowSelUsersSecificIp)){
                    alert(SUGAR.language.get('Administration', 'LBL_DIFFERENT_IP_DENY_SELECTED_USERS_IP'));
                    $(obj).val('');
                }
            }//end of if 
        }else{
            alert(SUGAR.language.get('Administration', 'LBL_ADD_VALID_IP'));
            $(obj).val('');
        }
    }
    
}//end of function

function denySelUserBlur(obj){
    var allowSelUsersSecificIp = $('#allowSelUsersSecificIp').val();
    var denySelUsersSecificIp = $('#denySelUsersSecificIp').val();
    
    if(trim(denySelUsersSecificIp) != ""){
        var validateIp = validateIP(denySelUsersSecificIp);
        if(validateIp == true){
            if(trim(allowSelUsersSecificIp) != ""){
                if(trim(denySelUsersSecificIp) == trim(allowSelUsersSecificIp)){
                    alert(SUGAR.language.get('Administration', 'LBL_DIFFERENT_IP_ALLOW_SELECTED_USERS_IP'));
                    $(obj).val('');
                }
            }//end of if
        }else{
            alert(SUGAR.language.get('Administration', 'LBL_ADD_VALID_IP'));
            $(obj).val('');
        }
    }
}//end of function

function allowAllUsersFromSpecificIpBlur(obj){
    var allowAllUsersFromSpecificIp = $('#allowAllUsersFromSpecificIp').val();
    var allowAllUsersToSpecificIp = $('#allowAllUsersToSpecificIp').val();

    var denyAllUsersFromSpecificIp = $('#denyAllUsersFromSpecificIp').val();
    var denyAllUsersToSpecificIp = $('#denyAllUsersToSpecificIp').val();
    if(trim(allowAllUsersFromSpecificIp) != ""){
        var validateIp = validateIP(allowAllUsersFromSpecificIp);
        if(validateIp == true){
            if(trim(allowAllUsersFromSpecificIp) != "" && trim(allowAllUsersToSpecificIp) != ""){
                if(ipToLong(trim(allowAllUsersToSpecificIp)) <= ipToLong(trim(allowAllUsersFromSpecificIp))){
                    alert(SUGAR.language.get('Administration', 'LBL_ADD_LESS_IP'));
                    $('#allowAllUsersFromSpecificIp').val('');
                }
            }//end of if
            if(trim(denyAllUsersToSpecificIp) != "" && trim(allowAllUsersFromSpecificIp) != "" && trim(denyAllUsersFromSpecificIp) != ""){
                if(ipToLong(trim(allowAllUsersFromSpecificIp)) <= ipToLong(trim(denyAllUsersToSpecificIp)) && ipToLong(trim(allowAllUsersFromSpecificIp)) >= ipToLong(trim(denyAllUsersFromSpecificIp))){
                    alert(SUGAR.language.get('Administration', 'LBL_DO_NOT_USE_DENY_ALL_USERS'));
                    $('#allowAllUsersFromSpecificIp').val('');
                }
            }
        }else{
            alert(SUGAR.language.get('Administration', 'LBL_ADD_VALID_IP'));
            $(obj).val('');
        } 
    }
    
}//end of function

function allowAllUsersToSpecificIpBlur(obj){
    var allowAllUsersToSpecificIp = $('#allowAllUsersToSpecificIp').val();
    var allowAllUsersFromSpecificIp = $("#allowAllUsersFromSpecificIp").val();

    var denyAllUsersFromSpecificIp = $("#denyAllUsersFromSpecificIp").val();
    var denyAllUsersToSpecificIp = $('#denyAllUsersToSpecificIp').val();

    if(trim(allowAllUsersToSpecificIp) != ""){
        var validateIp = validateIP(allowAllUsersToSpecificIp);
        if(validateIp == true){
            if(trim(allowAllUsersToSpecificIp) != "" && trim(allowAllUsersFromSpecificIp) != ""){
                if(ipToLong(trim(allowAllUsersToSpecificIp)) <= ipToLong(trim(allowAllUsersFromSpecificIp))){
                    alert(SUGAR.language.get('Administration', 'LBL_ADD_GREATER_IP_ALLOW_SEL_USERS'));
                    $('#allowAllUsersToSpecificIp').val('');
                }
            }
            if(trim(denyAllUsersToSpecificIp) != "" && trim(allowAllUsersToSpecificIp) != "" && trim(denyAllUsersFromSpecificIp) != ""){
                if(ipToLong(trim(allowAllUsersToSpecificIp)) <= ipToLong(trim(denyAllUsersToSpecificIp)) && ipToLong(trim(allowAllUsersToSpecificIp)) >= ipToLong(trim(denyAllUsersFromSpecificIp))){
                    alert(SUGAR.language.get('Administration', 'LBL_DO_NOT_USE_DENY_ALL_USERS'));
                    $('#allowAllUsersToSpecificIp').val('');
                }
            }
        }else{
            alert(SUGAR.language.get('Administration', 'LBL_ADD_VALID_IP'));
            $(obj).val('');
        }
    }
}//end of function

function denyAllUsersFromSpecificIpBlur(obj){
    var denyAllUsersFromSpecificIp = $('#denyAllUsersFromSpecificIp').val();
    var denyAllUsersToSpecificIp = $('#denyAllUsersToSpecificIp').val();

    var allowAllUsersToSpecificIp = $('#allowAllUsersToSpecificIp').val();

    if(trim(denyAllUsersFromSpecificIp) != ""){
        var validateIp = validateIP(denyAllUsersFromSpecificIp);
        if(validateIp == true){
            if(trim(denyAllUsersFromSpecificIp) != "" && trim(denyAllUsersToSpecificIp) != ""){
                if(ipToLong(trim(denyAllUsersToSpecificIp)) <= ipToLong(trim(denyAllUsersFromSpecificIp))){
                    alert(SUGAR.language.get('Administration', 'LBL_ADD_LESS_IP_DENY_ALL_USERS'));
                    $('#denySelUsersFromSpecificIp').val('');
                }
            }//end of if 
            if(trim(allowAllUsersToSpecificIp) != "" && trim(denyAllUsersFromSpecificIp) != ""){
                if(ipToLong(trim(denyAllUsersFromSpecificIp)) < ipToLong(trim(allowAllUsersToSpecificIp))){
                    alert(SUGAR.language.get('Administration', 'LBL_ADD_GREATER_RANGE_IP_DENY_USERS'));
                    $('#denyAllUsersFromSpecificIp').val('');
                }
            }
        }else{
            alert(SUGAR.language.get('Administration', 'LBL_ADD_VALID_IP'));
            $(obj).val('');
        }
    }
     
}//end of function

function denyAllUsersToSpecificIpBlur(obj){
    var denyAllUsersToSpecificIp = $('#denyAllUsersToSpecificIp').val();
    var denyAllUsersFromSpecificIp = $("#denyAllUsersFromSpecificIp").val();

    var allowAllUsersFromSpecificIp = $("#allowAllUsersFromSpecificIp").val();
    var allowAllUsersToSpecificIp = $("#allowAllUsersToSpecificIp").val();

    if(trim(denyAllUsersToSpecificIp) != ""){
        var validateIp = validateIP(denyAllUsersToSpecificIp);
        if(validateIp == true){
            if(trim(denyAllUsersFromSpecificIp) != "" && trim(denyAllUsersToSpecificIp) != ""){
                if(ipToLong(trim(denyAllUsersToSpecificIp)) <= ipToLong(trim(denyAllUsersFromSpecificIp))){
                    alert(SUGAR.language.get('Administration', 'LBL_ADD_GREATER_IP_TO_DENY_ALL_USERS'));
                   $('#denySelUsersToSpecificIp').val('');
                }
            }
            if(trim(allowAllUsersToSpecificIp) != "" && trim(denyAllUsersToSpecificIp) != "" && trim(allowAllUsersFromSpecificIp) != ""){
                if(ipToLong(trim(denyAllUsersToSpecificIp)) <= ipToLong(trim(allowAllUsersToSpecificIp)) && ipToLong(trim(denyAllUsersToSpecificIp)) >= ipToLong(trim(allowAllUsersFromSpecificIp))){
                    alert(SUGAR.language.get('Administration', 'LBL_DO_NOT_USE_ALLOW_ALL_USERS'));
                    $('#denyAllUsersToSpecificIp').val('');
                }
            }
        }else{
            alert(SUGAR.language.get('Administration', 'LBL_ADD_VALID_IP'));
            $(obj).val('');
        }    
    }
}//end of function

function allowSelUsersFromSpecificIpBlur(obj){
    var allowSelUsersFromSpecificIp = $('#allowSelUsersFromSpecificIp').val();
    var allowSelUsersToSpecificIp = $('#allowSelUsersToSpecificIp').val();

    var denySelUsersFromSpecificIp = $("#denySelUsersFromSpecificIp").val();
    var denySelUsersToSpecificIp = $("#denySelUsersToSpecificIp").val();
    if(trim(allowSelUsersFromSpecificIp) != ""){
        var validateIp = validateIP(allowSelUsersFromSpecificIp);
        if(validateIp == true){
            if(trim(allowSelUsersFromSpecificIp) != "" && trim(allowSelUsersToSpecificIp) != ""){
                if(ipToLong(trim(allowSelUsersToSpecificIp)) <= ipToLong(trim(allowSelUsersFromSpecificIp))){
                    alert(SUGAR.language.get('Administration', 'LBL_ADD_LESS_IP_ALLOW_SEL_USERS'));
                    $('#allowSelUsersFromSpecificIp').val('');
                }
            }
            if(trim(denySelUsersToSpecificIp) != "" && trim(allowSelUsersFromSpecificIp) != "" && trim(denySelUsersFromSpecificIp) != ""){
                if(ipToLong(trim(allowSelUsersFromSpecificIp)) <= ipToLong(trim(denySelUsersToSpecificIp)) && ipToLong(trim(allowSelUsersFromSpecificIp)) >= ipToLong(trim(denySelUsersFromSpecificIp))){
                    alert(SUGAR.language.get('Administration', 'LBL_DO_NOT_USE_DENY_SEL_USERS'));
                    $('#allowSelUsersFromSpecificIp').val('');
                }
            }

            if(trim(denySelUsersToSpecificIp) != "" && trim(allowSelUsersToSpecificIp) == "" && trim(denySelUsersFromSpecificIp) == "" && trim(allowSelUsersFromSpecificIp) != ""){
                if(ipToLong(trim(denySelUsersToSpecificIp)) >= ipToLong(trim(allowSelUsersFromSpecificIp))){
                    alert(SUGAR.language.get('Administration', 'LBL_DO_NOT_USE_ALLOW_SEL_USERS'));
                    $('#allowSelUsersFromSpecificIp').val('');
                }
            }

            if(trim(denySelUsersToSpecificIp) == "" && trim(allowSelUsersToSpecificIp) == "" && trim(denySelUsersFromSpecificIp) != "" && trim(allowSelUsersFromSpecificIp) != ""){
                if(ipToLong(trim(allowSelUsersFromSpecificIp)) == ipToLong(trim(denySelUsersFromSpecificIp))){
                    alert(SUGAR.language.get('Administration', 'LBL_DO_NOT_USE_ALLOW_SEL_USERS'));
                    $('#allowSelUsersFromSpecificIp').val('');
                }
            }


        }else{
            alert(SUGAR.language.get('Administration', 'LBL_ADD_VALID_IP'));
            $(obj).val('');
        } 
    }
}//end of if

function allowSelUsersToSpecificIpBlur(obj){
    var allowSelUsersToSpecificIp = $('#allowSelUsersToSpecificIp').val();
    var allowSelUsersFromSpecificIp = $("#allowSelUsersFromSpecificIp").val();

    var denySelUsersFromSpecificIp = $("#denySelUsersFromSpecificIp").val();
    var denySelUsersToSpecificIp = $("#denySelUsersToSpecificIp").val();
    if(trim(allowSelUsersToSpecificIp) != ""){
        var validateIp = validateIP(allowSelUsersToSpecificIp);
        if(validateIp == true){
            if(trim(allowSelUsersToSpecificIp) != "" && trim(allowSelUsersFromSpecificIp) != ""){
                if(ipToLong(trim(allowSelUsersToSpecificIp)) <= ipToLong(trim(allowSelUsersFromSpecificIp))){
                    alert(SUGAR.language.get('Administration', 'LBL_ADD_GREATER_IP_ALLOW_SEL_USERS'));
                    $('#allowSelUsersToSpecificIp').val('');
                }
            }
            if(trim(denySelUsersToSpecificIp) != "" && trim(allowSelUsersToSpecificIp) != "" && trim(denySelUsersFromSpecificIp) != ""){
                if(ipToLong(trim(allowSelUsersToSpecificIp)) <= ipToLong(trim(denySelUsersToSpecificIp)) && ipToLong(trim(allowSelUsersToSpecificIp)) >= ipToLong(trim(denySelUsersFromSpecificIp))){
                    alert(SUGAR.language.get('Administration', 'LBL_DO_NOT_USE_DENY_SEL_USERS'));
                    $('#allowSelUsersToSpecificIp').val('');
                }
            }

            if(trim(denySelUsersToSpecificIp) == "" && trim(allowSelUsersToSpecificIp) != "" && trim(denySelUsersFromSpecificIp) != "" && trim(allowSelUsersFromSpecificIp) == "" ){
                if(ipToLong(trim(allowSelUsersToSpecificIp)) == ipToLong(trim(denySelUsersFromSpecificIp))){
                    alert(SUGAR.language.get('Administration', 'LBL_DO_NOT_USE_DENY_SEL_USERS'));
                    $('#allowSelUsersToSpecificIp').val('');
                }
            }

            if(trim(denySelUsersToSpecificIp) != "" && trim(allowSelUsersToSpecificIp) != "" && trim(denySelUsersFromSpecificIp) == "" && trim(allowSelUsersFromSpecificIp) == "" ){
                if(ipToLong(trim(allowSelUsersToSpecificIp)) == ipToLong(trim(denySelUsersToSpecificIp))){
                    alert(SUGAR.language.get('Administration', 'LBL_DO_NOT_USE_DENY_SEL_USERS'));
                    $('#allowSelUsersToSpecificIp').val('');
                }
            }
        }else{
            alert(SUGAR.language.get('Administration', 'LBL_ADD_VALID_IP'));
            $(obj).val('');
        } 
    }
}//end of function
 
function denySelUsersFromSpecificIpBlur(obj){
    var denySelUsersFromSpecificIp = $('#denySelUsersFromSpecificIp').val();
    var denySelUsersToSpecificIp = $('#denySelUsersToSpecificIp').val();

    var allowSelUsersToSpecificIp = $('#allowSelUsersToSpecificIp').val();
    var allowSelUsersFromSpecificIp = $('#allowSelUsersFromSpecificIp').val();
    if(trim(denySelUsersFromSpecificIp) != ""){
        var validateIp = validateIP(denySelUsersFromSpecificIp);
        if(validateIp == true){
            if(trim(denySelUsersFromSpecificIp) != "" && trim(denySelUsersToSpecificIp) != ""){
                if(ipToLong(trim(denySelUsersToSpecificIp)) <= ipToLong(trim(denySelUsersFromSpecificIp))){
                    alert(SUGAR.language.get('Administration', 'LBL_ADD_LESS_IP_DENY_SEL_USERS'));
                    $('#denySelUsersFromSpecificIp').val('');
                }
            }//end of if 
            if(trim(denySelUsersFromSpecificIp) != "" && trim(allowSelUsersFromSpecificIp) != ""){
                if(ipToLong(trim(denySelUsersFromSpecificIp)) <= ipToLong(trim(allowSelUsersToSpecificIp)) && ipToLong(trim(denySelUsersFromSpecificIp)) >= ipToLong(trim(allowSelUsersFromSpecificIp))){
                    alert(SUGAR.language.get('Administration', 'LBL_DO_NOT_USE_ALLOW_SEL_USERS'));
                    $('#denySelUsersFromSpecificIp').val('');
                }
            }

            if(trim(denySelUsersToSpecificIp) == "" && trim(allowSelUsersToSpecificIp) == "" && trim(denySelUsersFromSpecificIp) != "" && trim(allowSelUsersFromSpecificIp) != ""){
                if(ipToLong(trim(denySelUsersFromSpecificIp)) == ipToLong(trim(allowSelUsersFromSpecificIp))){
                    alert(SUGAR.language.get('Administration', 'LBL_DO_NOT_USE_ALLOW_SEL_USERS'));
                    $('#denySelUsersFromSpecificIp').val('');
                }
            }

            if(trim(denySelUsersToSpecificIp) == "" && trim(allowSelUsersToSpecificIp) != "" && trim(denySelUsersFromSpecificIp) != "" && trim(allowSelUsersFromSpecificIp) == ""){
                if(ipToLong(trim(denySelUsersFromSpecificIp)) == ipToLong(trim(allowSelUsersToSpecificIp))){
                    alert(SUGAR.language.get('Administration', 'LBL_DO_NOT_USE_ALLOW_SEL_USERS'));
                    $('#denySelUsersFromSpecificIp').val('');
                }
            }
        }else{
            alert(SUGAR.language.get('Administration', 'LBL_ADD_VALID_IP'));
            $(obj).val('');
        } 
    }
}//end of function

function denySelUsersToSpecificIpBlur(obj){
    var denySelUsersToSpecificIp = $('#denySelUsersToSpecificIp').val();
    var denySelUsersFromSpecificIp = $("#denySelUsersFromSpecificIp").val();

    var allowSelUsersToSpecificIp = $('#allowSelUsersToSpecificIp').val();
    var allowSelUsersFromSpecificIp = $('#allowSelUsersFromSpecificIp').val();
    if(trim(denySelUsersToSpecificIp) != ""){
        var validateIp = validateIP(denySelUsersToSpecificIp);
        if(validateIp == true){
            if(trim(denySelUsersFromSpecificIp) != "" && trim(denySelUsersToSpecificIp) != ""){
                if(ipToLong(trim(denySelUsersToSpecificIp)) <= ipToLong(trim(denySelUsersFromSpecificIp))){
                    alert(SUGAR.language.get('Administration', 'LBL_ADD_GREATER_IP_TO_DENY_SEL_USERS'));
                   $('#denySelUsersToSpecificIp').val('');
                }
            }
            if(trim(allowSelUsersToSpecificIp) != "" && trim(denySelUsersToSpecificIp) != ""){
                if(ipToLong(trim(denySelUsersToSpecificIp)) <= ipToLong(trim(allowSelUsersToSpecificIp)) && ipToLong(trim(denySelUsersToSpecificIp)) >= ipToLong(trim(allowSelUsersFromSpecificIp))){
                    alert(SUGAR.language.get('Administration', 'LBL_DO_NOT_USE_ALLOW_SEL_USERS'));
                    $('#denySelUsersToSpecificIp').val('');
                }
            }
            if(trim(denySelUsersToSpecificIp) != "" && trim(allowSelUsersToSpecificIp) == "" && trim(denySelUsersFromSpecificIp) == "" && trim(allowSelUsersFromSpecificIp) != ""){
                if(trim(denySelUsersToSpecificIp) == trim(allowSelUsersFromSpecificIp)){
                    alert(SUGAR.language.get('Administration', 'LBL_DO_NOT_USE_ALLOW_SEL_USERS'));
                    $('#denySelUsersToSpecificIp').val('');
                }
            }
        }else{
            alert(SUGAR.language.get('Administration', 'LBL_ADD_VALID_IP'));
            $(obj).val('');
        } 
    }
}//end of function

function ipToLong(dot){
    var d = dot.split('.');
    return ((((((+d[0])*256)+(+d[1]))*256)+(+d[2]))*256)+(+d[3]);
}//end of if

function addIpAllowSelUserBlur(obj){
    var addIpAllowSelUser = $('#addIpAllowSelUser').val();
    var addIpAllowSelUserArr = addIpAllowSelUser.split(',');
    var addIpDenySelUser = $('#addIpDenySelUser').val();
    if(trim(addIpDenySelUser) == ""){
        var addIpDenySelUserArr = [];
    }else{
        var addIpDenySelUserArr = addIpDenySelUser.split(',');
    }

    if(trim(addIpAllowSelUser) == ""){
        var addIpAllowSelUserArr = [];
    }else{
        var addIpAllowSelUserArr = addIpAllowSelUser.split(',');
    }

    if(addIpAllowSelUserArr.length > 0){
        var flag = 0;
        $.each(addIpAllowSelUserArr, function(key, value){
            var validateIp = validateIP(value);
            if(validateIp == true){
                flag = 3;
                if(addIpDenySelUserArr.length > 0){
                    $.each(addIpDenySelUserArr, function(key, value){
                        if(addIpAllowSelUserArr.indexOf(value) !== -1) { 
                            flag = 1;
                        }
                    });
                }//end of if

                var allowDuplicateIpAddress = checkIfDuplicateExists(addIpAllowSelUserArr);
                if(allowDuplicateIpAddress == true){
                    flag = 2;
                }
            }
        });
        if(flag == 0){
            alert(SUGAR.language.get('Administration', 'LBL_ADD_VALID_IP'));
            $(obj).val('');
        }
        if(flag == 1){
            alert(SUGAR.language.get('Administration', 'LBL_ADD_DIFF_IP_ADDRESS_DENY_SELECTED_USERS'));
            $('#addIpAllowSelUser').val("");
            return false; 
        }
        if(flag == 2){
            alert(SUGAR.language.get('Administration', 'LBL_DO_NOT_ADD_SAME_ALLOW_SELECTED_IP'));
            $('#addIpAllowSelUser').val("");
        }
    }
}//end of function

function addIpDenySelUserBlur(obj){
    var addIpDenySelUser = $('#addIpDenySelUser').val();
    var addIpDenySelUserArr = addIpDenySelUser.split(',');

    var addIpAllowSelUser = $('#addIpAllowSelUser').val();
    var addIpAllowSelUserArr = addIpAllowSelUser.split(',');

    if(trim(addIpDenySelUser) == ""){
        var addIpDenySelUserArr = [];
    }else{
        var addIpDenySelUserArr = addIpDenySelUser.split(',');
    }

    if(trim(addIpAllowSelUser) == ""){
        var addIpAllowSelUserArr = [];
    }else{
        var addIpAllowSelUserArr = addIpAllowSelUser.split(',');
    }

    if(addIpDenySelUserArr.length > 0){
        var flag = 0;
        $.each(addIpDenySelUserArr, function(key, value){
            var validateIp = validateIP(value);
            if(validateIp == true){
                flag = 3;
                if(addIpAllowSelUserArr.length > 0){
                    $.each(addIpAllowSelUserArr, function(key, value){
                        if(addIpDenySelUserArr.indexOf(value) !== -1) { 
                            flag = 1;
                        }
                    });
                }//end of if

                var denyDuplicateIpAddress = checkIfDuplicateExists(addIpDenySelUserArr);
                if(trim(denyDuplicateIpAddress) == true){
                    flag = 2;
                }
            }
        });
        
        if(flag == 0){
            alert(SUGAR.language.get('Administration', 'LBL_ADD_VALID_IP'));
            $(obj).val('');
        }
        if(flag == 1){
            alert(SUGAR.language.get('Administration', 'LBL_ADD_DIFF_IP_ADDRESS_ALLOW_SELECTED_USERS'));
            $('#addIpDenySelUser').val(""); 
            return false;
        }
        if(flag == 2){
            alert(SUGAR.language.get('Administration', 'LBL_DO_NOT_ADD_SAME_DENY_SELECTED_IP'));
            $('#addIpDenySelUser').val("");
        }
    }   
}//end of function

function addIpAllowAllUserBlur(obj){
    var addIpAllowAllUser = $('#addIpAllowAllUser').val();
    var addIpAllowAllUserArr = addIpAllowAllUser.split(',');

    var addIpDenyAllUser = $('#addIpDenyAllUser').val();
    if(trim(addIpDenyAllUser) == ""){
        var addIpDenyAllUserArr = [];
    }else{
        var addIpDenyAllUserArr = addIpDenyAllUser.split(',');
    }

    if(trim(addIpAllowAllUser) == ""){
        var addIpAllowAllUserArr = [];
    }else{
        var addIpAllowAllUserArr = addIpAllowAllUser.split(',');
    }

    
    if(addIpAllowAllUserArr.length > 0){
        var flag = 0;
        $.each(addIpAllowAllUserArr, function(key, value){
            var validateIp = validateIP(value);
            if(validateIp == true){
                flag = 3;
                var allowDuplicateIpAddress = checkIfDuplicateExists(addIpAllowAllUserArr);
                if(allowDuplicateIpAddress == true){
                    flag = 1;
                }
                if(addIpDenyAllUserArr.length > 0){
                    $.each(addIpDenyAllUserArr, function(key, value){
                        if(addIpAllowAllUserArr.indexOf(value) !== -1) {
                            flag = 2;
                        }
                    });
                }//end of if
            }
        });
        if(flag == 0){
            alert(SUGAR.language.get('Administration', 'LBL_ADD_VALID_IP'));
            $(obj).val('');
            return false;
        }
        if(flag == 1){
            alert(SUGAR.language.get('Administration', 'LBL_DO_NOT_ADD_SAME_ALLOW_IP'));
            $('#addIpAllowAllUser').val(""); 
        }

        if(flag == 2){
            alert(SUGAR.language.get('Administration', 'LBL_ADD_DIFF_IP_ADDRESS_DENY_ALL_USERS'));
            $('#addIpAllowAllUser').val(""); 
        }
    }
}//end of function

function addIpDenyAllUserBlur(obj){
    var addIpDenyAllUser = $('#addIpDenyAllUser').val();
    var addIpDenyAllUserArr = addIpDenyAllUser.split(',');

    var addIpAllowAllUser = $('#addIpAllowAllUser').val();
    if(trim(addIpDenyAllUser) == ""){
        var addIpDenyAllUserArr = [];
    }else{
        var addIpDenyAllUserArr = addIpDenyAllUser.split(',');
    }

    if(trim(addIpAllowAllUser) == ""){
        var addIpAllowAllUserArr = [];
    }else{
        var addIpAllowAllUserArr = addIpAllowAllUser.split(',');
    }

    if(addIpDenyAllUserArr.length > 0){
        var flag = 0;
        $.each(addIpDenyAllUserArr, function(key, value){
            var validateIp = validateIP(value);
            if(validateIp == true){
                flag = 3;
                var allowDuplicateIpAddress = checkIfDuplicateExists(addIpDenyAllUserArr);
                if(allowDuplicateIpAddress == true){
                    flag = 1;
                }
                
                if(addIpAllowAllUserArr.length > 0){
                    $.each(addIpAllowAllUserArr, function(key, value){
                        if(addIpDenyAllUserArr.indexOf(value) !== -1) { 
                            flag = 2;
                        }
                    });
                }//end of if
            }
        });

        if(flag == 0){
            alert(SUGAR.language.get('Administration', 'LBL_ADD_VALID_IP'));
            $(obj).val('');
            return false;
        }
        if(flag == 1){
            alert(SUGAR.language.get('Administration', 'LBL_DO_NOT_ADD_SAME_DENY_IP'));
            $('#addIpDenyAllUser').val("");
            return false;
        }
        if(flag == 2){
            alert(SUGAR.language.get('Administration', 'LBL_ADD_DIFF_IP_ADDRESS_ALLOW_ALL_USERS'));
            $('#addIpDenyAllUser').val(""); 
            return false;
        }
    }
}//end of function

function checkIfDuplicateExists(arr) {
    return new Set(arr).size !== arr.length
}//end of function

//Click Event for Clear Button
function clearall(){
    var wizardCurrentStep = $('.nav-steps.selected').attr('data-nav-step');
    if(wizardCurrentStep == 1){
        $('#blockingType, #ipBlockingUserType').find('option:selected').removeAttr('selected');
        $('#blockingType, #ipBlockingUserType').find('option:first').prop('selected', true);
        $('#specificGroupsUsersRow, #allowUsersRow, #denyUsersRow').css('display', 'none');
    }else if(wizardCurrentStep == 2){
        $('#enableOTPLoginSecurity').attr('checked', false);
        $('#enableOTPLoginSecurity').val("0");
        setDisplayOtpBased();
    }
}//end of function

//Set Display Otp Based
function setDisplayOtpBased(){
    $('#otpTypeRow, #emailSubjectRow, #templateEditorRow, #smsTriggerRow, #minutesRow, #daysRow').css('display', 'none');
}//end of function

//Set Display Otp Type
function setDisplayOtpType(otpType){
    if(otpType == 'Email'){
        $('#templateEditorRow').css('display', 'contents');
        $('#emailSubjectRow').css('display', 'table-row');
        $('#templateEditorRow').find('td:first').find('#emailLabel').remove();
        $('#templateEditorRow').find('td:first').append('<b id="emailLabel">'+SUGAR.language.get('Administration', 'LBL_EMAIL_BODY')+'<span class="required">*</span></b>');
        $('#smsTriggerRow').css('display', 'table-row');
        
    }else{
        $('#templateEditorRow, #emailSubjectRow, #smsTriggerRow').css('display', 'none');
    }
}//end of function