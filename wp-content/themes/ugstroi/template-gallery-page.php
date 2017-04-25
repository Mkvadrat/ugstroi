<?php
/*
Template name: Gallery page
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

                    <!-- start bread crumbs -->

                    <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>

                    <!-- end bread crumbs -->

                    <!-- start main content -->

                    <main class="galery-page">
                        <h2 class="h2-title"><?php the_title(); ?></h2>

                       	<?php if (have_posts()): while (have_posts()): the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; endif; ?>
					   
                        <ul class="list-page">
                            <li>Перейти в <a href="galery.html">галерею</a></li>
                            <li>Перейти в <a href="projects.html">проекты</a></li>
                            <li>Перейти в <a href="contacts.html">контакты</a></li>
                        </ul>
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