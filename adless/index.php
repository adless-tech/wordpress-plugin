<?php

/**
 * Plugin Name: Adless
 * Plugin URI: https://adless.net/get-started
 * Description: Adless subscription network integration
 * Version: 1.0
 * Author: Adless
 * Author URI: https://adless.net
 */

include dirname(__FILE__) . '/options.php';

$adless_opts = get_option('adless_options');

if (is_admin()) {
    $adless_settings_page = new AdlessSettingsPage();
} elseif(!empty($adless_opts['earnerID'])) {
    wp_enqueue_script('adless', 'https://static.adless.net/adless.js');
    add_action('wp_footer', 'adless_initialize');
}

add_filter('plugin_action_links_adless/index.php', 'adless_action_links');

function adless_initialize()
{
    $opts = get_option('adless_options');
?>
    <script>
        (window.adless = window.adless || []).push({
            earner: "<?= $opts['earnerID'] ?>",
            services: [<?= !empty($opts['services']) ? '"' . implode('", "', explode(trim($opts['services'], " \""), '\"')) : "" ?>],
            ...{
                paywall: {
                    <?= !empty($opts['paywallMessage']) ? "message: atob(\"" . $opts['paywallMessage'] . "\")," : "" ?>
                }
            },
            ...<?= !empty($opts['customConfiguration']) ? $opts['customConfiguration'] : "{}" ?>
        })
    </script>
<?php
}

/* TODO  
 * - define custom hooks for callbacks
 * - no ads example (fallback????)
 * - login/kiosk example
 * 
 */

?>