<?php
/*
Theme Name: Ugstroi
Theme URI: http://ugstroi.ru/
Author: M2
Author URI: http://mkvadrat.com/
Description: Тема для сайта ugstroi
Version: 1.0
*/
?>

	<!-- start sidebar -->
	<div class="col-md-3 pad-left-none">
		<aside class="side-bar">
			<div class="our-services-block-side-bar">
				<h3 class="sidebar-title">Наши <a href="<?php echo esc_url( home_url( '/' ) ); ?>">услуги</a></h3>
				<ul class="our-services">
					<?php
						$args_list = array(
							'numberposts' => -1,
							'orderby'     => 'date',
							'order'       => 'DESC',
							'post_type'   => 'our-services',
						);
						
						$childrens = get_posts( $args_list );
												
						if( $childrens ){
							foreach( $childrens as $children ){
					?>
					<li><a href="<?php echo get_permalink($children->ID); ?>"><?php echo $children->post_title; ?></a></li>
					<?php 
							}
							
							wp_reset_postdata();
					
						}
					?>		
				</ul>
			</div>

			<div class="our-news-block-side-bar">
				<h3 class="sidebar-title">Наши <a href="#">новости</a></h3>
				<p>Полезная для Вас новость</p>
				<img src="images/news-photo-main-page.jpg" alt="">
				<p>Просто отрывок текста новости на три строчки при клике на него будет продолжение...</p>
				<a href="#">Читать дальше</a>
			</div>
			
			<div class="our-reviews-block-side-bar">
				<h3 class="sidebar-title">Наши <a href="#">отзывы</a></h3>
				<div class="reviews-block">
					<h4 class="title">Руслан (СК “КРЫМСТРОЙ”)</h4>
					<p>Работая с компанией “Югстроймонтаж”, я получил массу позитивных впечатлений..</p>
					<a href="#">Читать дальше</a>
				</div>
			</div>

			<?php if ( ! dynamic_sidebar() ) { ?>
				<?php dynamic_sidebar( 'sidebar' ); ?>
			<?php } ?>
		</aside>
	</div>
	<!-- end sidebar -->