<?php
##### [SET POSTS ORDER]
function set_post_order_in_admin( $wp_query ) {
  if ( is_admin() ) {
    $wp_query->set( 'orderby', 'ID' ); //BY ID
    $wp_query->set( 'order', 'ASC' );
  }
}
add_filter('pre_get_posts', 'set_post_order_in_admin' );
?>
