<?php

include_once('DB.php');
class bienBan
{

    public function them()
    {
        $ten = $_POST['ten'];
        $cmnd = $_POST['cmnd'];
        $phuongtien = $_POST['phuongtien'];
        $bienso = $_POST['bienso'];
        $diadiem = $_POST['diadiem'];
        $loivp = $_POST['loivp'];
        $tien = $_POST['tien'];
        $hannop = $_POST['hannop'];
        if (!empty($ten) && !empty($cmnd) && !empty($phuongtien) && !empty($bienso) && !empty($diadiem) && !empty($loivp) && !empty($tien) && !empty($hannop)) {
            $sql = "INSERT INTO bienban(tenNVP,cmnd,loaipt,bienso,diadiem,loivp,mucphat,hannop) VALUES (?,?,?,?,?,?,?,?)";
            $stmt = DB::mysqli()->prepare($sql);
            $stmt->bind_param("ssssssss", $ten, $cmnd, $phuongtien, $bienso, $diadiem, $loivp, $tien, $hannop);
            $stmt->execute();
            return true;
        } else {
            return false;
        }
        return false;
    }

    public function importcsv(){
        $filename = $_FILES['nhapcsv']['tmp_name'];
        if ($_FILES['nhapcsv']['size'] > 0) {
            $file = fopen($filename, "r");
            $count = 0;
            while (($column = fgetcsv($file, 1000, ",")) !== FALSE) {
                $count++;
                if ($count > 1) {
                    $tenNVP = $column[0];
                    $cmnd = $column[1];
                    $loaipt = $column[2];
                    $bienso = $column[3];
                    $diadiem = $column[4];
                    $loivp = $column[5];
                    $mucphat = $column[6];
                    $hannop = $column[7];
                    $sql = "INSERT INTO bienban(tenNVP,cmnd,loaipt,bienso,diadiem,loivp,mucphat,hannop) VALUES (?,?,?,?,?,?,?,?)";
                    $stmt = DB::mysqli()->prepare($sql);
                    $stmt->bind_param("ssssssss", $tenNVP, $cmnd, $loaipt, $bienso, $diadiem, $loivp, $mucphat, $hannop);
                    $stmt->execute();
                }
            }
            fclose($file);
            return true;
        }
        return false;
    }

    public function sua(){
        $id= $_POST['id'];
        $ten = $_POST['ten'];
        $cmnd = $_POST['cmnd'];
        $phuongtien = $_POST['phuongtien'];
        $bienso = $_POST['bienso'];
        $diadiem = $_POST['diadiem'];
        $loivp = $_POST['loivp'];
        $tien = $_POST['tien'];
        $hannop = $_POST['hannop'];
        if (!empty($ten) && !empty($cmnd) && !empty($phuongtien) && !empty($bienso) && !empty($diadiem) && !empty($loivp) && !empty($tien) && !empty($hannop)) {
            $sql = "UPDATE bienban SET tenNVP = ?, cmnd = ?, loaipt = ?, bienso = ?, diadiem = ?, loivp = ?, mucphat = ?, hannop = ? WHERE id = ? ";
            $stmt = DB::mysqli()->prepare($sql);
            $stmt->bind_param("sssssssss", $ten, $cmnd, $phuongtien, $bienso, $diadiem, $loivp, $tien, $hannop,$id);
            $stmt->execute();
            return true;
        } else {
            return false;
        }
        return false;
    }

    public function excel()
    {
        $sql = "SELECT * FROM bienban";
        $result = DB::mysqli()->query($sql);
        $data = "";
        if ($result->num_rows > 0) {
            $data .= "<table class='table' border='1'>";
            $data .= "<tr>";
            $data .= "<th>ID</th>";
            $data .= "<th>Tên</th>";
            $data .= "<th>CMND</th>";
            $data .= "<th>Phương Tiện</th>";
            $data .= "<th>Biển số</th>";
            $data .= "<th>Địa điểm</th>";
            $data .= "<th>Lỗi vi phạm</th>";
            $data .= "<th>Mức nộp phạt</th>";
            $data .= "<th>Hạn nộp</th>";
            $data .= "</tr>";

            while ($row = $result->fetch_assoc()) {
                $data .= "<tr>";
                $data .= "<td class='id'>" . $row['id'] . "</td>";
                $data .= "<td>" . $row['tenNVP'] . "</td>";
                $data .= "<td>" . $row['cmnd'] . "</td>";
                $data .= "<td>" . $row['loaipt'] . "</td>";
                $data .= "<td>" . $row['bienso'] . "</td>";
                $data .= "<td>" . $row['diadiem'] . "</td>";
                $data .= "<td>" . $row['loivp'] . "</td>";
                $data .= "<td>" . $row['mucphat'] . "</td>";
                $data .= "<td>" . $row['hannop'] . "</td>";
                $data .= "</tr>";
            }
            $data .= "</table>";
            header("Content-Disposition: attachment; filename=bienban.xls");
            header("Content-Type: application/vnd.ms-excel");
            echo $data;
        }
    }

    public function xoa()
    {
        $id = $_POST['id'];
        if (!empty($id)) {
            $sql = "DELETE FROM bienban WHERE id = ?";
            $stmt = DB::mysqli()->prepare($sql);
            $stmt->bind_param("s", $id);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function thongkept()
    {
        $sql = "SELECT loaipt, COUNT(loaipt) as soluong FROM bienban GROUP BY loaipt";
        $stmt = DB::mysqli()->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data += array($row['loaipt'] => $row['soluong']);
            }
        }
        $stmt->close();
        return $data;
    }

    public function thongkeloi()
    {
        $sql = "SELECT loivp, COUNT(loivp) as soluong FROM bienban GROUP BY loivp";
        $stmt = DB::mysqli()->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data += array($row['loivp'] => $row['soluong']);
            }
        }
        $stmt->close();
        return $data;
    }

    public function hienthi()
    {
        $sql = "SELECT * FROM bienban";
        $result = DB::mysqli()->query($sql);
        $data = "";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $ten = $row['tenNVP'];
                $cmnd = $row['cmnd'];
                $loaipt = $row['loaipt'];
                $bienso = $row['bienso'];
                $diadiem = $row['diadiem'];
                $loivp = $row['loivp'];
                $mucphat = $row['mucphat'];
                $hannop = $row['hannop'];
                $data .= "<tr>";
                $data .= "<td class='id'> " . $id . "</td>";
                $data .= "<td class='ten'> " . $ten . "</td>";
                $data .= "<td class='cmnd'> " . $cmnd . "</td>";
                $data .= "<td class='loaipt'> " . $loaipt . "</td>";
                $data .= "<td class='bienso'> " . $bienso . "</td>";
                $data .= "<td class='diadiem'> " . $diadiem . "</td>";
                $data .= "<td class='loivp'> " . $loivp . "</td>";
                $data .= "<td class='mucphat'> " . $mucphat . "</td>";
                $data .= "<td class='hannop'> " . $hannop . "</td>";
                $data .= "<td>
                <button class='btn btn-danger' onclick='deletefunc($id)'>Xoá</button>    
                <button data-toggle='modal' data-target='#updateModal' class='btn btn-warning' onclick='updatedata(this)'>Sửa</button>
                </td>";
                $data .= "</tr>";
            }
        } else {
            $data = "Không có biên bản nào";
        }
        return $data;
    }

    
}
