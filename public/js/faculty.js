$(document).ready(function() {
    $('.read_more').click(function() {
        var id = $(this).attr('faculty_id');
        $.ajax({
            url : '/faculty/readmore',
            method : 'post',
            data : {
                id : id
            },
            success : function(data){
                $('#faculty_name').text(data.faculty.name);
                $('#description').text(data.faculty.description);
                $('#readmoreModal').modal('show');
            }
        })
    })
});
