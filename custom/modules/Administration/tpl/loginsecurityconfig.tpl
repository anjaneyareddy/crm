{*

 *}
 <html>
	<head>
		<link rel="stylesheet" type="text/css" href="custom/modules/Administration/css/LoginSecurityConfig.css">
	</head>
	<body>
		<div class="moduleTitle">
			<h2 id="moduleTitle">{$MOD.LBL_LOGIN_SECURITY}</h2>
		</div>
		<div class="clear"></div>
		<form name="EditView" id="EditView">
			<div class="progression-container">
			   <ul class="progression">
				    <li id="navStep1" class="nav-steps selected" data-nav-step="1"><div>{$MOD.LBL_IP_BLOCKING}</div></li>
			        <li id="navStep2" class="nav-steps" data-nav-step="2"><div id="label">{$MOD.LBL_OTP_BASED}</div></li>
				</ul>
			</div>
			<p>
				<div id='buttons'>
				    <table width="100%" border="0" cellspacing="0" cellpadding="0">
				        <tr> 
				            <td align="left" width='30%'>
				            	<table border="0" cellspacing="0" cellpadding="0" ><tr>
				                    <td><button id="btnBack" type='button' class="button" name="btnBack">{$MOD.LBL_BACK}</button></td>
				                    <td><button type="button" class="button" name="btnCancel" id="btnCancel">{$MOD.LBL_CANCEL}</button></td>
				                    <td><button type="button" class="button" name="btnClear" id="btnClear" onclick = "clearall();">{$MOD.LBL_CLEAR}</button></td>
				                    <td><button type="button" class="button" name="btnNext" id="btnNext">{$MOD.LBL_NEXT}</button></td>
				                    <td><button type="button" class="button" name="btnSave" id="btnSave">{$MOD.LBL_SAVE}</button></td>
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
			                                    	<tr><th colspan="4"><h4 class="header-4">{$MOD.LBL_IP_BLOCKING}</h4></th></tr>
			                                    	<tr rowspan="4">
			                                    		<td><b>{$MOD.LBL_SELECT_IP_BLOCKING_TYPE}<span class="required">*</span></b>
			                                    		<img src="{$HELP_LINE_IMAGE_PATH}" class="image" alt="{$MOD.LBL_INFO_INLINE}" height="15" width="15" onclick="return SUGAR.util.showHelpTips(this,'{$MOD.LBL_SELECT_IP_BLOCKING_TYPE_INFO}');">
			                                    		</td>
			                                    		<td class="setvisibilityclass">
			                                            	<select name="blockingType" id="blockingType">
					                                            <option value="" selected="selected">{$MOD.LBL_SELECT_AN_OPTION}</option>
			                                            		<option label="{$MOD.LBL_SPECIFIC_IP}" value="Specific Ip" {if isset($IP_BLOCKING_DATA.ipBlockingType) && $IP_BLOCKING_DATA.ipBlockingType eq 'Specific Ip'} selected="selected" {/if}>{$MOD.LBL_SPECIFIC_IP}</option>
			                                            		<option label="{$MOD.LBL_ALL_RANGE}" value="All Range" {if isset($IP_BLOCKING_DATA.ipBlockingType) && $IP_BLOCKING_DATA.ipBlockingType eq 'All Range'} selected="selected" {/if}>{$MOD.LBL_ALL_RANGE}</option>
			                                            		<option label="{$MOD.LBL_COMMA_SEPARATED}" value="Comma Separated" {if isset($IP_BLOCKING_DATA.ipBlockingType) && $IP_BLOCKING_DATA.ipBlockingType eq 'Comma Separated'} selected="selected" {/if}>{$MOD.LBL_COMMA_SEPARATED}</option>
			                                            	</select>
			                                        	</td>
			                                    	</tr>

			                                    	<tr rowspan="4">
			                                    		<td><b>{$MOD.LBL_SELECT_USERS_IP_BLOCKING}<span class="required">*</span></b>
			                                    		<img src="{$HELP_LINE_IMAGE_PATH}" class="image" alt="{$MOD.LBL_INFO_INLINE}" height="15" width="15" onclick="return SUGAR.util.showHelpTips(this,'{$MOD.LBL_SELECT_USERS_IP_BLOCKING_INFO}');">
			                                    		</td>
			                                    		<td class="setvisibilityclass">
			                                            	<select name="ipBlockingUserType" id="ipBlockingUserType">
					                                            <option value="">{$MOD.LBL_SELECT_AN_OPTION}</option>
			                                            		<option label="{$MOD.LBL_ALL_USERS}" value="All Users" {if isset($IP_BLOCKING_DATA.usersTypeIpBlocking) && $IP_BLOCKING_DATA.usersTypeIpBlocking eq 'All Users'} selected="selected" {/if}>{$MOD.LBL_ALL_USERS}</option>
			                                            		<option label="{$MOD.LBL_SPECIFIC_GROUP_USER}" value="Specific Group or User" {if isset($IP_BLOCKING_DATA.usersTypeIpBlocking) && $IP_BLOCKING_DATA.usersTypeIpBlocking eq 'Specific Group or User'} selected="selected" {/if}>{$MOD.LBL_SPECIFIC_GROUP_USER}</option>
			                                            	</select>
			                                        	</td>
			                                    	</tr>

			                                    	<tr rowspan="4" style="display:none;" id="specificGroupsUsersRow">
			                                    		<td><b>{$MOD.LBL_SELECT_USERS}<span class="required">*</span></b>
			                                    		<img src="{$HELP_LINE_IMAGE_PATH}" class="image" alt="{$MOD.LBL_INFO_INLINE}" height="15" width="15" onclick="return SUGAR.util.showHelpTips(this,'{$MOD.LBL_SELECT_USERS_INFO}');">
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
			                                            	<b>{$MOD.LBL_STATUS}</b>
			                                            	<img src="{$HELP_LINE_IMAGE_PATH}" class="image" alt="{$MOD.LBL_INFO_INLINE}" height="15" width="15" onclick="return SUGAR.util.showHelpTips(this,'{$MOD.LBL_STATUS_INFO}');">
			                                            </td>
			                                            <td class="setvisibilityclass" id="statusCol">
			                                            	<select name="status" id="status">
																<option label="{$MOD.LBL_ACTIVE}" value="Active" {if isset($IP_BLOCKING_DATA.status) && $IP_BLOCKING_DATA.status eq 'Active'} selected="selected" {/if}>{$MOD.LBL_ACTIVE}</option>
					                                            <option label="{$MOD.LBL_INACTIVE}" value="Inactive" {if isset($IP_BLOCKING_DATA.status) && $IP_BLOCKING_DATA.status eq 'Inactive'} selected="selected" {/if}>{$MOD.LBL_INACTIVE}</option>
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
			                                        		<h4 class="header-4">{$MOD.LBL_OTP_BASED}</h4>
														</th>
			                                        </tr>

			                                        <tr rowspan="4">
			                                        	<td id="otpLoginSecurityLabel"><b>{$MOD.LBL_OTP_LOGIN_SECURITY}<span class="required">*</span></b></td>
			                                        	<td>
			                                        		<label class="switch">
									                            <input type="checkbox" id="enableOTPLoginSecurity" name="enableOTPLoginSecurity" value="{if isset($OTP_BASED_DATA.enableOtpBased) && $OTP_BASED_DATA.enableOtpBased eq '1'}1{else}0{/if}" {if isset($OTP_BASED_DATA.enableOtpBased) && $OTP_BASED_DATA.enableOtpBased eq '1'} checked="checked" {/if}>
									                            <span class="slider round" id='slider_round'></span>
									                        </label>
			                                        	</td>
			                                        </tr>

			                                        <tr rowspan="4" id="otpTypeRow">
			                                    		<td id="otpTypeLabel"><b>{$MOD.LBL_OTP_TYPE}<span class="required">*</span></b>
			                                    		<img src="{$HELP_LINE_IMAGE_PATH}" class="image" alt="{$MOD.LBL_INFO_INLINE}" height="15" width="15" onclick="return SUGAR.util.showHelpTips(this,'{$MOD.LBL_OTP_TYPE_INFO}');">
			                                    		</td>
			                                    		<td class="setvisibilityclass" id="otpTypeCol">
			                                            	<select name="otpType" id="otpType">
					                                            <option value="" selected="selected">{$MOD.LBL_SELECT_AN_OPTION}</option>
			                                            		<option label="{$MOD.LBL_EMAIL}" value="Email" {if isset($OTP_BASED_DATA.otpType) && $OTP_BASED_DATA.otpType eq 'Email'} selected="selected" {/if}>{$MOD.LBL_EMAIL}</option>
			                                            	</select>
			                                        	</td>
			                                    	</tr>

			                                    	<tr rowspan="4" id="emailSubjectRow">
			                                    		<td><b>{$MOD.LBL_SUBJECT}<span class="required">*</span><b></td>
			                                    		<td><input type="text" name="emailSubject" id="emailSubject" value="{if isset($OTP_BASED_DATA.emailSubject)}{$OTP_BASED_DATA.emailSubject}{/if}" style="margin-bottom: 10px;" ></td>
			                                    	</tr>
			                                    	
			                                    	<tr rowspan="4" id="templateEditorRow">
										                <td></td>   
											            <td>
											                <textarea name="templateEditor" id="templateEditor" rows="4" cols="50">{if isset($OTP_BASED_DATA.body)}{$OTP_BASED_DATA.body}{/if}</textarea>
										                </td>
										            </tr>

										            <tr rowspan = "4" id="smsTriggerRow">
			                                    		<td><b>{$MOD.LBL_SMS_TRIGGER}<span class="required">*</span></b>
			                                    		<img src="{$HELP_LINE_IMAGE_PATH}" class="image" alt="{$MOD.LBL_INFO_INLINE}" height="15" width="15" onclick="return SUGAR.util.showHelpTips(this,'{$MOD.LBL_SMS_TRIGGER_MSG}');">
			                                    		</td>
			                                    		<td class="setvisibilityclass" style="margin-top:10px;">
			                                            	<select name="smsTrigger" id="smsTrigger">
					                                            <option value="" selected="selected">{$MOD.LBL_SELECT_AN_OPTION}</option>
					                                            
			                                            		<option label="{$MOD.LBL_DAYS}" value="Days" {if isset($OTP_BASED_DATA.smsTrigger) && $OTP_BASED_DATA.smsTrigger eq 'Days'} selected="selected" {/if}>{$MOD.LBL_DAYS}</option>
			                                            		<option label="{$MOD.LBL_WEEK}" value="Week" {if isset($OTP_BASED_DATA.smsTrigger) && $OTP_BASED_DATA.smsTrigger eq 'Week'} selected="selected" {/if}>{$MOD.LBL_WEEK}</option>
			                                            		<option label="{$MOD.LBL_MONTH}" value="Month" {if isset($OTP_BASED_DATA.smsTrigger) && $OTP_BASED_DATA.smsTrigger eq 'Month'} selected="selected" {/if}>{$MOD.LBL_MONTH}</option>
			                                            		<option label="{$MOD.LBL_MINUTES}" value="Minutes" {if isset($OTP_BASED_DATA.smsTrigger) && $OTP_BASED_DATA.smsTrigger eq 'Minutes'} selected="selected" {/if}>{$MOD.LBL_MINUTES}</option>
			                                            	</select>
			                                        	</td>
			                                    	</tr>

			                                    	<tr rowspan = "4" id="minutesRow" style="display:none;">
			                                    		<td><b>{$MOD.LBL_RESEND_OTP_IN_MINUTES}<span class="required">*</span></b>
			                                    		<img src="{$HELP_LINE_IMAGE_PATH}" class="image" alt="{$MOD.LBL_INFO_INLINE}" height="15" width="15" onclick="return SUGAR.util.showHelpTips(this,'{$MOD.LBL_RESEND_OTP_MSG}');">
			                                    		</td>
			                                    		<td class="setvisibilityclass">
			                                            	<select name="minutes" id="minutes">
					                                            <option value="" selected="selected">{$MOD.LBL_SELECT_AN_OPTION}</option>
					                                            <option label="{$MOD.LBL_2_MINUTES}" value="2 Minutes" {if isset($OTP_BASED_DATA.resendOtpMinutes) && $OTP_BASED_DATA.resendOtpMinutes eq '2 Minutes'} selected="selected" {/if}>{$MOD.LBL_2_MINUTES}</option>
			                                            		<option label="{$MOD.LBL_5_MINUTES}" value="5 Minutes" {if isset($OTP_BASED_DATA.resendOtpMinutes) && $OTP_BASED_DATA.resendOtpMinutes eq '5 Minutes'} selected="selected" {/if}>{$MOD.LBL_5_MINUTES}</option>
			                                            		<option label="{$MOD.LBL_10_MINUTES}" value="10 Minutes" {if isset($OTP_BASED_DATA.resendOtpMinutes) && $OTP_BASED_DATA.resendOtpMinutes eq '10 Minutes'} selected="selected" {/if}>{$MOD.LBL_10_MINUTES}</option>
			                                            		<option label="{$MOD.LBL_15_MINUTES}" value="15 Minutes" {if isset($OTP_BASED_DATA.resendOtpMinutes) && $OTP_BASED_DATA.resendOtpMinutes eq '15 Minutes'} selected="selected" {/if}>{$MOD.LBL_15_MINUTES}</option>
			                                            	</select>
			                                        	</td>
			                                    	</tr>

			                                    	<tr rowspan = "4" id="daysRow">
			                                    		<td><b>{$MOD.LBL_DAYS_RESEND_OTP}<span class="required">*</span></b>
			                                    		<img src="{$HELP_LINE_IMAGE_PATH}" class="image" alt="{$MOD.LBL_INFO_INLINE}" height="15" width="15" onclick="return SUGAR.util.showHelpTips(this,'{$MOD.LBL_RESEND_OTP_MSG}');">
			                                    		</td>
			                                    		<td class="setvisibilityclass">
			                                            	<select name="days" id="days">
					                                            <option value="" selected="selected">{$MOD.LBL_SELECT_AN_OPTION}</option>
			                                            		<option label="{$MOD.LBL_30_DAYS}" value="30 Days" {if isset($OTP_BASED_DATA.resendOtp) && $OTP_BASED_DATA.resendOtp eq '30 Days'} selected="selected" {/if}>{$MOD.LBL_30_DAYS}</option>
			                                            		<option label="{$MOD.LBL_60_DAYS}" value="60 Days" {if isset($OTP_BASED_DATA.resendOtp) && $OTP_BASED_DATA.resendOtp eq '60 Days'} selected="selected" {/if}>{$MOD.LBL_60_DAYS}</option>
			                                            		<option label="{$MOD.LBL_180_DAYS}" value="180 Days" {if isset($OTP_BASED_DATA.resendOtp) && $OTP_BASED_DATA.resendOtp eq '180 Days'} selected="selected" {/if}>{$MOD.LBL_180_DAYS}</option>
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

{literal}
	<script src="include/javascript/tiny_mce/tiny_mce.js"></script>
    <script type="text/javascript">
    	var ipBlockingData = {/literal}{$IP_BLOCKING_DATA|@json_encode}{literal};
    	var otpBasedData = {/literal}{$OTP_BASED_DATA|@json_encode}{literal};
    	var theme = "{/literal}{$THEME}{literal}";
    	var recordId = "{/literal}{$RECORD_ID}{literal}";
        var script = document.createElement("script");
        script.type = "text/javascript";
        script.src = "custom/modules/Administration/js/LoginSecurityConfig.js?v="+Math.random();
        document.body.appendChild(script);
    </script>
{/literal}