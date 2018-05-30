
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Halaman Login</title>
</head>

<body>
<form action="<?php echo $loginFormAction; ?>" method="POST">
<input name="username" type="text" placeholder="Username" />
<input name="password" type="password" placeholder="Password" />
<input type="submit" value="Login" class="btn btn-home" />
</form>
</body>
</html>