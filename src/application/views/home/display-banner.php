<?php
$content= str_replace('[[MONTHLY_DONATION_FORM]]',$monthly_donation_form,$contents['banner_content']);
$content2= str_replace('[[ONE_TIME_DONATION_FORM]]',$one_time_donation_form,$content);

echo $content2;
?>