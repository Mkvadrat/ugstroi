<?php
/*
Template name: Contacts page
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

                    <main class="contacts-page">
                        <h1 class="h2-title"><?php the_title(); ?></h1>

						<?php if (have_posts()): while (have_posts()): the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; endif; ?>
                        
						<!-- start map -->
						<div class="map-block">
							<div id="maps" style="width:100%; height:385px"></div>
							<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&load=package.full" type="text/javascript"> </script>
							<script type="text/javascript">
								var myMap;
								ymaps.ready(init);
								function init(){
									ymaps.geocode('<?php the_field('adress_contacts_page'); ?>', {
											results: 1
									}).then
									(
											function (res){
													var firstGeoObject = res.geoObjects.get(0),
															myMap = new ymaps.Map
															("maps",{
																			center: firstGeoObject.geometry.getCoordinates(),
																			zoom: 15,
									controls: ["zoomControl", "fullscreenControl"]
																	}
															);
													var myPlacemark = new ymaps.Placemark(
															firstGeoObject.geometry.getCoordinates(),
															{
																	iconContent: ''
															},
															{
																	preset: 'twirl#blueStretchyIcon'
															}
													);
													myMap.geoObjects.add(myPlacemark);
													myMap.controls.add('typeSelector');
													myMap.behaviors.disable('scrollZoom');
											},
											function (err){
													alert(err.message);
											}
									);
								}
							</script>
						</div>
						<!-- end map -->
						
                        <h2 class="h2-title">Обратная связь</h2>
                        <p>Задайте вопрос нашим менеджерам</p>

						<div class="form">
						   <input type="text" id="name" placeholder="Имя">
						   <input type="tel" id="phone" placeholder="Телефон">
						   <input type="email" id="email" placeholder="Почта">
						   <textarea id="comment" placeholder="Сообщение"></textarea>
						   <input type="submit" onclick="SendForm();" value="Отправить">
					    </div>
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