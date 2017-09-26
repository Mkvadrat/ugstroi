<?php
/*
Template name: Service price page
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

                    <main class="price-page">
						<h2 class="h2-title">Цены</h2>
						<p>Lorem ipsum dolor sit amet, sodales ut, porta pellentesque, at volutpat magnis in orci id sem, at mauris sollicitudin tempus, morbi arcu id quisque ea integer eget. Etiam tellus sed tellus, est turpis accumsan et, ac id, sed sociis porta praesent quam diam, sed lorem urna est maecenas sit a. Neque wisi, quam donec a eu </p>
						<div class="divider"></div>
						<p class="equipment-title">
							<span class="number">1</span>Комлектация
							<span class="name">«стандарт»</span>
						</p>
						<div class="equipment-block">
							<div class="photo-block">
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/photo-price-1.png" alt="">
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/photo-price-2.png" alt="">
								<p class="price">от <span>12000</span> руб. за м2</p>
							</div>
							<div class="description-block">
								<p class="title-list foundation">Фундамент</p>
								<ul>
									<li>земельные работы</li>
									<li>монолитная железобетонная лента</li>
									<li>устройство закладных деталей под инженерные коммуникации</li>
									<li>устройство монолитного железобетонного пола (плита пола первого этажа)</li>
									<li>устройство и создание канализационной и водопроводной систем</li>
									<li>вертикальная гидроизоляция фундамента</li>
									<li>гидроизоляция поверхности перед кладкой</li>
								</ul>

								<p class="title-list floor">Этаж</p>
								<ul>
									<li>устройство стен этажа, вытяжных и вентиляционных каналов дома</li>
									<li>кладка стеновых строительных материалов</li>
									<li>создание монолитных ж/б колон и сердечников</li>
									<li>армирование кладки, камня-ракушечника, газо- или пеноблоков, кирпича, керамзитов, бетонных блоков и т.д.(согласно проекту)</li>
									<li>устройство ж/б армированного АСП (антисейсмопояса)</li>
									<li>создание монолитного ж/б перекрытия (включая в себя сбор и установку опалубки объемного армированного каркаса, сбора ригелей или систем тригонов)</li>
								</ul>

								<p class="title-list roof">Кровля</p>
								<ul>
									<li>устройство деревянных потолочных балок</li>
									<li>изготовление строительной системы</li>
									<li>монтаж металлочерепицы с утеплением минеральной ватой, кровли и потолка</li>
									<li>устройство ветровых и лобовых планок и отливной системы</li>
								</ul>
							</div>
						</div>

						<div class="divider"></div>

						<p><strong>Дополнительный подзаголовок</strong></p>
						<p>Lorem ipsum dolor sit amet, sodales ut, porta pellentesque, at volutpat magnis in orci id sem, at mauris sollicitudin tempus, morbi arcu id quisque ea integer eget. Etiam tellus sed tellus, est turpis accumsan et, ac id, sed sociis porta praesent quam diam, sed lorem urna est maecenas sit a. Neque wisi, quam donec a eu </p>
						<p><a href="#">Подробнее</a></p>

						<div class="divider"></div>

						<p class="equipment-title">
							<span class="number">2</span>Комлектация
							<span class="name">«люкс»</span>
						</p>
						<div class="equipment-block">
							<div class="photo-block">
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/photo-price-3.png" alt="">
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/photo-price-4.png" alt="">
								<p class="price">от <span>20000</span> руб. за м2</p>
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/photo-price-5.png" alt="">
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/photo-price-6.png" alt="">
								<p class="price">от <span>20000</span> руб. за м2</p>
							</div>
							<div class="description-block">
								<p class="title-list foundation">Фундамент</p>
								<ul>
									<li>земельные работы</li>
									<li>монолитная железобетонная лента(или другой тип фундамента согласно проекту)</li>
									<li>устройство закладных деталей под инженерные коммуникации</li>
									<li>устройство монолитного железобетонного пола (плита пола первого этажа)</li>
									<li>устройство и создание канализационной и водопроводной систем</li>
									<li>ввод в дом и на участок инженерных коммуникаций</li>
									<li>установка опор и люков для проведения коммуникаций</li>
									<li>утепление пола керамзитом или другими материалами(перед ж/б плитой)</li>
									<li>вертикальная гидроизоляция фундамента </li>
								</ul>

								<p class="title-list floor">Этаж</p>
								<ul>
									<li>устройство стен этажа, вытяжных и вентиляционных каналов дома</li>
									<li>кладка стеновых строительных материалов</li>
									<li>гидроизоляция поверхности перед кладкой</li>
									<li>создание монолитных ж/б колон и сердечников</li>
									<li>армирование кладки, камня-ракушечника, газо- или пеноблоков, кирпича, керамзитов, бетонных блоков и т.д.(согласно проекту)</li>
									<li>устройство ж/б армированного АСП (антисейсмопояса)</li>
									<li>создание монолитного ж/б перекрытия (включая в себя сбор и установку опалубки объемного армированного каркаса, сбора ригелей или систем тригонов)</li>
									<li>фасадная отделка стен с утеплением ( базальтовой ватой, полифасадом, клинкерными панелями или другими материалами согласно проекту и желанию заказчика )</li>
									<li>устройство камина(согласно пожеланиям заказчика)</li>
								</ul>

								<p class="title-list roof">Кровля</p>
								<ul>
									<li>устройство деревянных потолочных балок</li>
									<li>изготовление строительной системы</li>
									<li>устройство ветровых и лобовых планок и отливной системы</li>
									<li>создание композитной черепицы, мягкой кровли, утепление минватой 200 мм кровли и потолка</li>
									<li>установка снегозадержателей и дефлекторов труб на кровлю</li>
									<li>монтаж водосточной системы</li>
								</ul>

								<p class="title-list more">Дополнительно</p>
								<ul>
									<li>устройство деревянных потолочных балок</li>
									<li>изготовление строительной системы</li>
									<li>устройство ветровых и лобовых планок и отливной системы</li>
									<li>создание композитной черепицы, мягкой кровли, утепление минватой 200 мм кровли и потолка</li>
									<li>установка снегозадержателей и дефлекторов труб на кровлю</li>
								</ul>
							</div>
						</div>

						<div class="divider"></div>

						<p><strong>Дополнительный подзаголовок</strong></p>
						<p>Lorem ipsum dolor sit amet, sodales ut, porta pellentesque, at volutpat magnis in orci id sem, at mauris sollicitudin tempus, morbi arcu id quisque ea integer eget. Etiam tellus sed tellus, est turpis accumsan et, ac id, sed sociis porta praesent quam diam, sed lorem urna est maecenas sit a. Neque wisi, quam donec a eu </p>
						<p><a href="#">Подробнее</a></p>

						<div class="divider"></div>

						<p class="equipment-title">
							<span class="number">3</span>Комлектация
							<span class="name">«премиум»</span>
						</p>
						<div class="equipment-block">
							<div class="photo-block">
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/photo-price-7.png" alt="">
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/photo-price-8.png" alt="">
								<p class="price">от <span>20000</span> руб. за м2</p>
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/photo-price-9.png" alt="">
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/photo-price-10.png" alt="">
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/photo-price-11.png" alt="">
								<p class="price">от <span>30000</span> руб. за м2</p>
							</div>
							<div class="description-block">
								<p class="title-list foundation">Фундамент</p>
								<ul>
									<li>земельные работы</li>
									<li>монолитная железобетонная лента(или другой тип фундамента согласно проекту)</li>
									<li>устройство закладных деталей под инженерные коммуникации</li>
									<li>устройство монолитного железобетонного пола (плита пола первого этажа)</li>
									<li>устройство и создание канализационной и водопроводной систем</li>
									<li>ввод в дом и на участок инженерных коммуникаций</li>
									<li>установка опор и люков для проведения коммуникаций</li>
									<li>утепление пола керамзитом или другими материалами(перед ж/б плитой)</li>
									<li>отделка цоколя дома</li>
									<li>устройство ж/б отмостки вокруг дома</li>
									<li>вертикальная гидроизоляция</li>
								</ul>

								<p class="title-list floor">Этаж</p>
								<ul>
									<li>устройство стен этажа, вытяжных и вентиляционных каналов дома</li>
									<li>кладка стеновых строительных материалов</li>
									<li>гидроизоляция поверхности перед кладкой</li>
									<li>создание монолитных ж/б колон и сердечников</li>
									<li>армирование кладки, камня-ракушечника, газо- или пеноблоков, кирпича, керамзитов, бетонных блоков и т.д.(согласно проекту)</li>
									<li>устройство ж/б армированного АСП (антисейсмопояса)</li>
									<li>создание монолитного ж/б перекрытия (включая в себя сбор и установку опалубки объемного армированного каркаса, сбора ригелей или систем тригонов)</li>
									<li>фасадная отделка стен с утеплением ( базальтовой ватой, полифасадом, клинкерными панелями или другими материалами согласно проекту и желанию заказчика )</li>
									<li>устройство камина(согласно пожеланиям заказчика)</li>
									<li>создание межэтажной лестницы(бетонной деревянной и т.д.) согласно пожеланиям заказчика</li>
								</ul>

								<p class="title-list roof">Кровля</p>
								<ul>
									<li>устройство монолитного ж/б потолка</li>
									<li>изготовление стропильной системы</li>
									<li>устройство ветровых и лобовых планок и отливной системы</li>
									<li>создание композитной черепицы, мягкой кровли, утепление минватой 200 мм кровли и потолка</li>
									<li>установка снегозадержателей и дефлекторов труб на кровлю</li>
									<li>монтаж водосточной системы</li>
								</ul>

								<p class="title-list more">Дополнительно</p>
								<ul>
									<li>остекление дома, установка деревянных окон или металлопластиковых окон («Veka» или других по желанию заказчика)</li>
									<li>монтаж системы отопления</li>
									<li>монтаж и разводка электрической проводки</li>
									<li>штукатурные работы внутри дома</li>
									<li>чистовая отделка</li>
									<li>установка охранных систем, систем видео наблюдения (по желанию заказчика)</li>
									<li>монтаж кондиционеров</li>
									<li>отделка стен, потолков, укладка напольного покрытия, установка сантехники</li>
									<li>установка межкомнатных и входных дверей, монтаж выключателей и осветительных приборов</li>
									<li>создание дизайна интерьеров и экстерьеров дома, подбор собственной и уникальной архитектуры дома</li>
									<li>выполнение ландшафтных работ</li>
									<li>создание септика</li>
								</ul>
							</div>
						</div>

						<div class="divider"></div>

						<p>Заказчик вправе вносить любые изменения в ходе работ. Будем рады помочь Вам в реализации всех ваших желаний и построить самый удобный Дом для Вас и Вашей семьи.<i>С уважением, Югстрой Монтаж</i></p>

						<div class="divider"></div>

						<h2 class="h2-title">Заказать услугу</h2>
                        <p>Для заказа данной услуги воспользуйтесь формой </p>

						<div class="form">
						   <input type="text" id="name" placeholder="Имя">
						   <input type="tel" id="phone" placeholder="Телефон">
						   <input type="email" id="email" placeholder="Почта">
						   <textarea id="comment" placeholder="Сообщение"></textarea>
						   <input type="submit" onclick="SendForm();" value="Заказать услугу">
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