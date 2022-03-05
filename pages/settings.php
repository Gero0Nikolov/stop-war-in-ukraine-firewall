<?php 
$options = [
    'redirectOption',
    'redirectUrl',
    'showDomainOption'
];

$optionsPrefix = 'swui_';

$optionsValues = [];

foreach ($options as $optionName) {
    $optionsValues[$optionName] = get_option($optionsPrefix . $optionName, false);
}
?>
<div class="wrap">
    <h1 class="wp-heading-inline">Stop War In Ukraine!</h1>

    <div class="swui-content-container">
        <h2>Help Ukraine Citizens</h2>

        <p>On February 24th, 2022, Russia started a <strong>massive invasion</strong> of Ukraine, a European democracy of 44 million people.</p>
        <p>As a sign of protest agains all types of war and suffering, ExMoment Ltd. offers the SWIU plugin completely <strong>free of charge</strong>.</p>
        <p>Join us on our mission and <strong>together</strong> we can help Ukraine citizens in this time of need!</p>

        <div class="swiu-donate-container">
            <div id="donate-button-container">
                <div id="donate-button"></div>
                <script src="https://www.paypalobjects.com/donate/sdk/donate-sdk.js" charset="UTF-8"></script>
                <script>
                PayPal.Donation.Button({
                env:'production',
                hosted_button_id:'DU3XUK7A7SYG4',
                image: {
                src:'https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif',
                alt:'Donate with PayPal button',
                title:'PayPal - The safer, easier way to pay online!',
                }
                }).render('#donate-button');
                </script>
            </div>
        </div>

        <div class="swiu-desclaimer">
            ExMoment Ltd. will reroute all of the donations to the <a href="https://helpukrainewin.org/" target="_blank">HelpUkraineWin</a> tech community organization,
            excluding transaction and administrative fees. Transaction fee may vary. Administrative fee is equal to 1% of each transaction.
        </div>

        <div class="swiu-flag">
            <div class="part blue"></div>
            <div class="part yellow"></div>
        </div>
    </div>

    <div class="swiu-settings-container js-swiu-settings">
        
        <!-- Redirect URL Option -->
        <div class="swiu-setting-container">
            <h2>Where should users be redirected to?</h2>
            
            <div class="js-swiu-setting-options-container">
                <div class="js-swiu-setting-option-container">
                    <input 
                        type="radio" 
                        id="swiu-redirect-option-generic" 
                        name="swiu-redirect-option" 
                        class="js-swiu-redirect-option" 
                        value="generic"
                        <?php echo $optionsValues['redirectOption'] === 'generic' ? 'checked="checked"' : ''; ?>
                    >
                    <label for="swiu-redirect-option-generic">Redirect Russia landing page (<a href="https://redirectrussia.org/?from=example.com" target="_blank">example</a>)</label>
                </div>

                <div class="js-swiu-setting-option-container">
                    <input 
                        type="radio" 
                        id="swiu-redirect-option-custom" 
                        name="swiu-redirect-option" 
                        class="js-swiu-redirect-option" 
                        value="custom"
                        <?php echo $optionsValues['redirectOption'] === 'custom' ? 'checked="checked"' : ''; ?>
                    >
                    <label for="swiu-redirect-option-custom">Custom URL</label>
                </div>
            </div>

            <div class="swiu-explanation">
                We redirect your users to a landing page which tells them that your site is unavailable in Russia and what they can do to help Ukraine. You can also set any custom redirection URL.
            </div>
            
            <div class="swiu-input-container js-swiu-redirect-custom-url-container" <?php echo $optionsValues['redirectOption'] === 'custom' ? '' : 'style="display: none;"'; ?>>
                <label for="swiu-redirect-custom-url">Custom URL</label>
                <input 
                    type="url" 
                    id="swiu-redirect-custom-url" 
                    name="swiu-redirect-custom-url" 
                    class="js-swiu-redirect-custom-url" 
                    value="<?php echo !empty($optionsValues['redirectUrl']) ? $optionsValues['redirectUrl'] : ''; ?>" 
                    placeholder="https://example.com"
                >
            </div>
        </div>

        <!-- Show domain in Redirection Option -->
        <div class="swiu-setting-container">
            <h2>Show domain on redirect?</h2>
            
            <div class="js-swiu-setting-options-container">
                <div class="js-swiu-setting-option-container">
                    <input 
                        type="radio" 
                        id="swiu-show-domain-yes" 
                        name="swiu-show-domain-option" 
                        class="js-swiu-show-domain-option" 
                        value="yes"
                        <?php echo $optionsValues['showDomainOption'] === 'yes' ? 'checked="checked"' : ''; ?>
                    >
                    <label for="swiu-show-domain-yes">Yes</label>
                </div>

                <div class="js-swiu-setting-option-container">
                    <input 
                        type="radio" 
                        id="swiu-show-domain-no" 
                        name="swiu-show-domain-option" 
                        class="js-swiu-show-domain-option" 
                        value="no"
                        <?php echo $optionsValues['showDomainOption'] === 'no' ? 'checked="checked"' : ''; ?>
                    >
                    <label for="swiu-show-domain-no">No</label>
                </div>
            </div>

            <div class="swiu-explanation">
                If your site is example.com, the redirect page will say "example.com is not available in Russia" if you choose to show the domain (we'll add a ?from query parameter in the redirect URL). You can disable this if you don't want to leak your domain name.
            </div>
        </div>

        <!-- Update Option -->
        <div class="swiu-setting-container">
            <div class="js-swiu-setting-options-container">
                <div class="js-swiu-setting-option-container swiu-bottom">
                    <button id="swiu-settings-submit" class="button button-primary button-large js-swiu-settings-submit" type="button">Update</button>
                    <span class="separator">&bull;</span> 
                    <a href="https://redirectrussia.org/" target="_blank">Learn more</a>
                </div>
            </div>
        </div>
    </div>
</div>