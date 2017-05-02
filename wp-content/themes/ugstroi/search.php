<?php
/*
Theme Name: Ugstroi
Theme URI: http://ugstroi.ru/
Author: M2
Author URI: http://mkvadrat.com/
Description: Тема для сайта ugstroi
Version: 1.0
*/

get_header(); ?>

    <!-- start content -->
    <div class="container-fluid bg-content padding-none">
        <div class="container">
            <div class="row">
                <div class="col-md-9 pad-non-right">

                    <!-- start bread crumbs -->
			
					<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>

                    <!-- end bread crumbs -->

                    <!-- start main content -->

                    <main class="search-page">
                        <!--<form class="search-form" action="">
                            <input type="search" name="" placeholder="Введите Слово или фразу">
                            <input type="submit" name="" value="Искать">
                        </form>-->
						
						<form class="search-form" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ) ?>" >
							<input type="search" value="<?php echo get_search_query() ?>" name="s" id="s" placeholder="Введите Слово или фразу" />
                            <input type="submit" id="searchsubmit" value="Искать" />
                        </form>

                        <p>Результаты по запросу</p>

                        <h2 class="h2-title"><?php echo $_GET['s'];?></h2>

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<ol class="search-list">
							<li><a href="<?php the_permalink();?>"><?php the_title(); ?></a></li>
						</ol>
						<?php endwhile; else: ?>
						<p>Поиск не дал результатов.</p>
						<?php endif;?>

                        <h2 class="h2-title">Обратная связь</h2>

                        <p>Задайте вопрос нашим менеджерам</p>

                        <!--<form class="form" action="">
                            <input type="text" placeholder="Имя">
                            <input type="tel" placeholder="Телефон">
                            <input type="email" placeholder="Почта">
                            <textarea placeholder="Сообщение"></textarea>
                            <input type="submit" name="" value="Отправить">
                        </form>-->
						
						<div class="form">
                            <input type="text" id="name" placeholder="Имя">
                            <input type="tel" id="phone" placeholder="Телефон">
                            <input type="email" id="email" placeholder="Почта">
                            <textarea id="comment" placeholder="Сообщение"></textarea>
                            <input type="submit" onclick="SendForm();" value="Отправить">
                        </div>

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
