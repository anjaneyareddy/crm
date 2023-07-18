<?php /* Smarty version 2.6.33, created on 2023-07-16 18:38:45
         compiled from custom/modules/Administration/tpl/loginsecurityconfig.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'json_encode', 'custom/modules/Administration/tpl/loginsecurityconfig.tpl', 219, false),)), $this); ?>
 <html>
	<head>
		<link rel="stylesheet" type="text/css" href="custom/modules/Administration/css/LoginSecurityConfig.css">
	</head>
	<body>
		<div class="moduleTitle">
			<h2 id="moduleTitle"><?php echo $this->_tpl_vars['MOD']['LBL_LOGIN_SECURITY']; ?>
</h2>
		</div>
		<div class="clear"></div>
		<form name="EditView" id="EditView">
			<div class="progression-container">
			   <ul class="progression">
				    <li id="navStep1" class="nav-steps selected" data-nav-step="1"><div><?php echo $this->_tpl_vars['MOD']['LBL_IP_BLOCKING']; ?>
</div></li>
			        <li id="navStep2" class="nav-steps" data-nav-step="2"><div id="label"><?php echo $this->_tpl_vars['MOD']['LBL_OTP_BASED']; ?>
</div></li>
				</ul>
			</div>
			<p>
				<div id='buttons'>
				    <table width="100%" border="0" cellspacing="0" cellpadding="0">
				        <tr> 
				            <td align="left" width='30%'>
				            	<table border="0" cellspacing="0" cellpadding="0" ><tr>
				                    <td><button id="btnBack" type='button' class="button" name="btnBack"><?php echo $this->_tpl_vars['MOD']['LBL_BACK']; ?>
</button></td>
				                    <td><button type="button" class="button" name="btnCancel" id="btnCancel"><?php echo $this->_tpl_vars['MOD']['LBL_CANCEL']; ?>
</button></td>
				                    <td><button type="button" class="button" name="btnClear" id="btnClear" onclick = "clearall();"><?php echo $this->_tpl_vars['MOD']['LBL_CLEAR']; ?>
</button></td>
				                    <td><button type="button" class="button" name="btnNext" id="btnNext"><?php echo $this->_tpl_vars['MOD']['LBL_NEXT']; ?>
</button></td>
				                    <td><button type="button" class="button" name="btnSave" id="btnSave"><?php echo $this->_tpl_vars['MOD']['LBL_SAVE']; ?>
</button></td>
				                </table>
				            </td>
				        </tr>
				    </table>
				</div>
			</p>
			<table cellspacing="1" id="loginSecurity">
			    <tr>
			        <td class='edit view' rowspan='2' width='100%'>
			            <div id="wiz_message"></div>
			            <div id="wizard" class="wizard-unique-elem">
			            	<div id="step1">
			                    <div class="template-panel">
			                        <div class="template-panel-container panel">
			                            <div class="template-container-full">
			                                <table width="100%" border="0" cellspacing="10" cellpadding="0">
			                                    <tbody>
			                                    	<tr><th colspan="4"><h4 class="header-4"><?php echo $this->_tpl_vars['MOD']['LBL_IP_BLOCKING']; ?>
</h4></th></tr>
			                                    	<tr rowspan="4">
			                                    		<td><b><?php echo $this->_tpl_vars['MOD']['LBL_SELECT_IP_BLOCKING_TYPE']; ?>
<span class="required">*</span></b>
			                                    		<img src="<?php echo $this->_tpl_vars['HELP_LINE_IMAGE_PATH']; ?>
" class="image" alt="<?php echo $this->_tpl_vars['MOD']['LBL_INFO_INLINE']; ?>
" height="15" width="15" onclick="return SUGAR.util.showHelpTips(this,'<?php echo $this->_tpl_vars['MOD']['LBL_SELECT_IP_BLOCKING_TYPE_INFO']; ?>
');">
			                                    		</td>
			                                    		<td class="setvisibilityclass">
			                                            	<select name="blockingType" id="blockingType">
					                                            <option value="" selected="selected"><?php echo $this->_tpl_vars['MOD']['LBL_SELECT_AN_OPTION']; ?>
</option>
			                                            		<option label="<?php echo $this->_tpl_vars['MOD']['LBL_SPECIFIC_IP']; ?>
" value="Specific Ip" <?php if (isset ( $this->_tpl_vars['IP_BLOCKING_DATA']['ipBlockingType'] ) && $this->_tpl_vars['IP_BLOCKING_DATA']['ipBlockingType'] == 'Specific Ip'): ?> selected="selected" <?php endif; ?>><?php echo $this->_tpl_vars['MOD']['LBL_SPECIFIC_IP']; ?>
</option>
			                                            		<option label="<?php echo $this->_tpl_vars['MOD']['LBL_ALL_RANGE']; ?>
" value="All Range" <?php if (isset ( $this->_tpl_vars['IP_BLOCKING_DATA']['ipBlockingType'] ) && $this->_tpl_vars['IP_BLOCKING_DATA']['ipBlockingType'] == 'All Range'): ?> selected="selected" <?php endif; ?>><?php echo $this->_tpl_vars['MOD']['LBL_ALL_RANGE']; ?>
</option>
			                                            		<option label="<?php echo $this->_tpl_vars['MOD']['LBL_COMMA_SEPARATED']; ?>
" value="Comma Separated" <?php if (isset ( $this->_tpl_vars['IP_BLOCKING_DATA']['ipBlockingType'] ) && $this->_tpl_vars['IP_BLOCKING_DATA']['ipBlockingType'] == 'Comma Separated'): ?> selected="selected" <?php endif; ?>><?php echo $this->_tpl_vars['MOD']['LBL_COMMA_SEPARATED']; ?>
</option>
			                                            	</select>
			                                        	</td>
			                                    	</tr>

			                                    	<tr rowspan="4">
			                                    		<td><b><?php echo $this->_tpl_vars['MOD']['LBL_SELECT_USERS_IP_BLOCKING']; ?>
<span class="required">*</span></b>
			                                    		<img src="<?php echo $this->_tpl_vars['HELP_LINE_IMAGE_PATH']; ?>
" class="image" alt="<?php echo $this->_tpl_vars['MOD']['LBL_INFO_INLINE']; ?>
" height="15" width="15" onclick="return SUGAR.util.showHelpTips(this,'<?php echo $this->_tpl_vars['MOD']['LBL_SELECT_USERS_IP_BLOCKING_INFO']; ?>
');">
			                                    		</td>
			                                    		<td class="setvisibilityclass">
			                                            	<select name="ipBlockingUserType" id="ipBlockingUserType">
					                                            <option value=""><?php echo $this->_tpl_vars['MOD']['LBL_SELECT_AN_OPTION']; ?>
</option>
			                                            		<option label="<?php echo $this->_tpl_vars['MOD']['LBL_ALL_USERS']; ?>
" value="All Users" <?php if (isset ( $this->_tpl_vars['IP_BLOCKING_DATA']['usersTypeIpBlocking'] ) && $this->_tpl_vars['IP_BLOCKING_DATA']['usersTypeIpBlocking'] == 'All Users'): ?> selected="selected" <?php endif; ?>><?php echo $this->_tpl_vars['MOD']['LBL_ALL_USERS']; ?>
</option>
			                                            		<option label="<?php echo $this->_tpl_vars['MOD']['LBL_SPECIFIC_GROUP_USER']; ?>
" value="Specific Group or User" <?php if (isset ( $this->_tpl_vars['IP_BLOCKING_DATA']['usersTypeIpBlocking'] ) && $this->_tpl_vars['IP_BLOCKING_DATA']['usersTypeIpBlocking'] == 'Specific Group or User'): ?> selected="selected" <?php endif; ?>><?php echo $this->_tpl_vars['MOD']['LBL_SPECIFIC_GROUP_USER']; ?>
</option>
			                                            	</select>
			                                        	</td>
			                                    	</tr>

			                                    	<tr rowspan="4" style="display:none;" id="specificGroupsUsersRow">
			                                    		<td><b><?php echo $this->_tpl_vars['MOD']['LBL_SELECT_USERS']; ?>
<span class="required">*</span></b>
			                                    		<img src="<?php echo $this->_tpl_vars['HELP_LINE_IMAGE_PATH']; ?>
" class="image" alt="<?php echo $this->_tpl_vars['MOD']['LBL_INFO_INLINE']; ?>
" height="15" width="15" onclick="return SUGAR.util.showHelpTips(this,'<?php echo $this->_tpl_vars['MOD']['LBL_SELECT_USERS_INFO']; ?>
');">
			                                    		</td>
			                                    		<td class="setvisibilityclass">
			                                            	<select name="specificGroupsUsers[]" id="specificGroupsUsers" multiple="true">
                                                            </select>
			                                        	</td>
			                                    	</tr>

			                                    	<tr rowspan="4" id="allowUsersRow">
			                                        </tr>

			                                        <tr rowspan="4" id="denyUsersRow">
			                                        </tr>

			                                        <tr rowspan="4">
			                                            <td id="statusLabel">
			                                            	<b><?php echo $this->_tpl_vars['MOD']['LBL_STATUS']; ?>
</b>
			                                            	<img src="<?php echo $this->_tpl_vars['HELP_LINE_IMAGE_PATH']; ?>
" class="image" alt="<?php echo $this->_tpl_vars['MOD']['LBL_INFO_INLINE']; ?>
" height="15" width="15" onclick="return SUGAR.util.showHelpTips(this,'<?php echo $this->_tpl_vars['MOD']['LBL_STATUS_INFO']; ?>
');">
			                                            </td>
			                                            <td class="setvisibilityclass" id="statusCol">
			                                            	<select name="status" id="status">
																<option label="<?php echo $this->_tpl_vars['MOD']['LBL_ACTIVE']; ?>
" value="Active" <?php if (isset ( $this->_tpl_vars['IP_BLOCKING_DATA']['status'] ) && $this->_tpl_vars['IP_BLOCKING_DATA']['status'] == 'Active'): ?> selected="selected" <?php endif; ?>><?php echo $this->_tpl_vars['MOD']['LBL_ACTIVE']; ?>
</option>
					                                            <option label="<?php echo $this->_tpl_vars['MOD']['LBL_INACTIVE']; ?>
" value="Inactive" <?php if (isset ( $this->_tpl_vars['IP_BLOCKING_DATA']['status'] ) && $this->_tpl_vars['IP_BLOCKING_DATA']['status'] == 'Inactive'): ?> selected="selected" <?php endif; ?>><?php echo $this->_tpl_vars['MOD']['LBL_INACTIVE']; ?>
</option>
				                                        	</select>
				                                    	</td>
			                                        </tr>
			                                    </tbody>
			                                </table>
			                            </div>
			                        </div>
			                    </div>
			                </div>

			                <div id="step2">
			                	<div class="template-panel">
			                        <div class="template-panel-container panel">
			                            <div class="template-container-full">
			                            	<input type="hidden" name="ipBlockingId" id="ipBlockingId" value=""/>
			                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
			                                    <tbody>
			                                        <tr>
			                                        	<th colspan="4">
			                                        		<h4 class="header-4"><?php echo $this->_tpl_vars['MOD']['LBL_OTP_BASED']; ?>
</h4>
														</th>
			                                        </tr>

			                                        <tr rowspan="4">
			                                        	<td id="otpLoginSecurityLabel"><b><?php echo $this->_tpl_vars['MOD']['LBL_OTP_LOGIN_SECURITY']; ?>
<span class="required">*</span></b></td>
			                                        	<td>
			                                        		<label class="switch">
									                            <input type="checkbox" id="enableOTPLoginSecurity" name="enableOTPLoginSecurity" value="<?php if (isset ( $this->_tpl_vars['OTP_BASED_DATA']['enableOtpBased'] ) && $this->_tpl_vars['OTP_BASED_DATA']['enableOtpBased'] == '1'): ?>1<?php else: ?>0<?php endif; ?>" <?php if (isset ( $this->_tpl_vars['OTP_BASED_DATA']['enableOtpBased'] ) && $this->_tpl_vars['OTP_BASED_DATA']['enableOtpBased'] == '1'): ?> checked="checked" <?php endif; ?>>
									                            <span class="slider round" id='slider_round'></span>
									                        </label>
			                                        	</td>
			                                        </tr>

			                                        <tr rowspan="4" id="otpTypeRow">
			                                    		<td id="otpTypeLabel"><b><?php echo $this->_tpl_vars['MOD']['LBL_OTP_TYPE']; ?>
<span class="required">*</span></b>
			                                    		<img src="<?php echo $this->_tpl_vars['HELP_LINE_IMAGE_PATH']; ?>
" class="image" alt="<?php echo $this->_tpl_vars['MOD']['LBL_INFO_INLINE']; ?>
" height="15" width="15" onclick="return SUGAR.util.showHelpTips(this,'<?php echo $this->_tpl_vars['MOD']['LBL_OTP_TYPE_INFO']; ?>
');">
			                                    		</td>
			                                    		<td class="setvisibilityclass" id="otpTypeCol">
			                                            	<select name="otpType" id="otpType">
					                                            <option value="" selected="selected"><?php echo $this->_tpl_vars['MOD']['LBL_SELECT_AN_OPTION']; ?>
</option>
			                                            		<option label="<?php echo $this->_tpl_vars['MOD']['LBL_EMAIL']; ?>
" value="Email" <?php if (isset ( $this->_tpl_vars['OTP_BASED_DATA']['otpType'] ) && $this->_tpl_vars['OTP_BASED_DATA']['otpType'] == 'Email'): ?> selected="selected" <?php endif; ?>><?php echo $this->_tpl_vars['MOD']['LBL_EMAIL']; ?>
</option>
			                                            	</select>
			                                        	</td>
			                                    	</tr>

			                                    	<tr rowspan="4" id="emailSubjectRow">
			                                    		<td><b><?php echo $this->_tpl_vars['MOD']['LBL_SUBJECT']; ?>
<span class="required">*</span><b></td>
			                                    		<td><input type="text" name="emailSubject" id="emailSubject" value="<?php if (isset ( $this->_tpl_vars['OTP_BASED_DATA']['emailSubject'] )): ?><?php echo $this->_tpl_vars['OTP_BASED_DATA']['emailSubject']; ?>
<?php endif; ?>" style="margin-bottom: 10px;" ></td>
			                                    	</tr>
			                                    	
			                                    	<tr rowspan="4" id="templateEditorRow">
										                <td></td>   
											            <td>
											                <textarea name="templateEditor" id="templateEditor" rows="4" cols="50"><?php if (isset ( $this->_tpl_vars['OTP_BASED_DATA']['body'] )): ?><?php echo $this->_tpl_vars['OTP_BASED_DATA']['body']; ?>
<?php endif; ?></textarea>
										                </td>
										            </tr>

										            <tr rowspan = "4" id="smsTriggerRow">
			                                    		<td><b><?php echo $this->_tpl_vars['MOD']['LBL_SMS_TRIGGER']; ?>
<span class="required">*</span></b>
			                                    		<img src="<?php echo $this->_tpl_vars['HELP_LINE_IMAGE_PATH']; ?>
" class="image" alt="<?php echo $this->_tpl_vars['MOD']['LBL_INFO_INLINE']; ?>
" height="15" width="15" onclick="return SUGAR.util.showHelpTips(this,'<?php echo $this->_tpl_vars['MOD']['LBL_SMS_TRIGGER_MSG']; ?>
');">
			                                    		</td>
			                                    		<td class="setvisibilityclass" style="margin-top:10px;">
			                                            	<select name="smsTrigger" id="smsTrigger">
					                                            <option value="" selected="selected"><?php echo $this->_tpl_vars['MOD']['LBL_SELECT_AN_OPTION']; ?>
</option>
					                                            
			                                            		<option label="<?php echo $this->_tpl_vars['MOD']['LBL_DAYS']; ?>
" value="Days" <?php if (isset ( $this->_tpl_vars['OTP_BASED_DATA']['smsTrigger'] ) && $this->_tpl_vars['OTP_BASED_DATA']['smsTrigger'] == 'Days'): ?> selected="selected" <?php endif; ?>><?php echo $this->_tpl_vars['MOD']['LBL_DAYS']; ?>
</option>
			                                            		<option label="<?php echo $this->_tpl_vars['MOD']['LBL_WEEK']; ?>
" value="Week" <?php if (isset ( $this->_tpl_vars['OTP_BASED_DATA']['smsTrigger'] ) && $this->_tpl_vars['OTP_BASED_DATA']['smsTrigger'] == 'Week'): ?> selected="selected" <?php endif; ?>><?php echo $this->_tpl_vars['MOD']['LBL_WEEK']; ?>
</option>
			                                            		<option label="<?php echo $this->_tpl_vars['MOD']['LBL_MONTH']; ?>
" value="Month" <?php if (isset ( $this->_tpl_vars['OTP_BASED_DATA']['smsTrigger'] ) && $this->_tpl_vars['OTP_BASED_DATA']['smsTrigger'] == 'Month'): ?> selected="selected" <?php endif; ?>><?php echo $this->_tpl_vars['MOD']['LBL_MONTH']; ?>
</option>
			                                            		<option label="<?php echo $this->_tpl_vars['MOD']['LBL_MINUTES']; ?>
" value="Minutes" <?php if (isset ( $this->_tpl_vars['OTP_BASED_DATA']['smsTrigger'] ) && $this->_tpl_vars['OTP_BASED_DATA']['smsTrigger'] == 'Minutes'): ?> selected="selected" <?php endif; ?>><?php echo $this->_tpl_vars['MOD']['LBL_MINUTES']; ?>
</option>
			                                            	</select>
			                                        	</td>
			                                    	</tr>

			                                    	<tr rowspan = "4" id="minutesRow" style="display:none;">
			                                    		<td><b><?php echo $this->_tpl_vars['MOD']['LBL_RESEND_OTP_IN_MINUTES']; ?>
<span class="required">*</span></b>
			                                    		<img src="<?php echo $this->_tpl_vars['HELP_LINE_IMAGE_PATH']; ?>
" class="image" alt="<?php echo $this->_tpl_vars['MOD']['LBL_INFO_INLINE']; ?>
" height="15" width="15" onclick="return SUGAR.util.showHelpTips(this,'<?php echo $this->_tpl_vars['MOD']['LBL_RESEND_OTP_MSG']; ?>
');">
			                                    		</td>
			                                    		<td class="setvisibilityclass">
			                                            	<select name="minutes" id="minutes">
					                                            <option value="" selected="selected"><?php echo $this->_tpl_vars['MOD']['LBL_SELECT_AN_OPTION']; ?>
</option>
					                                            <option label="<?php echo $this->_tpl_vars['MOD']['LBL_2_MINUTES']; ?>
" value="2 Minutes" <?php if (isset ( $this->_tpl_vars['OTP_BASED_DATA']['resendOtpMinutes'] ) && $this->_tpl_vars['OTP_BASED_DATA']['resendOtpMinutes'] == '2 Minutes'): ?> selected="selected" <?php endif; ?>><?php echo $this->_tpl_vars['MOD']['LBL_2_MINUTES']; ?>
</option>
			                                            		<option label="<?php echo $this->_tpl_vars['MOD']['LBL_5_MINUTES']; ?>
" value="5 Minutes" <?php if (isset ( $this->_tpl_vars['OTP_BASED_DATA']['resendOtpMinutes'] ) && $this->_tpl_vars['OTP_BASED_DATA']['resendOtpMinutes'] == '5 Minutes'): ?> selected="selected" <?php endif; ?>><?php echo $this->_tpl_vars['MOD']['LBL_5_MINUTES']; ?>
</option>
			                                            		<option label="<?php echo $this->_tpl_vars['MOD']['LBL_10_MINUTES']; ?>
" value="10 Minutes" <?php if (isset ( $this->_tpl_vars['OTP_BASED_DATA']['resendOtpMinutes'] ) && $this->_tpl_vars['OTP_BASED_DATA']['resendOtpMinutes'] == '10 Minutes'): ?> selected="selected" <?php endif; ?>><?php echo $this->_tpl_vars['MOD']['LBL_10_MINUTES']; ?>
</option>
			                                            		<option label="<?php echo $this->_tpl_vars['MOD']['LBL_15_MINUTES']; ?>
" value="15 Minutes" <?php if (isset ( $this->_tpl_vars['OTP_BASED_DATA']['resendOtpMinutes'] ) && $this->_tpl_vars['OTP_BASED_DATA']['resendOtpMinutes'] == '15 Minutes'): ?> selected="selected" <?php endif; ?>><?php echo $this->_tpl_vars['MOD']['LBL_15_MINUTES']; ?>
</option>
			                                            	</select>
			                                        	</td>
			                                    	</tr>

			                                    	<tr rowspan = "4" id="daysRow">
			                                    		<td><b><?php echo $this->_tpl_vars['MOD']['LBL_DAYS_RESEND_OTP']; ?>
<span class="required">*</span></b>
			                                    		<img src="<?php echo $this->_tpl_vars['HELP_LINE_IMAGE_PATH']; ?>
" class="image" alt="<?php echo $this->_tpl_vars['MOD']['LBL_INFO_INLINE']; ?>
" height="15" width="15" onclick="return SUGAR.util.showHelpTips(this,'<?php echo $this->_tpl_vars['MOD']['LBL_RESEND_OTP_MSG']; ?>
');">
			                                    		</td>
			                                    		<td class="setvisibilityclass">
			                                            	<select name="days" id="days">
					                                            <option value="" selected="selected"><?php echo $this->_tpl_vars['MOD']['LBL_SELECT_AN_OPTION']; ?>
</option>
			                                            		<option label="<?php echo $this->_tpl_vars['MOD']['LBL_30_DAYS']; ?>
" value="30 Days" <?php if (isset ( $this->_tpl_vars['OTP_BASED_DATA']['resendOtp'] ) && $this->_tpl_vars['OTP_BASED_DATA']['resendOtp'] == '30 Days'): ?> selected="selected" <?php endif; ?>><?php echo $this->_tpl_vars['MOD']['LBL_30_DAYS']; ?>
</option>
			                                            		<option label="<?php echo $this->_tpl_vars['MOD']['LBL_60_DAYS']; ?>
" value="60 Days" <?php if (isset ( $this->_tpl_vars['OTP_BASED_DATA']['resendOtp'] ) && $this->_tpl_vars['OTP_BASED_DATA']['resendOtp'] == '60 Days'): ?> selected="selected" <?php endif; ?>><?php echo $this->_tpl_vars['MOD']['LBL_60_DAYS']; ?>
</option>
			                                            		<option label="<?php echo $this->_tpl_vars['MOD']['LBL_180_DAYS']; ?>
" value="180 Days" <?php if (isset ( $this->_tpl_vars['OTP_BASED_DATA']['resendOtp'] ) && $this->_tpl_vars['OTP_BASED_DATA']['resendOtp'] == '180 Days'): ?> selected="selected" <?php endif; ?>><?php echo $this->_tpl_vars['MOD']['LBL_180_DAYS']; ?>
</option>
			                                            	</select>
			                                        	</td>
			                                    	</tr>
			                                    </tbody>
			                                </table>
			                            </div>
			                        </div>
			                    </div>
			                </div>
			            </div>
			        </td>
			    </tr>
			</table>
		</form>
	</body>
</html>

<?php echo '
	<script src="include/javascript/tiny_mce/tiny_mce.js"></script>
    <script type="text/javascript">
    	var ipBlockingData = '; ?>
<?php echo json_encode($this->_tpl_vars['IP_BLOCKING_DATA']); ?>
<?php echo ';
    	var otpBasedData = '; ?>
<?php echo json_encode($this->_tpl_vars['OTP_BASED_DATA']); ?>
<?php echo ';
    	var theme = "'; ?>
<?php echo $this->_tpl_vars['THEME']; ?>
<?php echo '";
    	var recordId = "'; ?>
<?php echo $this->_tpl_vars['RECORD_ID']; ?>
<?php echo '";
        var script = document.createElement("script");
        script.type = "text/javascript";
        script.src = "custom/modules/Administration/js/LoginSecurityConfig.js?v="+Math.random();
        document.body.appendChild(script);
    </script>
'; ?>