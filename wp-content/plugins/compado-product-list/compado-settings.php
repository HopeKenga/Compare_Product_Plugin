<?php
// Add the admin menu item for the plugin
function compado_add_admin_menu() {
    add_options_page(
        'Compado Product Display',
        'Compado Product Display',
        'manage_options',
        'compado_product_display',
        'compado_options_page'
    );
}

add_action('admin_menu', 'compado_add_admin_menu');

// Initialize the plugin settings
function compado_settings_init() {
    register_setting('compadoPlugin', 'compado_settings');

    add_settings_section(
        'compado_plugin_section',
        __('API Settings', 'compado-product-display'),
        'compado_settings_section_callback',
        'compadoPlugin'
    );

    add_settings_field(
        'compado_text_field_api_url',
        __('API URL', 'compado-product-display'),
        'compado_text_field_api_url_render',
        'compadoPlugin',
        'compado_plugin_section'
    );
}

add_action('admin_init', 'compado_settings_init');

function compado_text_field_api_url_render() {
    $options = get_option('compado_settings');
    ?>
    <input type='text' name='compado_settings[compado_text_field_api_url]' value='<?php echo esc_attr($options['compado_text_field_api_url'] ?? ''); ?>' style="width: 100%;">
    <?php
}

function compado_settings_section_callback() {
    echo __('Set the API URL for the Compado Product Display plugin.', 'compado-product-display');
}

function compado_options_page() {
    ?>
    <form action='options.php' method='post'>
        <h2><?php _e('Compado Product Display', 'compado-product-display'); ?></h2>
        <?php
        settings_fields('compadoPlugin');
        do_settings_sections('compadoPlugin');
        submit_button();
        ?>
    </form>
    <?php
}
