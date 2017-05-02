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

                    <main class="projects-page">
                        <h2 class="h2-title"><?php single_cat_title(); ?></h2>
						
					<?php
						$term = get_queried_object();
						$cat_id = $term->term_id;
						$cat_data = get_option("category_$cat_id");
					?>
					
					<?php echo wpautop(stripcslashes( $cat_data['text_for_categories_projects_page'] ), $br = false); ?>
						
					<?php						
						$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
						$args = array(
						'tax_query' => array(
							array(
								'taxonomy' => 'projects-list',
								'field' => 'id',
								'terms' => array( get_queried_object()->term_id )
							)
						),
							'post_type' => 'projects',
							'posts_per_page' => $GLOBALS['wp_query']->query_vars['posts_per_page'],
							'paged'          => $current_page
						);
						
						$projects = get_posts( $args );
					?>
					<ul class="projects-list">
						<?php
						if($projects){
							foreach($projects as $projects_list){
								$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($projects_list->ID), 'full');
						?>
							<li>
								<a href="<?php echo get_permalink($projects_list->ID); ?>">
									<?php if(!empty($image_url)){ ?>
										<img src="<?php echo $image_url[0]; ?>" alt="<?php echo get_post_meta( get_post_thumbnail_id($projects_list->ID), '_wp_attachment_image_alt', true ); ?>">
									<?php }else{ ?>
										<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/galery-1.jpg">
									<?php } ?>								
								</a>
								<div class="info-block">
									<h3><?php echo $projects_list->post_title; ?></h3>
									<p class="date"><?php echo get_the_date( 'd-m-y', $projects_list->ID ); ?></p>
									<p><?php echo wp_trim_words( $projects_list->post_content, 25, '...' ); ?></p>
									<a href="<?php echo get_permalink($projects_list->ID); ?>">подробнее</a>
								</div>
							</li>
						<?php } ?>
						<?php }else{ ?>
							<li class="empty">
								<div class="info-block">
								<p>Проекты не найдены.</p>
								</div>
							</li>
						<?php } ?>
                    </ul>
							
						<?php
							wp_reset_postdata();
							
							$defaults = array(
								'type' => 'array',
								'prev_next'    => False,
								//'prev_text'    => __('В начало'),
								//'next_text'    => __('В конец'),
							);
	
							$pagination = paginate_links($defaults);
						?>
						
						<?php if($pagination){ ?>
						<ul class="page-number-list">
								<?php foreach ($pagination as $pag){ ?>
									<li><?php echo $pag; ?></li>
								<?php } ?>
						</ul>
						<?php } ?>
						
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
	
<?php get_footer(); ?>
