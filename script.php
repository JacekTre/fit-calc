<?php
const FILE_PATH = 'sitemap.xml';
const EOL_FOR_WINDOWS = "\r\n";
const FILE_RESULT = "result.csv";
const FILE_COLUMNS = ['url', 'status_code'];

echo 'start' . "\n";

$xml = file_get_contents(FILE_PATH);
$xmlObject = simplexml_load_string($xml);

$json = json_encode($xmlObject);
$data = json_decode($json, true);

file_put_contents(FILE_RESULT, implode("\t", FILE_COLUMNS) . EOL_FOR_WINDOWS, FILE_APPEND | LOCK_EX);

foreach ($data as $file) {
    foreach ($file as $row) {
        $url = $row["loc"];

        echo 'Sending - ' . $url . "\n";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_TIMEOUT,10);
        $output = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        echo 'Result - ' . $httpcode . "\n";

        file_put_contents(
            FILE_RESULT,
            implode("\t", mb_convert_encoding([$url, $httpcode], "UTF-8")) . EOL_FOR_WINDOWS,
            FILE_APPEND | LOCK_EX
        );

        echo 'Saving ...' . "\n";
    }
}

echo 'stop'. "\n";
?>
