jQuery(document).ready(function($) {
    $('#search-input').on('keyup', function() {
        let searchTerm = $(this).val();

        if (searchTerm.length >= 3) {
            $.ajax({
                url: search_params.ajax_url, 
                type: 'POST',
                data: {
                    action: 'fetch_posts',
                    query: searchTerm,
                    nonce: search_params.nonce 
                },
                beforeSend: function() {
                    $('#search-results').html('<li>...</li>');
                },
                success: function(data) {
                    $('#search-results').html(data);
                }
            });
        } else {
            $('#search-results').empty();
        }
    });
});
