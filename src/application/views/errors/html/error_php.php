<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<?php
// log error in Rollbar
// https://rollbar.com/docs/api/items_post/
use \Rollbar\Rollbar;
use \Rollbar\Payload\Level;

Rollbar::init(
    array(
        'access_token' => 'f573b33c0c1f4e0ea4a6c64599068cbc',
        'environment' => ENVIRONMENT
    )
);



$payload = array(
  "framework" => "CodeIgniter",
  "body" => array (
    "message" => $message
  )
);


Rollbar::log(
    Level::info(),
    json_encode($payload)
);

?>


<p>Severity: <?php echo $severity; ?></p>
<p>Message:  <?php echo $message; ?></p>
<p>Filename: <?php echo $filepath; ?></p>
<p>Line Number: <?php echo $line; ?></p>

<?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>

	<p>Backtrace:</p>
	<?php foreach (debug_backtrace() as $error): ?>

		<?php if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>

			<p style="margin-left:10px">
			File: <?php echo $error['file'] ?><br />
			Line: <?php echo $error['line'] ?><br />
			Function: <?php echo $error['function'] ?>
			</p>

		<?php endif ?>

	<?php endforeach ?>

<?php endif ?>

</div>
