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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE smapunggur_nilai SET id_siswa=%s, mata_pelajaran=%s, nilai=%s WHERE id_nilai=%s",
                       GetSQLValueString($_POST['id_siswa'], "int"),
                       GetSQLValueString($_POST['mata_pelajaran'], "text"),
                       GetSQLValueString($_POST['nilai'], "int"),
                       GetSQLValueString($_POST['id_nilai'], "int"));

  mysql_select_db($database_smapunggur_db, $smapunggur_db);
  $Result1 = mysql_query($updateSQL, $smapunggur_db) or die(mysql_error());

  $updateGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_halaman_update = "-1";
if (isset($_GET['id_nilai'])) {
  $colname_halaman_update = $_GET['id_nilai'];
}
mysql_select_db($database_smapunggur_db, $smapunggur_db);
$query_halaman_update = sprintf("SELECT * FROM smapunggur_nilai WHERE id_nilai = %s", GetSQLValueString($colname_halaman_update, "int"));
$halaman_update = mysql_query($query_halaman_update, $smapunggur_db) or die(mysql_error());
$row_halaman_update = mysql_fetch_assoc($halaman_update);
$totalRows_halaman_update = mysql_num_rows($halaman_update);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Id_siswa:</td>
      <td><input type="text" name="id_siswa" value="<?php echo htmlentities($row_halaman_update['id_siswa'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Mata_pelajaran:</td>
      <td><input type="text" name="mata_pelajaran" value="<?php echo htmlentities($row_halaman_update['mata_pelajaran'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nilai:</td>
      <td><input type="text" name="nilai" value="<?php echo htmlentities($row_halaman_update['nilai'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_nilai" value="<?php echo $row_halaman_update['id_nilai']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($halaman_update);
?>
