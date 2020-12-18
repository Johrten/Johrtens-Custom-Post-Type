<?php

/**
 * Handles cleaning up the price meta box and saving it to our post meta.
 *
 * @param int $post_id
 */
function save_price_meta_box_data( $post_id ) {

  // Sanitize user input.
  $my_data = sanitize_text_field( $_POST['price'] );

  // Update the meta field in the database.
  update_post_meta( $post_id, '_price', $my_data );
}

add_action( 'save_post_sandwich', 'save_price_meta_box_data', 10, 1 );

/**
 * Handles adding the price post meta to the rest API.
 */
function put_price_meta_in_rest() {

  register_meta('post', '_price',
    [
      'object_subtype' => 'sandwich',
      'type' => 'string',
      'show_in_rest' => true
    ]
  );

}

add_action( 'rest_api_init', 'put_price_meta_in_rest' );

/**
 * Handles adding the price post meta to the "All Sandwiches" page as a column.
 *
 * @param array $columns
 */
function put_price_meta_in_admin( $columns ) {

  $columns = [
    'cb' => $columns['cb'],
    'title' => __( 'Title' ),
    'price' => __( 'Price', 'johrten' ),
    'date'  => __( 'Date' )
  ];

  return $columns;
}
  
add_filter( 'manage_sandwich_posts_columns', 'put_price_meta_in_admin', 10, 1 );

/**
 * Handles displaying the value of price post meta to each Sandwich on the "All Sandwiches" page.
 *
 * @param string $column_name
 * @param int $post_id
 */
function print_price_meta_in_admin( $column_name, $post_id ) {

  if ( 'price' === $column_name ) {
    $price = get_post_meta( $post_id, '_price', true );
    // If the price is empty, show a default string
    echo ! empty( $price ) ? $price : '-.--';
  }
}

add_action( 'manage_sandwich_posts_custom_column', 'print_price_meta_in_admin', 10, 2 );
