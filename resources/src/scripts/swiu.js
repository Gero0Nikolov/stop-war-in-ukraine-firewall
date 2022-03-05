jQuery(document).ready(() => {
    
    // Redirect URL Option
    jQuery(document).on('change', 'input[name="swiu-redirect-option"]', (event) => {
        const target = jQuery(event.target);
        const customUrlContainer = jQuery('.js-swiu-redirect-custom-url-container');
        
        if (target.val() === 'custom') {
            customUrlContainer.slideDown('fast');
        } else {
            customUrlContainer.slideUp('fast');
        }
    });

    // Submit Option
    jQuery(document).on('click', '.js-swiu-settings-submit', (event) => {
        event.preventDefault();
        const target = jQuery(event.target);

        if (target.hasClass('js-disabled')) { return false; }
        else {
            target
                .addClass('js-disabled')
                .attr('disabled', 'disabled');
        }

        const data = {
            redirectOption: jQuery('.js-swiu-redirect-option:checked').val().trim(),
            redirectUrl: jQuery('.js-swiu-redirect-custom-url').val().trim(),
            showDomainOption: jQuery('.js-swiu-show-domain-option:checked').val().trim(),
        };
        
        jQuery.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'swuiSettingsSave',
                params: data,
            },
            success: (response) => {
                if (
                    typeof response === 'undefined' ||
                    response === null
                ) { 
                    alert('Something went wrong, please refresh and try again!'); 
                    return false;
                }

                const result = JSON.parse(response);

                if (result) {
                    target
                        .removeClass('js-disabled')
                        .removeAttr('disabled');
                } else {
                    alert('Something went wrong, please refresh and try again!');
                }
            },
            error: (response) => {
                console.log(response);
            }
        });
    });
});