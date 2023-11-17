<?php include('./include/head.php') ?>

<body data-aos="fade-down">
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <!-- <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="../assets/images/logos/dark-logo.svg" width="180" alt="">
                                </a> -->
                                <center><img src="./img/logo_sd.jpg" width="150"></center>
                                <form action="register_save.php" method="POST">
                                    <div class="mb-3">
                                        <label class="form-label">ชื่อผู้ใช้งาน</label>
                                        <input type="text" name="uname" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">รหัสผ่าน</label>
                                        <input type="password" name="pass" class="form-control"  required>
                                    </div>
                                    <div class="mb-4">
                                        <label  class="form-label">ชื่อ</label>
                                        <input type="text" name="fname" class="form-control" required>
                                    </div>
                                    <div class="mb-4">
                                        <label  class="form-label">นามสกุล</label>
                                        <input type="text" name="lname" class="form-control" required>
                                    </div>
                                    <div class="mb-4">
                                        <label  class="form-label">เลขบัตรประชาชน</label>
                                        <input type="text" name="cid" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">สมัครใช้งาน</button>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="fs-4 mb-0 fw-bold">มีบัญชีใช้งานแล้ว ?</p>
                                        <a class="text-primary fw-bold ms-2" href="login.php">เข้าสู่ระบบ</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    AOS.init({
      duration: 2000, // values from 0 to 3000, with step 50ms
      easing: "ease", // default easing for AOS animations
      once: true, // whether animation should happen only once - while scrolling down
    });
  </script>
</html>