
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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

$colname_test = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_test = $_SESSION['MM_Username'];
}
mysql_select_db($database_smapunggur_db, $smapunggur_db);
$query_test = sprintf("SELECT * FROM smapunggur_siswa WHERE username = %s", GetSQLValueString($colname_test, "text"));
$test = mysql_query($query_test, $smapunggur_db) or die(mysql_error());
$row_test = mysql_fetch_assoc($test);
$totalRows_test = mysql_num_rows($test);
?>
<div class="isi">

<div class="judul-web">Selamat Datang Saudara: <?php echo $row_test['nama_lengkap']; ?> Berikut Data Diri Anda
</div>

<div class="main">
<table width="100%" border="1">
  <tr>
    <td width="19%" rowspan="6"><img src="foto/<?php echo $row_test['foto']; ?>" width="200"/></td>
    <td width="19%">NISN</td>
    <td><?php echo $row_test['username']; ?></td>
    </tr>
  <tr>
    <td>Nama Lengkap</td>
    <td><?php echo $row_test['nama_lengkap']; ?></td>
    </tr>
  <tr>
    <td>Nama Orang Tua</td>
    <td><?php echo $row_test['nama_ortu']; ?></td>
    </tr>
  <tr>
    <td>Jenis Kelamin</td>
    <td><?php 
	 $jk = $row_test['jenis_kelamin'];
	 if ($jk == 0 ) { echo "Laki-Laki"; }
	 else if ($jk == 1) { echo "Wanita"; } 
	  ?></td>
    </tr>
  <tr>
    <td>Agama</td>
    <td> <?php
	  $agama = $row_test['agama'];
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
    </tr>
  <tr>
    <td>Tahun Ajaran</td>
    <td><?php echo $row_test['tahun_ajaran']; ?></td>
  </tr>
  <tr>
    <td colspan="3">Status pendafataran Anda :  <?php
		$status = $row_test['status'];
		if ($status == 0) {echo "<span class='menunggu'>menunggu</span> Silahkan cetak forumlir pendaftaran terlebih dahulu <a href='member/cetak-data.php'> DISINI </a>";}
		else if ($status == 1){ echo "<span class='diterima'>Diterima</span> Silahkan cetak formulir Anda <a href='member/cetak-acc.php' class='btn'>Disini</a>";}?>
        
        </td>
    </tr>
    <tr>
    <?php if ($status == 1) { ?>
    <td colspan="3"> Nilai tes anda : <?php echo  $row_test['nilai_tes']; ?></td>
    <?php } ?>
</table>


</div>

</div>
<?php
mysql_free_result($test);
?>
