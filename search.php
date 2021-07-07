<?php get_header(); ?>
<section class="search-page-title-section">
    <div class="content-container">
        <div class="search-page-title">
            <h1>αποτελέσματα για: <strong>“<?php echo get_search_query(); ?>”</strong></h1>
        </div>
    </div>
</section>
<div class="search-page-filter-section">
    <div class="search-page-filter-list">
        <div class="js-search-page-filter-item search-page-filter-item active" data-slug="book">ΒΙΒΛΙΑ</div>
        <div class="js-search-page-filter-item search-page-filter-item" data-slug="art-object">ΑΝΤΙΚΕΙΜΕΝΑ</div>
        <div class="js-search-page-filter-item search-page-filter-item" data-slug="contributor">ΣΥΝΤΕΛΕΣΤΕΣ</div>
        <div class="js-search-page-filter-item search-page-filter-item" data-slug="publisher">ΕΚΔΟΤΕΣ/ ΟΡΓΑΝΙΣΜΟΙ</div>
        <div class="js-search-page-filter-item search-page-filter-item" data-slug="news">ΝΕΑ/ ΕΚΔΗΛΩΣΕΙΣ</div>
        <div class="js-search-page-filter-item search-page-filter-item" data-slug="product-category">ΘΕΜΑΤΙΚΕΣ</div>
    </div>
</div>
<?php
    get_template_part( 'page-sections/search', 'book' );
    get_template_part( 'page-sections/search', 'contributor' );
?>
<div id="js-search-load-spinner" class="load-spinner hide"></div>
<?php get_footer(); ?>
