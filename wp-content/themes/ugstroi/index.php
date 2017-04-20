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

	<?php if (have_posts()): while (have_posts()): the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; endif; ?>

<?php get_footer(); ?>
