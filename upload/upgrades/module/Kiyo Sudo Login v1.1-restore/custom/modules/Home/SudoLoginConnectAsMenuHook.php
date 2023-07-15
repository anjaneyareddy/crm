<?php

class SudoLoginConnectAsMenuHook
{

    private static function listUsers_array($status = 'Active', $show_admins = false, $use_real_name = false, $user_name_filter = '', $portal_filter = ' AND portal_only=0 ', $from_cache = true)
{
    global $locale, $sugar_config, $current_user;

    if (empty($locale)) {
        $locale = new Localization();
    }

    if ($from_cache) {
        $key_name = $status . $use_real_name . $user_name_filter . $portal_filter;
        $user_array = get_register_value('sudologin_user_array', $key_name);
    }

    if (empty($user_array)) {
        $db = DBManagerFactory::getInstance();
        $temp_result = array();
        // Including deleted users for now.
        if (empty($status)) {
            $query = 'SELECT id, first_name, last_name, user_name FROM users WHERE 1=1' . $portal_filter;
        } else {
            $query = "SELECT id, first_name, last_name, user_name from users WHERE status='$status'" . $portal_filter;
        }
        /* BEGIN - SECURITY GROUPS */
        global $current_user, $sugar_config;
        if (!is_admin($current_user) && isset($sugar_config['securitysuite_filter_user_list']) && $sugar_config['securitysuite_filter_user_list'] == true && (empty($_REQUEST['module']) || $_REQUEST['module'] != 'Home') && (empty($_REQUEST['action']) || $_REQUEST['action'] != 'DynamicAction')
        ) {
            require_once 'modules/SecurityGroups/SecurityGroup.php';
            global $current_user;
            $group_where = SecurityGroup::getGroupUsersWhere($current_user->id);
            $query .= ' AND (' . $group_where . ') ';
        }
        /* END - SECURITY GROUPS */
        if (!$show_admins) {
            $query .= " AND is_admin = 0 ";
        }

        $query .= " AND id <> '$current_user->id'";
        
        if (!empty($user_name_filter)) {
            $user_name_filter = $db->quote($user_name_filter);
            $query .= " AND user_name LIKE '$user_name_filter%' ";
        }
        if (!empty($user_id)) {
            $query .= " OR id='{$user_id}'";
        }

        //get the user preference for name formatting, to be used in order by
        $order_by_string = ' user_name ASC ';
        if (!empty($current_user) && !empty($current_user->id)) {
            $formatString = $current_user->getPreference('default_locale_name_format');

            //create the order by string based on position of first and last name in format string
            $order_by_string = ' user_name ASC ';
            $firstNamePos = strpos($formatString, 'f');
            $lastNamePos = strpos($formatString, 'l');
            if ($firstNamePos !== false || $lastNamePos !== false) {
                //its possible for first name to be skipped, check for this
                if ($firstNamePos === false) {
                    $order_by_string = 'last_name ASC';
                } else {
                    $order_by_string = ($lastNamePos < $firstNamePos) ? 'last_name, first_name ASC' : 'first_name, last_name ASC';
                }
            }
        }

        $query = $query . ' ORDER BY ' . $order_by_string;
        $GLOBALS['log']->debug("get_user_array query: $query");
        $result = $db->query($query, true, 'Error filling in user array: ');

        // Get the id and the name.
        while ($row = $db->fetchByAssoc($result)) {
            if ($use_real_name == true || showFullName()) {
                if (isset($row['last_name'])) { // cn: we will ALWAYS have both first_name and last_name (empty value if blank in db)
                    $temp_result[$row['id']] = $locale->getLocaleFormattedName($row['first_name'], $row['last_name']);
                } else {
                    $temp_result[$row['id']] = $row['user_name'];
                }
            } else {
                $temp_result[$row['id']] = $row['user_name'];
            }
        }

        $user_array = $temp_result;
        if ($from_cache) {
            set_register_value('sudologin_user_array', $key_name, $temp_result);
        }
    }

    return $user_array;
}


    public static function aui_sudologin_menuconnectas($event, $arguments) {
        global $mod_strings;
        global $sugar_config;
        global $current_user;
        if (is_admin($current_user) && $_REQUEST['action'] == "index") {        
            echo <<< EOF
<script>
$( document ).ready(function() {
    \$menu = $("[data-action-name='user']").first();
    \$menu.attr('href', '#');
    \$menu.click(function() {
        $("#dialog222").dialog({
            resizable: false,
            height: "auto",
            width: 800,
            modal: true,
            buttons: {
              "Sudo Login as User": function() {
                window.location.href = "{$sugar_config['site_url']}/?module=Users&action=SudoLogin_Connect&record=" + $('#SudoLogin_user').val();
              },
              Cancel: function() {
                $( this ).dialog( "close" );
              }
            }
        });
        $(".ui-dialog-buttonpane button:contains('Sudo Login')").attr("disabled", true)
                                              .addClass("ui-state-disabled");
        $("#SudoLogin_user").change(function() {
            $(".ui-dialog-buttonpane button:contains('Sudo Login')").attr("disabled", false)
                                              .removeClass("ui-state-disabled");
        });
    });
});
</script> 
<div id='dialog222' style='display:none' title='{$mod_strings['LBL_SUDOLOGIN_POPUP_TITLE']}'>
    <p style='font-weight:bold;'>
        <span style='font-size:30px;display: inline-block;' class='suitepicon suitepicon-admin-oauth-keys'></span> 
        {$mod_strings['LBL_SUDOLOGIN_POPUP_SUBTITLE']}
    </p>
    <blockquote><em>{$mod_strings['LBL_SUDOLOGIN_POPUP_BLOCKQUOTE']}</em></blockquote>
    <p>{$mod_strings['LBL_SUDOLOGIN_POPUP_P1']}</p>
    <p>{$mod_strings['LBL_SUDOLOGIN_POPUP_P2']}</p>
    <br/>
    <p>{$mod_strings['LBL_SUDOLOGIN_POPUP_P3']}</p>
    <br/>
    <p>{$mod_strings['LBL_SUDOLOGIN_POPUP_P4']}</p>
    <select name="SudoLogin_user" id="SudoLogin_user">
      <option disabled selected>{$mod_strings['LBL_SUDOLOGIN_SELECT_HINT']}</option>
EOF;
            require_once('include/utils.php');
            $users_list = SudoLoginConnectAsMenuHook::listUsers_array(false, false);
            //asort($users_list);
            foreach($users_list as $id=>$username) {
                echo "<option value='$id'>$username</option>";
            }
echo <<<EOF
    </select>
</div>
EOF;
        }
    }
}