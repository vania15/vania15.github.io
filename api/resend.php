<?php

set_time_limit(0);

if (is_file('config.php')) {
    require_once 'config.php';
} else {
    exit('Для начала работы необходимо сконфигурировать приложение');
}

$file = __DIR__ . '/lead-' . sha1(KMA_ACCESS_TOKEN . KMA_CHANNEL) . '.txt';

$resend = '';

$fn = fopen($file,'r');
while(! feof($fn))  {
    $result = fgets($fn);
    $array = json_decode($result, true);
    if (json_last_error() === JSON_ERROR_NONE && is_array($array)) {
        require_once 'KmaLead.php';
        /** @var KmaLead $kma */
        $kma = new KmaLead($token);
        $response = $kma->resendRequest($array['data'], $array['headers']);
        if (!isset($response['order'])) {
            $resend .= $result . "\r\n";
        }
    }
}
fclose($fn);


if (empty($resend)) {
    @unlink($file);
} else {
    file_put_contents($file, $resend);
}

exit;
