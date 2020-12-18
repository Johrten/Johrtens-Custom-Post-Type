<?php

class Sandwich { 

  public $name = 'Sandwich';

  /**
   * Handles when to create our post type and meta box through WP hooks.
   */
  public function __construct() {

    add_action( 'init', array( $this, 'create_sandwich_post_type' ) );
    add_action( 'add_meta_boxes', array( $this, 'create_price_meta_box' ) );
  }

  /**
   * Handles creating the Sandwich post type with some customizations.
   */
  public function create_sandwich_post_type() {

    register_post_type(
      $this->name,
      [
        'labels' => [
          'name'                     => __( 'Sandwiches', 'johrten' ),
          'singular_name'            => __( 'Sandwich', 'johrten' ),
          'add_new_item'             => __( 'Add New Sandwich', 'johrten' ),
          'edit_item'                => __( 'Edit Sandwich', 'johrten' ),
          'new_item'                 => __( 'New Sandwich', 'johrten' ),
          'view_item'                => __( 'View Sandwich', 'johrten' ),
          'search_items'             => __( 'Search Sandwiches', 'johrten' ),
          'not_found'                => __( 'No Sandwiches found', 'johrten' ),
          'not_found_in_trash'       => __( 'No Sandwiches found in Trash', 'johrten' ),
          'all_items'                => __( 'All Sandwiches', 'johrten' ),
          'filter_items_list'        => __( 'Filter Sandwiches list', 'johrten' ),
          'items_list_navigation'    => __( 'Sandwiches list navigation', 'johrten' ),
          'items_list'               => __( 'Sandwiches list', 'johrten' ),
          'item_published'           => __( 'Sandwich is ready to eat!', 'johrten' ),
          'item_published_privately' => __( 'Sandwich is ready for VIPs.', 'johrten' ),
          'item_reverted_to_draft'   => __( 'Sandwich is off the menu.', 'johrten' ),
          'item_scheduled'           => __( 'Sandwich scheduled.', 'johrten' ),
          'item_updated'             => __( 'Sandwich updated.', 'johrten' ),
        ],
        'menu_icon' => 'dashicons-store',
        'menu_position' => 6,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_in_menu' => true,
        'supports' => [ 'editor', 'title', 'custom-fields' ],		
      ]
    );
  }

  /**
   * Handles displaying the price post meta value with a default value.
   * Handles the rendering the price meta box.
   *
   * @param WP_Post $post
   */
  public function display_price_meta_box( $post ) {

    $value = get_post_meta( $post->ID, '_price', true ) ?? '';
    echo '<textarea style="width:100%" id="price" name="price">' . esc_attr( $value ) . '</textarea>';
  }

  /**
   * Handles creating the price meta box on the Sandwich post type.
   */
  public function create_price_meta_box() {

    add_meta_box(
      'price',
      __( 'Price', 'johrten' ),
      array( $this, 'display_price_meta_box' ),
      'Sandwich',
      'side'
    );
  }
}

$sandwich = new Sandwich();
