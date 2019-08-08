<?php
$landing_n = $_GET['land'] ?? 0;
$landings_path = '/var/lands/';
$landing_path = $landings_path.$landing_n.'/';

if (!file_exists($landing_path)) {
    $landings = scandir($landings_path);
    unset($landings[0]);
    unset($landings[1]);
    $landing_n = $landings[array_rand($landings)];
    $landing_path = $landings_path.$landing_n.'/';
}

$content_link = $_SERVER['DOCUMENT_ROOT'].'/'.$landing_n.'/content';

if (!file_exists($content_link)) {
    if (!file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$landing_n)) {
        mkdir($_SERVER['DOCUMENT_ROOT'].'/'.$landing_n);
    }
    $landing_content_path = $landing_path.'content/';
    symlink($landing_content_path,$content_link);
}

$landing_index_path = $landing_path.'index.html';
print file_get_contents($landing_index_path);