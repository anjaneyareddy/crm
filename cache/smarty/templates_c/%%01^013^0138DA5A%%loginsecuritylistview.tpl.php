<?php /* Smarty version 2.6.33, created on 2023-07-16 18:38:43
         compiled from custom/modules/Administration/tpl/loginsecuritylistview.tpl */ ?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="custom/modules/Administration/css/LoginSecurityListView.css">
    </head>
    <body>
        <div class="moduleTitle">
            <h2 class="module-title-text"><?php echo $this->_tpl_vars['MOD']['LBL_LOGIN_SECURITY']; ?>
</h2>
            <button type='button' title="<?php echo $this->_tpl_vars['MOD']['LBL_BACK']; ?>
" class="button back" name="back" value="Back" onclick="location.href='<?php echo $this->_tpl_vars['ADMINISTRATION_VIEW']; ?>
';"><?php echo $this->_tpl_vars['MOD']['LBL_BACK']; ?>
</button> 
            <div class="clear"></div>
        </div>

        <!-- KiyoCRM Store HelpBox Content -->
        <?php echo $this->_tpl_vars['HELPBOXCONTENT']; ?>

        
        <?php if (! empty ( $this->_tpl_vars['LOGIN_SECURITY_DATA'] )): ?>
        <div>
            <table id="addNew">
                <tr>
                    <td>
                        <input type="button" name="addNew" value="<?php echo $this->_tpl_vars['MOD']['LBL_ADD_NEW']; ?>
" class="button" onclick="location.href='<?php echo $this->_tpl_vars['EDIT_VIEW_URL']; ?>
';">
                    </td>
                    <td class="bulkActionRow">
                        <button class="bulkAction" disabled="true">
                            <label class="selected-actions-label hidden-desktop">
                                <?php echo $this->_tpl_vars['MOD']['LBL_BULK_ACTION']; ?>

                                <span class="suitepicon suitepicon-action-caret actionIcon"></span>
                            </label>
                        </button>

                        <ul id="actionLinkTop" class="clickMenu selectActions fancymenu SugarActionMenu" style="display:none;" name="selectActions">
                            <li class="sugar_action_button actionButton">
                                <label class="selected-actions-label hidden-desktop actionLabel"><?php echo $this->_tpl_vars['MOD']['LBL_BULK_ACTION']; ?>

                                    <span class="suitepicon suitepicon-action-caret actions actionIcon"></span>
                                </label>
                                <ul class="subnav ddopen" id="actionMenu" style="display:none;">
                                    <li>
                                        <a class="btnDelete actionStatus"><?php echo $this->_tpl_vars['MOD']['LBL_DELETE']; ?>
</a>
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
                    <th><?php echo $this->_tpl_vars['MOD']['LBL_BLOCKING_TYPE']; ?>
</th>
                    <th><?php echo $this->_tpl_vars['MOD']['LBL_USERS_IP_BLOCKING']; ?>
</th>
                    <th><?php echo $this->_tpl_vars['MOD']['LBL_STATUS']; ?>
</th>
                    <th><?php echo $this->_tpl_vars['MOD']['LBL_DATE_CREATED']; ?>
</th>
                    <th><?php echo $this->_tpl_vars['MOD']['LBL_DATE_MODIFIED']; ?>
</th>
                </thead>
                <?php $_from = $this->_tpl_vars['LOGIN_SECURITY_DATA']; if (($_from instanceof StdClass) || (!is_array($_from) && !is_object($_from))) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
                <tr class="oddListRowS1" height="20" data-id="<?php echo $this->_tpl_vars['value']['id']; ?>
" value="<?php echo $this->_tpl_vars['value']['module']; ?>
">
                    <td><input title="<?php echo $this->_tpl_vars['MOD']['LBL_SELECT_THIS_ROW']; ?>
" class="listview-checkbox" name="mass[]" id="mass[]" value="<?php echo $this->_tpl_vars['value']['id']; ?>
" type="checkbox"></td>
                    <?php if ($this->_tpl_vars['THEME'] == 'Kiyo'): ?>
                    <td><a class="edit-link" title="Edit" id="<?php echo $this->_tpl_vars['value']['id']; ?>
" href="index.php?module=Administration&action=loginsecurityconfig&records=<?php echo $this->_tpl_vars['value']['id']; ?>
"><img src="themes/<?php echo $this->_tpl_vars['THEME']; ?>
/images/edit_inline.png"> </a></td>
                    <?php else: ?>
                    <td><a class="edit-link" title="Edit" id="<?php echo $this->_tpl_vars['value']['id']; ?>
" href="index.php?module=Administration&action=loginsecurityconfig&records=<?php echo $this->_tpl_vars['value']['id']; ?>
"><img src="themes/<?php echo $this->_tpl_vars['THEME']; ?>
/images/edit.gif"> </a></td>
                    <?php endif; ?>
                    <td scope="row" valign="top" align="left">
                       <?php echo $this->_tpl_vars['value']['blockingType']; ?>

                    </td>
                    <td scope="row" valign="top" align="left">
                        <?php echo $this->_tpl_vars['value']['usersIpBlocking']; ?>

                    </td>
                    <td scope="row" valign="top" align="left">
                        <label class="switch">
                            <input type="checkbox" class="enableLoginSecurity" name="enableLoginSecurity" <?php if ($this->_tpl_vars['value']['status'] == 'Active'): ?>checked="checked"<?php endif; ?> value="<?php echo $this->_tpl_vars['value']['status']; ?>
">
                            <span class="slider round" id='slider_round'></span>
                        </label>    
                    </td>
                    <td scope="row" valign="top" align="left">
                        <?php echo $this->_tpl_vars['value']['dateEntered']; ?>

                    </td>
                    <td scope="row" valign="top" align="left">
                        <?php echo $this->_tpl_vars['value']['dateModified']; ?>

                    </td>
                </tr>
                <?php endforeach; endif; unset($_from); ?>
            </table>
        </div>
        <?php else: ?>
        <br>
        <div class="list view listViewEmpty">
            <br>
            <p class="msg">
                <?php echo $this->_tpl_vars['MOD']['LBL_CREATE_MESSAGE']; ?>

                <a href="<?php echo $this->_tpl_vars['EDIT_VIEW_URL']; ?>
"><?php echo $this->_tpl_vars['MOD']['LBL_CREATE']; ?>
</a>
                <?php echo $this->_tpl_vars['MOD']['LBL_CREATE_MESSAGE_ONE']; ?>

            </p>
        </div>
        <?php endif; ?>
    </body>
</html>

<?php echo '
    <script type="text/javascript">
        var script = document.createElement("script");
        script.type = "text/javascript";
        script.src = "custom/modules/Administration/js/LoginSecurityListView.js?v="+Math.random();
        document.body.appendChild(script);
    </script>
'; ?>