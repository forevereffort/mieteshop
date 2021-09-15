<?php
    global $post, $wpdb;

    get_header();
?>
<section class="archive-contributor-title">
    <div class="content-container">
        <h1>Συγγραφείς</h1>
    </div>
</section>
<div class="archive-contributor-search-section">
    <div class="general-container">
        <div class="content-container">
            <div class="archive-contributor-search-greek-letter-wrapper">
                <div class="archive-contributor-search-greek-letter-row">
                    <?php
                        $greek_letter_list = ['α','β','γ','δ','ε','ζ','η','θ','ι','κ','λ','μ','ν','ξ','o','π','ρ','σ','τ','υ','φ','χ','ψ','ω'];
                        for($i = 0; $i < 24; $i++){
                    ?>
                            <div class="archive-contributor-search-greek-letter-col js-archive-contributor-search-greek-letter-col <?php echo $i == 0 ? 'active' : ''; ?>"><?php echo $greek_letter_list[$i]; ?></div>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <div class="archive-contributor-search-english-letter-wrapper">
                <div class="archive-contributor-search-english-letter-row">
                    <?php
                        $english_letter_list = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];

                        for($i = 0; $i < 26; $i++){
                    ?>
                            <div class="archive-contributor-search-english-letter-col js-archive-contributor-search-english-letter-col"><?php echo $english_letter_list[$i]; ?></div>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <div class="archive-contributor-search-result-row">
                <?php
                    $args = [
                        'post_type' => 'contributor',
                        'posts_per_page' => -1,
                        'search_title_with_first_letter' => 'α',
                        'orderby' => 'title',
                        'order' => 'ASC',
                        'fields' => 'ids',
                        'tax_query' => [
                            [
                                'taxonomy' => 'contributor_type',
                                'field'    => 'slug',
                                'terms'    => 'syggrafeas',
                            ]
                        ],
                    ];
                
                    $the_query = new WP_Query( $args );
                ?>
                <div class="archive-contributor-search-result-left-col"><span id="js-archive-contributor-search-result-count"><?php echo $the_query->found_posts; ?></span> Συγγραφείς</div>
                <div class="archive-contributor-search-result-right-col">
                    <div id="js-archive-contributor-search-result-list" class="archive-contributor-search-result-list" data-nonce="<?php echo wp_create_nonce('filter_search_archive_contributor_nonce'); ?>">
                        <?php
                            foreach( $the_query->posts as $contruibutor_id ) {
                                // check that the contributor is connected with published books
                                // $sql = "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key LIKE 'book_contributors_%' AND meta_value LIKE '%\"{$contruibutor_id}\"%' LIMIT 1";
                                // $product_id = $wpdb->get_var($sql);

                                // if( !empty($product_id) ){
                        ?>
                                    <div class="archive-contributor-search-result-col"><a href="<?php echo get_permalink($contruibutor_id); ?>"><?php echo get_the_title($contruibutor_id); ?></a></div>
                        <?php
                                // }
                            }

                            wp_reset_query();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="js-archive-contributor__load-spinner" class="load-spinner hide"></div>

<?php get_footer(); ?>