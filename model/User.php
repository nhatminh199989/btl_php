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
