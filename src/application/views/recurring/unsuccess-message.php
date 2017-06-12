<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div class="container">
    <div class="row">
	<div class="funding">
	<?php
  	  echo $thanks['message'];
	 ?>
     <p>
      <?php
  		echo "GetExpressCheckoutDetails API call failed. ";
		echo "<br />Detailed Error Message: " . $ErrorLongMsg;
		echo "<br />Short Error Message: " . $ErrorShortMsg;
		echo "<br />Error Code: " . $ErrorCode;
		echo "<br />Error Severity Code: " . $ErrorSeverityCode;
	  ?>
     </p>
    </div>
       </div>
    </div>
  </div>