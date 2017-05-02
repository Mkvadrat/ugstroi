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

                    <main class="news-page">
                        <h2 class="h2-title">Новости</h2>

                        <p class="underlined">В данном разделе Вы можете ознакомиться с новостями компании, а так же узнать о ходе строительства объектов и очереди на покупку квартиры.</p>
                        <ul class="projects-list">
                        <?php 
                            $current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
                            $args = array(
                                'category'    => 8,
                                'orderby'     => 'date',
                                'order'       => 'DESC',
                                'post_type'   => 'post',
                                'suppress_filters' => true, 
                                'posts_per_page' => $GLOBALS['wp_query']->query_vars['posts_per_page'],
                                'paged'       => $current_page
                            );

                            $posts = get_posts( $args );
							
							if($posts){
                            foreach($posts as $post){ setup_postdata($post);
                            $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
                        ?>
                            <li>
                                <a href="<?php echo get_permalink($post->ID); ?>">
                                <?php if(!empty($image_url)){ ?>
										<img class="article-img-mini" src="<?php echo $image_url[0]; ?>" alt="<?php echo get_post_meta( get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true ); ?>">
									<?php }else{ ?>
										<img class="article-img-mini" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/galery-1.jpg" alt="">
								<?php } ?>                                    
                                </a>
                                <div class="info-block">
                                    <h3><?php echo $post->post_title; ?></h3>
                                    <p class="date"><?php echo get_the_date( 'd-m-y', $post->ID ); ?></p>
                                    <p><?php echo wp_trim_words( $post->post_content, 15, '...' ); ?></p>
                                    <a href="<?php echo get_permalink($post->ID); ?>">подробнее</a>
                                </div>
                            </li>
                        <?php } ?>
						<?php }else{ ?>
							<li class="empty">
								<div class="info-block">
								<p>Новости не найдены.</p>
								</div>
							</li>
						<?php } ?>
                        </ul>
                        
                        <?php
                            wp_reset_postdata();

                            $defaults = array(
                                'type' 		   => 'array',
                                'prev_next'    => true,
                                'show_all'     => false, 
                                'end_size'     => 1,    
                                'mid_size'     => 1,
                            );
                            
                            $pagination = pg_links($defaults);
                        ?>
							
							<?php if($pagination){ ?>
								<div class="pagination">
									<ul class="page-number-list">
									<?php foreach ($pagination as $pag){ ?>
										<li><?php echo $pag; ?></li>
									<?php } ?>
									</ul>
								</div>
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