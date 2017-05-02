<?php
/*
Template name: Main page
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
    <div class="container-fluid bg-content padding-none padding-none">
        <div class="container">
            <div class="row">
                <div class="col-md-9 pad-non-right">
                    <main class="main-page">
                        <!-- start main content -->
						<div class="top-block-main-page">
							<?php if (have_posts()): while (have_posts()): the_post(); ?>
								<?php the_content(); ?>
							<?php endwhile; endif; ?>
						</div>
                        <!-- end main content -->
						
						<div class="our-services-block">
                            <h2 class="h2-title h2-title-underline">Наши услуги</h2>

                            <ul>
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
											//var_dump($children);
											$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($children->ID), 'full');
								?>
                                <li><a href="<?php echo get_permalink($children->ID); ?>">
                                    <figure>
										<?php if(!empty($image_url)){ ?>
											<img class="article-img-mini" src="<?php echo $image_url[0]; ?>" alt="<?php echo get_post_meta( get_post_thumbnail_id($children->ID), '_wp_attachment_image_alt', true ); ?>">
										<?php }else{ ?>
											<img class="article-img-mini" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/service-1.png" alt="">
										<?php } ?>
										
                                        <figcaption><?php echo $children->post_title; ?></figcaption>
                                    </figure>
                                </a></li>
								<?php 
										}
										
										wp_reset_postdata();
								
									}
								?>		
                            </ul>
                        </div>
                    </main>
                </div>

				<!-- start sidebar -->

                <?php get_sidebar(); ?>

                <!-- end sidebar -->

            </div>
        </div>
    </div>
    <!-- end content -->

<?php get_footer(); ?>