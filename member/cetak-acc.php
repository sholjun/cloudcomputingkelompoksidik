<?php require_once('../Connections/smapunggur_db.php'); ?>

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

$MM_restrictGoTo = "http://localhost/smapunggur/index.php";
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

ob_start(); 
mysql_select_db($database_smapunggur_db, $smapunggur_db);
$query_panggilan = sprintf("SELECT * FROM smapunggur_siswa WHERE username = %s", GetSQLValueString($colname_test, "text"));
$panggilan = mysql_query($query_panggilan, $smapunggur_db) or die(mysql_error());
$row_panggilan = mysql_fetch_assoc($panggilan);
$totalRows_panggilan = mysql_num_rows($panggilan);

mysql_select_db($database_smapunggur_db, $smapunggur_db);
$query_cetak = sprintf("SELECT * FROM smapunggur_siswa WHERE username = %s", GetSQLValueString($colname_test, "text"));
$cetak = mysql_query($query_cetak, $smapunggur_db) or die(mysql_error());
$row_cetak = mysql_fetch_assoc($cetak);
$totalRows_cetak = mysql_num_rows($cetak);

mysql_select_db($database_smapunggur_db, $smapunggur_db);
$query_nilai = sprintf("SELECT * FROM smapunggur_siswa,smapunggur_nilai,smapunggur_tes WHERE smapunggur_siswa.username=smapunggur_nilai.username AND smapunggur_siswa.username=smapunggur_tes.username AND  smapunggur_siswa.username = %s AND status=1", GetSQLValueString($colname_test, "text"));
$nilai = mysql_query($query_nilai, $smapunggur_db) or die(mysql_error());
$row_nilai = mysql_fetch_assoc($nilai);
$totalRows_nilai = mysql_num_rows($nilai);

mysql_select_db($database_smapunggur_db, $smapunggur_db);
$query_waktu = sprintf("SELECT * FROM smapunggur_waktutest");
$waktu = mysql_query($query_waktu, $smapunggur_db) or die(mysql_error());
$row_waktu = mysql_fetch_assoc($waktu);

mysql_select_db($database_smapunggur_db, $smapunggur_db);
$query_admin = sprintf("SELECT * FROM smapunggur_admin");
$admin = mysql_query($query_admin, $smapunggur_db) or die(mysql_error());
$row_admin = mysql_fetch_assoc($admin);

 ?>
<?php   
ob_start();     
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />  
<title>Nama Siswa</title>
<link href="print.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body>
<img src="head.jpg" width="700" height="100" />
<div class="formulir-header">
<strong>FORMULIR SISWA BARU ACC</strong><br />
Nomor : <?php echo $row_panggilan['id_siswa']; ?>/SMA/PSB/2015
</div>
  
<table width="800" border="0" cellpadding="5" cellspacing="5" >
  <tr>
    <td width="23"><strong>1</strong></td>
    <td width="200">Nama Calon Siswa</td>
    <td width="18">:</td>
    <td style="text-transform:capitalize" width="541"><?php echo $row_panggilan['nama_lengkap']; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Jenis Kelamin</td>
    <td>:</td>
    <td><?php 
	 $jk = $row_panggilan['jenis_kelamin'];
	 if ($jk == 0 ) { echo "Laki-Laki"; }
	 else if ($jk == 1) { echo "Wanita"; } 
	  ?></td>
  </tr> 
  <tr>
    <td>&nbsp;</td>
    <td><span class="field-label">Tempat dan Tanggal Lahir</span></td>
    <td>:</td>
    <td><?php echo $row_panggilan['tempat_lahir']; ?>,<?php echo $row_panggilan['tanggal_lahir']; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><span class="field-label">Nama Orang Tua / Wali</span></td>
    <td>:</td>
    <td><?php echo $row_panggilan['nama_ortu']; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><span class="field-label">Alamat Siswa</span></td>
    <td>:</td>
    <td><?php echo $row_panggilan['alamat_siswa']; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><span class="field-label">Nama Asal Sekolah</span></td>
    <td>:</td>
    <td><?php echo $row_panggilan['sekolah_asal']; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Tahun Ajaran</td>
    <td>:</td>
    <td><?php echo $row_panggilan['tahun_ajaran']; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Tanggal Diterima</td>
    <td>:</td>
    <td><?php echo $row_panggilan['tanggal_acc']; ?></td>
  </tr>
  <tr>
    <td>2</td>
    <td>NILAI TES MASUK</td>
    <td>:</td>
    <td><?php echo $row_panggilan['nilai_tes']; ?></td>
  </tr>
</table>
<table width="551" border="0">
  <tr>
    <td width="29">&nbsp;</td>
    <td width="252">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="12">&nbsp;</td>
    <td width="121" style="color:#fff;padding:10px;">&nbsp;</td>
    <td width="71" style="color:#fff;padding:10px;">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
    
    
    
    
    
    
    Petugas PSB Online
    
    
    
    
    <?php echo $row_admin['nama_lengkap']; ?><br />
    NIP:  <?php echo $row_admin['nip']; ?>
    </td>
    <td colspan="3" align="right">
           <br />
           <br />
    <br />    <img src="../foto/<?php echo $row_panggilan['foto']; ?>" alt="" width="100" /></td>
    <td> </td>
    <td>
    
    
    
    
    
    
    Punggur , <?php echo date('d-M-Y'); ?>
    
    Pendaftar,
    
    
    
    
    <?php echo $row_panggilan['nama_lengkap']; ?>
    &nbsp;</td>
  </tr>
</table>
<p>========================================================================================</p>
<p><br />
</p>
</body>
</html>

<?php  
$filename="tugas-akhir-".$nama = $row_panggilan['username'].".pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya  
//==========================================================================================================  
//Copy dan paste langsung script dibawah ini,untuk mengetahui lebih jelas tentang fungsinya silahkan baca-baca tutorial tentang HTML2PDF  
//==========================================================================================================  
$content = ob_get_clean();  
$content = '<page style="font-family: freeserif">'.nl2br($content).'</page>';  
 require_once(dirname(__FILE__).'../../html2pdf/html2pdf.class.php');  
 try  
 {  
  $html2pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15',array(11, 5, 5, 0));  
  $html2pdf->setDefaultFont('Arial');  
  $html2pdf->writeHTML($content, isset($_GET['vuehtml']));  
  $html2pdf->Output($filename);  
 }  
 catch(HTML2PDF_exception $e) { echo $e; }  
?> <?php mysql_free_result($cetak);

mysql_free_result($panggilan);
?>