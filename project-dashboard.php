    <?php if (!$_SESSION) {
        Header("Location: home.php");
    } else { ?>

        
        <!--input year -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <!-- chart js -->
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.min.js" integrity="sha512-7U4rRB8aGAHGVad3u2jiC7GA5/1YhQcQjxKeaVms/bT66i3LVBMRcBI9KwABNWnxOSwulkuSXxZLGuyfvo7V1A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

        <!-- thai date -->
        <?php
        function DateThai($strDate)
        {
            $strYear = date("Y", strtotime($strDate)) + 543;
            $strMonth = date("n", strtotime($strDate));
            $strDay = date("j", strtotime($strDate));
            $strHour = date("H", strtotime($strDate));
            $strMinute = date("i", strtotime($strDate));
            $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
            $strMonthThai = $strMonthCut[$strMonth];
            return "$strMonthThai $strYear";
        }

        // $strDate = "2008-08-14 13:42:44";
        // echo "ThaiCreate.Com Time now : ".DateThai($_POST["start"]);
        ?>

        <?php include('./db/connect.php') ?>

        <!-- garh bar -->
        <?php
        $query = " SELECT SUM(sub_budget) as sub_budget_total, DATE_FORMAT(sub_created, '%M-%Y') as sub_created
            FROM sub_budget
            GROUP BY DATE_FORMAT(sub_created, '%Y-%m')
            ORDER BY DATE_FORMAT(sub_created, '%Y-%m') ASC ";
        $result = mysqli_query($conn, $query);
        $resultchart = mysqli_query($conn, $query);

        //for chart
        $sub_created = array();
        $sub_budget_total = array();
        while ($rs = mysqli_fetch_array($resultchart)) {
            $sub_created[] = "\"" . DateThai($rs['sub_created']) . "\"";
            $sub_budget_total[] = "\"" . $rs['sub_budget_total'] . "\"";

            // echo '<hr>';
            // echo $rs['sub_created'];
            // exit;
        }
        // ตัด , ออก
        $sub_created = implode(",", $sub_created);
        $sub_budget_total = implode(",", $sub_budget_total);

        // echo $total;
        // echo $sub_created;
        // exit;
        ?>
        <!-- garph doughnut -->
        <?php
        $query2 =
            "SELECT SUM(s1.sub_budget) as total_sub, s2.project_plan as plan
        FROM sub_budget s1
        LEFT JOIN project s2 on s1.sub_p_name_id = s2.project_id
        GROUP BY s2.project_name
    ";
        $result2 = mysqli_query($conn, $query2);
        $resultchart2 = mysqli_query($conn, $query2);
        //for chart
        $total_sub = array();
        $plan = array();
        while ($rs = mysqli_fetch_array($resultchart2)) {
            $total_sub[] = "\"" . $rs['total_sub'] . "\"";
            $plan[] = "\"" . $rs['plan'] . "\"";

            // echo '<hr>';
            // echo $rs['total_sub'];
            // exit;
        }
        // ตัด , ออก
        $total_sub = implode(",", $total_sub);
        $plan = implode(",", $plan);

        // echo $total;


        ?>
        <?php
        // sum total
        $sql = "SELECT SUM(project_budget) FROM project ";
        $result = $conn->query($sql);
        $row_sum_total = mysqli_fetch_array($result);
        // echo 'total:' . $row_sum_total[0];

        // sum sub_budget
        $sql2 = "SELECT SUM(sub_budget) FROM sub_budget ";
        $result2 = $conn->query($sql2);
        $row_sum_sub_budget = mysqli_fetch_array($result2);
        // echo 'total:' . $row_sum_total[0];

        // exit;


        // remain
        $sql2 = "SELECT (project_budget - sub_budget) as remain
        FROM sub_budget s1 
        LEFT JOIN project s2 on s1.sub_p_name_id = s2.project_id
        WHERE s2.project_id = 1";
        $result2 = $conn->query($sql2);
        $row_remain = mysqli_fetch_array($result2);
        ?>
        <?php include('./include/head.php') ?>
        <?php include('./include/sidebar.php') ?>
        <!--  Header Start -->
        <?php include('./include/header.php') ?>
        <!--  Header End -->

        <div class="container-fluid">
            <!--  Row 1 -->
            <div class="row">

                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Monthly Earnings -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="row alig n-items-start">
                                        <div class="col-8">
                                            <h5 class="card-title mb-9 fw-semibold">งบประมาณตั้งต้นทั้งหมด</h5>
                                            <h4 style="color: darkgreen;" class="fw-semibold mb-3"><?php $total = $row_sum_total[0];
                                                                                                    echo number_format($total, 2) ?> บาท</h4>
                                        </div>
                                        <div class="col-4">
                                            <div class="d-flex justify-content-end">
                                                <div class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                                    <!-- <i class="ti ti-currency-dollar fs-6"></i> -->
                                                    <img src="./img/money-bag.png" class="fs-6" style="width: 50px;" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div id="earning"></div> -->
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Monthly Earnings -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="row alig n-items-start">
                                        <div class="col-8">
                                            <h5 class="card-title mb-9 fw-semibold">งบประมาณที่ใช้ไปทั้งหมด</h5>
                                            <h4 style="color: crimson;" class="fw-semibold mb-3"><?php $total_sub_budget = $row_sum_sub_budget[0];
                                                                                                    echo number_format($total_sub_budget, 2) ?> บาท</h4>
                                        </div>
                                        <div class="col-4">
                                            <div class="d-flex justify-content-end">
                                                <div class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                                    <!-- <i class="ti ti-currency-dollar fs-6"></i> -->
                                                    <img src="./img/money.png" class="fs-6" style="width: 50px;" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div id="earning"></div> -->
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row alig n-items-start">
                                        <div class="col-8">
                                            <h5 class="card-title mb-9 fw-semibold">งบประมาณคงเหลือทั้งหมด</h5>
                                            <h4 style="color: dodgerblue;" class="fw-semibold mb-3"><?php $total_remain = ($row_sum_total[0] - $row_sum_sub_budget[0]);
                                                                                                    echo number_format($total_remain, 2) ?> บาท</h4>
                                        </div>
                                        <div class="col-4">
                                            <div class="d-flex justify-content-end">
                                                <div class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                                    <img src="./img//piggy-bank.png" class="fs-6" style="width: 50px;" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-8 mt-2">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">สถิติงบประมาณที่ใช้ไป / รายเดือน</h4>
                            <canvas id="myChartBar" width="100%"></canvas>
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <script>
                                const ctx4 = document.getElementById('myChartBar');
                                const myChartBar = new Chart(ctx4, {
                                    type: 'bar',
                                    responsive: true,
                                    data: {
                                        labels: [<?php echo $sub_created; ?>],
                                        datasets: [{
                                            label: 'รายงานงบประมาณที่ใช้ไป แยกตามเดือน (บาท)',
                                            data: [<?php echo $sub_budget_total; ?>],
                                            backgroundColor: [
                                                'rgba(255, 99, 132)',
                                                'rgba(54, 162, 235)',
                                                'rgba(255, 206, 86)',
                                                'rgba(75, 192, 192)',
                                                'rgba(153, 102, 255)',
                                                'rgba(255, 159, 64)',
                                                '#FFA07A',
                                                '#0000FF',
                                                '#A52A2A',
                                                '#5F9EA0',
                                                '#6495ED',
                                                '#B8860B',
                                                '#9932CC',
                                                '#FFDAB9',
                                                '#9400D3',
                                                '#006400',
                                                '#FF4500',
                                                '#98FB98',
                                                '#800000',
                                                '#FFB6C1',
                                                '#191970',
                                                '#CD5C5C',
                                            ],
                                            borderColor: [
                                                'rgba(255, 99, 132, 1)',
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(255, 206, 86, 1)',
                                                'rgba(75, 192, 192, 1)',
                                                'rgba(153, 102, 255, 1)',
                                                'rgba(255, 159, 64, 1)'
                                            ],
                                            borderWidth: 0
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-2">
                    <div class="card h-full">
                        <div class="card-body">
                            <h4 class="header-title">สถิติงบประมาณที่ใช้ไป / แยกตามแผนงาน</h4>
                            <canvas id="myChartDoughnut" width="100%"></canvas>
                            <script>
                                const ctx5 = document.getElementById('myChartDoughnut');
                                const myChartDoughnut = new Chart(ctx5, {
                                    type: 'doughnut',
                                    data: {
                                        labels: [<?php echo $plan; ?>],
                                        datasets: [{
                                            label: '# of Votes',
                                            data: [<?php echo $total_sub; ?>],
                                            backgroundColor: [
                                                'rgb(255, 99, 132)',
                                                'rgb(54, 162, 235)',
                                                'rgb(255, 205, 86)',
                                                '#FFA07A',
                                                '#0000FF',
                                                '#A52A2A',
                                                '#5F9EA0',
                                                '#6495ED',
                                                '#B8860B',
                                                '#9932CC',
                                                '#FFDAB9',
                                                '#9400D3',
                                                '#006400',
                                                '#FF4500',
                                                '#98FB98',
                                                '#800000',
                                                '#FFB6C1',
                                                '#191970',
                                                '#CD5C5C',
                                            ],
                                            hoverOffset: 4
                                        }]
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>


            </div>





        </div>
        <?php include('./include/footer.php') ?>

        </div>
    <?php } ?>