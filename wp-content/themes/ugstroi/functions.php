<?php
/*
Theme Name: Ugstroi
Theme URI: http://ugstroi.ru/
Author: M2
Author URI: http://mkvadrat.com/
Description: Тема для сайта ugstroi
Version: 1.0
*/

/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
****************************************************************************НАСТРОЙКИ ТЕМЫ*****************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
//Регистрируем название сайта
function ug_stroi_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	$title .= get_bloginfo( 'name', 'display' );

	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'psy' ), max( $paged, $page ) );
	}

	if ( is_404() ) {
        $title = '404';
    }

	return $title;
}
add_filter( 'wp_title', 'ug_stroi_wp_title', 10, 2 );

//Регистрируем меню
if(function_exists('register_nav_menus')){
	register_nav_menus(
		array(
		  'primary_menu'        => 'Главное меню',
		  'footer_menu'         => 'Меню в подвале сайта (Уровень 1)',
		  'wrapper_menu'        => 'Меню в подвале сайта (Уровень 2)',
		  'wrapper_menu_second' => 'Меню в подвале сайта (Уровень 3)',
		  'wrapper_menu_third'  => 'Меню в подвале сайта (Уровень 4)',
		)
	);
}

//Регистрируем сайдбар
function register_my_widgets(){
	register_sidebar( array(
		'name' => 'Боковая панель',
		'id' => 'sidebar',
		'description' => 'Выводиться как боковая панель на странице сайта.',
		'before_widget' => '<div class="our-news-block-side-bar">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="sidebar-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'register_my_widgets' );

//Изображение в шапке сайта
$args = array(
  'width'         => 109,
  'height'        => 64,
  'default-image' => get_template_directory_uri() . '/images/logo.png',
  'uploads'       => true,
);
add_theme_support( 'custom-header', $args );

//Добавление в тему миниатюры записи и страницы
if ( function_exists( 'add_theme_support' ) ) {
     add_theme_support( 'post-thumbnails' );
}

//Удаляем пунткы меню
function remove_menu_items() {
    remove_menu_page('edit-comments.php'); // Удаляем пункт "Комментарии"
}
add_action( 'admin_menu', 'remove_menu_items' );

/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
*********************************************************************РАБОТА С METAПОЛЯМИ*******************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
//Вывод данных из произвольных полей для всех страниц сайта
function getMeta($meta_key){
	global $wpdb;
	
	$value = $wpdb->get_var( $wpdb->prepare("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = %s ORDER BY meta_id DESC LIMIT 1", $meta_key) );
	
	return $value;
}

//Вывод id категории
function getCurrentCatID(){
	global $wp_query;
	if(is_category()){
		$cat_ID = get_query_var('cat');
	}
	return $cat_ID;
}

/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
********************************************************************РАЗДЕЛ "НАШИ УСЛУГИ" В АДМИНКЕ*********************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
//Вывод в админке раздела "Наши услуги"
function register_post_type_our_services() {
	 $labels = array(
	 'name' => 'Наши услуги',
	 'singular_name' => 'Наши услуги',
	 'add_new' => 'Добавить статью',
	 'add_new_item' => 'Добавить новый статью',
	 'edit_item' => 'Редактировать статью',
	 'new_item' => 'Новый статья',
	 'all_items' => 'Все статьи',
	 'view_item' => 'Просмотр статьи на сайте',
	 'search_items' => 'Искать статью',
	 'not_found' => 'Статьи не найдены.',
	 'not_found_in_trash' => 'В корзине нет статей.',
	 'menu_name' => 'Наши услуги'
	 );
		 $args = array(
		 'labels' => $labels,
		 'public' => true,
		 'exclude_from_search' => false,
		 'show_ui' => true,
		 'has_archive' => false,
		 'menu_icon' => 'dashicons-building',
		 'menu_position' => 20,
		 'supports' => array( 'title', 'editor', 'thumbnail'),
		 );
	 register_post_type('our-services', $args);
}
add_action( 'init', 'register_post_type_our_services' );

function true_post_type_our_services( $our_services ) {
	 global $post, $post_ID;

	 $our_services['our-services'] = array(
		 0 => '',
		 1 => sprintf( 'Статьи обновлены. <a href="%s">Просмотр</a>', esc_url( get_permalink($post_ID) ) ),
		 2 => 'Статья обновлёна.',
		 3 => 'Статья удалёна.',
		 4 => 'Статья обновлена.',
		 5 => isset($_GET['revision']) ? sprintf( 'Статья восстановлена из редакции: %s', wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		 6 => sprintf( 'Статья опубликована на сайте. <a href="%s">Просмотр</a>', esc_url( get_permalink($post_ID) ) ),
		 7 => 'Статья сохранена.',
		 8 => sprintf( 'Отправлен на проверку. <a target="_blank" href="%s">Просмотр</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		 9 => sprintf( 'Запланирован на публикацию: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Просмотр</a>', date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		 10 => sprintf( 'Черновик обновлён. <a target="_blank" href="%s">Просмотр</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	 );

	 return $our_services;
}
add_filter( 'post_updated_messages', 'true_post_type_our_services' );









/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
********************************************************************ХЛЕБНЫЕ КРОШКИ*************************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/

function dimox_breadcrumbs() {

  /* === ОПЦИИ === */
  $text['home'] = 'Главная'; // текст ссылки "Главная"
  $text['category'] = '%s'; // текст для страницы рубрики
  $text['search'] = 'Результаты поиска по запросу "%s"'; // текст для страницы с результатами поиска
  $text['tag'] = 'Записи с тегом "%s"'; // текст для страницы тега
  $text['author'] = 'Статьи автора %s'; // текст для страницы автора
  $text['404'] = 'Ошибка 404'; // текст для страницы 404
  $text['page'] = 'Страница %s'; // текст 'Страница N'
  $text['cpage'] = 'Страница комментариев %s'; // текст 'Страница комментариев N'

  $wrap_before = '<ul class="bread-crumbs">'; // открывающий тег обертки
  $wrap_after = '</ul>'; // закрывающий тег обертки
  $sep = '/'; // разделитель между "крошками"
  $sep_before = ''; // тег перед разделителем
  $sep_after = ''; // тег после разделителя
  $show_home_link = 1; // 1 - показывать ссылку "Главная", 0 - не показывать
  $show_on_home = 0; // 1 - показывать "хлебные крошки" на главной странице, 0 - не показывать
  $show_current = 1; // 1 - показывать название текущей страницы, 0 - не показывать
  $before = '<li><span>'; // тег перед текущей "крошкой"
  $after = '</li></span>'; // тег после текущей "крошки"
  /* === КОНЕЦ ОПЦИЙ === */

  global $post;
  $home_url = home_url('/');
  $link_before = '';
  $link_after = '';
  $link_attr = '';
  $link_in_before = '';
  $link_in_after = '';
  $link = $link_before . '<li><a href="%1$s"' . $link_attr . '>' . $link_in_before . '%2$s' . $link_in_after . '</a></li>' . $link_after;
  $frontpage_id = get_option('page_on_front');
  $parent_id = ($post) ? $post->post_parent : '';
  $sep = ' ' . $sep_before . $sep . $sep_after . ' ';
  $home_link = $link_before . '<li><a href="' . $home_url . '"' . $link_attr . '>' . $link_in_before . $text['home'] . $link_in_after . '</a></li>' . $link_after;

  if (is_home() || is_front_page()) {

    if ($show_on_home) echo $wrap_before . $home_link . $wrap_after;

  } else {

    echo $wrap_before;
    if ($show_home_link) echo $home_link;

    if ( is_category() ) {
      $cat = get_category(get_query_var('cat'), false);
      if ($cat->parent != 0) {
        $cats = get_category_parents($cat->parent, TRUE, $sep);
        $cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
        $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
        if ($show_home_link) echo $sep;
        echo $cats;
      }
      if ( get_query_var('paged') ) {
        $cat = $cat->cat_ID;
        echo $sep . sprintf($link, get_category_link($cat), get_cat_name($cat)) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
      } else {
        if ($show_current) echo $sep . $before . sprintf($text['category'], single_cat_title('', false)) . $after;
      }

    } elseif ( is_search() ) {
      if (have_posts()) {
        if ($show_home_link && $show_current) echo $sep;
        if ($show_current) echo $before . sprintf($text['search'], get_search_query()) . $after;
      } else {
        if ($show_home_link) echo $sep;
        echo $before . sprintf($text['search'], get_search_query()) . $after;
      }

    } elseif ( is_day() ) {
      if ($show_home_link) echo $sep;
      echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $sep;
      echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F'));
      if ($show_current) echo $sep . $before . get_the_time('d') . $after;

    } elseif ( is_month() ) {
      if ($show_home_link) echo $sep;
      echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y'));
      if ($show_current) echo $sep . $before . get_the_time('F') . $after;

    } elseif ( is_year() ) {
      if ($show_home_link && $show_current) echo $sep;
      if ($show_current) echo $before . get_the_time('Y') . $after;

    } elseif ( is_single() && !is_attachment() ) {
      //Категории
      if ($show_home_link) echo $sep;
      if ( get_post_type() != 'post' ) {
		if( get_post_type() == 'our-services' ){			
			printf($link, $home_url, $post_type->labels->singular_name);
			
			if ($show_current) echo $before . get_the_title() . $after;
		}else{
			$post_type = get_post_type_object(get_post_type());
			$slug = $post_type->rewrite;
			printf($link, $home_url . $slug['slug'] . '/', $post_type->labels->singular_name);
			if ($show_current) echo $sep . $before . get_the_title() . $after;
		}
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, $sep);
        if (!$show_current || get_query_var('cpage')) $cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
        $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
        echo $cats;
        if ( get_query_var('cpage') ) {
          echo $sep . sprintf($link, get_permalink(), get_the_title()) . $sep . $before . sprintf($text['cpage'], get_query_var('cpage')) . $after;
        } else {
          if ($show_current) echo $before . get_the_title() . $after;
        }
      }

    // custom post type
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      if ( get_query_var('paged') ) {
        echo $sep . sprintf($link, get_post_type_archive_link($post_type->name), $post_type->label) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
      } else {
        if ($show_current) echo $sep . $before . $post_type->label . $after;
      }

    } elseif ( is_attachment() ) {
      if ($show_home_link) echo $sep;
      $parent = get_post($parent_id);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      if ($cat) {
        $cats = get_category_parents($cat, TRUE, $sep);
        $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
        echo $cats;
      }
      printf($link, get_permalink($parent), $parent->post_title);
      if ($show_current) echo $sep . $before . get_the_title() . $after;

    } elseif ( is_page() && !$parent_id ) {
      if ($show_current) echo $sep . $before . get_the_title() . $after;

    } elseif ( is_page() && $parent_id ) {
      if ($show_home_link) echo $sep;
      if ($parent_id != $frontpage_id) {
        $breadcrumbs = array();
        while ($parent_id) {
          $page = get_page($parent_id);
          if ($parent_id != $frontpage_id) {
            $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
          }
          $parent_id = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        for ($i = 0; $i < count($breadcrumbs); $i++) {
          echo $breadcrumbs[$i];
          if ($i != count($breadcrumbs)-1) echo $sep;
        }
      }
      if ($show_current) echo $sep . $before . get_the_title() . $after;
    } elseif ( is_tag() ) {
      if ( get_query_var('paged') ) {
        $tag_id = get_queried_object_id();
        $tag = get_tag($tag_id);
        echo $sep . sprintf($link, get_tag_link($tag_id), $tag->name) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
      } else {
        if ($show_current) echo $sep . $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
      }

    } elseif ( is_author() ) {
      global $author;
      $author = get_userdata($author);
      if ( get_query_var('paged') ) {
        if ($show_home_link) echo $sep;
        echo sprintf($link, get_author_posts_url($author->ID), $author->display_name) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
      } else {
        if ($show_home_link && $show_current) echo $sep;
        if ($show_current) echo $before . sprintf($text['author'], $author->display_name) . $after;
      }

    } elseif ( is_404() ) {
      if ($show_home_link && $show_current) echo $sep;
      if ($show_current) echo $before . $text['404'] . $after;

    } elseif ( has_post_format() && !is_singular() ) {
      if ($show_home_link) echo $sep;
      echo get_post_format_string( get_post_format() );
    }

    echo $wrap_after;

  }
} 

/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
*****************************************************************REMOVE POST_TYPE SLUG*********************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
//Удаление из url таксономии
function remove_slug_from_post( $post_link, $post, $leavename ) {
	if ( 'our-services' != $post->post_type || 'publish' != $post->post_status ) {
		return $post_link;
	}
		$post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
	return $post_link;
}
add_filter( 'post_type_link', 'remove_slug_from_post', 10, 3 );

function parse_request_url_post( $query ) {
	if ( ! $query->is_main_query() )
		return;

	if ( 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
		return;
	}

	if ( ! empty( $query->query['name'] ) ) {
		$query->set( 'post_type', array( 'post', 'our-services', 'page' ) );
	}
}
add_action( 'pre_get_posts', 'parse_request_url_post' );

/**********************************************************************************************************************************************************
***********************************************************************************************************************************************************
********************************************************************ФОРМЫ ОБРАТНОЙ СВЯЗИ*******************************************************************
***********************************************************************************************************************************************************
***********************************************************************************************************************************************************/
//Форма обратной связи для главной страницы
function SendForm(){

	$form_adress = get_option('admin_email');
	
	$site_url = $_SERVER['SERVER_NAME'];

	$alert = array(
		'status' => 0,
		'message' => ''
	);

	if (isset($_POST['name'])) {$name = $_POST['name']; if ($name == '') {unset($name);}}
	if (isset($_POST['email'])) {$email = $_POST['email']; if ($email == '' || !is_email($email)) {unset($email);}}
	if (isset($_POST['tel'])) {$tel = $_POST['tel']; if ($tel == '') {unset($tel);}}
	if (isset($_POST['comment'])) {$comment = $_POST['comment']; if ($comment == '') {unset($comment);}}

	if (isset($name) && isset($email) && isset($tel) && isset($comment)){

		$address = $form_adress;

		$headers  = "Content-type: text/html; charset=UTF-8 \r\n";
		$headers .= "From: $site_url\r\n";
		$headers .= "Bcc: birthday-archive@example.com\r\n";
		
		$mes = "Имя: $name \nEmail: $email \nСообщение: $comment";
		
		/*$mes = '<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta name="viewport" content="width=device-width" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>ZURBemails</title>
		<style>
		img {
		max-width: 100%;
		}
		.collapse {
		margin:0;
		padding:0;
		}
		body {
		-webkit-font-smoothing:antialiased;
		-webkit-text-size-adjust:none;
		width: 100%!important;
		height: 100%;
		}

		a { color: #2BA6CB;}

		.btn {
		text-decoration:none;
		color: #FFF;
		background-color: #666;
		padding:10px 16px;
		font-weight:bold;
		margin-right:10px;
		text-align:center;
		cursor:pointer;
		display: inline-block;
		}

		p.callout {
		padding:15px;
		background-color:#ECF8FF;
		margin-bottom: 15px;
		}
		.callout a {
		font-weight:bold;
		color: #2BA6CB;
		}

		table.social {
		background-color: #ebebeb;

		}
		.social .soc-btn {
		padding: 3px 7px;
		font-size:12px;
		margin-bottom:10px;
		text-decoration:none;
		color: #FFF;font-weight:bold;
		display:block;
		text-align:center;
		}
		a.fb { background-color: #3B5998!important; }
		a.tw { background-color: #1daced!important; }
		a.gp { background-color: #DB4A39!important; }
		a.ms { background-color: #000!important; }

		.sidebar .soc-btn {
		display:block;
		width:100%;
		}

		table.head-wrap { width: 100%;}

		.header.container table td.logo { padding: 15px; }
		.header.container table td.label { padding: 15px; padding-left:0px;}

		table.body-wrap { width: 100%;}

		table.footer-wrap { width: 100%;	clear:both!important;
		}
		.footer-wrap .container td.content  p { border-top: 1px solid rgb(215,215,215); padding-top:15px;}
		.footer-wrap .container td.content p {
		font-size:10px;
		font-weight: bold;

		}

		h1,h2,h3,h4,h5,h6 {
		font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; line-height: 1.1; margin-bottom:15px; color:#000;
		}
		h1 small, h2 small, h3 small, h4 small, h5 small, h6 small { font-size: 60%; color: #6f6f6f; line-height: 0; text-transform: none; }

		h1 { font-weight:200; font-size: 44px;}
		h2 { font-weight:200; font-size: 37px;}
		h3 { font-weight:500; font-size: 27px;}
		h4 { font-weight:500; font-size: 23px;}
		h5 { font-weight:900; font-size: 17px;}
		h6 { font-weight:900; font-size: 14px; text-transform: uppercase; color:#ffffff;}

		.collapse { margin:0!important;}

		p, ul {
		font-family: Helvetica, Arial, "Lucida Grande", sans-serif;
		margin-bottom: 10px;
		font-weight: normal;
		font-size:14px;
		line-height:1.6;
		}
		p.lead { font-size:17px; }
		p.last { margin-bottom:0px;}

		ul li {
		font-family: Helvetica, Arial, "Lucida Grande", sans-serif;
		margin-left:5px;
		list-style-position: inside;
		}

		ul.sidebar {
		font-family: Helvetica, Arial, "Lucida Grande", sans-serif;
		background:#ebebeb;
		display:block;
		list-style-type: none;
		}
		ul.sidebar li { display: block; margin:0;}
		ul.sidebar li a {
		text-decoration:none;
		color: #666;
		padding:10px 16px;
		margin-right:10px;
		cursor:pointer;
		border-bottom: 1px solid #777777;
		border-top: 1px solid #FFFFFF;
		display:block;
		margin:0;
		}
		ul.sidebar li a.last { border-bottom-width:0px;}
		ul.sidebar li a h1,ul.sidebar li a h2,ul.sidebar li a h3,ul.sidebar li a h4,ul.sidebar li a h5,ul.sidebar li a h6,ul.sidebar li a p { margin-bottom:0!important;}

		.container {
		font-family: Helvetica, Arial, "Lucida Grande", sans-serif;
		display:block!important;
		max-width:600px!important;
		margin:0 auto!important;
		clear:both!important;
		}

		.content {
		padding:15px;
		max-width:600px;
		margin:0 auto;
		display:block;
		}

		.content table { width: 100%; }

		.column {
		width: 300px;
		float:left;
		}
		.column tr td { padding: 15px; }
		.column-wrap {
		padding:0!important;
		margin:0 auto;
		max-width:600px!important;
		}
		.column table { width:100%;}
		.social .column {
		width: 280px;
		min-width: 279px;
		float:left;
		}


		.clear { display: block; clear: both; }

		@media only screen and (max-width: 600px) {

		a[class="btn"] { display:block!important; margin-bottom:10px!important; background-image:none!important; margin-right:0!important;}

		div[class="column"] { width: auto!important; float:none!important;}

		table.social div[class="column"] {
		width:auto!important;
		}

		}
		</style>

		</head>

		<body bgcolor="#FFFFFF">

		<!-- HEADER -->
		<table class="head-wrap" bgcolor="#003576">
		<tr>
		<td></td>
		<td class="header container" >

		<div class="content">
		<table>
		<tr>

		<td align="left"><h6 class="collapse" style="font-weight: 900; font-size: 14px; text-transform: uppercase; color: #ffffff;">Наталья Мельник психологические услуги</td>
		<td align="right"><h6 class="collapse" style="font-weight: 900; font-size: 14px; text-transform: uppercase; color: #ffffff;">Обратная связь</h6></td>
		</tr>
		</table>
		</div>

		</td>
		<td></td>
		</tr>
		</table>

		<table class="body-wrap">
		<tr>
		<td></td>
		<td class="container" bgcolor="#FFFFFF">

		<div class="content">
		<table>
		<tr>
		<td>
		<!--<h3>Тема сообщения</h3>-->

		<p>'.$comment.'</p>
		<!-- Callout Panel -->
		<!-- social & contact -->
		<table class="social" width="100%">
		<tr>
		<td>
		<table align="left" class="column">
		<tr>
		<td>

		<h5 class="">Контактная информация:</h5>
		<br/>
		<p>Имя: <strong>'.$name.'</strong></p>
		<p>Email: <strong><a href="emailto: '.$email.'">'.$email.'</a></strong></p>
		</td>
		</tr>
		</table>

		<span class="clear"></span>

		</td>
		</tr>
		</table>

		</td>
		</tr>
		</table>
		</div>

		</td>
		<td></td>
		</tr>
		</table>

		<table class="footer-wrap">
		<tr>
		<td></td>
		<td class="container"></td>
		<td></td>
		</tr>
		</table>

		</body>
		</html>';*/

		$send = mail($address, $email, $mes, $headers);

		if ($send == 'true'){
			$alert = array(
				'status' => 1,
				'message' => 'Ваше сообщение отправлено'
			);
		}else{
			$alert = array(
				'status' => 1,
				'message' => 'Ошибка, сообщение не отправлено!'
			);
		}
	}

	if (isset($_POST['name']) && isset($_POST['tel']) && isset($_POST['email']) && isset($_POST['comment'])){
		$name = $_POST['name'];
		$tel = $_POST['tel'];
		$email = $_POST['email'];
		$comment = $_POST['comment'];

		if(!is_email($email)) {
			$alert = array(
				'status' => 1,
				'message' => 'Email введен не верно, проверте внимательно поле!'
			);
		}

		if ($name == '' || $tel == '' || $email == '' || $comment == '') {
			unset($name);
			unset($tel);
			unset($email);
			unset($comment);
			$alert = array(
				'status' => 1,
				'message' => 'Ошибка, сообщение не отправлено! Заполните все поля!'
			);
		}
	}

	echo wp_send_json($alert);

	wp_die();
}
add_action('wp_ajax_SendForm', 'SendForm');
add_action('wp_ajax_nopriv_SendForm', 'SendForm');

//Форма быстрой обратной связи
function QuickForm(){

	$form_adress = get_option('admin_email');
	
	$site_url = $_SERVER['SERVER_NAME'];

	$alert = array(
		'status' => 0,
		'message' => ''
	);

	if (isset($_POST['name'])) {$name = $_POST['name']; if ($name == '') {unset($name);}}
	if (isset($_POST['tel'])) {$tel = $_POST['tel']; if ($tel == '') {unset($tel);}}

	if (isset($name) && isset($tel)){

		$address = $form_adress;

		$headers  = "Content-type: text/html; charset=UTF-8 \r\n";
		$headers .= "From: $site_url\r\n";
		$headers .= "Bcc: birthday-archive@example.com\r\n";
		
		$mes = "Имя: $name \nТелефон: $tel";
		
		/*$mes = '<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta name="viewport" content="width=device-width" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>ZURBemails</title>
		<style>
		img {
		max-width: 100%;
		}
		.collapse {
		margin:0;
		padding:0;
		}
		body {
		-webkit-font-smoothing:antialiased;
		-webkit-text-size-adjust:none;
		width: 100%!important;
		height: 100%;
		}

		a { color: #2BA6CB;}

		.btn {
		text-decoration:none;
		color: #FFF;
		background-color: #666;
		padding:10px 16px;
		font-weight:bold;
		margin-right:10px;
		text-align:center;
		cursor:pointer;
		display: inline-block;
		}

		p.callout {
		padding:15px;
		background-color:#ECF8FF;
		margin-bottom: 15px;
		}
		.callout a {
		font-weight:bold;
		color: #2BA6CB;
		}

		table.social {
		background-color: #ebebeb;

		}
		.social .soc-btn {
		padding: 3px 7px;
		font-size:12px;
		margin-bottom:10px;
		text-decoration:none;
		color: #FFF;font-weight:bold;
		display:block;
		text-align:center;
		}
		a.fb { background-color: #3B5998!important; }
		a.tw { background-color: #1daced!important; }
		a.gp { background-color: #DB4A39!important; }
		a.ms { background-color: #000!important; }

		.sidebar .soc-btn {
		display:block;
		width:100%;
		}

		table.head-wrap { width: 100%;}

		.header.container table td.logo { padding: 15px; }
		.header.container table td.label { padding: 15px; padding-left:0px;}

		table.body-wrap { width: 100%;}

		table.footer-wrap { width: 100%;	clear:both!important;
		}
		.footer-wrap .container td.content  p { border-top: 1px solid rgb(215,215,215); padding-top:15px;}
		.footer-wrap .container td.content p {
		font-size:10px;
		font-weight: bold;

		}

		h1,h2,h3,h4,h5,h6 {
		font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; line-height: 1.1; margin-bottom:15px; color:#000;
		}
		h1 small, h2 small, h3 small, h4 small, h5 small, h6 small { font-size: 60%; color: #6f6f6f; line-height: 0; text-transform: none; }

		h1 { font-weight:200; font-size: 44px;}
		h2 { font-weight:200; font-size: 37px;}
		h3 { font-weight:500; font-size: 27px;}
		h4 { font-weight:500; font-size: 23px;}
		h5 { font-weight:900; font-size: 17px;}
		h6 { font-weight:900; font-size: 14px; text-transform: uppercase; color:#ffffff;}

		.collapse { margin:0!important;}

		p, ul {
		font-family: Helvetica, Arial, "Lucida Grande", sans-serif;
		margin-bottom: 10px;
		font-weight: normal;
		font-size:14px;
		line-height:1.6;
		}
		p.lead { font-size:17px; }
		p.last { margin-bottom:0px;}

		ul li {
		font-family: Helvetica, Arial, "Lucida Grande", sans-serif;
		margin-left:5px;
		list-style-position: inside;
		}

		ul.sidebar {
		font-family: Helvetica, Arial, "Lucida Grande", sans-serif;
		background:#ebebeb;
		display:block;
		list-style-type: none;
		}
		ul.sidebar li { display: block; margin:0;}
		ul.sidebar li a {
		text-decoration:none;
		color: #666;
		padding:10px 16px;
		margin-right:10px;
		cursor:pointer;
		border-bottom: 1px solid #777777;
		border-top: 1px solid #FFFFFF;
		display:block;
		margin:0;
		}
		ul.sidebar li a.last { border-bottom-width:0px;}
		ul.sidebar li a h1,ul.sidebar li a h2,ul.sidebar li a h3,ul.sidebar li a h4,ul.sidebar li a h5,ul.sidebar li a h6,ul.sidebar li a p { margin-bottom:0!important;}

		.container {
		font-family: Helvetica, Arial, "Lucida Grande", sans-serif;
		display:block!important;
		max-width:600px!important;
		margin:0 auto!important;
		clear:both!important;
		}

		.content {
		padding:15px;
		max-width:600px;
		margin:0 auto;
		display:block;
		}

		.content table { width: 100%; }

		.column {
		width: 300px;
		float:left;
		}
		.column tr td { padding: 15px; }
		.column-wrap {
		padding:0!important;
		margin:0 auto;
		max-width:600px!important;
		}
		.column table { width:100%;}
		.social .column {
		width: 280px;
		min-width: 279px;
		float:left;
		}


		.clear { display: block; clear: both; }

		@media only screen and (max-width: 600px) {

		a[class="btn"] { display:block!important; margin-bottom:10px!important; background-image:none!important; margin-right:0!important;}

		div[class="column"] { width: auto!important; float:none!important;}

		table.social div[class="column"] {
		width:auto!important;
		}

		}
		</style>

		</head>

		<body bgcolor="#FFFFFF">

		<!-- HEADER -->
		<table class="head-wrap" bgcolor="#003576">
		<tr>
		<td></td>
		<td class="header container" >

		<div class="content">
		<table>
		<tr>

		<td align="left"><h6 class="collapse" style="font-weight: 900; font-size: 14px; text-transform: uppercase; color: #ffffff;">Наталья Мельник психологические услуги</td>
		<td align="right"><h6 class="collapse" style="font-weight: 900; font-size: 14px; text-transform: uppercase; color: #ffffff;">Обратная связь</h6></td>
		</tr>
		</table>
		</div>

		</td>
		<td></td>
		</tr>
		</table>

		<table class="body-wrap">
		<tr>
		<td></td>
		<td class="container" bgcolor="#FFFFFF">

		<div class="content">
		<table>
		<tr>
		<td>
		<!--<h3>Тема сообщения</h3>-->

		<p>'.$comment.'</p>
		<p>Дата записи на консультацию: '.$datepicker.'</p>
		<!-- Callout Panel -->
		<!-- social & contact -->
		<table class="social" width="100%">
		<tr>
		<td>
		<table align="left" class="column">
		<tr>
		<td>

		<h5 class="">Контактная информация:</h5>
		<br/>
		<p>Имя: <strong>'.$name.'</strong></p>
		<p>Email: <strong><a href="emailto: '.$email.'">'.$email.'</a></strong></p>
		</td>
		</tr>
		</table>

		<span class="clear"></span>

		</td>
		</tr>
		</table>

		</td>
		</tr>
		</table>
		</div>

		</td>
		<td></td>
		</tr>
		</table>

		<table class="footer-wrap">
		<tr>
		<td></td>
		<td class="container"></td>
		<td></td>
		</tr>
		</table>

		</body>
		</html>';*/

		$send = mail($address, $email, $mes, $headers);

		if ($send == 'true'){
			$alert = array(
				'status' => 1,
				'message' => 'Ваше сообщение отправлено'
			);
		}else{
			$alert = array(
				'status' => 1,
				'message' => 'Ошибка, сообщение не отправлено!'
			);
		}
	}

	if (isset($_POST['name']) && isset($_POST['tel'])){
		$name = $_POST['name'];
		$tel = $_POST['tel'];

		if ($name == '' || $tel == '') {
			unset($name);
			unset($tel);

			$alert = array(
				'status' => 1,
				'message' => 'Ошибка, сообщение не отправлено! Заполните все поля!'
			);
		}
	}

	echo wp_send_json($alert);

	wp_die();
}
add_action('wp_ajax_QuickForm', 'QuickForm');
add_action('wp_ajax_nopriv_QuickForm', 'QuickForm');


