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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
                    <a class="nav-link " href="index.php?mod=admin&act=trangql">Trang quản lý</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php?mod=admin&act=thongke">Thống kê</a>
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
        <div id="piechart" class="col-6"></div>
        <div id="columnchart" class="col-6"></div>
    </div>




    <script type="text/javascript">
        // Load google charts
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        // Draw the chart and set the chart values
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Loại phương tiện', 'Số lượng'],
                <?php
                foreach ($data as $pt => $soluong) {
                    echo "['" . $pt . "'," . $soluong . "],";
                }
                ?>
            ]);

            // Optional; add a title and set the width and height of the chart
            var options = {
                'title': 'Biểu đồ loại phương tiện vi phạm',
                'width': 550,
                'height': 400
            };

            // Display the chart inside the <div> element with id="piechart"
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>

    <script type="text/javascript">
        // Load google charts
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);
        // Draw the chart and set the chart values
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Lỗi vi phạm', 'Số lượng'],
                <?php
                foreach ($data_loi as $loi => $soluong) {
                    echo "['" . $loi . "'," . $soluong . "],";
                }
                ?>
            ]);
            // Optional; add a title and set the width and height of the chart
            var options = {
                'title': 'Biểu đồ các lỗi vi phạm giao thông',
                'width': 550,
                'height': 400
            };
            // Display the chart inside the <div> element with id="piechart"
            var chart = new google.visualization.ColumnChart(document.getElementById('columnchart'));
            chart.draw(data, options);
        }
    </script>



</body>

</html>