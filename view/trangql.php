<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang quản lý</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body class="container-fluid">
    <div class="jumbotron text-center" style="margin-bottom:0; background-color:#4287f5;color:white;border-radius:0;">
        <h1>Quản lý vi phạm giao thông</h1>
    </div>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <a class="navbar-brand" href="index.php?mod=public&act=trangchu">Trang chủ</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php?mod=admin&act=trangql">Trang quản lý</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link " href="index.php?mod=admin&act=thongke">Thống kê</a>
                </li>
            </ul>
        </div>

        <ul class="nav navbar-nav navbar-right">
            <li>
                <form action="index.php?mod=public&act=dangxuat" method="POST">
                    <button type="submit" name="dxsubmit" class="btn btn-primary">Đăng xuất</button>
                </form>
            </li>
        </ul>
    </nav>
    <br>

    <div class="row">
        <div class="col-2">
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#addModal">Thêm biên bản</button>
        </div>
        <div class="col-1">
            <form action="index.php?mod=admin&act=excel" method="POST">
                <button type="submit" class="btn btn-success">In Excel</button>
            </form>
        </div>
        <div class="col-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCSV">Thêm từ file</button>
        </div>
    </div>

    <!-- import csv -->
    <div class="modal fade" id="addCSV" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm từ file</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="insertcsv" enctype="multipart/form-data">
                        <div class="custom-file">
                            <input name="nhapcsv" type="file" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Chọn file</label>
                        </div>
                        <button type="submit" class="btn btn-success">Nhập Excel</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Thêm -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm biên bản</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="insertform">
                        <div class="form-group">
                            <label>Tên người vi phạm:</label>
                            <input name="ten" type="text" class="form-control" placeholder="Nhập tên người vi phạm">
                        </div>
                        <div class="form-group">
                            <label>CMND:</label>
                            <input name="cmnd" type="text" class="form-control" placeholder="Nhập chứng minh nhân dân">
                        </div>
                        <div class="form-group">
                            <label for="phuongtien">Loại phương tiện:</label>
                            <select name="phuongtien" class="form-control" id="phuongtien">
                                <option>Ô tô</option>
                                <option>Xe máy</option>
                                <option>Xe tải</option>
                                <option>Xe đạp điện</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Biển số phương tiện:</label>
                            <input name="bienso" type="text" class="form-control" placeholder="Nhập biển số phương tiện vi phạm">
                        </div>
                        <div class="form-group">
                            <label>Địa điểm:</label>
                            <input name="diadiem" type="text" class="form-control" placeholder="Địa điểm vi phạm">
                        </div>
                        <div class="form-group">
                            <label>Lỗi vi phạm:</label>
                            <textarea class="form-control" rows="3" name="loivp"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Mức phạt:</label>
                            <input name="tien" type="text" class="form-control" placeholder="Nhập mức tiền nộp phạt" onkeypress="CurrencyFormat(this)">
                        </div>
                        <div class="form-group">
                            <label>Hạn nộp:</label>
                            <input name="hannop" type="date" class="form-control" placeholder="">
                        </div>
                        <button type="submit" class="btn btn-danger">THÊM</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Sửa     -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sửa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateform">
                        <div class="form-group">
                            <label>ID:</label>
                            <input id="update-id" name="id" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Tên người vi phạm:</label>
                            <input id="update-ten" name="ten" type="text" class="form-control" placeholder="Nhập tên người vi phạm">
                        </div>
                        <div class="form-group">
                            <label>CMND:</label>
                            <input id="update-cmnd" name="cmnd" type="text" class="form-control" placeholder="Nhập chứng minh nhân dân">
                        </div>
                        <div class="form-group">
                            <label for="phuongtien">Loại phương tiện:</label>
                            <select id="update-loaipt" name="phuongtien" class="form-control">
                                <option>Ô tô</option>
                                <option>Xe máy</option>
                                <option>Xe tải</option>
                                <option>Xe đạp điện</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Biển số phương tiện:</label>
                            <input id="update-bienso" name="bienso" type="text" class="form-control" placeholder="Nhập biển số phương tiện vi phạm">
                        </div>
                        <div class="form-group">
                            <label>Địa điểm:</label>
                            <input id="update-diadiem" name="diadiem" type="text" class="form-control" placeholder="Địa điểm vi phạm">
                        </div>
                        <div class="form-group">
                            <label>Lỗi vi phạm:</label>
                            <textarea id="update-loivp" class="form-control" rows="3" name="loivp"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Mức phạt:</label>
                            <input id="update-mucphat" name="tien" type="text" class="form-control" placeholder="Nhập mức tiền nộp phạt">
                        </div>
                        <div class="form-group">
                            <label>Hạn nộp:</label>
                            <input id="update-hannop" name="hannop" type="date" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-danger">Sửa</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <h1 align="center">Bảng biên bản</h1>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tên</th>
                <th scope="col">CMND</th>
                <th scope="col">Phương tiện</th>
                <th scope="col">Biển số</th>
                <th scope="col">Địa điểm</th>
                <th scope="col">Lỗi </th>
                <th scope="col">Mức phạt</th>
                <th scope="col">Hạn nộp</th>
                <th scope="col">Hành động</th>
            </tr>
        </thead>
        <tbody id="list">
            <?php
            echo $data;
            ?>
        </tbody>
    </table>


    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>




    <script>
        function updatedata(obj) {
            var tr = $(obj).parents("tr");
            var id = tr.find('.id').text();
            var ten = tr.find('.ten').text();
            var cmnd = tr.find('.cmnd').text();
            var loaipt = tr.find('.loaipt').text();
            var bienso = tr.find('.bienso').text();
            var diadiem = tr.find('.diadiem').text();
            var loivp = tr.find('.loivp').text();
            var mucphat = tr.find('.mucphat').text();
            var hannop = tr.find('.hannop').text();
            hannop = hannop.trim();
            loaipt = loaipt.trim();
            id = id.trim();
            ten = ten.trim();
            cmnd = cmnd.trim();
            bienso = bienso.trim();
            diadiem = diadiem.trim();
            loivp = loivp.trim();
            mucphat = mucphat.trim();
            document.getElementById('update-ten').value = ten;
            document.getElementById('update-cmnd').value = cmnd;
            document.getElementById('update-bienso').value = bienso;
            document.getElementById('update-loivp').value = loivp;
            document.getElementById('update-diadiem').value = diadiem;
            document.getElementById('update-mucphat').value = mucphat;
            document.getElementById('update-hannop').value = hannop;
            document.getElementById('update-id').value = id;
            if (loaipt === "Ô tô") {
                document.getElementById('update-loaipt').selectedIndex = "0";
            }
            if (loaipt === "Xe máy") {
                document.getElementById('update-loaipt').selectedIndex = "1";
            }
            if (loaipt === "Xe tải") {
                document.getElementById('update-loaipt').selectedIndex = "2";
            }
            if (loaipt === "Xe đạp điện") {
                document.getElementById('update-loaipt').selectedIndex = "3";
            }
        }

        $("#insertcsv").submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "index.php?mod=admin&act=importcsv",
                enctype: 'multipart/form-data',
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    document.getElementById("list").innerHTML = response;
                    console.log(response);
                    alert("Nhập thành công");
                },
            })
        })

        $("#insertform").submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "index.php?mod=admin&act=them",
                enctype: 'multipart/form-data',
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    var data = response;
                    document.getElementById("list").innerHTML = data;
                    console.log(response);
                    document.getElementById("insertform").reset();
                    alert("Thêm thành công");
                },
            })
        })

        function deletefunc(id) {
            var result = confirm("Bạn có muốn xoá biên bản này không ?");
            if (result) {
                $.ajax({
                    type: "POST",
                    url: "index.php?mod=admin&act=xoa",
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        alert("Xoá thành công");
                        document.getElementById("list").innerHTML = response;
                    }
                })
            }
        }

        $("#updateform").submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "index.php?mod=admin&act=sua",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    document.getElementById("list").innerHTML = response;
                    console.log(response);
                    alert("Sửa thành công")
                },
            })
        })
    </script>
</body>

</html>