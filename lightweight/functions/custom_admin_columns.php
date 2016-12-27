<?

function custom_admin_columns( $columns ) {

   	$columns['slug'] = 'Slug';	

   	unset($columns['comments']);
   	

    foreach($columns as $key=>$value) {
        if($key=='author') {  // when we find the date column
           $new['slug'] = 'Slug';  // put the tags column before it
        }    
        $new[$key]=$value;
    }  

    return $new;
 	
}
add_filter( 'manage_pages_columns', 'custom_admin_columns' );

add_filter( 'manage_edit-page_sortable_columns', 'sortable_custom_admin_columns' );
function sortable_custom_admin_columns( $columns ) {

    $columns['slug'] = 'slug'; 
    return $columns;
}

add_action( 'pre_get_posts', 'custom_admin_columns_orderby' );
function custom_admin_columns_orderby( $query ) {
    if( ! is_admin() )
        return;
 
    $orderby = $query->get( 'orderby');
    
    if( 'slug' == $orderby ) {
        $query->set('orderby','name');
    }
    
}

function custom_admin_columns_content( $column_name, $post_id ) {
    
    if( $column_name == 'slug' ) {    
	    echo get_post( $post_id )->post_name;	    
    }
}

add_action( 'manage_pages_custom_column', 'custom_admin_columns_content', 10, 2 );





