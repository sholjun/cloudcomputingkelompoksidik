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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO smapunggur_siswa (username, password, nama_lengkap, jenis_kelamin, agama, tempat_lahir, tanggal_lahir, nama_ortu, alamat_siswa, sekolah_asal, foto, status, tes_akademis, tes_akademis_bakat, tes_bakat, nilai_mtk, nilai_bing, nilai_bindo, nilai_ipa, nilai_ips) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
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
                       GetSQLValueString($_POST['foto'], "text"),
                       GetSQLValueString($_POST['status'], "int"),
                       GetSQLValueString($_POST['tes_akademis'], "int"),
                       GetSQLValueString($_POST['tes_akademis_bakat'], "int"),
                       GetSQLValueString($_POST['tes_bakat'], "int"),
                       GetSQLValueString($_POST['nilai_mtk'], "double"),
                       GetSQLValueString($_POST['nilai_bing'], "double"),
                       GetSQLValueString($_POST['nilai_bindo'], "double"),
                       GetSQLValueString($_POST['nilai_ipa'], "double"),
                       GetSQLValueString($_POST['nilai_ips'], "double"));

  mysql_select_db($database_smapunggur_db, $smapunggur_db);
  $Result1 = mysql_query($insertSQL, $smapunggur_db) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Username:</td>
      <td><input type="text" name="username" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Password:</td>
      <td><input type="text" name="password" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nama_lengkap:</td>
      <td><input type="text" name="nama_lengkap" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Jenis_kelamin:</td>
      <td><select name="jenis_kelamin">
        <option value="0" <?php if (!(strcmp(0, ""))) {echo "SELECTED";} ?>>Laki - Laki</option>
        <option value="1" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?>>Wanita</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Agama:</td>
      <td><select name="agama">
        <option value="0" <?php if (!(strcmp(0, ""))) {echo "SELECTED";} ?>>Islam</option>
        <option value="1" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?>>Kristen</option>
        <option value="2" <?php if (!(strcmp(2, ""))) {echo "SELECTED";} ?>>Katholik</option>
        <option value="3" <?php if (!(strcmp(3, ""))) {echo "SELECTED";} ?>>Hindu</option>
        <option value="4" <?php if (!(strcmp(4, ""))) {echo "SELECTED";} ?>>Budha</option>
        <option value="5" <?php if (!(strcmp(5, ""))) {echo "SELECTED";} ?>>Kong Hu Chu</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tempat_lahir:</td>
      <td><input type="text" name="tempat_lahir" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tanggal_lahir:</td>
      <td><input type="text" name="tanggal_lahir" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nama_ortu:</td>
      <td><input type="text" name="nama_ortu" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Alamat_siswa:</td>
      <td><input type="text" name="alamat_siswa" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Sekolah_asal:</td>
      <td><input type="text" name="sekolah_asal" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Foto:</td>
      <td><input type="text" name="foto" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Status:</td>
      <td><select name="status" id="status">
        <option value="0">Terima</option>
        <option value="1">Tolak</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tes_akademis:</td>
      <td><input type="checkbox" name="tes_akademis" id="tes_akademis" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tes_akademis_bakat:</td>
      <td><input type="checkbox" name="tes_akademis_bakat" id="tes_akademis_bakat" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tes_bakat:</td>
      <td><select name="tes_bakat" class="input-selek">
      <option selected="selected">Tidak Ikut</option>
      <option value="1">basket</option>
      <option value="2">volly</option>
      <option value="3">atletik</option>
      <option value="4">sepak bola</option>
    </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nilai_mtk:</td>
      <td><input type="text" name="nilai_mtk" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nilai_bing:</td>
      <td><input type="text" name="nilai_bing" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nilai_bindo:</td>
      <td><input type="text" name="nilai_bindo" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nilai_ipa:</td>
      <td><input type="text" name="nilai_ipa" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nilai_ips:</td>
      <td><input type="text" name="nilai_ips" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
