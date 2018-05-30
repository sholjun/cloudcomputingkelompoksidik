
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

$maxRows_halaman_daftar = 10;
$pageNum_halaman_daftar = 0;
if (isset($_GET['pageNum_halaman_daftar'])) {
  $pageNum_halaman_daftar = $_GET['pageNum_halaman_daftar'];
}
$startRow_halaman_daftar = $pageNum_halaman_daftar * $maxRows_halaman_daftar;

mysql_select_db($database_smapunggur_db, $smapunggur_db);
$query_halaman_daftar = "SELECT nama_lengkap, tempat_lahir, tanggal_lahir, alamat_siswa, sekolah_asal, status FROM smapunggur_siswa";
$query_limit_halaman_daftar = sprintf("%s LIMIT %d, %d", $query_halaman_daftar, $startRow_halaman_daftar, $maxRows_halaman_daftar);
$halaman_daftar = mysql_query($query_limit_halaman_daftar, $smapunggur_db) or die(mysql_error());
$row_halaman_daftar = mysql_fetch_assoc($halaman_daftar);

if (isset($_GET['totalRows_halaman_daftar'])) {
  $totalRows_halaman_daftar = $_GET['totalRows_halaman_daftar'];
} else {
  $all_halaman_daftar = mysql_query($query_halaman_daftar);
  $totalRows_halaman_daftar = mysql_num_rows($all_halaman_daftar);
}
$totalPages_halaman_daftar = ceil($totalRows_halaman_daftar/$maxRows_halaman_daftar)-1;

$queryString_halaman_daftar = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_halaman_daftar") == false && 
        stristr($param, "totalRows_halaman_daftar") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_halaman_daftar = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_halaman_daftar = sprintf("&totalRows_halaman_daftar=%d%s", $totalRows_halaman_daftar, $queryString_halaman_daftar);
?>
<!--BAGIAN ISI-->
<div class="isi">

<div class="judul-web">
Data Pendaftar
</div>
<!--BAGIAN MAIN-->
<div class="main">
 
    <table width="100%">
      <tr class="judul-tabel">
        <td width="4%">No.</td>
        <td width="24%">Nama</td>
        <td width="32%">Tempat Tanggal Lahir</td>
        <td width="24%"> Asal Sekolah</td>
        <td width="16%">Status</td>
      </tr>
 <?php $nomor=1; do { ?>
      <tr>
        <td><?php echo $nomor;?></td>
        <td style="text-transform:capitalize"><?php echo $row_halaman_daftar['nama_lengkap']; ?></td>
        <td style="text-transform:capitalize"><?php echo $row_halaman_daftar['tempat_lahir']; ?>,<?php echo $row_halaman_daftar['tanggal_lahir']; ?></td>
        <td style="text-transform:uppercase"><?php echo $row_halaman_daftar['sekolah_asal']; ?></td>
        
        <?php
		$status = $row_halaman_daftar['status'];
		if ($status == 0) {echo "<td class='menunggu'>menunggu</td>";}
		 else {
			 echo "<td class='diterima'>Diterima</td>";
		 }?></td>
        </tr>
     <?php $nomor++; } while ($row_halaman_daftar = mysql_fetch_assoc($halaman_daftar)); ?>
    </table>
   
</div>

<div class="navigator">

<div class="tombolnext">
  <a href="<?php printf("%s?pageNum_halaman_daftar=%d%s", $currentPage, min($totalPages_halaman_daftar, $pageNum_halaman_daftar + 1), $queryString_halaman_daftar); ?>">Selanjutnya</a>
</div>

<div class="tombolprev">
  <a href="<?php printf("%s?pageNum_halaman_daftar=%d%s", $currentPage, max(0, $pageNum_halaman_daftar - 1), $queryString_halaman_daftar); ?>">Sebelumnya</a>
  
</div>
<div class="total-data">
data <?php echo ($startRow_halaman_daftar + 1) ?> sampai <?php echo min($startRow_halaman_daftar + $maxRows_halaman_daftar, $totalRows_halaman_daftar) ?> dari <?php echo $totalRows_halaman_daftar ?> data
</div>
<div class="clear"></div>
</div> <!--PENUTUP ISI-->
</div>
</div> <!--penutup container-->
<?php
mysql_free_result($halaman_daftar);
?>
