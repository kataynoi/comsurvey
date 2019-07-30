/**
 * Created by Spider on 19/7/2562.
 */
var num_filed = 0;
var all_field= new Array();
var all_comment= new Array();
$('#alert').hide();
$(document).on('click', 'input[type="checkbox"]', function (e) {
    // e.preventDefault();
    var filed = $(this).data('filed');
    var column = $(this).data('comment');

    if ($(this).prop("checked") == true) {
        crud.set_select(filed, column);
    }
    else if ($(this).prop("checked") == false) {
        crud.unset_select(filed, column);

    }

});

var crud = {};

crud.set_select = function (filed, column) {
    if ($('#select').val() == '') {
        var val = filed;
        var com = column
    } else {
        var val = $('#select').val() + ',' + filed;
        var com = $('#column').val() + ',' + column;
    }
    $('#select').val(val);
    $('#column').val(com);


}
crud.unset_select = function (filed, column) {

    var val = $('#select').val();
    var val2 = val.replace(filed + ',', '');
    var val3 = val2.replace(',' + filed, '');
    $('#select').val(val3);

    var co = $('#column').val();
    var co2 = co.replace(filed + ',', '');
    var co3 = co2.replace(',' + filed, '');
    $('#column').val(co3);
}
crud.ajax = {
    create_crud: function (items, cb) {
        var url = '/crud/create_crud',
            params = {
                items: items
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    },
    get_table: function (table, cb) {
        var url = '/crud/get_table',
            params = {
                table: table
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }
};

crud.create_crud = function (items) {
    crud.ajax.create_crud(items, function (err, data) {
        if (err) {
            //app.alert(err);
            swal(err);
        }
        else {

            swal('บันทึกข้อมูลเรียบร้อยแล้ว ');
            $('#alert').empty();
            $('#alert').append(
                data.msg+
                '<br><a href="'+site_url+'/'+data.ctrl+'" target="_bank"> Link To View</a>'
            );
            $('#alert').show();

        }
    });

}

crud.set_table = function (data) {
    console.log(data.success);
    if (data.success) {
        var no = 1;
        $('#select').val('');
        $('#column').val('');
        $('#search_txt').val('');
        $('#view_name').val('');
        $('#tbl_list > tbody').empty();
        if (_.size(data.rows) > 0) {
            _.each(data.rows, function (v) {
                $('#tbl_list > tbody').append(
                    '<tr>' +
                    '<td class="row">' + no + '</td>' +
                    '<td ><input type="checkbox" id="Field' + no + '" class="field" name="case" data-filed="' + v.Field + '" data-comment="' + v.Comment + '" value= "' + v.Field + '" /> ' + v.Field + '</td>' +
                    '<td >' + v.Type + '<span class="pull-right form-inline"><select class="form-control" style="width: 100px">' +
                    '<option value="text">Text</option>' +
                    '<option value="select">Select</option>' +
                    '<option value="date">Date</option>' +
                    '<option value="radio">Radio</option>' +
                    '<option value="checkbox">Checkbox</option>' +
                    '</select><input class="form-control" type="text" style="width: 100px" placeholder="ชื่อ Table"></span></td>' +
                    '<td >' + v.Comment + '</td>' +
                    '<td >' + v.Extra + '</td>' +
                    '</tr>'
                );
                no++;
                all_field.push(v.Field);
                all_comment.push(v.Comment);
            });
            num_filed = no - 1;
            console.log(num_filed);
        }
        else {
            $('#tbl_list > tbody').append('<tr><td colspan="4">ไม่พบรายการ</td></tr>');
        }
    } else {
        swal('ไม่พบข้อมูล');
    }
}
crud.get_table = function (table) {
    crud.ajax.get_table(table, function (err, data) {
        if (err) {
            swal(err);
        }
        else {
            console.log(data);
            crud.set_table(data);

        }
    });

}

$('#btn_create_crud').click(function (e) {
    e.preventDefault();
    var items = {};
    items.ctrl = $('#ctrl').val();
    items.table = $('#table').val();
    items.select = $('#select').val();
    items.column = $('#column').val();
    items.search_txt = $('#search_txt').val();
    items.view_name = $('#view_name').val();
    var items_s =new Array();
    $("tbody>tr").each(function (index) {
        var val2 = $(this).find("select").val();
        var val3 = $(this).find("input[type=text]").val();
            items_s[index]=all_field[index]+','+all_comment[index]+','+val2+','+val3;
    });
    items.formcreate = items_s;
    console.log(items_s);

    swal({
        title: "คำเตือน?",
        text: "คุณต้องการสร้าง CRUD ",
        icon: "warning",
        buttons: [
            'cancel !',
            'Yes !'
        ],
        dangerMode: true,
    }).then(function (isConfirm) {
        if (isConfirm) {
            crud.create_crud(items);
        }
    });
});
$('#btn_get_table').click(function (e) {
    e.preventDefault();
    var table = $('#table').val();
    console.log(table);
    crud.get_table(table);

});