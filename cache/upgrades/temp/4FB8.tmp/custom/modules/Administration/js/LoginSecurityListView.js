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
//Select All List Checkbox
$('#selectAll').click(function(event) {
    $('#actionMenu').css('display','none');
    if(this.checked) {
        $('.bulkAction').css('display','none');
        $('#actionLinkTop').css('display','block');
        // Iterate each checkbox
        $('.listview-checkbox').each(function() {
            this.checked = true;                        
        });
    }else{
        $('.bulkAction').css('display','block');
        $('#actionLinkTop').css('display','none');
        $('.listview-checkbox').each(function() {
            this.checked = false;                       
        });
    }
});//end of function

$('.listview-checkbox').on('click', function(){
    var id = [];
    var recordsId = [];
    $(".listview-checkbox:checked").each(function() {
        if(this.checked == true){
            id.push($(this).val());         
        }
    });
    $(".listview-checkbox").each(function() {
        if(this.checked == true){
            recordsId.push($(this).val());         
        }
    });
    if(id.length == recordsId.length){
        $('#selectAll').attr('checked',false);  
    }

    $('#actionMenu').css('display','none');

    if(this.checked) {
        $('.bulkAction').css('display','none');
        $('#actionLinkTop').css('display','block');
    }else{
        var id = [];
        $(".listview-checkbox:checked").each(function() {
            if(this.checked == true){
                id.push($(this).val());         
            }
        });
        if(id.length >= 1){
            $('.bulkAction').css('display','none');
            $('#actionLinkTop').css('display','block');
        }else{
            $('.bulkAction').css('display','block');
            $('#actionLinkTop').css('display','none');
        }
    }
});

$('.enableLoginSecurity').on('change', function(){
    var checkValue;
    if($(this).is(':checked')){
        $(this).val('Active');
        checkValue = 'Active';
    }else{
        $(this).val('Inactive');
        checkValue = 'Inactive';
    }
    var id = $(this).closest('tr').attr('data-id');
    $.ajax({
        url: "index.php?entryPoint=LoginSecurityUpdateStatus",
        type: "post",
        data: {enableLoginSecurity : checkValue,
                id : id},
        success: function (response) {
            if(response == 1){
                if(checkValue == 'Active'){
                    alert(SUGAR.language.get('Administration','LBL_LOGIN_SECURITY_STATUS_ACTIVATED'));
                }else if(checkValue == 'Inactive'){
                    alert(SUGAR.language.get('Administration','LBL_LOGIN_SECURITY_STATUS_DEACTIVATED'));
                }
                window.location.reload();
            }
        }
    });
});//end of function

$('.actionButton').on('click', function(){
    if($('#actionMenu').css('display') == "none"){
        $('#actionMenu').css('display','block');        
        $('#actionMenu').css('margin-top','10px');
    }else{
        $('#actionMenu').css('display','none');  
    }
});

function updateActionStatus(checkValue){
    var id = [];
    $(".listview-checkbox:checked").each(function() {
        id.push($(this).val());
    });
    if(checkValue == 1){
        checkValue = "Active";
    }else{
        checkValue = "Inactive";
    }
    var selectedValues = id.join(",");
    $.ajax({
        url: "index.php?entryPoint=LoginSecurityUpdateStatus",
        type: "post",
        data: {enableLoginSecurity : checkValue,
                recordId : selectedValues},
        success: function (response) {
            if(response != "" && response != 0){
                window.location.reload();
            }
        }
    });
}

//Delete List View Records
$('.btnDelete').on('click', function(e) {
    var id = [];
    $(".listview-checkbox:checked").each(function() {
        id.push($(this).val());
    });
    var deleteMsg = SUGAR.language.get('Administration','LBL_DELETE_MSG') +' '+(id.length>1?SUGAR.language.get('Administration','LBL_THESE')+' '+id.length:SUGAR.language.get('Administration','LBL_THIS'))+" "+SUGAR.language.get('Administration','LBL_ROW');
    var confirmed = confirm(deleteMsg);
    if(confirmed == true){
        var selectedValues = id.join(",");
        $.ajax({
            type: "POST",
            url: "index.php?entryPoint=LoginSecurityDeleteRecords",
            data: 'delId='+selectedValues,
            success: function(response) {
                if(response != "" && response != 0){
                    window.location.reload();
                }  
            }
        });
    }
});//end of function