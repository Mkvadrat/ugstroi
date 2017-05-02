<?php
/*
Template name: Thumbnails page
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

                    <main class="object-galery-page">
                        <h2 class="h2-title"><?php the_title(); ?></h2>

                        <?php if (have_posts()): while (have_posts()): the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; endif; ?>
						
						
                        <div class="back">
                            <p>Вернуться <a href="javascript:void(0)" class="back">назад</a></p>
                        </div>

                        <ul class="list-page">
                            <li>Перейти в <a href="<?php echo get_permalink(542); ?>">галерею</a></li>
                            <li>Перейти в <a href="<?php echo get_term_link(12, 'projects-list'); ?>">проекты</a></li>
                            <li>Перейти в <a href="<?php echo get_permalink(165); ?>"">контакты</a></li>
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

<script type="text/javascript">
$(document).ready(function(){
	$('.back').click(function(){
		parent.history.back();
		return false;
	});
});
</script>

<?php get_footer(); ?>