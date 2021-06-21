<?php
    global $post;

    get_header();
?>
<section class="archive-contributor-title">
    <div class="wide-container">
        <div class="content-container">
            <h1>Συγγραφείς</h1>
        </div>
    </div>
</section>
<div class="archive-contributor-search-section">
    <div class="content-container">
        <div class="archive-contributor-search-letter-row">
            <?php
                $greek_letter_list = ['Α','Β','Γ','Δ','Ε','Ζ','Η','Θ','Ι','Κ','Λ','Μ','Ν','Ξ','O','Π','Ρ','Σ','Τ','Υ','Φ','Χ','Ψ','Ω'];
                for($i = 0; $i < 24; $i++){
                    $disable_class = '';

                    if( $i != 9 ){
                        $disable_class = 'disable';
                    }
            ?>
                    <div class="archive-contributor-search-letter-col <?php echo $disable_class; ?>"><?php echo $greek_letter_list[$i]; ?></div>
            <?php
                }
            ?>
        </div>
        <div class="archive-contributor-search-result-row">
            <div class="archive-contributor-search-result-left-col">58 Συγγραφείς</div>
            <div class="archive-contributor-search-result-right-col">
                <div class="archive-contributor-search-result-list">
                    <?php
                        $args = [
                            'post_type' => 'contributor',
                            'posts_per_page' => 58,
                        ];
                    
                        $loop = new WP_Query( $args );
                    
                        while ( $loop->have_posts() ){
                            $loop->the_post();
                    ?>
                            <div class="archive-contributor-search-result-col"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></div>
                    <?php
                        }

                        wp_reset_query();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>