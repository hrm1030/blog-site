$(document).ready(function() {
    $('.read_more').click(function() {
        var id = $(this).attr('university_id');
        $.ajax({
            url : '/university/readmore',
            method : 'post',
            data : {
                id : id
            },
            success : function(data){
                $('#university_name').text(data.university.name);
                $('#description').text(data.university.description);
                $('#readmoreModal').modal('show');
            }
        })
    })
});
