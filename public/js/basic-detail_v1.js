function loadVideoStart() {
    $("#loading_logo_container").show()
}

function canplayVideo() {
    $("#loading_logo_container").hide()
}

function errorVideo() {
    $("#loading_logo_container").hide();
}

function changeStreamServer(n, o) {
    $("#linkhongId").hide(), $("#mainLinkhongId").hide(), svid = "db_" + o, $.ajax({
        beforeSend: function() {
            $("#loading_logo_container").show()
        },
        type: "GET",
        url: "/change-sever/" + n + "/" + o,
        success: function(n) {
            $('.ul-ds-du-phong li').each(function(index) {
                document.getElementById($(this).attr('id')).lastChild.classList.remove("actived");
            });
            $("#hy_container").hide();
            $("#hyframe").attr('src', '#');
            $("#ok_container").hide();
            $("#okframe").attr('src', '#');
            $("#phimContainId").show();
            $("#loading_logo_container").hide(), document.getElementById(svid).lastChild.classList.add("actived"), $("#phimContainId").attr("src", n.newUrl), n.isErrorUrl ? ($("#linkhongId").show(), $("#alertContentId")[0].textContent = "     Server " + o + " hỏng    ") : $("#phimContainId")[0].play()
        }
    })
}

function changeFrame(n, o, m) {
    svid = "db_" + m;
    $('.ul-ds-du-phong li').each(function(index) {
        document.getElementById($(this).attr('id')).lastChild.classList.remove("actived");
    });
    document.getElementById(svid).lastChild.classList.add("actived");
    $("#mainLinkhongId").hide();
    $("#linkhongId").hide();

    if (n == 'okframe') {
        $("#phimContainId").hide();
        $("#phimContainId").attr("src", '#');
        $("#hy_container").hide();
        $("#hyframe").attr('src', '#');

        $("#ok_container").show();
        $("#okframe").attr('src', '//ok.ru/videoembed/' + o + '?autoplay=1');
    }
    if (n == 'hyframe') {
        $("#phimContainId").hide();
        $("#phimContainId").attr("src", '#');
        $("#ok_container").hide();
        $("#okframe").attr('src', '#');

        $("#hy_container").show();
        $("#hyframe").attr('src', 'https://playhydrax.com/?v=' + o);
    }
}

function backToMainServer(n, o) {
    $("#hy_container").hide();
    $("#hyframe").attr('src', '#');
    $("#ok_container").hide();
    $("#okframe").attr('src', '#');
    $("#phimContainId").show();
    1 == o && $("#mainLinkhongId").show(), $("#linkhongId").hide(), $("#phimContainId").attr("src", n);
    var e = document.getElementsByClassName("btn-episode");
    for (episode of e) episode.classList.remove("actived");
    document.getElementById("serverId").lastChild.classList.add("actived")
}
$(window).ready(function() {
    $("#loading_logo_container").show()
}).load(function() {
    $("#loading_logo_container").hide()
}), $(document).ready(function() {
    var n;
    $(".video-btn").click(function() {
        n = $(this).data("src")
    }), $("#myModal").on("shown.bs.modal", function(o) {
        $("#video").attr("src", n + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0")
    }), $("#myModal").on("hide.bs.modal", function(o) {
        $("#video").attr("src", n)
    }), $("#demoModal").modal("show")
});