<?php require_once('../../Connections/smapunggur_db.php'); ?>
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

$maxRows_halaman_utama = 20;
$pageNum_halaman_utama = 0;
if (isset($_GET['pageNum_halaman_utama'])) {
  $pageNum_halaman_utama = $_GET['pageNum_halaman_utama'];
}
$startRow_halaman_utama = $pageNum_halaman_utama * $maxRows_halaman_utama;

mysql_select_db($database_smapunggur_db, $smapunggur_db);
$query_halaman_utama = "SELECT * FROM smapunggur_nilai";
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
<title>Untitled Document</title>
</head>

<body>
<table border="1" align="center">
  <tr>
    <td>id_siswa</td>
    <td>mata_pelajaran</td>
    <td>nilai</td>
    <td>pilihan</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><a href="detail.php?recordID=<?php echo $row_halaman_utama['id_nilai']; ?>"> <?php echo $row_halaman_utama['id_siswa']; ?>&nbsp; </a></td>
      <td><?php echo $row_halaman_utama['mata_pelajaran']; ?>&nbsp; </td>
      <td><?php echo $row_halaman_utama['nilai']; ?>&nbsp; </td>
      <td><p><a href="update.php?id_nilai=<?php echo $row_halaman_utama['id_nilai']; ?>">edit</a></p>
      <p><a href="delete.php?id_nilai=<?php echo $row_halaman_utama['id_nilai']; ?>">hapus</a></p></td>
    </tr>
    <?php } while ($row_halaman_utama = mysql_fetch_assoc($halaman_utama)); ?>
</table>
<br />
<table border="0">
  <tr>
    <td><?php if ($pageNum_halaman_utama > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_halaman_utama=%d%s", $currentPage, 0, $queryString_halaman_utama); ?>">First</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_halaman_utama > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_halaman_utama=%d%s", $currentPage, max(0, $pageNum_halaman_utama - 1), $queryString_halaman_utama); ?>">Previous</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_halaman_utama < $totalPages_halaman_utama) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_halaman_utama=%d%s", $currentPage, min($totalPages_halaman_utama, $pageNum_halaman_utama + 1), $queryString_halaman_utama); ?>">Next</a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_halaman_utama < $totalPages_halaman_utama) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_halaman_utama=%d%s", $currentPage, $totalPages_halaman_utama, $queryString_halaman_utama); ?>">Last</a>
        <?php } // Show if not last page ?></td>
  </tr>
</table>
Records <?php echo ($startRow_halaman_utama + 1) ?> to <?php echo min($startRow_halaman_utama + $maxRows_halaman_utama, $totalRows_halaman_utama) ?> of <?php echo $totalRows_halaman_utama ?>
</body>
</html>
<?php
mysql_free_result($halaman_utama);
?>
