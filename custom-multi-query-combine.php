// one option: https://github.com/birgire/wp-combine-queries & https://stackoverflow.com/questions/41624577/one-pagination-for-multiple-queries-or-how-to-group-a-one-query/41693555

//second: https://stackoverflow.com/questions/35309058/merging-two-post-type-in-a-single-wp-query


//setup hooks in the template_redirect action => once the main WordPress query is set
add_action( 'template_redirect', 'hooks_setup' , 20 );
function hooks_setup() {
    if (! is_search() ) {//<= you can also use any conditional tag here
        return;
    }
    add_action( '__before_loop'     , 'visitsanantonio_custom_search_main' );
    add_action( '__after_loop'      , 'visitsanantonio_custom_search_main', 100 );
}

add_action( 'wp_head'     , 'visitsanantonio_custom_search_main' );

function visitsanantonio_custom_search_main()
{
    global $wp_query, $wp_the_query;
    // Set our defaults to keep our code DRY
    $defaults = [
        'fields'                 => 'ids',
        'post_type' => array('location', 'tribe_events'),
        's' => get_search_query(),
        'exact' => false,
        'sentence' => false,
        'posts_per_page' => '-1',
        'suppress_filters' => true,
        'update_post_term_cache' => false,
        'update_post_meta_cache' => false,
        'cache_results'          => false
    ];
    // Set query args for query 1
    $args = [
        'cat' => '-11',
    ];
    // Set query args for query 2
    $args1 = [
        'cat' => '11',
    ];
    $post_query = get_posts(array_merge($defaults, $args));
    $page_query = get_posts(array_merge($defaults, $args1));

    // Merge the two results
    $post_ids = array_merge($post_query, $page_query); //. You can swop around here
    // echo "<pre>";
    // print_r($post_ids);
    // echo "</pre>";
    // We can now run our final query, but first mke sure that we have a valid array
    if ($post_ids) {
        $final_args = [
            'posts_per_page' => '10',
            'post_type' => array('location', 'tribe_events'),
            'post__in'  => $post_ids,
            'paged' => get_query_var('paged'),
            'suppress_filters' => true,
            'orderby'   => 'post__in', // If you need to keep the order from $post_ids
            // 'order'     => 'DESC' // If you need to keep the order from $post_ids
        ];
        //    $wp_query = new WP_Query( $final_args );

        $merged_queried_posts = new WP_Query($final_args);
        // $merged_queried_posts->posts = array_merge($wp_query_11_exclude->posts,$wp_query_11_only->posts);
        // $merged_queried_posts->post_count = $wp_query_11_exclude->post_count + $wp_query_11_only->post_count;

        $wp_query = $merged_queried_posts;

        // echo "<pre>";
        // print_r($wp_query);
        // echo "</pre>";
        // // Run your loop as normal
    } else {
        $wp_query = new WP_Query();
    }
}
