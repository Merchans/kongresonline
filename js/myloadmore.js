jQuery(function ($) {
    $('.articles__more').click(function () {

        var button = $(this),
            data = {
                'action': 'loadmore',
                'query': chi_loadmore_params.posts,
                'page': chi_loadmore_params.current_page
            };

        $.ajax({ // you can also use $.post here
            url: chi_loadmore_params.ajaxurl, // AJAX handler
            data: data,
            type: 'POST',
            beforeSend: function (xhr) {
                button.text('Načítání...'); // change the button text, you can also add a preloader image
            },
            success: function (data) {
                if (data) {
                    button.text('Více produktů').prev().append(data); // insert new posts
                    chi_loadmore_params.current_page++;

                    if (chi_loadmore_params.current_page == chi_loadmore_params.max_page)
                        button.remove(); // if last page, remove the button
                } else {
                    button.remove(); // if no data, remove the button as well
                }
            }
        });
    });
});
