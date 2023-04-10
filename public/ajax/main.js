$(document).ready(function() {
    var room = '.tabs_id'

    $(room).on('click', function(e){

        e.preventDefault();

        var room_url = $(this).data('url');
        $.ajax({
            url: room_url,
            success: function(data){
                console.log(data);
                // $('#room_available').innerHTML(data);
            }
        })
    })
});

