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

  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<!--BAGIAN MENU KIRI-->
<div class="container">
<div class="menu-kiri">
<div class="menu-kiri-title">
Member
</div>
<div class="menu-kiri-isi">
<li><a href="index.php?page=siswa">Home</a></li>
<li><a href="<?php echo $logoutAction ?>">Log out</a></li>
</div>
<div class="menu-kiri-title">
Menu navigasi
</div>

<div class="menu-kiri-isi">
<li><a href="/index.php?page=panduan">Panduan</a></li>
<li><a href="/index.php?page=informasi">Informasi</a></li>
<li><a href="/index.php?page=data-pendaftar">Data Pendaftar</a></li>
</div>

<div class="clear">
</div>
</div>
</div>
