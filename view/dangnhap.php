<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="view/css/dangnhap.css">
    <title>Đăng nhập</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>

<body>
    <?php
    include_once("message.php");
    ?>
    <div id="login">
        <a href="index.php">
            <h3 class="text-center text-white pt-5"></h3>
        </a>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="index.php?mod=public&act=dangnhapbe" method="post">
                            <h3 class="text-center text-info">Đăng nhập</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Tài Khoản:</label><br>
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Mật Khẩu:</label><br>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="6LepYN8ZAAAAACBKoMBrOY7FgMYQyrdPMnlZtK42"></div>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="dnsubmit" class="btn btn-info btn-md" value="Đăng nhập">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="?mod=public&act=dangky" class="text-info">Đăng ký</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>