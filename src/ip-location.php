<?php
 $ip = $_SERVER['REMOTE_ADDR'];
 $country = geoip_record_by_name ($ip); 
 echo "<pre>"; print_r($country); echo "<pre>";
?>