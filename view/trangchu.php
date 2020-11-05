<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<style>
    .jumbotron {
        background-color: lightblue;
    }
</style>

<body>
    <nav class="navbar navbar-light bg-light static-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">Trang chủ</a>
            <a class="btn btn-primary" href="index.php?mod=public&act=dangnhap">Đăng nhập</a>
        </div>
    </nav>
    <header class="text-center jumbotron">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <h1 class="mb-5">Quản lý biên bản vi phạm giao thông</h1>
                </div>
                <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
                    <form id="search">
                        <div class="form-row">
                            <div class="col-12 col-md-9 mb-2 mb-md-0">
                                <input name="cmnd" type="text" class="form-control form-control-lg" placeholder="Nhập chứng minh nhân dân">
                            </div>
                            <div class="col-12 col-md-3">
                                <button type="submit" class="btn btn-block btn-lg btn-primary">Tìm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <div id='list'>

    </div>



    <script>
        $("#search").submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "index.php?mod=public&act=timkiem",
                enctype: 'multipart/form-data',
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    var objs = JSON.parse(response);
                    if (Array.isArray(objs) && objs.length ) {
                        console.log(objs);
                        $("#list").empty();
                        var html = "<table class='table table-condensed'>";
                        html += " <thead>";
                        html += " <tr>";
                        html += "<th>ID</th>";
                        html += "<th>Tên người vi phạm</th>";
                        html += "<th>CMND</th>";
                        html += "<th>Biển số</th>";
                        html += "<th>Phương tiện</th>";
                        html += "<th>Lỗi vi phạm</th>";
                        html += "<th>Địa điểm</th>";
                        html += "<th>Mức phạt</th>";
                        html += "<th>Hạn nộp</th>";
                        html += "</tr>";
                        html += "</thead>";
                        html += "<tbody>";
                        $.each(objs, function (key,obj){
                            html += "<tr>";
                            html += "<td>"+obj.id+"</td>";
                            html += "<td>"+obj.tenNVP+"</td>";
                            html += "<td>"+obj.cmnd+"</td>";
                            html += "<td>"+obj.bienso+"</td>";
                            html += "<td>"+obj.loaipt+"</td>";
                            html += "<td>"+obj.loivp+"</td>";
                            html += "<td>"+obj.diadiem+"</td>";
                            html += "<td>"+obj.mucphat+"</td>";
                            html += "<td>"+obj.hannop+"</td>";
                            html += "</tr>";
                        });
                        html += "</tbody>";
                        html += " </table>";
                        $("#list").append(html);
                    }else{
                        $("#list").empty();
                        var html = "<h3 style='text-align:center'>Không tìm được kết quả tương ứng</h3>";
                        $("#list").append(html);
                    }
                },
            })
        })
    </script>

</body>

</html>