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
  $updateSQL = sprintf("UPDATE smapunggur_pengumuman SET judul_pengumuman=%s, isi_pengumuman=%s, tanggal_pengumuman=%s WHERE id_pengumuman=%s",
                       GetSQLValueString($_POST['judul_pengumuman'], "text"),
                       GetSQLValueString($_POST['isi_pengumuman'], "text"),
                       GetSQLValueString($_POST['tanggal_pengumuman'], "date"),
                       GetSQLValueString($_POST['id_pengumuman'], "int"));

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
if (isset($_GET['id_pengumuman'])) {
  $colname_halaman_update = $_GET['id_pengumuman'];
}
mysql_select_db($database_smapunggur_db, $smapunggur_db);
$query_halaman_update = sprintf("SELECT * FROM smapunggur_pengumuman WHERE id_pengumuman = %s", GetSQLValueString($colname_halaman_update, "int"));
$halaman_update = mysql_query($query_halaman_update, $smapunggur_db) or die(mysql_error());
$row_halaman_update = mysql_fetch_assoc($halaman_update);
$totalRows_halaman_update = mysql_num_rows($halaman_update);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Pengumuman</title>
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Judul_pengumuman:</td>
      <td><input type="text" name="judul_pengumuman" value="<?php echo htmlentities($row_halaman_update['judul_pengumuman'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Isi_pengumuman:</td>
      <td>
      
      <textarea name="isi_pengumuman" cols="50" rows="5">
      <?php echo htmlentities($row_halaman_update['isi_pengumuman'], ENT_COMPAT, 'utf-8'); ?>
      </textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tanggal_pengumuman:</td>
      <td><input type="text" name="tanggal_pengumuman" value="<?php echo htmlentities($row_halaman_update['tanggal_pengumuman'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_pengumuman" value="<?php echo $row_halaman_update['id_pengumuman']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($halaman_update);
?>
