<?php

include_once('DB.php');
class User
{
    public function dangkybe()
    {
        if (isset($_POST['dksubmit'])) {
            if (isset($_POST['hovaten']) && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm'])) {
                $username = trim($_POST['username']);
                $password = trim($_POST['password']);
                $confirm = trim($_POST['confirm']);
                $hoten = trim($_POST['hovaten']);
                $email = trim($_POST['email']);
                $cmt = trim($_POST['cmt']);
                if (!empty($username) && !empty($password) && !empty($confirm) && !empty($hoten) && !empty($email) && !empty($cmt)) {
                    if ($password === $confirm) {
                        $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
                        $isadmin = "0";
                        $active = "0";
                        $sql = "INSERT INTO users(username,password,hoten,cmt,email,isadmin,active) VALUES (?,?,?,?,?,?,?)";
                        $stmt = DB::mysqli()->prepare($sql);
                        $stmt->bind_param("sssssss", $username, $passwordHashed, $hoten, $cmt, $email, $isadmin, $active);
                        $stmt->execute();
                        $_SESSION['message'] = "Đăng ký thành công";
                        header("Location:index.php?mod=public&act=dangnhap");
                        exit();
                    } else {
                        $_SESSION['message'] = "Mật khẩu không thống nhất";
                        header("Location:index.php?mod=public&act=dangky");
                        exit();
                    }
                } else {
                    $_SESSION['message'] = "Thông tin thiếu";
                    header("Location:index.php?mod=public&act=dangky");
                    exit();
                }
            } else {
                $_SESSION['message'] = "Thông tin thiếu";
                header("Location:index.php?mod=public&act=dangky");
                exit();
            }
        }
    }

    public function dangnhapbe()
    {
        //check login
        if (isset($_POST['g-recaptcha-response'])) {
            $captcha = $_POST['g-recaptcha-response'];
        }
        if ($captcha) {
            $secretKey = "6LepYN8ZAAAAAK7sMvVjOmoR0IWG3X_YvLaKHc7y";
            //$ip = $_SERVER['REMOTE_ADDR'];
            $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
            $response = file_get_contents($url);
            $responseKeys = json_decode($response, true);
            if ($responseKeys["success"]) {
                if (isset($_POST['dnsubmit'])) {
                    if (isset($_POST['username']) && $_POST['password']) {
                        if (!empty($_POST['username']) && !empty($_POST['password'])) {
                            $username = $_POST['username'];
                            $password = $_POST['password'];
                            $hashed_password = NULL;
                            $sql = "SELECT username,password from users WHERE username = ?";
                            $stmt = DB::mysqli()->prepare($sql);
                            $stmt->bind_param("s", $username);
                            $stmt->execute();
                            $stmt->store_result();
                            if ($stmt->num_rows() == 1) {
                                $stmt->bind_result($username, $hashed_password);
                                $stmt->fetch();
                                if (password_verify($password, $hashed_password)) {
                                    $_SESSION['login'] = "true";
                                    return true;
                                }
                            } else {
                                return false;
                            }
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function sendWarningEmail($username,$txt){
        $sql = "SELECT email FROM users WHERE username = ?";
        $stmt = DB::mysqli()->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows() == 1) {
            $stmt->bind_result($email);
            $stmt->fetch();
            $stmt->close();          

            //SEND EMAIL
            $receiver = $email;
            $subject = "Cảnh báo: Đây có phải là bạn đang cố gắng đăng nhập";            
            $header  = 'MIME-Version: 1.0' . "\r\n";
            $header .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
            $header .= "From: Nhatminh";
            mail($receiver, $subject, $txt, $header);
        } 
    }

    public function sendOTP()
    {
        if (isset($_POST['username'])) {
            $username = $_POST['username'];
            $sql = "SELECT email FROM users WHERE username = ?";
            $stmt = DB::mysqli()->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows() == 1) {
                $stmt->bind_result($email);
                $stmt->fetch();
                $stmt->close();
                //GEN OTP
                $otp = rand(100000, 999999);
                $is_used = 0;
                //INSERT OTP DB
                $sql = "INSERT INTO otp(otp,username,is_used,created_at) VALUES (?,?,?,NOW())";
                $stmt = DB::mysqli()->prepare($sql);
                $stmt->bind_param("sss", $otp, $username, $is_used);
                $stmt->execute();

                //SEND EMAIL
                $receiver = $email;
                $subject = "OTP for login";
                $content = "<h1>This is your code to login:  <em>$otp </em> </h1>";
                $header  = 'MIME-Version: 1.0' . "\r\n";
                $header .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
                $header .= "From: Nhatminh";
                mail($receiver, $subject, $content, $header);
                echo "Mã OTP đã được gửi";
            } else {
                echo false;
            }
        } else {
            echo false;
        }
    }

    public function dangnhapotp()
    {
        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['otp'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $otp = $_POST['otp'];
            $hashed_password = NULL;
            $sql = "SELECT username,password from users WHERE username = ?";
            $stmt = DB::mysqli()->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows() == 1) {
                $stmt->bind_result($username, $hashed_password);
                $stmt->fetch();
                $stmt->close();
                if (password_verify($password, $hashed_password)) {
                    $sql = "SELECT id from otp WHERE otp = ? AND username = ? AND is_used = 0 AND NOW() <= DATE_ADD(created_at, INTERVAL 2 MINUTE) ";
                    $stmt = DB::mysqli()->prepare($sql);
                    $stmt->bind_param("ss", $otp, $username);
                    $stmt->execute();
                    $stmt->store_result();
                    if ($stmt->num_rows() == 1) {
                        $stmt->bind_result($id);
                        $stmt->fetch();
                        $stmt->close();
                        $sql = "UPDATE otp SET is_used = 1 WHERE id = ?";
                        $stmt = DB::mysqli()->prepare($sql);
                        $stmt->bind_param("i", $id);
                        $stmt->execute();
                        return true;
                    }
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function timkiem()
    {
        if (isset($_POST['cmnd'])) {
            if (!empty($_POST['cmnd'])) {
                $cmnd = $_POST['cmnd'];
                $sql = "SELECT * FROM bienban WHERE cmnd = ?";
                $stmt = DB::mysqli()->prepare($sql);
                $stmt->bind_param("s", $cmnd);
                $stmt->execute();
                $result = $stmt->get_result();
                $kq = array();
                if ($result->num_rows > 0) {
                    while ($data = $result->fetch_assoc()) {
                        array_push($kq, $data);
                    }
                }
                $stmt->close();
                echo json_encode($kq);
            } else {
                echo false;
            }
        } else {
            echo false;
        }
    }
}
