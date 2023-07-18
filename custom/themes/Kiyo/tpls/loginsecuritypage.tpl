<link rel="stylesheet" type="text/css" href="custom/themes/Kiyo/css/LoginSecurityPage.css">

<script type='text/javascript'>
    var LBL_LOGIN_SUBMIT = '{sugar_translate module="Users" label="LBL_LOGIN_SUBMIT"}';
    var LBL_REQUEST_SUBMIT = '{sugar_translate module="Users" label="LBL_REQUEST_SUBMIT"}';
    var LBL_SHOWOPTIONS = '{sugar_translate module="Users" label="LBL_SHOWOPTIONS"}';
    var LBL_HIDEOPTIONS = '{sugar_translate module="Users" label="LBL_HIDEOPTIONS"}';
    var LBL_OTP_EXPIRED = '{sugar_translate module="Users" label="LBL_OTP_EXPIRED"}';
    var LBL_WRONG_OTP = '{sugar_translate module="Users" label="LBL_WRONG_OTP"}';
    var LBL_VALID_OTP = '{sugar_translate module="Users" label="LBL_VALID_OTP"}';
    var LBL_VALID_CREDENTIALS = '{sugar_translate module="Users" label="LBL_VALID_CREDENTIALS"}';
    var LBL_VALID_EMAIL_ADDRESS = '{sugar_translate module="Users" label="LBL_VALID_EMAIL_ADDRESS"}';
</script>

<!-- Start login container -->
<div class="p_login">
    <div class="p_login_top">
        <a title="KiyoCRM" href="http://www.suitecrm.com">{$MOD.LBL_KIYOCRM}</a>
    </div>
    
    <div class="p_login_middle">
        {if $LOGIN_ERROR_MESSAGE}
            <p align='center' class='error'>{$LOGIN_ERROR_MESSAGE}</p>
        {/if}
        <div id="popup-loading" style="display:none;"></div>

        <div id="loginform">
            <form class="form-signin" role="form" action="index.php" method="post" name="DetailView" id="form" onsubmit="return document.getElementById('cant_login').value == ''" autocomplete="off">
                <div class="companylogo">{$LOGIN_IMAGE}</div>
            <span class="error" id="browser_warning" style="display:none">
                {sugar_translate label="WARN_BROWSER_VERSION_WARNING"}
            </span>
            <span class="error" id="ie_compatibility_mode_warning" style="display:none">
            {sugar_translate label="WARN_BROWSER_IE_COMPATIBILITY_MODE_WARNING"}
            </span>
                {if $LOGIN_ERROR !=''}
                    <span class="error">{$LOGIN_ERROR}</span>
                    {if $WAITING_ERROR !=''}
                        <span class="error">{$WAITING_ERROR}</span>
                    {/if}
                {else}
                    <span id='post_error' class="error"></span>
                {/if}
                <input type="hidden" name="module" value="Users">
                <input type="hidden" name="action" value="Authenticate">
                <input type="hidden" name="return_module" value="Users">
                <input type="hidden" name="return_action" value="Login">
                <input type="hidden" id="cant_login" name="cant_login" value="">
                {foreach from=$LOGIN_VARS key=key item=var}
                    <input type="hidden" name="{$key}" value="{$var}">
                {/foreach}
                {if !empty($SELECT_LANGUAGE)}
                    <div class="login-language-chooser">
                        {sugar_translate module="Users" label="LBL_LANGUAGE"}:
                        <select name='login_language' onchange="switchLanguage(this.value)">{$SELECT_LANGUAGE}</select>
                    </div>
                {/if}
                <br>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="{sugar_translate module="Users" label="LBL_USER_NAME"}" required autofocus tabindex="1" id="user_name" name="user_name" value='{$LOGIN_USER_NAME}' autocomplete="off">
                </div>
                <br>
                <div class="input-group">
                    <input type="password" class="form-control" placeholder="{sugar_translate module="Users" label="LBL_PASSWORD"}" tabindex="2" id="username_password" name="username_password" value='{$LOGIN_PASSWORD}' autocomplete="off">
                </div>
                <br>
                <input id="bigbutton" class="btn btn-lg btn-primary btn-block" type="button" title="{sugar_translate module="Users" label="LBL_LOGIN_BUTTON_TITLE"}" tabindex="3" name="Login" value="{sugar_translate module="Users" label="LBL_LOGIN_BUTTON_LABEL"}">
                
                <div id="otpRow">
                    <div id="divInner">
                        <input id="otp" type="text" maxlength="4"/>
                        <div>{$MOD.LBL_TIME_LEFT} <span id="timer"></span></div>
                    </div>
                </div>
                <br/>

                <input id="bigbutton" class="btn btn-lg btn-primary btn-block continue" type="button" title="{$MOD.CONTINUE}" tabindex="3" name="continue" value="continue" style="display:none;">

                <a title="resendOTP" id="resendOtp">{$MOD.LBL_RESEND_OTP}</a>
                
                <div id="forgotpasslink" style="cursor: pointer; display:{$DISPLAY_FORGOT_PASSWORD_FEATURE};"
                     onclick='toggleDisplay("forgot_password_dialog");'>
                    <a href='javascript:void(0)'>{sugar_translate module="Users" label="LBL_LOGIN_FORGOT_PASSWORD"}</a>
                </div>
            </form>
            
            <form class="form-signin passform" role="form" action="index.php" method="post" name="DetailView" id="form" name="fp_form" id="fp_form" autocomplete="off">
                <div id="forgot_password_dialog" style="display:none">
                    <input type="hidden" name="entryPoint" value="GeneratePassword">
                    <div id="generate_success" class='error' style="display:inline;"></div>
                    <br>
                    <div class="input-group">
                        {*<span class="input-group-addon logininput glyphicon glyphicon-user"></span>*}
                        <input type="text" class="form-control" size='26' id="fp_user_name" name="fp_user_name" value='{$LOGIN_USER_NAME}' placeholder="{sugar_translate module="Users" label="LBL_USER_NAME"}" autocomplete="off">
                    </div>
                    <br>
                    <div class="input-group">
                        {*<span class="input-group-addon logininput glyphicon glyphicon-envelope"></span>*}
                        <input type="text" class="form-control" size='26' id="fp_user_mail" name="fp_user_mail" value='' placeholder="{sugar_translate module="Users" label="LBL_EMAIL"}" autocomplete="off">
                    </div>
                    <br>
                    {$CAPTCHA}
                    <div id='wait_pwd_generation'></div>
                    <input title="Email Temp Password" class="button  btn-block" type="button" style="display:inline" onclick="validateAndSubmit(); return document.getElementById('cant_login').value == ''" id="generate_pwd_button" name="fp_login" value="{sugar_translate module="Users" label="LBL_LOGIN_SUBMIT"}" autocomplete="off">
                </div>
            </form>
        </div>
    </div>
    
    <div class="p_login_bottom" style="position:fixed;">
        <a id="admin_options">&copy; {$MOD.LBL_SUPER_CHARGED_KIYOCRM}</a>
        <a id="powered_by">&copy; {$MOD.LBL_POWERED_SUGARCRM}</a>
    </div>
</div>

<!-- End login container -->
{literal}
    <script type="text/javascript">
        var otpType = "{/literal}{$IP_BLOCKING_DATA.otp_type}{literal}";
        var theme = "{/literal}{$THEME}{literal}";
        
        var script = document.createElement("script");
        script.type = "text/javascript";
        script.src = "custom/themes/Kiyo/js/LoginSecurity.js?v="+Math.random();
        document.body.appendChild(script);
    </script> 
{/literal}
