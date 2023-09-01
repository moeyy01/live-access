<?php
// 配置信息
$mainKey = getenv('KEY'); // 主 Key
$streamName = getenv('NAME'); // 流名称，与 StreamID 概念等同
$validTime = 15; // 有效时间（秒）

// 获取当前的UNIX时间戳并转换为十六进制格式
$timestamp = dechex(time());
$txTime = strtoupper($timestamp);

// 计算 txSecret
$txSecret = md5($mainKey . $streamName . $txTime);

// 构建带鉴权参数的播放链接
$baseURL = "https://livecdn.moeyy.cn/live/moeyy.m3u8";
$authURL = $baseURL . "?txSecret=" . $txSecret . "&txTime=" . $txTime;

header("X-Expiration-Time: " . $expirationTime);

// 执行HTTP 302重定向到鉴权后的URL
header("Location: " . $authURL, true, 302);
exit; // 确保脚本结束执行
?>
