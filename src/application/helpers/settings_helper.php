<?php
//session_start();
// Admin Folder name
define('admin','zeemoadmin');
//logo which is displayed just above login box
define('MAIN_LOGO',"logo.png");

//logo which is displayed on left side after login
define('LEFT_LOGO',"zeemo-logo.png");

//Name and Email address which is used as sender in case of forgot password
define('FORGOT_PASSWORD_SENDER',"info@zeemo.com.au");

//subject of forgot password email
define('FORGOT_PASSWORD_SUBJECT',"Zeemo: new password setup!");

//subject of email send to user after creating new account
define('NEW_ACCOUNT_USER_SUBJECT',"Zeemo: confirmation mail-new user account");

//subject of email send to "admin" after creating new account
define('NEW_ACCOUNT_ADMIN_SUBJECT',"Zeemo: new user account created");

//subject of email send to user after udating account details by "admin"
define('EDIT_ACCOUNT_USER_SUBJECT',"Zeemo: your account details updated");

//subject of email send to admin/service provider after updating account details by "admin"
define('EDIT_ACCOUNT_ADMIN_SUBJECT',"Zeemo: account details updated");

//subject of email send to service provider after updating admin account details.
define('EDIT_ACCOUNT_SERVICE_PROVIDER_SUBJECT',"Sleep Bus: admin details updated");

//service provider email address
define('SERVICE_PROVIDER_EMAIL_ADDRESS',"info@zeemo.com.au"); // change it to info@zeemo.com.au
define('CHANGE_SUPERADMIN_PASSWORD_SUBJECT',"Sleep Bus: superadmin new password");

//common prefix of page title for all pages
define('PREFIX_TITLE', "Zeemo - ");

define('HEADER_PAGE_ICON', "home.png");
define('HEADER_TEXT','Home');


// meta tags
define('DEFAULT_SUFFIX', " - sleepbus"); // or define('DEFAULT_SUFFIX', " - Gallay Medical & Scientific ");
define('ZEEMO_CONTACT_NO','1300 881 594');

// Determining base directory of the website for configuration of ckfinder to ckeditor
if(preg_match('/devs/',$_SERVER['HTTP_HOST'])) $_SESSION['base_dir'] = '/sleepbus-demo/'; // this value will be changed according as site directory name
else if(preg_match('/iisdemo.com.au/',$_SERVER['HTTP_HOST'])) $_SESSION['base_dir'] = '/projects/sleepbus-demo/'; // this value will be changed according as site directory name
else $_SESSION['base_dir'] = '/';
define('BASE_DIR',$_SESSION['base_dir']);

/*
echo "is_auth=".$_SESSION['username'];
*/
?>