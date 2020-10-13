<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
// Line to enable Manual Only mode.
  fbq('set', 'autoConfig', false, '319168575979425');
//Insert Your Facebook Pixel ID below.
  fbq('track', 'Lead');
  fbq('init', '319168575979425');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=319168575979425&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

<?php

include("PublisherApi.php");

$api = new \Aff1\PublisherApi();

$api->setProperty('api_key', 'wTyORkPNVAJTWx6h');
$api->setProperty('target_hash', 'xwlBxbL7');
$api->setProperty('country_code', request('country_code'));
$api->setPrice(2400);
$api->setProperty('first_name', custom('first_name'));
$api->setProperty('last_name', custom('last_name'));
$api->setProperty('address', request('address'));
$api->setProperty('state', custom('state'));
$api->setProperty('city', custom('city'));
$api->setProperty('zipcode', custom('zipcode'));
$api->setProperty('email', request('email'));
$api->setProperty('comment', request('comment'));
$api->setProperty('size', custom('size'));
$api->setProperty('quantity', custom('quantity'));
$api->setProperty('password', custom('password'));
$api->setProperty('language', custom('language'));
$api->setProperty('tz_name', custom('tz_name'));
$api->setProperty('call_time_frame', custom('call_time_frame'));
$api->setProperty('messenger_code', custom('messenger_code'));
$api->setProperty('sale_code', custom('sale_code'));
$api->setProperty('browser_locale', $api->getBrowserLocale());
$api->setProperty('phone2', request('phone2'));

if (isset($_REQUEST["subid1"])) {
    $api->setProperty("data1", $_REQUEST["subid1"]);
}

if (isset($_REQUEST["subid2"])) {
    $api->setProperty("data2", $_REQUEST["subid2"]);
}


$response = $api->makeOrder(request('client'), request('phone'));

if (false) {
    writeLog($api);
}

$response = json_decode($response, true);

if ($response['status'] !== 'success') {
    die(var_dump($response));
}

die(showSuccessPage());

/** Functions */
function showSuccessPage()
{
    header(
        'Location: success.html?' .
        http_build_query(array_merge($_GET, array('name' => request('client'), 'phone' => $_POST['phone'])))
    );
}

function request($field)
{
    return isset($_REQUEST[$field]) ? $_REQUEST[$field] : '';
}

function custom($field)
{
    return isset($_REQUEST['custom'], $_REQUEST['custom'][$field]) ? $_REQUEST['custom'][$field] : '';
}

function writeLog($api)
{
    $params = array_merge(
        $api->getRequestParams(),
        array(
            'date' => date("Y-m-d H:i:s"),
            'success' => (int)in_array($api->getCurlInfo()['http_code'], array(200, 202, 422)),
        )
    );

    @file_put_contents("", sprintf("%s\n", json_encode($params)), FILE_APPEND);
}