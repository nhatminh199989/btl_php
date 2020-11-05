<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Đăng ký</title>
</head>

<body>
    <?php
        include_once("message.php");
    ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="text-align:center;">
                        <h3>Đăng ký</h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" method="post" action="index.php?mod=public&act=dangkybe">
                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">Họ và tên</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="hovaten" id="name" placeholder="Nhập họ và tên" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="id" class="cols-sm-2 control-label">Chứng minh thư nhân dân</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="cmt" id="name" placeholder="Nhập CMTND" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="cols-sm-2 control-label">Email</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="email" id="email" placeholder="Nhập email" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="cols-sm-2 control-label">Tài khoản</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Nhập tên tài khoản" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="cols-sm-2 control-label">Mật khẩu</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Nhập mật khẩu" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="confirm" class="cols-sm-2 control-label">Nhập lại mật khẩu</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="confirm" id="confirm" placeholder="Nhập lại mật khẩu" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <button name="dksubmit" type="submit" class="btn btn-primary btn-lg btn-block login-button">Đăng ký</button>
                            </div>
                        </form>
                        <div class="login-register">
                            <a href="index.php">Đăng nhập</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>