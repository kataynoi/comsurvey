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
                <a href="<?php echo site_url();?>"><i class="fas fa-chart-line"></i> Dashboard</a>
            </li>
            <li>
                <a href="<?php echo site_url('outsite')?>"><i class="fa fa-bus fa-fw"></i>ลงทะเบียนอุปกรณ์<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo site_url('com_survey')?>">Computer</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('printer_survey')?>">Printer</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('network')?>">อุปกรณ์เครือข่าย</a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('scanner')?>">Scanner</a>
                    </li>

                </ul>
                <!-- /.nav-second-level -->
            </li>


            <li>
                <a href="#"><i class="fa fa-bus fa-fw"></i>รายงาน<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo site_url('/report/com_by_series')?>">จำนวนคอมพิวเตอร์ รายรุ่นปีที่เริ่มใช้งาน</a></li>
                    <li><a href="<?php echo site_url('/report/com_by_status')?>">คอมพิวเตอร์ตามสถานะการใช้งาน</a></li>
                    <li><a href="<?php echo site_url('/report/employee')?>"">จำนวนเจ้าหน้าที่ที่ไม่มีคอมพิวเตอร์ใช้</a></li>

                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="<?php echo site_url('signin/')?>"><i class="far fa-calendar-check"></i> แจ้งซ่อม</a>
            </li>
            <li>
                <a href="<?php echo site_url('admin')?>"><i class="far fa-calendar-check"> Administrator</i></a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>

<script src="<?php echo base_url() ?>assets/apps/js/search.js" charset="utf-8"></script>
