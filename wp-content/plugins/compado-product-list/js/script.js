jQuery(document).ready(function($) {
    // Function to load products via AJAX
    function loadProducts(category) {
        $.ajax({
            url: compadoAjax.ajaxurl,
            type: 'POST',
            dataType: 'html',
            data: {
                action: 'load_compado_products',
                category: category,
                nonce: compadoAjax.nonce
            },
            success: function(response) {
                $('.compado-products-wrapper').html(response);
            },
            error: function() {
                $('.compado-products-wrapper').html('<p>Error loading products.</p>');
            }
        });
    }

    // Example trigger for loading products
    // You can customize this part as per your need
    $('#load-products-btn').on('click', function() {
        var category = $(this).data('category');
        loadProducts(category);
    });

    // Delegate click event to the static parent element
    $(document).on('click', '.compado-read-more-btn', function() {
        const $btn = $(this);
        const $introduction = $btn.next('.compado-introduction');

        // Check if the introduction element exists
        if ($introduction.length > 0) {
            // Toggle a class to control the display via CSS
            $introduction.toggleClass('open');

            // Update button text based on the state
            if ($introduction.hasClass('open')) {
                $btn.text('Read Less');
            } else {
                $btn.text('Read More');
            }
        }
    });
});