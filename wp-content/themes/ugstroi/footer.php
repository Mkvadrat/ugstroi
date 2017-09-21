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

    <!--- start footer -->

    <footer class="footer">
        <div class="container-fluid padding-none">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <nav>
                            <!--<ul class="footer-nav">
                                <li><a href="index.html">Главная</a></li>
                                <li><a href="about.html">О нас</a></li>
                                <li><a href="news.html">Новости</a></li>
                                <li><a href="galery.html">Галерея</a></li>
                                <li><a href="projects.html">Проекты</a></li>
                                <li><a href="reviews.html">Отзывы</a></li>
                                <li><a href="contacts.html">Контакты</a></li>
                            </ul>-->
                            <?php
                                if (has_nav_menu('footer_menu')){
                                    wp_nav_menu( array(
                                        'theme_location'  => 'footer_menu',
                                        'menu'            => '',
                                        'container'       => false,
                                        'container_class' => '',
                                        'container_id'    => '',
                                        'menu_class'      => '',
                                        'menu_id'         => '',
                                        'echo'            => true,
                                        'fallback_cb'     => 'wp_page_menu',
                                        'before'          => '',
                                        'after'           => '',
                                        'link_before'     => '',
                                        'link_after'      => '',
                                        'items_wrap'      => '<ul class="footer-nav">%3$s</ul>',
                                        'depth'           => 1,
                                        'walker'          => '',
                                    ) );
                                }
                            ?>
                        </nav>

                        <div class="footer-lists-services">
                            <div class="col-md-4 pad-left-none">
                                <!--<ul class="footer-list-services">
                                    <li><a href="#">Строительство домов под ключ</a></li>
                                    <li><a href="#">Генподряд строительство</a></li>
                                    <li><a href="#">Ремонт квартир, офисов, домов</a></li>
                                    <li><a href="#">Дизайн проекты</a></li>
                                </ul>-->
                                <?php
                                    if (has_nav_menu('wrapper_menu')){
                                        wp_nav_menu( array(
                                            'theme_location'  => 'wrapper_menu',
                                            'menu'            => '',
                                            'container'       => false,
                                            'container_class' => '',
                                            'container_id'    => '',
                                            'menu_class'      => '',
                                            'menu_id'         => '',
                                            'echo'            => true,
                                            'fallback_cb'     => 'wp_page_menu',
                                            'before'          => '',
                                            'after'           => '',
                                            'link_before'     => '',
                                            'link_after'      => '',
                                            'items_wrap'      => '<ul class="footer-list-services">%3$s</ul>',
                                            'depth'           => 1,
                                            'walker'          => '',
                                        ) );
                                    }
                                ?>
                            </div>
                            <div class="col-md-4">
                                <!--<ul class="footer-list-services">
                                    <li><a href="#">Проектирование</a></li>
                                    <li><a href="#">Изготовление корпусной мебели</a></li>
                                    <li><a href="#">Кондицианирование</a></li>
                                    <li><a href="#">Благоустройство</a></li>
                                </ul>-->
                                <?php
                                    if (has_nav_menu('wrapper_menu_second')){
                                        wp_nav_menu( array(
                                            'theme_location'  => 'wrapper_menu_second',
                                            'menu'            => '',
                                            'container'       => false,
                                            'container_class' => '',
                                            'container_id'    => '',
                                            'menu_class'      => '',
                                            'menu_id'         => '',
                                            'echo'            => true,
                                            'fallback_cb'     => 'wp_page_menu',
                                            'before'          => '',
                                            'after'           => '',
                                            'link_before'     => '',
                                            'link_after'      => '',
                                            'items_wrap'      => '<ul class="footer-list-services">%3$s</ul>',
                                            'depth'           => 1,
                                            'walker'          => '',
                                        ) );
                                    }
                                ?>
                            </div>
                            <div class="col-md-4 pad-non-right">
                            <!--<ul class="footer-list-services">
                                    <li><a href="#">Электромонтажные работы</a></li>
                                    <li><a href="#">Сантехнические работы</a></li>
                                    <li><a href="#">Остекление</a></li>
                                </ul>-->
                                <?php
                                    if (has_nav_menu('wrapper_menu_third')){
                                        wp_nav_menu( array(
                                            'theme_location'  => 'wrapper_menu_third',
                                            'menu'            => '',
                                            'container'       => false,
                                            'container_class' => '',
                                            'container_id'    => '',
                                            'menu_class'      => '',
                                            'menu_id'         => '',
                                            'echo'            => true,
                                            'fallback_cb'     => 'wp_page_menu',
                                            'before'          => '',
                                            'after'           => '',
                                            'link_before'     => '',
                                            'link_after'      => '',
                                            'items_wrap'      => '<ul class="footer-list-services">%3$s</ul>',
                                            'depth'           => 1,
                                            'walker'          => '',
                                        ) );
                                    }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="right-block-footer">
                            <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ) ?>" >
                                <p><input type="search" value="<?php echo get_search_query() ?>" placeholder="Поиск" name="s" id="s" /></p>
                            </form>
                            
                            <ul class="social-list">
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                            </ul>

                            <p><?php echo getMeta('ugstroi_field_main_mage'); ?></p>

                            <address>
                                <p><i><?php echo getMeta('adress_main_page'); ?></i></p>
                                <p><a href="tel:<?php echo getMeta('phone_main_page'); ?>">Тел: <i><?php echo getMeta('phone_main_page'); ?></i></a></p>
                                <p>Эл. почта: <a href="mailto:<?php echo getMeta('email_main_page'); ?>"><i><?php echo getMeta('email_main_page'); ?></i></a></p>
                            </address>
                        </div>
                    </div>

                    <div class="copy-dev-block">
                        <div class="col-md-3 copy">
                            <p>&#169; 2017 Югстроймонтаж</p>
                            <p>Все права защищены</p>
                        </div>

                        <div class="col-md-9 dev-in">
                            <p>Сайт разработан в <a href="http://mkvadrat.com/"></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- end footer -->

    <!-- start fancybox -->

    <div class="hidden">
        <div class="modal-form" id="modal-form">
            <h4 class="h2-title">Заказать обратный звонок</h4>

            <p>Оставте свой номер телефона и наши менеджеры перезвонят Вам</p>
            <div class="form">
                <input type="text" id="quick_name" placeholder="Имя">
                <input type="tel" id="quick_phone" placeholder="Телефон">
                <input type="submit" onclick="QuickForm();" value="Отправить">
            </div>

            <p>Спасибо, запрос отправлен, наши менеджеры свяжутся с Вами через 15 минут</p>
        </div>
    </div>

    <!-- end fancybox -->
    
    <script type="text/javascript">
		//форма обратной связи
		function SendForm() {
		  var data = {
			'action': 'SendForm',
			'name' : $('#name').val(),
            'tel' : $('#phone').val(),
			'email' : $('#email').val(),
			'comment' : $('#comment').val()
		  };
		  $.ajax({
			url:'http://' + location.host + '/wp-admin/admin-ajax.php',
			data:data, // данные
			type:'POST', // тип запроса
			success:function(data){
			  swal(data.message);
			}
		  });
		};
		
		//быстрая заявка
		function QuickForm() {
		  var data = {
			'action': 'QuickForm',
			'name' : $('#quick_name').val(),
            'tel' : $('#quick_phone').val(),
		  };
		  $.ajax({
			url:'http://' + location.host + '/wp-admin/admin-ajax.php',
			data:data, // данные
			type:'POST', // тип запроса
			success:function(data){
			  swal(data.message);
			}
		  });
		};
	</script>
	
	<?php wp_footer(); ?>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter45702921 = new Ya.Metrika({
                    id:45702921,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/45702921" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>