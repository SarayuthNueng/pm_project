<?php 
if($_SESSION['level'] == 'admin') {
    include('./include/sidebar_admin.php');
}else if($_SESSION['level'] == 'plan') {
    include('./include/sidebar_plan.php');
}else if($_SESSION['level'] == 'finance') {
    include('./include/sidebar_finance.php');
}else if($_SESSION['level'] == 'member') {
    include('./include/sidebar_member.php');
}

?>
<script>
        $('.exit-btn').on('click', function(e) {
            e.preventDefault();
            var self = $(this);
            console.log(self.data('title'));
            Swal.fire({
                title: 'ออกจากระบบ',
                text: "คุณต้องการออกจากระบบหรือไม่!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href = self.attr('href');
                }

            })
        })
    </script>
