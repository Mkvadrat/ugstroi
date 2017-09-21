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
    <div class="container-fluid bg-content padding-none">
        <div class="container">
            <div class="row">
                <div class="col-md-9 pad-non-right">

                    <!-- start bread crumbs -->

                   <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>

                    <!-- end bread crumbs -->

                    <!-- start main content -->

                    <main class="about-page">
                        <h1 class="h2-title"><?php the_title(); ?></h1>
						
						<?php if (have_posts()): while (have_posts()): the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; endif; ?>
                    </main>
                </div>

                <!-- end main content -->

                <!-- start sidebar -->

                <?php get_sidebar(); ?>

                <!-- end sidebar -->
            </div>
        </div>
    </div>
    <!-- end content -->
    
<?php get_footer(); ?>
