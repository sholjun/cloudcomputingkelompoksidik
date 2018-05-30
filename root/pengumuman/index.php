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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_halaman_utama = 2;
$pageNum_halaman_utama = 0;
if (isset($_GET['pageNum_halaman_utama'])) {
  $pageNum_halaman_utama = $_GET['pageNum_halaman_utama'];
}
$startRow_halaman_utama = $pageNum_halaman_utama * $maxRows_halaman_utama;

mysql_select_db($database_smapunggur_db, $smapunggur_db);
$query_halaman_utama = "SELECT * FROM smapunggur_pengumuman";
$query_limit_halaman_utama = sprintf("%s LIMIT %d, %d", $query_halaman_utama, $startRow_halaman_utama, $maxRows_halaman_utama);
$halaman_utama = mysql_query($query_limit_halaman_utama, $smapunggur_db) or die(mysql_error());
$row_halaman_utama = mysql_fetch_assoc($halaman_utama);

if (isset($_GET['totalRows_halaman_utama'])) {
  $totalRows_halaman_utama = $_GET['totalRows_halaman_utama'];
} else {
  $all_halaman_utama = mysql_query($query_halaman_utama);
  $totalRows_halaman_utama = mysql_num_rows($all_halaman_utama);
}
$totalPages_halaman_utama = ceil($totalRows_halaman_utama/$maxRows_halaman_utama)-1;

$queryString_halaman_utama = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_halaman_utama") == false && 
        stristr($param, "totalRows_halaman_utama") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_halaman_utama = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_halaman_utama = sprintf("&totalRows_halaman_utama=%d%s", $totalRows_halaman_utama, $queryString_halaman_utama);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Manajemen Pengumuman</title>
</head>

<body>
<a href="http://localhost/smapunggur/root/index.php?page=tambah-pengumuman">Tambah Pengumuman </a>
<table border="1" width="100%">
  <tr>
    <td>judul_pengumuman</td>
    <td>isi_pengumuman</td>
    <td>tanggal_pengumuman</td>
    <td>pilihan</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><a href="detail.php?recordID=<?php echo $row_halaman_utama['id_pengumuman']; ?>"> <?php echo $row_halaman_utama['judul_pengumuman']; ?>&nbsp; </a></td>
      <td><?php echo $row_halaman_utama['isi_pengumuman']; ?>&nbsp; </td>
      <td><?php echo $row_halaman_utama['tanggal_pengumuman']; ?>&nbsp; </td>
      <td><p><a href="http://localhost/smapunggur/root/index.php?page=edit-pengumuman&id_pengumuman=<?php echo $row_halaman_utama['id_pengumuman']; ?>">edit</a></p>
      <p><a href="delete.php?id_pengumuman=<?php echo $row_halaman_utama['id_pengumuman']; ?>">hapus</a></p></td>
    </tr>
    <?php } while ($row_halaman_utama = mysql_fetch_assoc($halaman_utama)); ?>
</table>
<br />

<div class="navigator">

<div class="tombolnext">
  <a href="<?php printf("%s?pageNum_halaman_utama=%d%s", $currentPage, min($totalPages_halaman_utama, $pageNum_halaman_utama + 1), $queryString_halaman_utama); ?>">Selanjutnya</a>
</div>

<div class="tombolprev">
  <a href="<?php printf("%s?pageNum_halaman_utama=%d%s", $currentPage, max(0, $pageNum_halaman_utama - 1), $queryString_halaman_utama); ?>">Sebelumnya</a>
  
</div>
<div class="total-data">
data <?php echo ($startRow_halaman_utama + 1) ?> sampai <?php echo min($startRow_halaman_utama + $maxRows_halaman_utama, $totalRows_halaman_utama) ?> dari <?php echo $totalRows_halaman_utama ?> data
</div>
</body>
</html>
<?php
mysql_free_result($halaman_utama);
?>
