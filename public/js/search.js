$(document).ready(function() {
    $('#keyword').keydown(function(e) {
        if(e.which == 13) {
            if($('#keyword').val == '') {
                toastr.info('Please type university.');
            } else {
                $('#searchForm').submit();
            }
        }
    })
});
