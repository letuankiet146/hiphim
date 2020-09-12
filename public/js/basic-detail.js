$(window).on('load', function() {
    $('#demoModal').modal('show');
});

$(document).ready(function() {

    // Gets the video src from the data-src on each button
    var $videoSrc;
    $('.video-btn').click(function() {
        $videoSrc = $(this).data("src");
    });

    // when the modal is opened autoplay it
    $('#myModal').on('shown.bs.modal', function(e) {

        // set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
        $("#video").attr('src', $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
    })

    // stop playing the youtube video when I close the modal
    $('#myModal').on('hide.bs.modal', function(e) {
            // a poor man's stop video
            $("#video").attr('src', $videoSrc);
        })
        // document ready
});


function changeStreamServer(phimId, serverId) {
    $.ajax({
        beforeSend: function() {
            $('#loading_logo_container').show();
        },
        type: 'GET',
        url: '/change-sever/' + phimId + '/' + serverId,
        success: function(data) {
            $('#loading_logo_container').hide();
            $('#phimContainId').attr('src', data.newUrl);
            $("#phimContainId")[0].play();
        },
    });
}

function backToMainServer(publicUrl) {
    $('#phimContainId').attr('src', publicUrl);
}