jQuery(document).ready(function($) {
    $('#ajax-search-form').on('submit', function(e) {
        e.preventDefault();

        const formData = $(this).serialize();
        const resultsContainer = $('#search-results');

        $.ajax({
            url: '<?php echo admin_url("admin-ajax.php"); ?>',
            type: 'POST',
            data: formData,
            beforeSend: function() {
                resultsContainer.html('...');
            },
            success: function(data) {
                resultsContainer.html(data);
            }
        });
    });
});
