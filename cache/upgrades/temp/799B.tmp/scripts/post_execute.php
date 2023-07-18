<?php

global $sugar_config;
$databaseType = $sugar_config['dbconfig']['db_type'];
if($databaseType == 'mysql'){
    //ip blocking table
    $ipBlocking = "CREATE TABLE `kiyo_ip_blocking` (
                                                    id char(36) NOT NULL PRIMARY KEY,
                                                    ip_blocking_type text NOT NULL,
                                                    users_type_ip_blocking text NOT NULL,
                                                    users longtext  NULL,
                                                    allow_ip_addresses varchar(255) NOT NULL,
                                                    deny_ip_addresses varchar(255) NOT NULL,
                                                    status varchar(55) DEFAULT '0',
                                                    date_entered datetime NOT NULL,
                                                    date_modified datetime NOT NULL,
                                                    deleted tinyint(1) NOT NULL DEFAULT '0'
                                                )";
    $ipBlockingResult = $GLOBALS['db']->query($ipBlocking); 

    //OTP Based Table
    $otpBased = "CREATE TABLE `kiyo_otp_based`(
                                            id char(36) NOT NULL PRIMARY KEY,
                                            ip_blocking_id char(36) NOT NULL,
                                            enable_otp_based int(10) NOT NULL,
                                            otp_type varchar(150)  NULL,
                                            email_subject text NOT NULL,
                                            body varchar(255) NOT NULL,
                                            sms_trigger varchar(150) NOT NULL,
                                            resend_otp varchar(255) NOT NULL,
                                            resend_otp_minutes varchar(255) NOT NULL,
                                            date_entered datetime NOT NULL, 
                                            date_modified datetime NOT NULL,
                                            deleted tinyint(1) NOT NULL DEFAULT '0'
                                        )";
    $otpBasedResult = $GLOBALS['db']->query($otpBased); 

    //Otp Entry Table
    $loginOtpEntry = "CREATE TABLE `kiyo_login_otp_entry` (
                                                    id char(36) NOT NULL PRIMARY KEY,
                                                    user_id char(36) NOT NULL,
                                                    user_name varchar(100) NOT NULL,
                                                    otp varchar(100) NOT NULL,
                                                    date_entered datetime NOT NULL,
                                                    deleted tinyint(1) NOT NULL DEFAULT '0'
                                                )";
    $loginOtpEntryResult = $GLOBALS['db']->query($loginOtpEntry); 
}else if($databaseType == 'mssql'){
    //ip blocking table
    $ipBlocking = "IF NOT EXISTS (SELECT * FROM dbo.sysobjects where id = object_id(N'dbo.[kiyo_ip_blocking]') and OBJECTPROPERTY(id, N'IsTable') = 1)
        BEGIN
        CREATE TABLE [dbo].[kiyo_ip_blocking](
            [id] [CHAR](36) NOT NULL PRIMARY KEY,
            [ip_blocking_type] [TEXT] NOT NULL,
            [users_type_ip_blocking] [TEXT] NOT NULL,
            [users] [nvarchar](max) NULL,
            [allow_ip_addresses] [VARCHAR](255) NULL,
            [deny_ip_addresses] [VARCHAR](255) NULL,
            [status] [VARCHAR](50) NOT NULL DEFAULT 0,
            [date_entered] [DATETIME] NOT NULL,
            [date_modified] [DATETIME] NOT NULL,
            [deleted] [SMALLINT] NOT NULL DEFAULT 0
        )
        END";
    $ipBlockingResult = $GLOBALS['db']->query($ipBlocking);   

    //OTP Based Table
    $otpBased = "IF NOT EXISTS (SELECT * FROM dbo.sysobjects where id = object_id(N'dbo.[kiyo_otp_based]') and OBJECTPROPERTY(id, N'IsTable') = 1)
        BEGIN
        CREATE TABLE [dbo].[kiyo_otp_based](
            [id] [CHAR](36) NOT NULL PRIMARY KEY,
            [ip_blocking_id] [CHAR](36) NOT NULL,
            [enable_otp_based] [INT] NOT NULL,
            [otp_type] [VARCHAR](150) NOT NULL,
            [email_subject] [TEXT] NOT NULL,
            [body] [VARCHAR](255) NOT NULL,
            [sms_trigger] [VARCHAR](150) NOT NULL,
            [resend_otp] [VARCHAR](255) NOT NULL,
            [resend_otp_minutes] [VARCHAR](255) NOT NULL,
            [date_entered] [DATETIME] NOT NULL,
            [date_modified] [DATETIME] NOT NULL,
            [deleted] [SMALLINT] NOT NULL DEFAULT 0
        )
        END";
    $otpBasedResult = $GLOBALS['db']->query($otpBased);

    //OTP Entry Table
    $loginOtpEntry = "IF NOT EXISTS (SELECT * FROM dbo.sysobjects where id = object_id(N'dbo.[kiyo_login_otp_entry]') and OBJECTPROPERTY(id, N'IsTable') = 1)
        BEGIN
        CREATE TABLE [dbo].[kiyo_login_otp_entry](
            [id] [CHAR](36) NOT NULL PRIMARY KEY,
            [user_id] [CHAR](36) NOT NULL,
            [user_name] [VARCHAR](100) NOT NULL,
            [otp] [VARCHAR](100) NOT NULL,
            [date_entered] [DATETIME] NOT NULL,
            [deleted] [SMALLINT] NOT NULL DEFAULT 0
        )
        END";
    $loginOtpEntryResult = $GLOBALS['db']->query($loginOtpEntry);
}