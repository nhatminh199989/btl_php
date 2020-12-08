<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<link rel="stylesheet" href="view/css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<body>
  <?php
  include_once("message.php");
  ?>

  <form id="regForm" action="index.php?mod=public&act=dangnhapotp" method="post">
    <h1>Đăng nhập</h1>
    <div class="tab">Login:
      <p><input placeholder="Username..." oninput="this.className = ''" name="username" type="text" id="username"></p>
      <p><input placeholder="Password..." oninput="this.className = ''" name="password" type="password"></p>
      <input type="button" value="Send OTP" class="btn" id="sendOTP">
    </div>
    <div class="tab">
      <p>Mã OTP:</p>
      <p><input placeholder="OTP" oninput="this.className = ''" name="otp"></p>
    </div>
    <div style="overflow:auto;">
      <div style="float:right;">
        <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
        <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
      </div>
    </div>
    <!-- Circles which indicates the steps of the form: -->
    <div style="text-align:center;margin-top:40px;">
      <span class="step"></span>
      <span class="step"></span>
    </div>
  </form>

  <script src="view/script/main.js"></script>
</body>

</html>