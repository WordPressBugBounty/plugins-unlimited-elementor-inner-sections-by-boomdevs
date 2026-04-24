jQuery(document).ready(function($) {

    elementor.settings.page.addChangeCallback("pea_demo_post_id", function(newValue) {
        elementor.saver.update().then(function() {
            elementor.reloadPreview();
        });
    });

    elementor.settings.page.addChangeCallback("pea_demo_cat_archive_select", function(newValue) {
        elementor.saver.update().then(function() {
            elementor.reloadPreview();
        });
    });

    elementor.settings.page.addChangeCallback("pea_demo_tag_archive_select", function(newValue) {
        elementor.saver.update().then(function() {
            elementor.reloadPreview();
        });
    });

    elementor.settings.page.addChangeCallback("pea_demo_author_archive_select", function(newValue) {
        elementor.saver.update().then(function() {
            elementor.reloadPreview();
        });
    });

    elementor.settings.page.addChangeCallback("pea_demo_date_year_archive_select", function(newValue) {
        elementor.saver.update().then(function() {
            elementor.reloadPreview();
        });
    });

    elementor.settings.page.addChangeCallback("pea_demo_search_result_archive_select", function(newValue) {
        elementor.saver.update().then(function() {
            elementor.reloadPreview();
        });
    });
    
});