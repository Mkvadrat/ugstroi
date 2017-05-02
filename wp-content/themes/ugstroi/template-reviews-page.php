<?php
/*
Template name: Reviews page
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

                    <main class="reviews-page">
                        <h2 class="h2-title"><?php the_title(); ?></h2>

                        <?php if (have_posts()): while (have_posts()): the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; endif; ?>
						
						<?php
							define( 'DEFAULT_COMMENTS_PER_PAGE', $GLOBALS['wp_query']->query_vars['comments_per_page']);
							
							$page = (get_query_var('page')) ? get_query_var('page') : 1;
							
							$limit = DEFAULT_COMMENTS_PER_PAGE;
							
							$offset = ($page * $limit) - $limit;
							
							$param = array(
								'status'	=> 'approve',
								'offset'	=> $offset,
								'number'	=> $limit
							);
							
							$total_comments = get_comments(array(
								'orderby' => 'comment_date',
								'order'   => 'ASC',
								'status'  => 'approve',
								'parent'  => 0
							));
							
							$pages = ceil(count($total_comments)/DEFAULT_COMMENTS_PER_PAGE);
							
							$comments = get_comments( $param );
							
							$args = array(
								'base'         => @add_query_arg('page','%#%'),
								'format'       => '?page=%#%',
								'total'        => $pages,
								'current'      => $page,
								'show_all'     => false,
								'mid_size'     => 4,
								'prev_next'    => false,
								//'prev_text'    => __('&laquo; В начало'),
								//'next_text'    => __('В конец &raquo;'),
								'type'         => 'array'
							);
						?>
						
						<?php
						if(!empty($comments)){
						?>
						<ul class="reviews-list">
						<?php
						foreach($comments as $comment){
						
							global $cnum;
							
							// определяем первый номер, если включено разделение на страницы
							$per_page = $limit;
							
							if( $per_page && !isset($cnum) ){
							$com_page = $page;
							
							if($com_page>1)
							$cnum = ($com_page-1)*(int)$per_page;
							}
							
							// считаем
							$cnum = isset($cnum) ? $cnum+1 : 1;
						?>
                            <li>
                                <div class="info-block">
                                    <h3><?php echo get_comment_author($comment->comment_ID); ?></h3>
                                    <p class="date"><?php comment_date('d-m-y'); ?></p>
                                    <p><?php echo $comment->comment_content; ?></p>
                                </div>
                            </li>
                           
						<?php } ?>
                        </ul>

                        <!--<ul class="page-number-list">
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><span>4</span></li>
                            <li><a href="#">5</a></li>
                            <li><em>...</em></li>
                            <li><a href="#">10</a></li>
                        </ul>-->
						
						<?php
							$pagination_pages = paginate_links( $args );
						
							if(!empty($pagination_pages)){
						?>
						<ul class="page-number-list">
						<?php
							foreach ($pagination_pages as $pagination) {
						?>
								<li><?php echo $pagination; ?></li>
						<?php
							}
						?>
						</ul>
						<?php
							}
						 }
						 ?>
						
                        <h2 class="h2-title">Оставить отзыв</h2>

                        <p>Отзыв будет доступен на сайте после модерации</p>
						
							<p id="respond"></p>
							<form class="form" id="commentform">
								<input type="text" name="author" id="author" placeholder="Имя">
								<input type="text" name="phone" id="phone" placeholder="Телефон">
								<input type="text" name="email" id="email" placeholder="Почта">
								<textarea name="comment" id="comment" placeholder="Сообщение"></textarea>
								<?php echo comment_id_fields(); ?>
							</form>
							
							<input class="submit-button" type="submit" onclick="submit()" value="Отправить">
						
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

<script type="text/javascript">
//Отправка данных формы на сервер
function submit(){
	$(".form").submit();
}
</script>

<?php get_footer(); ?>