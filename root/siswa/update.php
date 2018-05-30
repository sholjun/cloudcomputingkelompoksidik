
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
  $updateSQL = sprintf("UPDATE smapunggur_siswa SET username=%s, password=%s, nama_lengkap=%s, jenis_kelamin=%s, agama=%s, tempat_lahir=%s, tanggal_lahir=%s, nama_ortu=%s, alamat_siswa=%s, sekolah_asal=%s, status=%s, nilai_tes=%s,tanggal_acc=%s,tahun_ajaran=%s WHERE id_siswa=%s",
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['nama_lengkap'], "text"),
                       GetSQLValueString($_POST['jenis_kelamin'], "int"),
                       GetSQLValueString($_POST['agama'], "int"),
                       GetSQLValueString($_POST['tempat_lahir'], "text"),
                       GetSQLValueString($_POST['tanggal_lahir'], "date"),
                       GetSQLValueString($_POST['nama_ortu'], "text"),
                       GetSQLValueString($_POST['alamat_siswa'], "text"),
                       GetSQLValueString($_POST['sekolah_asal'], "text"),
                       GetSQLValueString($_POST['status'], "int"),
                       GetSQLValueString($_POST['nilai_tes'], "double"),
                       GetSQLValueString($_POST['tanggal_acc'], "date"),
                       GetSQLValueString($_POST['tahun_ajaran'], "text"),
                       GetSQLValueString($_POST['id_siswa'], "int"));

  mysql_select_db($database_smapunggur_db, $smapunggur_db);
  $Result1 = mysql_query($updateSQL, $smapunggur_db) or die(mysql_error());

  $updateGoTo = "http://localhost/smapunggur/root/index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: http://localhost/smapunggur/root/index.php?page=siswa"));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE smapunggur_tes SET tes_akademis=%s, tes_akademis_bakat=%s, tes_bakat=%s, username=%s WHERE id_tes=%s" ,
                       GetSQLValueString($_POST['tes_akademis'], "int"),
                       GetSQLValueString($_POST['tes_akademis_bakat'], "int"),
                       GetSQLValueString($_POST['tes_bakat'], "int"),
                       GetSQLValueString($_POST['username'], "text"),					   
                       GetSQLValueString($_POST['id_tes'], "int"));

  mysql_select_db($database_smapunggur_db, $smapunggur_db);
  $Result1 = mysql_query($updateSQL, $smapunggur_db) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE smapunggur_nilai SET nilai_mtk=%s, nilai_bing=%s, nilai_bindo=%s, nilai_ipa=%s, nilai_ips=%s, username=%s WHERE id_nilai=%s",
                       GetSQLValueString($_POST['nilai_mtk'], "double"),
                       GetSQLValueString($_POST['nilai_bing'], "double"),
                       GetSQLValueString($_POST['nilai_bindo'], "double"),
                       GetSQLValueString($_POST['nilai_ipa'], "double"),
                       GetSQLValueString($_POST['nilai_ips'], "double"),
                       GetSQLValueString($_POST['username'], "text"),					   
                       GetSQLValueString($_POST['id_nilai'], "int"));

  mysql_select_db($database_smapunggur_db, $smapunggur_db);
  $Result1 = mysql_query($updateSQL, $smapunggur_db) or die(mysql_error());
}

$colname_update = "-1";
if (isset($_GET['username'])) {
  $colname_update = $_GET['username'];
}
mysql_select_db($database_smapunggur_db, $smapunggur_db);
$query_update = sprintf("SELECT * FROM smapunggur_siswa,smapunggur_nilai,smapunggur_tes WHERE smapunggur_siswa.username=smapunggur_nilai.username AND smapunggur_siswa.username=smapunggur_tes.username AND smapunggur_siswa.username = %s", GetSQLValueString($colname_update, "text"));
$update = mysql_query($query_update, $smapunggur_db) or die(mysql_error());
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);

?>

<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table width="100%">
    <tr valign="baseline">
      <td nowrap align="right">Id_siswa:</td>
      <td><?php echo $row_update['id_siswa']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Username:</td>
      <td><input type="text" name="username" value="<?php echo htmlentities($row_update['username'], ENT_COMPAT, ''); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Password:</td>
      <td><input type="text" name="password" value="<?php echo htmlentities($row_update['password'], ENT_COMPAT, ''); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Nama_lengkap:</td>
      <td><input type="text" name="nama_lengkap" value="<?php echo htmlentities($row_update['nama_lengkap'], ENT_COMPAT, ''); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Jenis_kelamin:</td>
      <td><select name="jenis_kelamin" id="jenis_kelamin">
        <option value="0" <?php if (!(strcmp(0, $row_update['jenis_kelamin']))) {echo "selected=\"selected\"";} ?>>Laki - Laki</option>
        <option value="1" <?php if (!(strcmp(1, $row_update['jenis_kelamin']))) {echo "selected=\"selected\"";} ?>>Wanita</option>
