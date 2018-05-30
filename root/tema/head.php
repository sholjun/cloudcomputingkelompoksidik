
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../tema/style.css" rel="stylesheet" type="text/css" media="all" />

    <link href="style.css" rel="stylesheet" media="screen">
     
    <!-- ss yang digunakan tampilkan ketika dalam mode print -->
    <link href="print.css" rel="stylesheet" media="print">
    <script src="jquery-1.8.3.min.js"></script>
    <script src="jquery.PrintArea.js"></script>
     <script>
        (function($) {
            // fungsi dijalankan setelah seluruh dokumen ditampilkan
            $(document).ready(function(e) {
                 
                // aksi ketika tombol cetak ditekan
                $("#cetak").bind("click", function(event) {
                    // cetak data pada area <div id="#data-mahasiswa"></div>
                    $('#data-siswa').printArea();
                });
            });
        }) (jQuery);
    </script>
<title>Admin Panel</title>
</head>

<body>
</body>
</html>