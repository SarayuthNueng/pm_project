 <!-- Sidebar Start -->
 <aside class="left-sidebar">
     <!-- Sidebar scroll-->
     <div>
         <div class="brand-logo d-flex align-items-center justify-content-between">
             <a href="./home.php" class="text-nowrap logo-img">
                 <img src="./assets/images/logos/logo_side.png" width="200" alt="" />
             </a>
             <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                 <i class="ti ti-x fs-8"></i>
             </div>
         </div>
         <!-- Sidebar navigation-->
         <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
             <ul id="sidebarnav">
                 <li class="nav-small-cap">
                     <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                     <span class="hide-menu">หน้าแรก</span>
                 </li>
                 <li class="sidebar-item">
                     <a class="sidebar-link" href="home.php" aria-expanded="false">
                         <span>
                             <i class="ti ti-layout-dashboard"></i>
                         </span>
                         <span class="hide-menu">แดชบอร์ด</span>
                     </a>
                 </li>
                 <li class="nav-small-cap">
                     <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                     <span class="hide-menu">โครงการ</span>
                 </li>
                 <li class="sidebar-item">
                     <a class="sidebar-link" href="project-import-plan.php" aria-expanded="false">
                         <span>
                             <i class="ti ti-file-import"></i>
                         </span>
                         <span class="hide-menu">นำเข้าโครงการ</span>
                     </a>
                 </li>
                 <li class="sidebar-item">
                     <a class="sidebar-link" href="project-manage.php" aria-expanded="false">
                         <span>
                             <i class="ti ti-checkup-list"></i>
                         </span>
                         <span class="hide-menu">ตรวจสอบโครงการ</span>
                     </a>
                 </li>
                 <li class="sidebar-item">
                     <a class="sidebar-link" href="project-budget.php" aria-expanded="false">
                         <span>
                             <i class="ti ti-coin"></i>
                         </span>
                         <span class="hide-menu">การเบิกงบประมาณโครงการ</span>
                     </a>
                 </li>
                 <li class="nav-small-cap">
                     <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                     <span class="hide-menu">สิทธ์การเข้าถึง</span>
                 </li>
                 <li class="sidebar-item">
                     <a class="sidebar-link" href="member-manage.php" aria-expanded="false">
                         <span>
                             <i class="ti ti-user-plus"></i>
                         </span>
                         <span class="hide-menu">จัดการบัญชีผู้ใช้งาน</span>
                     </a>
                 </li>
                 <?php
                    if (!$_SESSION) { ?>
                     <li class="sidebar-item">
                         <a class="sidebar-link" href="./login.php" aria-expanded="false">
                             <span>
                                 <i class="ti ti-key"></i>
                             </span>
                             <span class="hide-menu">เข้าสู่ระบบ</span>
                         </a>
                     </li>
                 <?php } else { ?>
                     <li class="sidebar-item">
                         <a class="sidebar-link exit-btn" href="./logout.php" aria-expanded="false">
                             <span>
                                 <i class="ti ti-logout"></i>
                             </span>
                             <span class="hide-menu">ออกจากระบบ</span>
                         </a>
                     </li>
                 <?php } ?>
             </ul>
             <div class="mt-5 m-2 text-center">
                <h6 style="font-size: 12px;">เวอร์ชัน 1.0</h6>
             </div>
         </nav>
         <!-- End Sidebar navigation -->
     </div>
     <!-- End Sidebar scroll-->
 </aside>
 <!--  Sidebar End -->
 <!--  Main wrapper -->
 <div class="body-wrapper">