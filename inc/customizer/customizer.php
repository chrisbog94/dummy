<?php
/**
 * Krystal Lawyer Theme Customizer
 *
 * @package krystal-lawyer
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

if ( ! function_exists( 'krystal_lawyer_customize_register' ) ) :
function krystal_lawyer_customize_register( $wp_customize ) {

    // Add custom controls.

    require_once( get_stylesheet_directory(). '/inc/customizer/custom-controls/info/class-info-control.php' );
    require_once( get_stylesheet_directory(). '/inc/customizer/custom-controls/info/class-title-info-control.php' );
    require_once( get_stylesheet_directory(). '/inc/customizer/custom-controls/toggle-button/class-login-designer-toggle-control.php' );
    require_once( get_stylesheet_directory(). '/inc/customizer/custom-controls/radio-images/class-radio-image-control.php' );


    //Header Menu
    $wp_customize->add_section(
        'krystal_lawyer_header_menu_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'theme_supports'=> '',
            'title'         => esc_html__( 'Header Menu Settings', 'krystal-lawyer' ),
        )
    );

    // Info label
    $wp_customize->add_setting( 
        'kr_label_header_menu_settings_section', 
        array(
            'sanitize_callback' => 'krystal_lawyer_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Krystal_Lawyer_Title_Info_Control( $wp_customize, 'kr_label_header_menu_settings_section', 
        array(
            'label'       => esc_html__( 'Header Menu Settings', 'krystal-lawyer' ),
            'section'     => 'krystal_lawyer_header_menu_settings',
            'type'        => 'title',
            'settings'    => 'kr_label_header_menu_settings_section',
        ) 
    ));

    // Enable last menu as button
    $wp_customize->add_setting(
        'kr_enable_last_menu_button',
        array(
            'type' => 'theme_mod',
            'default'           => false,
            'sanitize_callback' => 'krystal_lawyer_sanitize_checkbox_selection'
        )
    );

    $wp_customize->add_control(
        new Krystal_Lawyer_Toggle_Control( $wp_customize, 'kr_enable_last_menu_button', 
        array(
            'settings'      => 'kr_enable_last_menu_button',
            'section'       => 'krystal_lawyer_header_menu_settings',
            'type'          => 'toggle',
            'label'         => esc_html__( 'Make last menu item as button', 'krystal-lawyer' ),
            'description'   => esc_html__( 'This will make last menu item as button which can be used as a call to action', 'krystal-lawyer' ),         
        )
    ));

    // Info label
    $wp_customize->add_setting( 
        'kr_label_header_menu_button_styles', 
        array(
            'sanitize_callback' => 'krystal_lawyer_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Krystal_Lawyer_Title_Info_Control( $wp_customize, 'kr_label_header_menu_button_styles', 
        array(
            'label'       => esc_html__( 'Button Styles', 'krystal-lawyer' ),
            'section'     => 'krystal_lawyer_header_menu_settings',
            'type'        => 'title',
            'settings'    => 'kr_label_header_menu_button_styles',
            'active_callback' => 'krystal_lawyer_last_menu_item_enable',
        ) 
    ));

    // Menu Button styles
    $wp_customize->add_setting(
        'kr_menu_button_styles',
        array(
            'type' => 'theme_mod',
            'default'           => 'style2',
            'sanitize_callback' => 'krystal_lawyer_sanitize_radio_selection'
        )
    );

    $wp_customize->add_control(
        'kr_menu_button_styles',
        array(
            'settings'      => 'kr_menu_button_styles',
            'section'       => 'krystal_lawyer_header_menu_settings',
            'type'          => 'radio',
            'label'         => esc_html__( 'Select button styles:', 'krystal-lawyer' ),
            'description'   => esc_html__( 'Note: This option will only work when the above (menu item as button) option is enabled.', 'krystal-lawyer' ),
            'choices' => array(
                            'style1' =>esc_html__( 'Rounded button with background', 'krystal-lawyer' ),
                            'style2' =>esc_html__( 'Square button with border only', 'krystal-lawyer' ),
                            ),
            'active_callback' => 'krystal_lawyer_last_menu_item_enable',
        )
    );
   
}
endif;
add_action( 'customize_register', 'krystal_lawyer_customize_register' );



/**
 * Sanitize checkbox.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
if ( ! function_exists( 'krystal_lawyer_sanitize_checkbox_selection' ) ) :
function krystal_lawyer_sanitize_checkbox_selection( $checked ) {
    // Boolean check.
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}
endif;


/**
 * Sanitize menu buttons radio option
 *
 * @param string $input
 * @return string
 */
if ( ! function_exists( 'krystal_lawyer_sanitize_radio_selection' ) ) :
function krystal_lawyer_sanitize_radio_selection( $input ) {
    $valid = array(        
        'style1' =>esc_html__( 'Rounded button with background', 'krystal-lawyer' ),
        'style2' =>esc_html__( 'Square button with border only', 'krystal-lawyer' ),
     );

     if ( array_key_exists( $input, $valid ) ) {
        return $input;
     } else {
        return '';
     }
}
endif;


/**
 * Title sanitization.
 */
if ( ! function_exists( 'krystal_lawyer_sanitize_title' ) ) :
function krystal_lawyer_sanitize_title( $str ) {
    return sanitize_title( $str );  
}
endif;


/**
 * Check if the header menu last item is enabled or not
 */
function krystal_lawyer_last_menu_item_enable( $control ) {
    if ( $control->manager->get_setting( 'kr_enable_last_menu_button' )->value() == true) {
        return true;
    } else {
        return false;
    }
}