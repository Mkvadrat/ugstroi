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

                    <main class="services-in-page">
						<h1 class="h1-title"><?php the_title(); ?></h1>
						
						<?php if (have_posts()): while (have_posts()): the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; endif; ?>

                        <!--<h3 class="h2-title">Заказать услугу</h3>-->
                        <p>Для заказа данной услуги воспользуйтесь формой </p>

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