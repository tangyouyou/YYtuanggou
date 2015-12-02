<?php

header("Content-type: text/html; charset=utf-8");
echo "用户名:".SAE_MYSQL_USER."<br>";
echo "密码:".SAE_MYSQL_PASS."<br>";
echo "主库域名:".SAE_MYSQL_HOST_M."<br>";
echo "从库域名:".SAE_MYSQL_HOST_S."<br>";
echo "端口:".SAE_MYSQL_PORT."<br>";
echo "数据库名:".SAE_MYSQL_DB."<br>";
?>