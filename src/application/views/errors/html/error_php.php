<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<?php
// log error in Rollbar
use \Rollbar\Rollbar;
use \Rollbar\Payload\Level;

/* 
    Rollbar lib should raise Exceptions out of box,
    error reporting not plugging into CI, so using Guzzle
*/
Rollbar::init(
    array(
        'access_token' => 'f573b33c0c1f4e0ea4a6c64599068cbc',
        'environment' => ENVIRONMENT
    )
);

$payload = array(
  'access_token' => 'f573b33c0c1f4e0ea4a6c64599068cbc',
  'data' => array(
    'environment' => ENVIRONMENT,
    'framework' => 'CodeIgniter',
    'body' => array(
      'message' => array(
        'body' => 'coming via guzzle'
      )
    )
  )
);

echo print_r(json_encode($payload));die();

$client = new GuzzleHttp\Client();
$res = $client->request('POST', 'https://api.rollbar.com/api/1/item', [
    'payload' => json_encode($payload)
]);

echo $res->getStatusCode();
echo $res->getBody();

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
