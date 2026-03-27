jQuery(function ($) {
    $('#toggle_advanced_search').on('click', function() {
        $('#advanced_search').toggle();
    });

    function sendSearchRequest() {
        var data = {
            action: 'search', // ????????
            text: $('#search_content').val(),
            author: $('#search_author').val(),
            institution: $('#search_institution').val(),
            language: $('#search_language').val(),
            year: $('#search_year').val(),
        };

        $.post(ajax_object.ajaxurl, data, function(response) {
            $('.articles-container').html(response);  // ????????
        });
    }

    $('#search_run').on('click', function() {
        sendSearchRequest();
    });

    $('#reset_filters').on('click', function () {
        $('#advanced_search').find('input, select').val('');
        $('.articles-container').html('');     // ????????
        sendSearchRequest();
    });

    $('#search_content, #search_author, #search_institution, #search_language, #search_year').on('input change', function() {
        console.log(ajax_object);
        sendSearchRequest();
    });
});
