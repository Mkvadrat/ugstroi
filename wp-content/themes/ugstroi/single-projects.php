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

                    <main class="object-page">
                        <h2 class="h2-title"><?php the_title(); ?></h2>

						<?php echo the_field('introductory_description_projects_page'); ?>

						<?php if(getMetaByID('gallery_projects_page', get_the_ID())){ ?>
						<?php
							foreach(get_field('gallery_projects_page') as $nextgen_gallery_id) :
								nggShowGallery($nextgen_gallery_id['ngg_id'], $template = 'ugstroi-view') ;
							endforeach;
						?>
						<?php } ?>
						
						
                       	<?php if (have_posts()): while (have_posts()): the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; endif; ?>
						
                        <h2 class="h2-title">Обратная связь</h2>
                        <p>Задайте вопрос нашим менеджерам</p>

                        <div class="form">
                            <input type="text" id="name" placeholder="Имя">
                            <input type="tel" id="phone" placeholder="Телефон">
                            <input type="email" id="email" placeholder="Почта">
                            <textarea id="comment" placeholder="Сообщение"></textarea>
                            <input type="submit" onclick="SendForm();" value="Отправить">
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
   
<?php get_footer(); ?>