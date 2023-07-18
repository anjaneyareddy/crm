{*

 *}
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="custom/modules/Administration/css/LoginSecurityListView.css">
    </head>
    <body>
        <div class="moduleTitle">
            <h2 class="module-title-text">{$MOD.LBL_LOGIN_SECURITY}</h2>
            <button type='button' title="{$MOD.LBL_BACK}" class="button back" name="back" value="Back" onclick="location.href='{$ADMINISTRATION_VIEW}';">{$MOD.LBL_BACK}</button> 
            <div class="clear"></div>
        </div>

        <!-- KiyoCRM Store HelpBox Content -->
        {$HELPBOXCONTENT}
        
        {if !empty($LOGIN_SECURITY_DATA)}
        <div>
            <table id="addNew">
                <tr>
                    <td>
                        <input type="button" name="addNew" value="{$MOD.LBL_ADD_NEW}" class="button" onclick="location.href='{$EDIT_VIEW_URL}';">
                    </td>
                    <td class="bulkActionRow">
                        <button class="bulkAction" disabled="true">
                            <label class="selected-actions-label hidden-desktop">
                                {$MOD.LBL_BULK_ACTION}
                                <span class="suitepicon suitepicon-action-caret actionIcon"></span>
                            </label>
                        </button>

                        <ul id="actionLinkTop" class="clickMenu selectActions fancymenu SugarActionMenu" style="display:none;" name="selectActions">
                            <li class="sugar_action_button actionButton">
                                <label class="selected-actions-label hidden-desktop actionLabel">{$MOD.LBL_BULK_ACTION}
                                    <span class="suitepicon suitepicon-action-caret actions actionIcon"></span>
                                </label>
                                <ul class="subnav ddopen" id="actionMenu" style="display:none;">
                                    <li>
                                        <a class="btnDelete actionStatus">{$MOD.LBL_DELETE}</a>
                                    </li>
                                </ul>
                            </li>
                        </ul> 
                    </td>
                </tr>
            </table>
        </div>
        
        <div class="list-view-rounded-corners">
            <table class="list view table-responsive">
                <thead>
                    <th><input type="checkbox" id="selectAll"></th>
                    <th class="login_security_links"></th>
                    <th>{$MOD.LBL_BLOCKING_TYPE}</th>
                    <th>{$MOD.LBL_USERS_IP_BLOCKING}</th>
                    <th>{$MOD.LBL_STATUS}</th>
                    <th>{$MOD.LBL_DATE_CREATED}</th>
                    <th>{$MOD.LBL_DATE_MODIFIED}</th>
                </thead>
                {foreach key=key item=value from=$LOGIN_SECURITY_DATA}
                <tr class="oddListRowS1" height="20" data-id="{$value.id}" value="{$value.module}">
                    <td><input title="{$MOD.LBL_SELECT_THIS_ROW}" class="listview-checkbox" name="mass[]" id="mass[]" value="{$value.id}" type="checkbox"></td>
                    {if $THEME eq 'Kiyo'}
                    <td><a class="edit-link" title="Edit" id="{$value.id}" href="index.php?module=Administration&action=loginsecurityconfig&records={$value.id}"><img src="themes/{$THEME}/images/edit_inline.png"> </a></td>
                    {else}
                    <td><a class="edit-link" title="Edit" id="{$value.id}" href="index.php?module=Administration&action=loginsecurityconfig&records={$value.id}"><img src="themes/{$THEME}/images/edit.gif"> </a></td>
                    {/if}
                    <td scope="row" valign="top" align="left">
                       {$value.blockingType}
                    </td>
                    <td scope="row" valign="top" align="left">
                        {$value.usersIpBlocking}
                    </td>
                    <td scope="row" valign="top" align="left">
                        <label class="switch">
                            <input type="checkbox" class="enableLoginSecurity" name="enableLoginSecurity" {if $value.status eq 'Active'}checked="checked"{/if} value="{$value.status}">
                            <span class="slider round" id='slider_round'></span>
                        </label>    
                    </td>
                    <td scope="row" valign="top" align="left">
                        {$value.dateEntered}
                    </td>
                    <td scope="row" valign="top" align="left">
                        {$value.dateModified}
                    </td>
                </tr>
                {/foreach}
            </table>
        </div>
        {else}
        <br>
        <div class="list view listViewEmpty">
            <br>
            <p class="msg">
                {$MOD.LBL_CREATE_MESSAGE}
                <a href="{$EDIT_VIEW_URL}">{$MOD.LBL_CREATE}</a>
                {$MOD.LBL_CREATE_MESSAGE_ONE}
            </p>
        </div>
        {/if}
    </body>
</html>

{literal}
    <script type="text/javascript">
        var script = document.createElement("script");
        script.type = "text/javascript";
        script.src = "custom/modules/Administration/js/LoginSecurityListView.js?v="+Math.random();
        document.body.appendChild(script);
    </script>
{/literal}