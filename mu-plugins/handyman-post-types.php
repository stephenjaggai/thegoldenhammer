<?php 
function handyman_post_types(){
        register_post_type('location',array(
            'capability_type' => 'location',
            'map_meta_cap'=> true,
            'supports' => array('title', 'editor','excerpt'),
            'rewrite'=> array('slug' => 'locations' ),
            'has_archive' => true,
            'public' => true, 
            'labels' => array(
                'name' => "Locations",
                'add_new_item' => 'Add New Location',
                'edit_item' => 'Edit Location',
                'all_items' => 'All Locations',
                'singular_name' => "Location"
            ),
            'menu_icon' => 'dashicons-location'
        ));
        register_post_type('service',array(
            'capability_type' => 'service',
            'map_meta_cap'=> true,
            'supports' => array('title', 'editor'),
            'rewrite'=> array('slug' => 'services' ),
            'has_archive' => true,
            'public' => true, 
            'labels' => array(
                'name' => "Services",
                'add_new_item' => 'Add New Service',
                'edit_item' => 'Edit Service',
                'all_items' => 'All Services',
                'singular_name' => "Service"
            ),
            'menu_icon' => 'dashicons-hammer'
        ));
        register_post_type('handyman',array(
            'capability_type' => 'handyman',
            'map_meta_cap'=> true,
            'supports' => array('title', 'editor','thumbnail'),
            'public' => true,
            'labels' => array(
            'name' => "Handymen",
            'add_new_item' => 'Add New Handyman',
            'edit_item' => 'Edit Handyman',
            'all_items' => 'All Handymen',
            'singular_name' => "Handyman"
            ),
            'menu_icon' => 'dashicons-businessman'
        ));
}
 add_action('init', 'handyman_post_types');
?>