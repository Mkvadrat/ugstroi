<?php
/*
Theme Name: Ugstroi
Theme URI: http://ugstroi.ru/
Author: M2
Author URI: http://mkvadrat.com/
Description: Тема для сайта ugstroi
Version: 1.0
*/

get_header();
?>

    <!-- start content -->
    <div class="container-fluid bg-content">
        <div class="container">
            <div class="row">
                <div class="col-md-9 pad-non-right">
                    <main class="main-page">
                        <!-- start main content -->
                        <?php if (have_posts()): while (have_posts()): the_post(); ?>
                            <?php the_content(); ?>
                        <?php endwhile; endif; ?>
                        <!-- end main content -->
                    </main>
                </div>

				<?php get_sidebar(); ?>

            </div>
        </div>
    </div>
    <!-- end content -->
    
<?php get_footer(); ?>
