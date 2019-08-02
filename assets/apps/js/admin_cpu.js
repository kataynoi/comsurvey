$(document).ready(function () {
    var dataTable = $('#table_data').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],

        "pageLength": 50,
        "ajax": {
            url: site_url + '/admin_cpu/fetch_admin_cpu',
            data: {
                'csrf_token': csrf_token
            },
            type: "POST"
        },
        "columnDefs": [
            {
                "targets": [1, 2],
                "orderable": false,
            },
        ],
    });

});

var crud = {};

crud.ajax = {
    del_data: function (id, cb) {
        var url = '/admin_cpu/del_admin_cpu',
            params = {
                id: id
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }, save: function (items, cb) {
        var url = '/admin_cpu/save_admin_cpu',
            params = {
                items: items
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }, get_update: function (id, cb) {
        var url = '/admin_cpu/get_admin_cpu',
            params = {
                id: id
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }

};
crud.del_data = function (id) {

    crud.ajax.del_data(id, function (err, data) {
        if (err) {
            swal(err)
        }
        else {
            //swal('ลบข้อมูลเรียบร้อย')
            app.alert('ลบข้อมูลเรียบร้อย');

        }
    });
}

crud.save = function (items) {
    crud.ajax.save(items, function (err, data) {
        if (err) {
            //app.alert(err);
            swal(err);
        }
        else {
            swal('แก้ไขข้อมูลเรียบร้อยแล้ว ');
            location.reload();
        }
    });

}

crud.get_update = function (id) {
    crud.ajax.get_update(id, function (err, data) {
        if (err) {
            //app.alert(err);
            swal(err);
        }
        else {
            //swal('แก้ไขข้อมูลเรียบร้อยแล้ว ');
            //location.reload();
            crud.set_update(data);
        }
    });

}
crud.set_update = function (data) {
    $("#id").val(data.rows["id"]);
    $("#name").val(data.rows["name"]);
    $("#cpu_series").val(data.rows["cpu_series"]);
}

$('#btn_save').on('click', function (e) {
    e.preventDefault();
    var action;
    var items = {};
    items.action = $('#action').val();
    items.id = $("#id").val();
    items.name = $("#name").val();
    items.cpu_series = $("#cpu_series").val();

    if (validate(items)) {
        crud.save(items);
    }

});

$('#add_data').on('click', function (e) {
    e.preventDefault();
    app.clear_form();
});

$(document).on('click', 'button[data-btn="btn_del"]', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var td = $(this).parent().parent().parent();

    swal({
        title: "คำเตือน?",
        text: "คุณต้องการลบข้อมูล ",
        icon: "warning",
        buttons: [
            'cancel !',
            'Yes !'
        ],
        dangerMode: true,
    }).then(function (isConfirm) {
        if (isConfirm) {
            crud.del_data(id);
            td.hide();
        }
    });
});

$(document).on('click', 'button[data-btn="btn_edit"]', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#action').val('update');
    $('#id').val(id);
    crud.get_update(id);
    $('#frmModal').modal('show');

});

function validate(items) {

   if (!items.name) {
        swal("กรุณาระบุประเภทCPU");
        $("#name").focus();
    } else if (!items.cpu_series) {
        swal("กรุณาระบุรหัสย่อย CPU");
        $("#cpu_series").focus();
    }
    else {
        return true;
    }

}