</select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Agama:</td>
      <td><select name="agama" id="agama">
        <option value="0" <?php if (!(strcmp(0, $row_update['agama']))) {echo "selected=\"selected\"";} ?>>Islam</option>
        <option value="1" <?php if (!(strcmp(1, $row_update['agama']))) {echo "selected=\"selected\"";} ?>>Kristen</option>
        <option value="2" <?php if (!(strcmp(2, $row_update['agama']))) {echo "selected=\"selected\"";} ?>>Katholik</option>
        <option value="3" <?php if (!(strcmp(3, $row_update['agama']))) {echo "selected=\"selected\"";} ?>>Hindu</option>
        <option value="4" <?php if (!(strcmp(4, $row_update['agama']))) {echo "selected=\"selected\"";} ?>>Budha</option>
        <option value="5" <?php if (!(strcmp(5, $row_update['agama']))) {echo "selected=\"selected\"";} ?>>Kong Hu Chu</option>
</select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Tempat_lahir:</td>
      <td><input type="text" name="tempat_lahir" value="<?php echo htmlentities($row_update['tempat_lahir'], ENT_COMPAT, ''); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Tanggal_lahir:</td>
      <td><input type="text" name="tanggal_lahir" value="<?php echo htmlentities($row_update['tanggal_lahir'], ENT_COMPAT, ''); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Nama_ortu:</td>
      <td><input type="text" name="nama_ortu" value="<?php echo htmlentities($row_update['nama_ortu'], ENT_COMPAT, ''); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Alamat_siswa:</td>
      <td><input type="text" name="alamat_siswa" value="<?php echo htmlentities($row_update['alamat_siswa'], ENT_COMPAT, ''); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Sekolah_asal:</td>
      <td><input type="text" name="sekolah_asal" value="<?php echo htmlentities($row_update['sekolah_asal'], ENT_COMPAT, ''); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Foto:</td>
      <td>
          <img src="http://localhost/smapunggur/foto/<?php echo htmlentities($row_update['foto'], ENT_COMPAT, ''); ?>" width="100">
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Status:</td>
      <td><select name="status" id="status">
        <option value="0" <?php if (!(strcmp(0, $row_update['status']))) {echo "selected=\"selected\"";} ?>>Tolak</option>
        <option value="1" <?php if (!(strcmp(1, $row_update['status']))) {echo "selected=\"selected\"";} ?>>Terima</option>
</select></td>
    </tr>
     <tr valign="baseline">
      <td nowrap align="right">Nilai Tes:</td>
      <td><input type="text" name="nilai_tes" value="<?php echo htmlentities($row_update['nilai_tes'], ENT_COMPAT, ''); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Tes_akademis:</td>
      <td><input <?php if (!(strcmp($row_update['tes_akademis'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" name="tes_akademis" id="tes_akademis"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Tes_akademis_bakat:</td>
      <td><input <?php if (!(strcmp($row_update['tes_akademis_bakat'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" name="tes_akademis_bakat" id="tes_akademis_bakat"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Tes_bakat:</td>
      <td><select name="tes_bakat" id="tes_bakat">
        <option value="0" <?php if (!(strcmp(0, $row_update['tes_bakat']))) {echo "selected=\"selected\"";} ?>>Tidak Ikut</option>
        <option value="1" <?php if (!(strcmp(1, $row_update['tes_bakat']))) {echo "selected=\"selected\"";} ?>>Basket</option>
        <option value="2" <?php if (!(strcmp(2, $row_update['tes_bakat']))) {echo "selected=\"selected\"";} ?>>Volli</option>
        <option value="3" <?php if (!(strcmp(3, $row_update['tes_bakat']))) {echo "selected=\"selected\"";} ?>>Atletik</option>
        <option value="4" <?php if (!(strcmp(4, $row_update['tes_bakat']))) {echo "selected=\"selected\"";} ?>>Sepak Bola</option>
</select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Nilai_mtk:</td>
      <td><input type="text" name="nilai_mtk" value="<?php echo htmlentities($row_update['nilai_mtk'], ENT_COMPAT, ''); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Nilai_bing:</td>
      <td><input type="text" name="nilai_bing" value="<?php echo htmlentities($row_update['nilai_bing'], ENT_COMPAT, ''); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Nilai_bindo:</td>
      <td><input type="text" name="nilai_bindo" value="<?php echo htmlentities($row_update['nilai_bindo'], ENT_COMPAT, ''); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Nilai_ipa:</td>
      <td><input type="text" name="nilai_ipa" value="<?php echo htmlentities($row_update['nilai_ipa'], ENT_COMPAT, ''); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Nilai_ips:</td>
      <td><input type="text" name="nilai_ips" value="<?php echo htmlentities($row_update['nilai_ips'], ENT_COMPAT, ''); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Tahun Ajaran:</td>
      <td><input type="text" name="tahun_ajaran" value="<?php echo htmlentities($row_update['tahun_ajaran'], ENT_COMPAT, ''); ?>" size="32"></td>
    </tr>
    
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Update record"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="id_siswa" value="<?php echo $row_update['id_siswa']; ?>">
  <input type="hidden" name="tanggal_acc" value="<?php echo date('Y-m-d'); ?>">
  <input type="hidden" name="id_tes" value="<?php echo $row_update['id_tes']; ?>">
  <input type="hidden" name="id_nilai" value="<?php echo $row_update['id_nilai']; ?>">
</form>
<p>&nbsp;</p>
<?php  
mysql_free_result($update);
?>