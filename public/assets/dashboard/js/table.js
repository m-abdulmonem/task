
let spanner = '<p class="spanner"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <span>إنتظر....</span></p>',
    $name,dataTable;

/**
 * delete validate
 */
btn_delete();

function btn_delete(table = null){
    $("body").on("click",".btn-delete",function () {
        let _this = $(this),
            oldBtnHtml = _this.html();
        _this.attr("disabled","disabled").html(spanner);

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: _this.data("url"),
                    data:{_token:_this.data("token")},
                    type: "DELETE",
                    dataType: "json",
                    success: function (result) {
                        if (result.status === 1) {
                            Swal.fire({
                                title :'Deleted!',
                                text : 'Your record has been deleted.',
                                icon :'success',
                                timer: 2000
                            })
                            if (table){
                                table.draw();
                            }else{
                                window.location.href = $(this).data("back");
                            }
                        }
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel){
                _this.children(".spanner").remove();
                _this.removeAttr("disabled").html(oldBtnHtml);
            }
        })
    });
}
function btn_refresh(table){
    $(".btn-refresh").click(function () {
        const _this = $(this), oldHtml = _this.html();

        _this.attr("disabled","disabled").html(spanner);

        if (table.draw()){
            _this.children(".spanner").remove();
            _this.removeAttr("disabled").html(oldHtml);
        }
    })
}


$.fn.extend({
    removeSpanner: function () {
        $(this).removeClass("disabled").html($name);
        return this;
    }
});
function getTable (dataTable){
    return dataTable
}

$.fn.extend({

    table: function(data = null){
        let table= $(".table"),
            setting = $.extend({
            columns: [],
            notColumns: [],
            data: null,
            actionOptions: {},
            url: table.data("url"),
            actionColumnWidth: "177.006px",
            searching: true,
            dom: 'Bfrtip',
            "paging": true,
            "pagingType": "full_numbers",
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        },data);


        if (!setting.notColumns.includes("#"))
            //add table row indexed
            setting.columns.unshift({data: 'DT_RowIndex', name: 'DT_RowIndex'});

        if (!setting.notColumns.includes("actions"))
            //add  row actions cell
            setting.columns.push({
                data: 'action', name: 'action', orderable: false, searchable: false, width: setting.actionColumnWidth
            });


        let datatable = $(this).DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: setting.url,
                data: setting.data ? setting.data : {data:table.data("query")}
            },
            columns: setting.columns,
            buttons: setting.buttons,
            "searching": setting.searching,
        });

        btn_delete(datatable);
        btn_refresh(datatable);
        getTable(datatable);

        dataTable = datatable;


        return datatable;
    },
});




