﻿<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<html>
<body>
<br>

<div class="row">
    <div class="panel panel-info ">
        <div class="panel-heading w3-theme">
            <i class="fa fa-user fa-2x "></i> Computer Brand
             <button class="btn btn-success pull-right" id="add_data" data-toggle="modal" data-target="#frmModal"><i class="fa fa-plus-circle"></i> Add</button>
</span>

        </div>
        <div class="panel-body">

            <table id="table_data" class="table table-responsive">
                <thead>
                <tr>
                    <th>รหัส</th><th>ยี่ห้อ</th>
                    <th>#</th>
                </tr>
                </thead>

            </table>
        </div>

    </div>

</div>


<div class="modal fade" id="frmModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">เพิ่มComputer Brand</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <input type="hidden" id="action" value="insert"><div class="form-group">

                    <input type="hidden" class="form-control" id="id" placeholder="รหัส" value="" disabled></div><div class="form-group">
                    <label for="name">ยี่ห้อ</label>
                    <input type="text" class="form-control" id="name" placeholder="ยี่ห้อ" value=""></div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btn_save">Save</button><button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<script src="<?php echo base_url() ?>assets/apps/js/admin_line.js" charset="utf-8"></script>

