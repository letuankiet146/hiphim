$(document).ready(function() {
    $('.play-trailer').on('click', function(e) {
        e.preventDefault();
        var youtubeId = $(this).data('href').match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
        if (youtubeId && youtubeId[1] != null && youtubeId[1] != 'undefined') {
            var vidWidth = 560;
            var vidHeight = 320;
            if ($(this).attr('data-width')) { vidWidth = parseInt($(this).attr('data-width')); }
            if ($(this).attr('data-height')) { vidHeight = parseInt($(this).attr('data-height')); }
            var iFrameCode = '<iframe width="' + vidWidth + '" height="' + vidHeight + '" scrolling="no" allowtransparency="true" allowfullscreen="true" src="https://www.youtube.com/embed/' + youtubeId[1] + '?rel=0&wmode=transparent&showinfo=0&hd=1" frameborder="0"></iframe>';
            $('#mediaModal .modal-body').html(iFrameCode);
            $('#mediaModal').on('show.bs.modal', function() { var modalBody = $(this).find('.modal-body'); var modalDialog = $(this).find('.modal-dialog'); var newModalWidth = vidWidth + parseInt(modalBody.css("padding-left")) + parseInt(modalBody.css("padding-right"));
                newModalWidth += parseInt(modalDialog.css("padding-left")) + parseInt(modalDialog.css("padding-right"));
                newModalWidth += 'px';
                $(this).find('.modal-dialog').css('width', newModalWidth); });
            $('#mediaModal').modal();
        }
    });
    var fixKeyword = function(str) { str = str.toLowerCase();
        str = str.replace(/[^\s0-9a-zA-ZấầẩẫậẤẦẨẪẬắằẳẵặẮẰẲẴẶáàảãạâăÁÀẢÃẠÂĂếềểễệẾỀỂỄỆéèẻẽẹêÉÈẺẼẸÊíìỉĩịÍÌỈĨỊốồổỗộỐỒỔÔỘớờởỡợỚỜỞỠỢóòỏõọôơÓÒỎÕỌÔƠứừửữựỨỪỬỮỰúùủũụưÚÙỦŨỤƯýỳỷỹỵÝỲỶỸỴđĐ]+/g, " ");
        str = str.replace(/^\s+|\s+$/g, "");
        str = str.replace(/\s{1,}/g, "+"); return str; }
    $('#search-block').submit(function() {
        var keywordObj = $(this).find('input[name=keyword]')[0];
        if (typeof keywordObj != 'undefined' && keywordObj != null) {
            var keyword = $(keywordObj).val();
            keyword = $.trim(keyword);
            if (keyword == '') { alert('Bạn chưa nhập từ khóa. (Không tính các ký tự đặc biệt vào độ dài từ khóa)');
                $(keywordObj).focus(); return false; }
            window.location.replace('/tim-kiem/' + keyword + '/');
        }
        return false;
    });
    $('#search-block-page').submit(function() {
        var keywordObj = $(this).find('input[name=q]')[0];
        if (typeof keywordObj != 'undefined' && keywordObj != null) {
            var keyword = $(keywordObj).val();
            keyword = fixKeyword(keyword);
            keyword = $.trim(keyword);
            if (keyword == '') { alert('Bạn chưa nhập từ khóa. (Không tính các ký tự đặc biệt vào độ dài từ khóa)');
                $(keywordObj).focus(); return false; }
            window.location.replace('/tim-kiem/' + keyword + '/');
        }
        return false;
    });
    $('#mediaModal').on('hidden.bs.modal', function() { $('#mediaModal .modal-body').html(''); });
    $("ul.film").init_scollbar_inset_dark();
    $('.submit-giftcode').on('click', function() {
        var code = $('#code').val();
        var captcha = $('#captcha').val();
        if (code == '') { $('#form_giftcode .custom-error').html('Giftcode không hợp lệ').fadeIn('fast').delay(2000).fadeOut(); } else if (captcha == '') { $('#form_giftcode .custom-error').html('Mã captcha không hợp lệ').fadeIn('fast').delay(2000).fadeOut(); } else {
            var data = $('#form_giftcode').serialize();
            $.ajax({ url: https_url + 'ajax/giftcode', type: 'POST', dataType: 'json', data: data }).done(function(data) {
                if (data.status == 1) { $('#form_giftcode .custom-success').html(data.message).fadeIn('fast').delay(2000).fadeOut(); } else { $('#form_giftcode .custom-error').html(data.message).fadeIn('fast').delay(2000).fadeOut(); }
                $('.img-captcha').attr('src', base_url + 'ajax/captcha?t=' + new Date().getTime());
            }).fail(function(msg) { console.log('error-connection'); });
        }
    });
    $('#form_giftcode').keydown(function(e) {
        var key = e.which;
        if (key == 13) {
            var code = $('#code').val();
            var captcha = $('#captcha').val();
            if (code == '') { $('#form_giftcode .custom-error').html('Giftcode không hợp lệ').fadeIn('fast').delay(2000).fadeOut(); } else if (captcha == '') { $('#form_giftcode .custom-error').html('Mã captcha không hợp lệ').fadeIn('fast').delay(2000).fadeOut(); } else {
                var data = $('#form_giftcode').serialize();
                $.ajax({ url: https_url + 'ajax/giftcode', type: 'POST', dataType: 'json', data: data }).done(function(data) {
                    console.log(data);
                    if (data.status == 1) { $('#form_giftcode .custom-success').html(data.message).fadeIn('fast').delay(2000).fadeOut(); } else { $('#form_giftcode .custom-error').html(data.message).fadeIn('fast').delay(2000).fadeOut(); }
                    $('.img-captcha').attr('src', base_url + 'ajax/captcha?t=' + new Date().getTime());
                }).fail(function(msg) { console.log('error-connection'); });
            }
        }
    });
});
var localCache = { data: {}, remove: function(url) { delete localCache.data[url]; }, exist: function(url) { return localCache.data.hasOwnProperty(url) && localCache.data[url] !== null; }, get: function(url) { return localCache.data[url]; }, set: function(url, cachedData, callback) { localCache.remove(url);
        localCache.data[url] = cachedData; if ($.isFunction(callback)) callback(cachedData); } };

