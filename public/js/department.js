$(document).ready(function() {
    $('.read_more').click(function() {
        var id = $(this).attr('department_id');
        $.ajax({
            url : '/department/readmore',
            method : 'post',
            data : {
                id : id
            },
            success : function(data){
                $('#department_name').text(data.department.name);
                $('#description').text(data.department.description);
                $('#readmoreModal').modal('show');
            }
        })
    })
});
