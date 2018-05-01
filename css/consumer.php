<?php

$result = include 'endpoints.php';
foreach ($result as $value) {
    $url = $value['base_url'];
    $method = $value['method'];
    $content_type = $value['content_type'];
    $data = $value['data'];


    if ($content_type == null) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . '?postId=' . $data['postId']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $timestamp = time();
        curl_exec($ch);
        if (!curl_exec($ch)) {
            echo 'Error: ' . curl_error($ch);
        }
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $time = curl_getinfo($ch, CURLINFO_TOTAL_TIME);
        curl_close($ch);
    } elseif ($content_type == 'application/x-www-form-urlencoded') {
        $value1 = $data['key1'];
        $value2 = $data['key2'];
        $params = 'key1=' . $value1 . '&key2=' . $value2;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array($content_type));
        $timestamp = time();
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $time = curl_getinfo($ch, CURLINFO_TOTAL_TIME);
        curl_close($ch);
    } else if ($content_type == 'application/json') {

        $value1 = $data['key1'];
        $value2 = $data['key2'];
        $params = 'key1=' . $value1 . '&key2=' . $value2;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array($content_type));
        $timestamp = time();
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $time = curl_getinfo($ch, CURLINFO_TOTAL_TIME);
        curl_close($ch);
    }


    echo 'Start Timestamp: ' . $timestamp . '<br>';
    echo 'Code:' . $code . '<br>';
    echo 'Response Time:' . $time . '<br><br><br>';
}
