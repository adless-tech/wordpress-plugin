<?php

/**
 * Plugin Name: Adless
 * Plugin URI: https://adless.net/get-started/wordpress
 * Description: Monetize easily with Adless
 * Version: 1.0
 * Author: Adless
 * Author URI: https://adless.net
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: adless
 */

$adless_opts = get_option('adless_options');

if (is_admin()) {
    require_once __DIR__ . '/admin/settings.php';
    $adless_settings_page = new AdlessSettingsPage();
} elseif(!empty($adless_opts['earnerID'])) {
    wp_enqueue_script('adless', 'https://static.adless.net/adless.js');
    add_action('wp_footer', 'adless_initialize');
}

function adless_initialize()
{
    $opts = get_option('adless_options');
?>
    <script>
        (window.adless = window.adless || []).push({
            earner: "<?= $opts['earnerID'] ?>",
            services: [<?= !empty($opts['services']) ? '"' . implode('", "', explode(",", trim($opts['services'], " \"'"))) . "\"" : "" ?>],
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

?>