function ajax_movies_block(url, data, callback, error_callback) { var cache_key = url + JSON.stringify(data); if (localCache.exist(cache_key)) { var response = localCache.get(cache_key);
        callback(response); } else { $.ajax({ url: https_url + url, type: 'get', cache: true, data: data }).done(function(html) { localCache.set(cache_key, html, function(html) { callback(html); }); }).fail(function(e) { console.log('ajax_movies_block_error: ' + e.statusText);
            error_callback(); }); } }

function add_loading() { $('.modal_loading').show(); }

function remove_loading() { $('.modal_loading').hide(); }

function phim_anime(slug, page, sort) { var url = 'ajax/phim_anime'; var data = { slug: slug, page: page, sort: sort };
    ajax_movies_block(url, data, function(data) { $('#cat-phim-anime').replaceWith(data); }, function() {}); }

function phim_oscar(slug, page, sort) { var url = 'ajax/phim_oscar'; var data = { slug: slug, page: page, sort: sort };
    add_loading();
    ajax_movies_block(url, data, function(data) { $('#cat-phim-oscar').replaceWith(data); }, function() {}); }

function phim_le(slug, page, sort) { var url = 'ajax/movies/'; var data = { slug: slug, page: page, sort: sort };
    add_loading();
    ajax_movies_block(url, data, function(data) { $('#cat-phim-le').replaceWith(data); }, function() {}); }

function phim_bo(slug, page, sort) { var url = 'ajax/movies/'; var data = { slug: slug, page: page, sort: sort };
    add_loading();
    ajax_movies_block(url, data, function(data) { $('#cat-phim-bo').replaceWith(data); }, function() {}); }

