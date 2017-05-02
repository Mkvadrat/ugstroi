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

                    <main class="page-404">
                        <div class="block-404">
                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/404.png" alt="">

                            <p class="underlined">Данная страница не найдена</p>
                        </div>

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