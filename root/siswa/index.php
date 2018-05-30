
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

$maxRows_index = 10;
$pageNum_index = 0;
if (isset($_GET['pageNum_index'])) {
  $pageNum_index = $_GET['pageNum_index'];
}
$startRow_index = $pageNum_index * $maxRows_index;

mysql_select_db($database_smapunggur_db, $smapunggur_db);
$query_index = "SELECT * FROM smapunggur_siswa";
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
<br />
<a href="http://localhost/smapunggur/root/index.php?page=tambah-siswa">Tambah Siswa</a><br />
<br />
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
   <h1>Keseluruhan Data Calon Siswa </h1>
 </center>
<table border="1" align="center" class="table">
<thead>
  <tr>
    <td width="15">No</td>
    <td width="120">nama_lengkap</td>
    <td width="15">JK</td>
    <td width="39">agama</td>
    <td width="100">alamat_siswa</td>
    <td width="136">sekolah_asal</td>
    <td width="34">status</td>
    <td width="150" class="action">Pilihan</td>
  </tr>
  </thead>
   <tbody>
  <?php
  $no = 1;
   do { ?>
    <tr>
      <td><?php echo $no ?> </a></td>
      <td><?php echo $row_index['nama_lengkap']; ?>&nbsp; </td>
      <td>
	  <?php 
	 $jk = $row_index['jenis_kelamin'];
	 if ($jk == 0 ) { echo "L"; }
	 else if ($jk == 1) { echo "P"; } 
	  ?>
      </td>
      <td>
        <?php
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
	  ?>&nbsp; </td>
      <td><?php echo $row_index['alamat_siswa']; ?>&nbsp; </td>
      <td><?php echo $row_index['sekolah_asal']; ?>&nbsp; </td>
      <td>
	   <?php 
	 $status = $row_index['status'];
	 if ($jk == 0 ) { echo "Ditolak"; }
	 else if ($jk == 1) { echo "Diterima"; } 
	  ?>
      </td>
      <td class="action"><a  class="btn btn-mini" href="http://localhost/smapunggur/root/index.php?page=edit-siswa&username=<?php echo $row_index['username']; ?>">Edit</a> <a class="btn btn-mini" href="http://localhost/smapunggur/root/index.php?page=hapus-siswa&id_siswa=<?php echo $row_index['id_siswa']; ?>">Hapus</a></td>
    </tr>
    <?php $no++; } while ($row_index = mysql_fetch_assoc($index)); ?>
    </tbody>
</table>

 </div>
<br /><div class="navigator">

<div class="tombolnext">
  <a href="<?php printf("%s?pageNum_index=%d%s", $currentPage, min($totalPages_index, $pageNum_index + 1), $queryString_index); ?>">Selanjutnya</a>
</div>

<div class="tombolprev">
  <a href="<?php printf("%s?pageNum_index=%d%s", $currentPage, max(0, $pageNum_index - 1), $queryString_index); ?>">Sebelumnya</a>
  
</div>
<div class="total-data">
data <?php echo ($startRow_index + 1) ?> sampai <?php echo min($startRow_index + $maxRows_index, $totalRows_index) ?> dari <?php echo $totalRows_index ?> data
</div>

<?php mysql_free_result($index);
?>
