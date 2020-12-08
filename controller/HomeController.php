<?php
include_once('model/User.php');
class HomeController
{

    private $usermodel;

    public function __construct()
    {
        $this->usermodel = new User();
    }

    public function dangnhap()
    {
        require_once('view/dangnhap.php');
    }
    public function dangnhapz()
    {
        require_once('view/dangnhap2.php');
    }
    public function dangky()
    {
        require_once('view/dangky.php');
    }
    public function dangkybe()
    {
        $this->usermodel->dangkybe();
    }

    public static function getBrowser($serverAgent)
    {
        $u_agent = $serverAgent;
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version = "";

        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        } elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }

        // Next get the name of the useragent yes seperately and for good reason
        if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        } elseif (preg_match('/Firefox/i', $u_agent)) {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        } elseif (preg_match('/OPR/i', $u_agent)) {
            $bname = 'Opera';
            $ub = "Opera";
        } elseif (preg_match('/Chrome/i', $u_agent) && !preg_match('/Edge/i', $u_agent)) {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        } elseif (preg_match('/Safari/i', $u_agent) && !preg_match('/Edge/i', $u_agent)) {
            $bname = 'Apple Safari';
            $ub = "Safari";
        } elseif (preg_match('/Netscape/i', $u_agent)) {
            $bname = 'Netscape';
            $ub = "Netscape";
        } elseif (preg_match('/Edge/i', $u_agent)) {
            $bname = 'Edge';
            $ub = "Edge";
        } elseif (preg_match('/Trident/i', $u_agent)) {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        }

        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }
        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
                $version = $matches['version'][0];
            } else {
                $version = $matches['version'][1];
            }
        } else {
            $version = $matches['version'][0];
        }

        // check if we have a number
        if ($version == null || $version == "") {
            $version = "?";
        }

        return array(
            'userAgent' => $u_agent,
            'name'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'    => $pattern
        );
    }

    public function dangnhapbe()
    {
        $verify = $this->usermodel->dangnhapbe();
        if ($verify === true) {
            $_SESSION['login'] = "true";
            header("Location:index.php?mod=admin&act=trangql");
            exit();
        } else {
            if (!isset($_SESSION['loginFail'])) {
                $_SESSION['loginFail'] = 1;
            }
            function get_client_ip()
            {
                $ipaddress = '';
                if (getenv('HTTP_CLIENT_IP'))
                    $ipaddress = getenv('HTTP_CLIENT_IP');
                else if (getenv('HTTP_X_FORWARDED_FOR'))
                    $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
                else if (getenv('HTTP_X_FORWARDED'))
                    $ipaddress = getenv('HTTP_X_FORWARDED');
                else if (getenv('HTTP_FORWARDED_FOR'))
                    $ipaddress = getenv('HTTP_FORWARDED_FOR');
                else if (getenv('HTTP_FORWARDED'))
                    $ipaddress = getenv('HTTP_FORWARDED');
                else if (getenv('REMOTE_ADDR'))
                    $ipaddress = getenv('REMOTE_ADDR');
                else
                    $ipaddress = 'UNKNOWN';
                return $ipaddress;
            }

            if ($_SESSION['loginFail'] >= 3) {
                $_SESSION['clientIP'] = get_client_ip();
            }

            if (isset($_SESSION['loginFail'])) {
                $a = $_SESSION['loginFail'];
                if ($a >= 3) {
                    $_SESSION['blocked'] = date('m/d/Y h:i:s a', time() + 300);
                    $_SESSION['loginFail'] = 1;
                    if (isset($_SESSION['clientIP'])) {
                        $ip = $_SESSION['clientIP'];
                        $json     = file_get_contents("http://ipinfo.io/$ip?token=ad58e6f976ff1c");
                        $json     = json_decode($json, true);
                        $country  = $json['country'];
                        $city     = $json['city'];
                        if (isset($json['org'])) {
                            $org = $json['org'];
                        } else {
                            $org = null;
                        }
                        $txt = "IP: " . $_SESSION['clientIP'] . " " . "Time:" . date('m/d/Y h:i:s a', time());
                        $txt .= " Country: $country, City: $city, Org: $org \n";
                        $ua = $this->getBrowser($_SERVER['HTTP_USER_AGENT']);
                        $txt .= "Your browser: " . $ua['name'] . " " . $ua['version'] . " on " .$ua['platform'] . " reports: <br>". $ua['userAgent'];
                        $this->usermodel->sendWarningEmail($_POST['username'], $txt);
                    }
                } else {
                    $_SESSION['loginFail'] = $a + 1;
                }
            }

            $_SESSION['message'] = "Tài khoản hoặc mật khẩu không chính xác";
            header("Location:index.php?mod=public&act=dangnhap");
            exit();
        }
    }

    public function dangnhapotp()
    {
        $verify = $this->usermodel->dangnhapotp();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        if (isset($_SESSION['blocked'])) {
            $blockedTime = $_SESSION['blocked'];
            if ($blockedTime > date('m/d/Y h:i:s a', time())) {
                $_SESSION['message'] = "Hãy thử lại sau 5 phút";
                header("Location:index.php?mod=public&act=dangnhapz");
                exit();
            }
        }
        if ($verify === true) {
            $_SESSION['loginFail'] = 1;
            $_SESSION['login'] = "true";
            header("Location:index.php?mod=admin&act=trangql");
            exit();
        } else {
            if (!isset($_SESSION['loginFail'])) {
                $_SESSION['loginFail'] = 1;
            }

            function get_client_ip()
            {
                $ipaddress = '';
                if (getenv('HTTP_CLIENT_IP'))
                    $ipaddress = getenv('HTTP_CLIENT_IP');
                else if (getenv('HTTP_X_FORWARDED_FOR'))
                    $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
                else if (getenv('HTTP_X_FORWARDED'))
                    $ipaddress = getenv('HTTP_X_FORWARDED');
                else if (getenv('HTTP_FORWARDED_FOR'))
                    $ipaddress = getenv('HTTP_FORWARDED_FOR');
                else if (getenv('HTTP_FORWARDED'))
                    $ipaddress = getenv('HTTP_FORWARDED');
                else if (getenv('REMOTE_ADDR'))
                    $ipaddress = getenv('REMOTE_ADDR');
                else
                    $ipaddress = 'UNKNOWN';
                return $ipaddress;
            }

            if ($_SESSION['loginFail'] >= 3) {
                $_SESSION['clientIP'] = get_client_ip();
            }

            if (isset($_SESSION['loginFail'])) {
                $a = $_SESSION['loginFail'];
                if ($a >= 3) {
                    $_SESSION['blocked'] = date('m/d/Y h:i:s a', time() + 300);
                    $_SESSION['loginFail'] = 1;
                    if (isset($_SESSION['clientIP'])) {
                        $ip = $_SESSION['clientIP'];
                        $json     = file_get_contents("http://ipinfo.io/$ip?token=ad58e6f976ff1c");
                        $json     = json_decode($json, true);
                        $country  = $json['country'];
                        $city     = $json['city'];
                        if (isset($json['org'])) {
                            $org = $json['org'];
                        } else {
                            $org = null;
                        }
                        $myfile = fopen("bruteforce.txt", "a") or die("Unable to open file!");
                        $txt = "IP: " . $_SESSION['clientIP'] . " " . "Time:" . date('m/d/Y h:i:s a', time());
                        $txt .= " Country: $country, City: $city, Org: $org \n";
                        fwrite($myfile, $txt);
                        fclose($myfile);
                    }
                } else {
                    $_SESSION['loginFail'] = $a + 1;
                }
            }
            $_SESSION['message'] = "Thông tin không chính xác";
            header("Location:index.php?mod=public&act=dangnhapz");
            exit();
        }
    }

    public function sendOTP()
    {
        if (isset($_POST['username'])) {
            $this->usermodel->sendOTP();
        } else {
            header("Location:index.php?mod=public&act=dangnhapz");
            exit();
        }
    }

    public function dangxuatbe()
    {
        if (isset($_POST['dxsubmit'])) {
            unset($_SESSION['login']);
            header("Location:index.php?mod=public&act=dangnhap");
            exit();
        }
    }

    public function trangchu()
    {
        require_once('view/trangchu.php');
    }

    public function timkiem()
    {
        $data = $this->usermodel->timkiem();
        echo $data;
    }
}
