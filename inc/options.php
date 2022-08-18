<?php

/**
 * Create Dark mode Setting
 */
function dark_mod_settings($wp_customize)
{
    $wp_customize->add_setting('dark_mod');
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'dark_mod',
        array(
            'type' => 'radio',
            'label' => __( 'Dark Mode', 'less-reimagined' ),
            'section' => 'colors',
            'settings' => 'dark_mod',
            'choices'        => array(
                'dark'   => __( 'Dark' ),
                'light'  => __( 'Light' ),
                'auto'  => __( 'Automatical' )
            )
        )
    ));
}
add_action('customize_register', 'dark_mod_settings');
