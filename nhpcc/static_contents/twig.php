<?php

use \Utils;
// Define global variables for view

$categories = Utils::loadStaticContent('category', true)->getContent();

return array('global' =>
    array(
        'webTitle' => '国家高性能计算中心深圳分中心',
        'webKeywords' => '深圳大学,计算机与软件学院,高性能计算中心',
        'webDescription' => '国家高性能计算中心深圳分中心',
        'logoTitle' => '国家高性能计算中心深圳分中心',
        'categories' => $categories,
    )
);
