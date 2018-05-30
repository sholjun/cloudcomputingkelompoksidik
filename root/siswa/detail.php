<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$maxRows_DetailRS1 = 10;
$pageNum_DetailRS1 = 0;
if (isset($_GET['pageNum_DetailRS1'])) {
  $pageNum_DetailRS1 = $_GET['pageNum_DetailRS1'];
}
$startRow_DetailRS1 = $pageNum_DetailRS1 * $maxRows_DetailRS1;

$colname_DetailRS1 = "-1";
if (isset($_GET['recordID'])) {
  $colname_DetailRS1 = $_GET['recordID'];
}
mysql_select_db($database_smapunggur_db, $smapunggur_db);
$query_DetailRS1 = sprintf("SELECT * FROM smapunggur_siswa WHERE id_siswa = %s", GetSQLValueString($colname_DetailRS1, "int"));
$query_limit_DetailRS1 = sprintf("%s LIMIT %d, %d", $query_DetailRS1, $startRow_DetailRS1, $maxRows_DetailRS1);
$DetailRS1 = mysql_query($query_limit_DetailRS1, $smapunggur_db) or die(mysql_error());
$row_DetailRS1 = mysql_fetch_assoc($DetailRS1);

if (isset($_GET['totalRows_DetailRS1'])) {
  $totalRows_DetailRS1 = $_GET['totalRows_DetailRS1'];
} else {
  $all_DetailRS1 = mysql_query($query_DetailRS1);
  $totalRows_DetailRS1 = mysql_num_rows($all_DetailRS1);
}
$totalPages_DetailRS1 = ceil($totalRows_DetailRS1/$maxRows_DetailRS1)-1;

$maxRows_DetailRS2 = 10;
$pageNum_DetailRS2 = 0;
if (isset($_GET['pageNum_DetailRS2'])) {
  $pageNum_DetailRS2 = $_GET['pageNum_DetailRS2'];
}
$startRow_DetailRS2 = $pageNum_DetailRS2 * $maxRows_DetailRS2;

$colname_DetailRS2 = "-1";
if (isset($_GET['recordID'])) {
  $colname_DetailRS2 = $_GET['recordID'];
}
mysql_select_db($database_smapunggur_db, $smapunggur_db);
$query_DetailRS2 = sprintf("SELECT * FROM smapunggur_siswa WHERE id_siswa = %s", GetSQLValueString($colname_DetailRS2, "int"));
$query_limit_DetailRS2 = sprintf("%s LIMIT %d, %d", $query_DetailRS2, $startRow_DetailRS2, $maxRows_DetailRS2);
$DetailRS2 = mysql_query($query_limit_DetailRS2, $smapunggur_db) or die(mysql_error());
$row_DetailRS2 = mysql_fetch_assoc($DetailRS2);

if (isset($_GET['totalRows_DetailRS2'])) {
  $totalRows_DetailRS2 = $_GET['totalRows_DetailRS2'];
} else {
  $all_DetailRS2 = mysql_query($query_DetailRS2);
  $totalRows_DetailRS2 = mysql_num_rows($all_DetailRS2);
}
$totalPages_DetailRS2 = ceil($totalRows_DetailRS2/$maxRows_DetailRS2)-1;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table border="1" align="center">
  <tr>
    <td>id_calon</td>
    <td><?php echo $row_DetailRS2['id_siswa']; ?></td>
  </tr>
  <tr>
    <td>username</td>
    <td><?php echo $row_DetailRS2['username']; ?></td>
  </tr>
  <tr>
    <td>password</td>
    <td><?php echo $row_DetailRS2['password']; ?></td>
  </tr>
  <tr>
    <td>nama_lengkap</td>
    <td><?php echo $row_DetailRS2['nama_lengkap']; ?></td>
  </tr>
  <tr>
    <td>jenis_kelamin</td>
    <td><?php echo $row_DetailRS2['jenis_kelamin']; ?></td>
  </tr>
  <tr>
    <td>agama</td>
    <td><?php echo $row_DetailRS2['agama']; ?></td>
  </tr>
  <tr>
    <td>tempat_lahir</td>
    <td><?php echo $row_DetailRS2['tempat_lahir']; ?></td>
  </tr>
  <tr>
    <td>tanggal_lahir</td>
    <td><?php echo $row_DetailRS2['tanggal_lahir']; ?></td>
  </tr>
  <tr>
    <td>nama_ortu</td>
    <td><?php echo $row_DetailRS2['nama_ortu']; ?></td>
  </tr>
  <tr>
    <td>alamat_siswa</td>
    <td><?php echo $row_DetailRS2['alamat_siswa']; ?></td>
  </tr>
  <tr>
    <td>sekolah_asal</td>
    <td><?php echo $row_DetailRS2['sekolah_asal']; ?></td>
  </tr>
  <tr>
    <td>status</td>
    <td><?php echo $row_DetailRS2['status']; ?></td>
  </tr>
  <tr>
    <td>tes_akademis</td>
    <td><?php echo $row_DetailRS2['tes_akademis']; ?></td>
  </tr>
  <tr>
    <td>tes_akademis_bakat</td>
    <td><?php echo $row_DetailRS2['tes_akademis_bakat']; ?></td>
  </tr>
  <tr>
    <td>tes_bakat</td>
    <td><?php echo $row_DetailRS2['tes_bakat']; ?></td>
  </tr>
  <tr>
    <td>nilai_mtk</td>
    <td><?php echo $row_DetailRS2['nilai_mtk']; ?></td>
  </tr>
  <tr>
    <td>nilai_bing</td>
    <td><?php echo $row_DetailRS2['nilai_bing']; ?></td>
  </tr>
  <tr>
    <td>nilai_bindo</td>
    <td><?php echo $row_DetailRS2['nilai_bindo']; ?></td>
  </tr>
  <tr>
    <td>nilai_ipa</td>
    <td><?php echo $row_DetailRS2['nilai_ipa']; ?></td>
  </tr>
  <tr>
    <td>nilai_ips</td>
    <td><?php echo $row_DetailRS2['nilai_ips']; ?></td>
  </tr>
</table>
</body>
</html><?php
mysql_free_result($DetailRS1);

mysql_free_result($DetailRS2);
?>