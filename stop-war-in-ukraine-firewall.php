<?php
/*
Plugin Name: Stop War In Ukraine - Firewall
Description: Plugin simply installs a firewall that restricts Russian traffic from your website. Together we can stop the madness of war!
Version: 1.0
Author: GeroNikolov
Author URI: https://geronikolov.com
License: GPLv2
*/

class SWIU {

    function __construct() {

        // Front Scripts
        add_action('wp_enqueue_scripts', [$this, 'swiuFrontAreaResources']);

        // Admin Scripts
		add_action('admin_enqueue_scripts', [$this, 'swiuAdminAreaResources']);
        
        // Admin Page
		add_action('admin_menu', [$this, 'swiuSettingsPage']);

        // Save Settings
        add_action('wp_ajax_swuiSettingsSave', [$this, 'swuiSettingsSave']);
    }

    function __destruct() {}

    function swiuSettingsPage() {
        add_menu_page('Stop War In Ukraine', 'Stop War In Ukraine', 'manage_options', 'stop-war-in-ukraine-settings', [$this, 'swiuSettingsPageRender'], 'dashicons-warning', NULL);
    }

    function swiuSettingsPageRender() {
        require_once plugin_dir_path(__FILE__) .'pages/settings.php';
    }

    function swiuAdminAreaResources() {
        $resourceVersion = (
            strpos(get_site_url(), 'localhost') === false ?
            1 :
            time()
        );

        // Core Scripts (JavaScript)
        wp_enqueue_script('swiu-settings-script', plugins_url('/resources/dist/scripts/swiu-dist.js', __FILE__), ['jquery'], $resourceVersion, true);
        wp_enqueue_style('swiu-settings-style', plugins_url('/resources/dist/styles/swiu.css', __FILE__), [], $resourceVersion, 'screen');
    }

    function swuiSettingsSave() {
        $params = !empty($_POST['params']) ? $_POST['params'] : [];
        $response = false;

        $acceptedParams = [
            'redirectOption' => [
                'generic',
                'custom'
            ],
            'redirectUrl' => false,
            'showDomainOption' => [
                'yes',
                'no'
            ]
        ];
    
        $cleanParams = [];

        foreach ($params as $paramKey => $paramValue) {
            if (!isset($acceptedParams[$paramKey])) { continue; }

            $paramSetup = $acceptedParams[$paramKey];
            
            if (
                (
                    !empty($paramSetup) &&
                    in_array($paramValue, $paramSetup) 
                ) || 
                empty($paramSetup)
            ) {
                $cleanParams[$paramKey] = sanitize_text_field($paramValue);
            }
        }
    
        if (!empty($cleanParams)) {
            foreach ($cleanParams as $paramKey => $paramValue) {
                $optionName = 'swui_'. $paramKey;
                $optionStatus = update_option($optionName, $paramValue, false);
            }

            $response = true;
        }

        echo json_encode($response);
        die('');
    }

    function swiuFrontAreaResources() {
        $resourceVersion = (
            strpos(get_site_url(), 'localhost') === false ?
            1 :
            time()
        );

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

        wp_enqueue_script('swiu-front-script', plugins_url('/resources/dist/scripts/swiu-front-dist.js', __FILE__), $resourceVersion, true);
        wp_localize_script('swiu-front-script', 'swiuOptions', $optionsValues);
    }
}

$_SWIU = new SWIU();