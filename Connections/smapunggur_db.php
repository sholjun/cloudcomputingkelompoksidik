<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_smapunggur_db = "localhost";
$database_smapunggur_db = "db_qjs";
$username_smapunggur_db = "root";
$password_smapunggur_db = "";
$smapunggur_db = mysql_pconnect($hostname_smapunggur_db, $username_smapunggur_db, $password_smapunggur_db) or trigger_error(mysql_error(),E_USER_ERROR); 
?>