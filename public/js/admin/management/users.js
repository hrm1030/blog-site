"use strict";

var KTDatatablesAdvancedColumnRendering = function() {

	var init = function() {
		var table = $('#user_table');

		// begin first table
		var oTable = table.dataTable({
			responsive: true,
			paging: true,
            "order": [
                [5, "asc"]
            ]
		});

		$('#user_table_search_status').on('change', function() {
			datatable.search($(this).val().toLowerCase(), 'Status');
		});

		$('#user_table_search_type').on('change', function() {
			datatable.search($(this).val().toLowerCase(), 'Type');
		});

		$('#user_table_search_status, #user_table_search_type').selectpicker();

        $('.state').change(function() {
            var nRow = $(this).parents('tr').eq(0);
            var state = $(this).val();
            var user_id = $(this).parents('tr').eq(0).attr('user_id');
            $.ajax({
                url : '/management/users/change_state',
                method : 'post',
                data : {
                    user_id : user_id,
                    state : state
                },
                success : function(data) {
                    toastr.success('Updated successfully.');
                    if(state == 1)
                    {
                        var html = `<span class="label label-lg font-weight-bold label-light-success label-inline">Actived</span>`;
                    } else {
                        var html = `<span class="label label-lg font-weight-bold label-light-danger label-inline">Disabled</span>`;
                    }
                    nRow.find('#state_td_'+user_id).html(html);
                }
            })
        });

        table.on('click', '.btn_delete', function() {
            var user_id = $(this).parents('tr').eq(0).attr('user_id');
            var nRow = $(this).parents('tr')[0];
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    KTApp.block('#user_table', {
                        overlayColor: '#000000',
                        state: 'danger',
                        message: 'Please wait...'
                    });
                    $.ajax({
                        url : '/management/users/delete',
                        method : 'post',
                        data : {
                            user_id : user_id
                        },
                        success : function(data) {
                            toastr.success('Successfully deleted.');
                            KTApp.unblock('#user_table');
                            oTable.fnDeleteRow(nRow);
                        },
                        error : function() {
                            Swal.fire(
                                "Error",
                                "Happening any errors on deleting user",
                                "error"
                            );
                        }
                    });
                }
            });
        });
	};

	return {

		//main function to initiate the module
		init: function() {
			init();
		}
	};
}();

jQuery(document).ready(function() {
	KTDatatablesAdvancedColumnRendering.init();
});
