<?php require_once('../Connections/smapunggur_db.php'); ?>
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

$maxRows_index = 100;
$pageNum_index = 0;
if (isset($_GET['pageNum_index'])) {
  $pageNum_index = $_GET['pageNum_index'];
}
$startRow_index = $pageNum_index * $maxRows_index;

mysql_select_db($database_smapunggur_db, $smapunggur_db);
$query_index = "SELECT * FROM smapunggur_siswa WHERE smapunggur_siswa.status=$_POST[status]";
$query_limit_index = sprintf("%s LIMIT %d, %d", $query_index, $startRow_index, $maxRows_index);
$index = mysql_query($query_limit_index, $smapunggur_db) or die(mysql_error());
$row_index = mysql_fetch_assoc($index);

if (isset($_GET['totalRows_index'])) {
  $totalRows_index = $_GET['totalRows_index'];
} else {
  $all_index = mysql_query($query_index);
  $totalRows_index = mysql_num_rows($all_index);
}
$totalPages_index = ceil($totalRows_index/$maxRows_index)-1;

$queryString_index = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_index") == false && 
        stristr($param, "totalRows_index") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_index = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_index = sprintf("&totalRows_index=%d%s", $totalRows_index, $queryString_index); ?>

  <title>Data Siswa </title>

<div class="sortir-kiri">
<form action="index.php?page=sortir-siswa&jenis_kelamin" method="POST">
Jenis Kelamin<select name="jenis_kelamin">
  <option value="">Semua</option>
  <option value="0">Laki</option>
  <option value="1">Perempuan</option>
</select>

Agama<select name="agama">
  <option value="">Semua</option>
  <option value="0">Islam</option>
  <option value="1">Kristen</option>
  <option value="2">Katholik</option>
  <option value="3">Hindu</option>
  <option value="4">Budha</option>
  <option value="5">Kong Hu Chu</option>
</select>

<input name="" type="submit" value="Sortir" />
</form>
</div>

<div class="sortir-kanan">
<form action="index.php?page=sortir&status" method="post">
Status<select name="status">
  <option value="0">Ditolak</option>
  <option value="1">Diterima</option>
</select>

<input name="" type="submit" value="Sortir" />
</form>

</div>

<button id="cetak" > Cetak </button>

      <div id="data-siswa"><center>
      <?php if ($_POST['status'] == 0) {
	echo "<h1>Daftar Calon Siswa Pendaftaran Ditolak</h1>";
}
else if($_POST['status'] == 1) {
echo"<h1>Daftar Calon Siswa Pendaftaran Diterima</h1>";
}
?></center>
         
        <!-- tampilkan ketika dalam mode print -->
      
        <table class="table table-condensed table-bordered table-hover" cellpadding="0" cellspacing="0">
            <thead>
            <tr>
                <th width="2%">#</th>
                <th width="12%">Nama</th>
                <th width="10%">JK</th>
                <th width="10%">Agama</th>
                <th width="12%">Alamat</th>
                <th width="12%">Sekolah</th>
                <th width="5%">Status</th>
                <th width="20%" class="action"></th>
            </tr>
        </thead>
        <tbody>
<?php if ($totalRows_index > 0) { // Show if recordset not empty ?>
<?php
  $no = 1;
   do { ?>
            <tr>
                <td><?php echo $no ?></td>
                <td><?php echo $row_index['nama_lengkap']; ?></td>
                <td><?php 
	 $jk = $row_index['jenis_kelamin'];
	 if ($jk == 0 ) { echo "Laki-Laki"; }
	 else if ($jk == 1) { echo "Wanita"; } 
	  ?></td>
                <td> <?php
	  $agama = $row_index['agama'];
	  if ($agama == 0) {
		  echo "Islam" ;
	  }
	  else if ($agama == 1) {
		  echo "Kristen";
	  }
	  else if ($agama == 2) {
		  echo "Katholik";
	  }
	  else if ($agama == 3) {
		  echo "Hindu";
	  }
	  else if ($agama == 4) {
		  echo "Budha";
	  }
	  else if ($agama == 5) {
		  echo "Kon Hu Chu";
	  }
	  ?></td>
                <td><?php echo $row_index['alamat_siswa']; ?></td>
                <td><?php echo $row_index['sekolah_asal']; ?></td>
                <td><?php 
	 $st = $row_index['status'];
	 if ($st == 0 ) { echo "Ditolak"; }
	 else if ($st == 1) { echo "Diterima"; } 
	  ?></td>
                <!-- sembunyikan ketika dalam mode print -->
                <td class="action">
                    <a href="http://localhost/smapunggur/root/index.php?page=edit-siswa&username=<?php echo $row_index['username']; ?>" class="btn btn-mini">Ubah</a>
                    <a href="http://localhost/smapunggur/root/index.php?page=hapus-siswa&id_siswa=<?php echo $row_index['id_siswa']; ?>" class="btn btn-mini">Hapus</a>
                </td>
            </tr>
              <?php $no++; } while ($row_index = mysql_fetch_assoc($index)); ?>
            <?php } 
			else {echo"kosong";}
			?>
        </tbody>
        </table>      
         
      </div>
 
</body>
</html>
<?php
mysql_free_result($index);
?>
