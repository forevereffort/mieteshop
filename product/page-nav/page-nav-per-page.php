<?php
    /**
     * Product Display Counts Setting
     * Template Args
     * selectDomId : dropdown html element id for javascript working
     */
?>
<div class="pcat-results-projection-options">
    <div class="pcat-results-footer-select">
        <div class="pcat-results-footer-select-label">Προβολή</div>
        <div class="pcat-results-footer-select-elem">
            <select id="<?php echo $args['selectDomId']; ?>">
                <?php
                    if( wp_is_mobile() ){
                ?>
                        <option value="4">4</option>
                <?php
                    }
                ?>
                <option value="16">16</option>
                <option value="32">32</option>
                <option value="64">64</option>
            </select>
            <div class="pcat-results-footer-select-elem-icon"><?php include get_template_directory() . '/assets/icons/arrow-down-icon.svg'; ?></div>
        </div>
    </div>
</div>