<?php
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
//insert record
function insertLoginSecurityRecord($tabelName, $fieldData){
    //data key
    $key = array_keys($fieldData);
    $fieldName = implode(",",$key);
    
    //data val
    $val = array_values($fieldData);
    $fieldVal = implode(",",$val);
    
    //insert
    $insLoginSecurityData = "INSERT INTO $tabelName ($fieldName) VALUES($fieldVal)";
    $insLoginSecurityDataResult = $GLOBALS['db']->query($insLoginSecurityData);

    return $insLoginSecurityDataResult;
}//end of function

//update record
function updateLoginSecurityRecord($tabelName, $data, $where, $operator){
    //update
    $updateLoginSecurityData = "UPDATE $tabelName SET";

    $fieldName = array_keys($data); //database field name
    $fieldValue = array_values($data); //field value

    $whereFieldName = array_keys($where); //where condition field name
    $whereFieldValue = array_values($where); // where condition field value

    $i=0;
    $count = count($data);
    foreach($data as $fieldData){
        if($count == $i+1){
            $updateLoginSecurityData .= " $fieldName[$i]=$fieldValue[$i]";
        }else{
            $updateLoginSecurityData .= " $fieldName[$i]=$fieldValue[$i],";
        }//end of else
        $i++;
    }//end of foreach

    $j=0;
    $updateLoginSecurityData .= " where";
    foreach($where as $whereConditionData){
        if($j == 0){
            $updateLoginSecurityData .=" $whereFieldName[$j]".$operator."'$whereFieldValue[$j]'";
        }else{
            $updateLoginSecurityData .=" and $whereFieldName[$j]".$operator."'$whereFieldValue[$j]'";
        }//end of else 
        $j++;
    }//end of foreach
    $updateLoginSecurityDataResult = $GLOBALS['db']->query($updateLoginSecurityData);
    return $updateLoginSecurityDataResult;
}//end of function


//Get Record
function getLoginSecurityRecord($tableName, $fieldNames, $where, $orderby){
    $getLoginSecurityData = '';
    //select
    $getLoginSecurityData .= "SELECT ";
    foreach($fieldNames as $key => $value){
        if($key == 0){
            $getLoginSecurityData .= $value;
        }else{
            $getLoginSecurityData .= ",".$value;
        }
    }
    $getLoginSecurityData .= " from $tableName"; 
    $whereFieldName = array_keys($where); //where condition field name
    $whereFieldValue = array_values($where); // where condition field value

    $j=0;
    if(!empty($where)){
        $getLoginSecurityData .= " WHERE";
        $count = count($where);
        foreach($where as $key => $w){
            $fieldName = $whereFieldName[$j];
            $fieldValue = $whereFieldValue[$j];
            if($count > 1 && $j >= 1){
                $getLoginSecurityData .=" AND $fieldName='$fieldValue'";
            }else{
                $getLoginSecurityData .=" $fieldName='$fieldValue'";
            }
            $j++;
        }//end of foreach
    }
    
    if(!empty($orderby)){
        $getLoginSecurityData .= " ORDER BY";  
        foreach($orderby as $k => $v){
            $getLoginSecurityData .= " $k $v";
        } 
    }
    
    return $getLoginSecurityData;
}//end of function


function displayLoginSecurityTMCEForTemplates($templateEditorId){
    require_once("include/SugarTinyMCE.php");
    global $locale;
    $tiny = new SugarTinyMCE();
    $tinyMCE = $tiny->getConfig();
    $js =<<<JS
    <script language="javascript" type="text/javascript">
        $tinyMCE
        var df = '{$locale->getPrecedentPreference('default_date_format')}';
        var templateEditorId = '{$templateEditorId}';
        tinyMCE.init({
            theme : "advanced",
            theme_advanced_toolbar_align : "left",
            mode: "exact",
            elements : templateEditorId,
            theme_advanced_toolbar_location : "top",
            theme_advanced_buttons1: "code,help,separator,bold,italic,underline,strikethrough,separator,justifyleft,justifycenter,justifyright,justifyfull,separator,forecolor,backcolor,separator,styleprops,styleselect,formatselect,fontselect,fontsizeselect",
            theme_advanced_buttons2: "cut,copy,paste,pastetext,pasteword,selectall,separator,search,replace,separator,bullist,numlist,separator,outdent,indent,separator,ltr,rtl,separator,undo,redo,separator, link,unlink,anchor,image,separator,sub,sup,separator,charmap,visualaid",
            theme_advanced_buttons3: "tablecontrols,separator,advhr,hr,removeformat,separator,insertdate,pagebreak",
            theme_advanced_fonts:"Andale Mono=andale mono,times;Arial=arial,helvetica,sans-serif;Arial Black=arial black,avant garde;Book Antiqua=book antiqua,palatino;Comic Sans MS=comic sans ms,sans-serif;Courier New=courier new,courier;Georgia=georgia,palatino;Helvetica=helvetica;Helvetica Neu=helveticaneue,sans-serif;Impact=impact,chicago;Symbol=symbol;Tahoma=tahoma,arial,helvetica,sans-serif;Terminal=terminal,monaco;Times New Roman=times new roman,times;Trebuchet MS=trebuchet ms,geneva;Verdana=verdana,geneva;Webdings=webdings;Wingdings=wingdings,zapf dingbats",
            plugins : "advhr,insertdatetime,table,paste,searchreplace,directionality,style,pagebreak",
            height:"300",
            width:"100%",
            inline_styles : true,
            directionality : "ltr",
            remove_redundant_brs : true,
            entity_encoding: 'raw',
            cleanup_on_startup : true,
            strict_loading_mode : true,
            convert_urls : false,
            plugin_insertdate_dateFormat : '{DATE '+df+'}',
            pagebreak_separator : "<pagebreak />",
            extended_valid_elements : "textblock,barcode[*]",
            custom_elements: "textblock",
        });
    </script>
JS;
    echo $js;     
}//end of function

function getLoginSecurityUsersData($key, $userArray){
    $fieldNames = array('first_name', 'last_name');
    $where = array('id' => $key);
    $userQuery = getLoginSecurityRecord('users', $fieldNames, $where, $orderby=array());
    $usersRow = $GLOBALS['db']->fetchOne($userQuery);
    $userArray[$key] =  $usersRow['first_name'].' '.$usersRow['last_name'];
    
    return $userArray;
}//end of function

function getLoginSecurityHelpBoxHtml($url){
    global $theme,$current_language;
        
    $helpBoxContent = '';
    $curl = curl_init();

    $postData = json_encode(array("themeName" => $theme, 'currentLanguage' => $current_language));
        
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,false);
    $data = curl_exec($curl);
    $httpCode = curl_getinfo($curl,CURLINFO_HTTP_CODE);
    if($httpCode == 200){
        $helpBoxContent = $data;
    }//end of if
    curl_close($curl);

    return $helpBoxContent;
}//end of function