$(window).on('load', function() { $('#demoModal').modal('show') });
$(document).ready(function() {
    var $videoSrc;
    $('.video-btn').click(function() { $videoSrc = $(this).data("src") });
    $('#myModal').on('shown.bs.modal', function(e) { $("#video").attr('src', $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0") })
    $('#myModal').on('hide.bs.modal', function(e) { $("#video").attr('src', $videoSrc) })
});

function changeStreamServer(phimId, serverNumber) {
    $('#linkhongId').hide();
    $('#mainLinkhongId').hide();
    svid = 'db_' + serverNumber;
    $.ajax({
        beforeSend: function() { $('#loading_logo_container').show() },
        type: 'GET',
        url: '/change-sever/' + phimId + '/' + serverNumber,
        success: function(data) {
            $('#loading_logo_container').hide();
            document.getElementById('serverId').lastChild.classList.remove('actived');
            document.getElementById(svid).lastChild.classList.add('actived');
            $('#phimContainId').attr('src', data.newUrl);
            if (data.isErrorUrl) {
                $('#linkhongId').show();
                $('#alertContentId')[0].textContent = "     Server " + serverNumber + " hỏng    "
            } else { $("#phimContainId")[0].play() }
        },
    })
}

function backToMainServer(publicUrl, isErrorUrl) {
    if (isErrorUrl == 1) {
        $('#mainLinkhongId').show();
    }
    $('#linkhongId').hide();
    $('#phimContainId').attr('src', publicUrl);
    var episodes = document.getElementsByClassName('btn-episode');
    for (episode of episodes) { episode.classList.remove('actived') }
    document.getElementById('serverId').lastChild.classList.add('actived')
}
