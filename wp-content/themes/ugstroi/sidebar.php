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
			<?php $link = get_category_link( '8' ); ?>
				<h3 class="sidebar-title">Наши <a href="<?php echo $link; ?>">новости</a></h3>
			<?php 
				$args_input = array(
					'numberposts' => 1,
					'category'    => 8,
					'orderby'     => 'date',
					'order'       => 'DESC',
					'post_type'   => 'post',
					'suppress_filters' => true, 
				);

				$news_line = get_posts( $args_input );
				
				if($news_line){
				foreach($news_line as $post){ setup_postdata($post);
				$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
			?>
				<p><?php echo wp_trim_words( $post->post_title, 2, '...' ); ?></p>
				
				<?php if(!empty($image_url)){ ?>
					<img class="article-img-mini" src="<?php echo $image_url[0]; ?>" alt="<?php echo get_post_meta( get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true ); ?>">
				<?php }else{ ?>
					<img class="article-img-mini" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/news-photo-main-page.jpg" alt="">
				<?php } ?>
				
				<p><?php echo wp_trim_words( $post->post_content, 10, '...' ); ?></p>
				<a href="<?php echo get_permalink($post->ID); ?>">Читать дальше</a>
			
			<?php
				}
				}
				wp_reset_postdata();
			?>
			</div>
			
			<div class="our-reviews-block-side-bar">
				<h3 class="sidebar-title">Наши <a href="<?php echo get_permalink(602); ?>">отзывы</a></h3>
				<?php 
					$param = array(
						'status'	=> 'approve',
						'number'	=> '1',
						'order'     => 'DESC',
					);
					
					$comments = get_comments( $param );
					
					if(!empty($comments)){
						foreach($comments as $comment){
				?>
					<div class="reviews-block">
						<h4 class="title"><?php echo get_comment_author($comment->comment_ID); ?></h4>
						<p><?php echo wp_trim_words( $comment->comment_content, $num_words = 8, $more = null ); ?></p>
						<a href="<?php echo get_permalink(602); ?>">Читать дальше</a>
					</div>
				<?php
						}
					}
				?>
			</div>
			
			<?php if ( ! dynamic_sidebar() ) { ?>
				<?php dynamic_sidebar( 'sidebar' ); ?>
			<?php } ?>
		</aside>
	</div>
	<!-- end sidebar -->