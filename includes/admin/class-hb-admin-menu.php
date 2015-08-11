<?php
class HB_Admin_Menu{
    function __construct(){
        add_action( 'admin_menu', array( $this, 'register' ) );
    }

    function register(){
        add_menu_page(
            __( 'TP Hotel Booking', 'tp-hotel-booking' ),
            __( 'TP Hotel Booking', 'tp-hotel-booking' ),
            'manage_options',
            'tp_hotel_booking',
            '',
            'dashicons-calendar',
            '3.99'
        );

        $menu_items = array(
            'room_type' => array(
                'tp_hotel_booking',
                __( 'Room Types', 'tp-hotel-booking' ),
                __( 'Room Types', 'tp-hotel-booking' ),
                'manage_options',
                'edit-tags.php?taxonomy=hb_room_type'
            ),
            'room_capacity' => array(
                'tp_hotel_booking',
                __( 'Room Capacities', 'tp-hotel-booking' ),
                __( 'Room Capacities', 'tp-hotel-booking' ),
                'manage_options',
                'edit-tags.php?taxonomy=hb_room_capacity'
            ),
            'pricing_table'   => array(
                'tp_hotel_booking',
                __( 'Pricing Plans', 'tp-hotel-booking' ),
                __( 'Pricing Plans', 'tp-hotel-booking' ),
                'manage_options',
                'tp_hotel_booking_pricing',
                array( $this, 'pricing_table' )
            ),
            'settings'   => array(
                'tp_hotel_booking',
                __( 'Settings', 'tp-hotel-booking' ),
                __( 'Settings', 'tp-hotel-booking' ),
                'manage_options',
                'tp_hotel_booking_settings',
                array( $this, 'settings_page' )
            )
        );

        // Third-party can be add more items
        $menu_items = apply_filters( 'tp_hotel_booking_menu_items', $menu_items );

        if ( $menu_items ) foreach ( $menu_items as $item ) {
            call_user_func_array( 'add_submenu_page', $item );
        }
    }

    function settings_page(){
        TP_Hotel_Booking::instance()->_include( 'includes/admin/views/settings.php' );
    }

    function pricing_table(){
        wp_enqueue_script( 'wp-util' );
        TP_Hotel_Booking::instance()->_include( 'includes/admin/views/pricing-table.php' );
    }
}

new HB_Admin_Menu();