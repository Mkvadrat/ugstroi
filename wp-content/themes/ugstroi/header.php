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

	<!DOCTYPE html>
	<html lang="en">
		<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo ug_stroi_wp_title('','', true, 'right'); ?></title>
		<base href="#">
		<!-- Bootstrap -->
		<link href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/reset.css">
		<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/fonts.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

		<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/style.css">
		<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/media.css">
	
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery-1.9.1.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/bootstrap.min.js"></script>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<!-- MMENU -->

		<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/demo.css">
		<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/jquery.mmenu.all.css">
		<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.mmenu.all.js"></script>
		
		<!-- SLICK-CAROUSEL -->
		<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/slick.min.js"></script>
		<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/slick.css">
		<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/slick-theme.css">
					
		<!-- OWL-CAROUSEL -->
		<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/owl.carousel.min.js"></script>
		<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/owl.carousel.min.css">
		<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/owl.theme.default.css">
	
		<!-- FANCYBOX -->
		<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/js/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
		<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/source/jquery.fancybox.pack.js?v=2.1.5"></script>
		<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.mousewheel-3.0.6.pack.js"></script>
	
		<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/js/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
		<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
		<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
		 
		<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/js/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
		<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
	
		<!-- HTML5 for IE -->
		<!--[if IE]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/common.js"></script>
		<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/comments.js"></script>
		
		<!-- SWEETALERT -->
		<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/sweetalert.css">
		<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/sweetalert.min.js"></script>
	
		<?php wp_head(); ?>
	</head>
		
	<body>

	<div id="page">
        <div class="header">
            <a href="#menu"><span></span></a>
        </div>
        <nav id="menu">
			<?php
				if (has_nav_menu('primary_menu')){
					wp_nav_menu( array(
						'theme_location'  => 'primary_menu',
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
						'items_wrap'      => '<ul>%3$s</ul>',
						'depth'           => 2,
						'walker'          => '',
					) );
				}
			?>
        </nav>


    <!-- start header -->
    <header class="header-page">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                	<div class="logo-block">
					<a class="logo-title" href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<p><img
						  src="<?php header_image(); ?>"
						  height="<?php echo get_custom_header()->height; ?>"
						  width="<?php echo get_custom_header()->width; ?>"
						  alt="logotype"
						/></p>
					</a>
					</div>
                </div>
                <div class="col-md-4">
                    <p class="h4-title-header"><?php echo getMeta('slogan_main_page'); ?></p>
                </div>
                <div class="col-md-5">
                    <address>
                        <p><?php echo getMeta('adress_main_page'); ?></p>
                        <p><a href="tel:<?php echo getMeta('phone_main_page'); ?>"><?php echo getMeta('phone_main_page'); ?></a></p>
                        <p>Заказать <a class="fancybox" href="#modal-form">обратный звонок</a></p>
                    </address>
                </div>

                <!-- <div class="col-md-3-offset"></div> -->
                <div class="col-md-12 header-content">
                    <?php echo getMeta('banner_main_page'); ?>
                </div>
                <div class="col-md-12">
                	<a href="http://www.sro-mots.ru" class="certificate" target="_blank"><img src="http://ugstroi.com/wp-content/themes/ugstroi/images/sro.png" alt=""></a>
                </div>
                <!-- <div class="col-md-2-offset"></div> -->

                <div class="col-md-12">
                    <div class="menu-header">
                        <!-- <button type="button" class="menu-button hidden-md hidden-lg"><i class="fa fa-bars"></i></button> -->
                        <!-- <ul>
                            <li><a class="active" href="index.html">Главная</a></li>
                            <li><a href="about.html">О нас</a></li>
                            <li><a href="news.html">Новости</a></li>
                            <li><a href="galery.html">Галерея</a>
                                <ul>
                                    <li><a href="galery-in.html">Строится</a></li>
                                    <li><a href="galery-in.html">Построено</a></li>
                                    <li><a href="galery-in.html">Строительство</a></li>
                                    <li><a href="galery-in.html">Ремонт</a></li>
                                    <li><a href="galery-in.html">Мебель </a></li>
                                </ul>
                            </li>
                            <li><a href="projects.html">Проекты</a>
                                <ul>
                                    <li><a href="projects-in.html">Дизайн проекты</a></li>
                                    <li><a href="#">Эскизный проект домов</a></li>
                                </ul>
                            </li>
                            <li><a href="reviews.html">Отзывы</a></li>
                            <li><a href="contacts.html">Контакты</a></li>
                        </ul> -->
						<?php
							if (has_nav_menu('primary_menu')){
								wp_nav_menu( array(
									'theme_location'  => 'primary_menu',
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
									'items_wrap'      => '<ul>%3$s</ul>',
									'depth'           => 2,
									'walker'          => '',
								) );
							}
						?>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- end header -->

   </div>