function phim_giang_sinh(slug, page, sort) { var url = 'ajax/phim_giang_sinh'; var data = { slug: slug, page: page, sort: sort };
    add_loading();
    ajax_movies_block(url, data, function(data) { $('#cat-phim-giang-sinh').replaceWith(data); }, function() {}); }

function phim_tet(slug, page, sort) { var url = 'ajax/phim_tet'; var data = { slug: slug, page: page, sort: sort };
    add_loading();
    ajax_movies_block(url, data, function(data) { $('#cat-phim-tet').replaceWith(data); }, function() {}); }

function phim_chieu_rap(slug, page, sort) { var url = 'ajax/phim_chieu_rap'; var data = { slug: slug, page: page, sort: sort };
    add_loading();
    ajax_movies_block(url, data, function(data) { $('#cat-phim-chieu-rap').replaceWith(data); }, function() {}); }

function phim_valentine(slug, page, sort) { var url = 'ajax/phim_valentine'; var data = { slug: slug, page: page, sort: sort };
    add_loading();
    ajax_movies_block(url, data, function(data) { $('#cat-phim-valentine').replaceWith(data); }, function() {}); }

function phim_hoat_hinh(slug, page, sort) { var url = 'ajax/phim_hoat_hinh'; var data = { slug: slug, page: page, sort: sort };
    add_loading();
    ajax_movies_block(url, data, function(data) { $('#cat-phim-hoat-hinh').replaceWith(data); }, function() {}); }

function phim_da_xem(page) { var url = 'ajax/phim_da_xem'; var data = { page: page };
    $.ajax({ url: https_url + url, type: 'get', cache: true, data: data }).done(function(data) { $('#cat-phim-da-xem').replaceWith(data); }).fail(function(e) { console.log('ajax_phim_da_xem_error: ' + e.statusText); }); }

function phim_tv_show(slug, page, sort) { var url = 'ajax/phim_tv_show'; var data = { slug: slug, page: page, sort: sort };
    add_loading();
    ajax_movies_block(url, data, function(data) { $('#cat-the-loai-tv-show').replaceWith(data); }, function() {}); }

function phim_18(slug, page, sort) { var url = 'ajax/phim_18'; var data = { slug: slug, page: page, sort: sort };
    add_loading();
    ajax_movies_block(url, data, function(data) { $('#cat-the-loai-18').replaceWith(data); }, function() {}); }

function phim_sap_chieu(slug, page, sort) { var url = 'ajax/phim_sap_chieu'; var data = { slug: slug, page: page, sort: sort };
    add_loading();
    ajax_movies_block(url, data, function(data) { $('#cat-phim-sap-chieu').replaceWith(data); }, function() {}); }

function updateView(e) { setTimeout(function() { $.ajax({ url: base_url + 'ajax/update_view', type: "POST", dataType: "json", data: { id: e }, success: function() {} }) }, 1000); };

function follow_phim(action, el) {
    var str = 'Lỗi cập nhật thông tin';
    var mov_id = $('#hid_mov_id').val();
    var eps_id = $('#hid_eps_id').val();
    $.ajax({ url: https_url + 'ajax/user_msg', type: 'POST', dataType: 'json', data: 'action=' + action + '&mov_id=' + mov_id + '&eps_id=' + eps_id }).done(function(data) {
        if (data.status == '-1') { str = 'Vui lòng đăng nhập để thực hiện tính năng này. Bạn có thể đăng nhập/đăng ký <a href="' + https_url + 'dang-nhap" >tại đây</a>.'; } else if (data.status == '-2' || data.status == '-3' || data.status == '-4') { str = 'Lỗi cập nhật thông tin'; } else if (data.status == '1') {
            if (action == 1) { str = 'Đăng ký nhận thông báo thành công.';
                $('#but_follow').replaceWith('<a id="but_follow" href="javascript:follow_phim(2, this);" class="thongbao"><i class="fa fa-bell" aria-hidden="true"></i>Huỷ Nhận Thông Báo</a>'); } else if (action == 2) { str = 'Huỷ nhận thông báo thành công.';
                $('#but_follow').replaceWith('<a id="but_follow" href="javascript:follow_phim(1, this);" class="thongbao"><i class="fa fa-bell" aria-hidden="true"></i>Nhận Thông Báo</a>'); } else if (action == 3) { str = 'Phim đã được thêm vào danh sách yêu thích';
                $('#but_like').replaceWith('<a id="but_like" href="javascript:follow_phim(4, this);" style="background-color:#222;" title="Xóa phim khỏi danh sách yêu thích?">Hủy Yêu thích +</a>'); } else if (action == 4) { str = 'Phim đã xóa khỏi danh sách yêu thích';
                $('#but_like').replaceWith('<a id="but_like" href="javascript:follow_phim(3, this);" style="background-color:#096;" title="Bạn có thích phim này không?">Yêu thích +</a>'); }
        }
        $('.custom-error').html(str).fadeIn('fast').delay(2000).fadeOut();
    }).fail(function() { console.log('error-connection'); });
}

