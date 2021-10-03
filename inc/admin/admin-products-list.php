<?php
if (is_admin()){

    //this hook will create a new filter on the admin area for the specified post type
    function adminProductFilterbyPublisher(){
        $screen = get_current_screen();

        if( $screen->id == 'edit-product' ){
            $publisherList = get_posts([
                'post_type'  => 'publisher',
                'posts_per_page' => -1,
                'orderby' => 'title',
                'order' => 'ASC',
            ]);
            ?>
                <select name="admin_filter_publisher">
                    <option value="0">All Publishers</option>
                    <?php
                        $current_v = isset($_GET['admin_filter_publisher'])? intval($_GET['admin_filter_publisher']) : 0;
                        foreach($publisherList as $publisher){
                    ?>
                            <option value="<?php echo $publisher->ID; ?>" <?php echo $current_v === $publisher->ID ? 'selected="selected"' : ''; ?>><?php echo $publisher->post_title; ?></option>
                    <?php
                        }
                    ?>
                </select>
            <?php
        }
    }
    add_action('restrict_manage_posts', 'adminProductFilterbyPublisher', 100);

    function adminProductFilterbyPublisherResult($query){
        $screen = get_current_screen();

        if( $screen->id == 'edit-product' && $query->query['post_type'] === 'product' && isset($_GET['admin_filter_publisher']) && !empty($_GET['admin_filter_publisher']) ){
            $query->set('meta_query', [
                [
                    'key'     => 'book_publishers',
                    'value'   => '"' . $_GET['admin_filter_publisher'] . '"',
                    'compare' => 'LIKE',
                ]
            ]);
        }
    }
    add_filter('pre_get_posts', 'adminProductFilterbyPublisherResult');
}