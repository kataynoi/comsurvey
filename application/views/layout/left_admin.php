<div class="sidebar w3-theme-l5" role="navigation" style="padding-top: 15px;margin-top: 54px;">
    <div class="sidebar-nav navbar-collapse" id="left_slide" >
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" id="txt_search_link" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button" id="btn_search_link">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="<?php echo site_url('admin');?>"><i class="fas fa-chart-line"></i> Dashboard</a>
            </li>
            <li>
                <a href="<?php echo site_url('outsite')?>"><i class="fa fa-bus fa-fw"></i> จัดการแฟ้มพื้นฐาน<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo site_url('admin_computertype')?>">ประเภทคอมพิวเตอร์ </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin_workgroup')?>">จัดการข้อมูลกลุ่มงาน</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin_brand')?>">จัดการ Brand Computer</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin_cpu')?>">จัดการ CPU</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin_operating_system')?>">จัดการ ระบบปฏิบัติการ OS</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin_office')?>">จัดการโปรแกรม Office</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin_location')?>">สถานที่ตั้งอุปกรณ์</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin_use_status')?>">สถานะการใช้งานอุปกรณ์</a>
                    </li>                    <li>
                        <a href="<?php echo site_url('admin_cband_series')?>">รุ่นอุปกรณ์</a>
                    </li>


                </ul>
                <!-- /.nav-second-level -->
            </li>


        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>