function top_view_feature_or_country(slug, option, type) { $.ajax({ url: https_url + 'ajax/top_view_feature_or_country', type: 'POST', dataType: 'json', data: 'slug=' + slug + '&top=' + option + '&type=' + type, }).done(function(data) { if (data.html != null || data.html != '') { $('#widget_top_film_feature').html(data.html);
            $('#widget_top_film_feature h2').html('top ' + $('#widget_top_film_feature').data('title'));
            $("ul.film").init_scollbar_inset_dark(); } }).fail(function(e) { console.log('error-connection', e); }); }

function top_view_country_by_type(country, type, option) { $.ajax({ url: https_url + 'ajax/top_view_country_by_type', type: 'POST', dataType: 'json', data: 'country=' + country + '&top=' + option + '&type=' + type, }).done(function(data) { if (data.html != null || data.html != '') { $('#widget_top_film_country_by_type_' + type).html(data.html);
            $("ul.film").init_scollbar_inset_dark(); } }).fail(function(e) { console.log('error-connection', e); }); }

function blog_posts(slug) { $.ajax({ url: https_url + 'ajax/blog_posts', type: 'POST', dataType: 'json', data: 'slug=' + slug, }).done(function(data) { if (data.html != null || data.html != '') { $('.top-tintuc').html(data.html);
            $("ul.film").init_scollbar_inset_dark(); } }).fail(function(e) { console.log('error-connection', e); }); }
jQuery(document).ready(function() {
    jQuery('#form-filter').submit(function() {
        try {
            var sort = jQuery('#filter-sort').val();
            var eptype = jQuery('#filter-eptype').val();
            var category = jQuery('#filter-category').val();
            var country = jQuery('#filter-country').val();
            var year = jQuery('#filter-year').val();
            var submitPath = '';
            if (eptype != '') {
                switch (eptype) {
                    case 'phim-moi':
                        submitPath += 'phim-moi/'; break;
                    case 'phim-le':
                        submitPath += 'phim-le/'; break;
                    case 'phim-bo':
                        submitPath += 'phim-bo/'; break;
                    case 'phim-chieu-rap':
                        submitPath += 'phim-chieu-rap/'; break;
                    case 'phim-hot':
                        submitPath += 'phim-hot/'; break;
                    case 'phim-18':
                        submitPath += 'phim-18/'; break; }
            }
            if (category != '') {
                if (submitPath == '') { submitPath = 'the-loai/' + category + '/'; } else { submitPath += category + '/'; }
            }
            if (country != '') {
                if (submitPath == '') { submitPath = 'quoc-gia/' + country + '/'; } else { submitPath += country + '/'; }
            }
            if (year != '' && year.length == 4) {
                if (submitPath == '')
                    submitPath += 'phim-' + year + '/';
                else
                    submitPath += year + '/';
            }
            if (sort != '' && sort != 'updatetime') { submitPath += (submitPath.indexOf('?') == -1) ? '?' : '&';
                submitPath += 'rel=' + sort; }
            window.location.replace(https_url + submitPath);
            return false;
        } catch (err) { return true; }
    });
});