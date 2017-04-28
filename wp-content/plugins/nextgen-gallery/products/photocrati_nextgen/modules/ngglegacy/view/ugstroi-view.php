<?php 
/**
Template Page for the gallery carousel

Follow variables are useable :

	$gallery     : Contain all about the gallery
	$images      : Contain all images, path, title
	$pagination  : Contain the pagination content
	$current     : Contain the selected image
	$prev/$next  : Contain link to the next/previous gallery page
	

 You can check the content when you insert the tag <?php var_dump($variable) ?>
 If you would like to show the timestamp of the image ,you can use <?php echo $exif['created_timestamp'] ?>
**/
?>

<?php if (!defined ('ABSPATH')) die ('No direct access allowed'); ?>

<?php if (!empty ($images)) : ?>

	<p><strong>Зд визуализация проекта</strong></p>
	
	<div class="slider-block">
		<div class="slider-for">
		<?php foreach ( $images as $image ) : ?>
			<div>
				<img alt="<?php echo esc_attr($image->title) ?>" src="<?php echo nextgen_esc_url($image->thumbnailURL) ?>" />
			</div>
		<?php endforeach; ?>
		</div>
		<p><strong>Планировки</strong></p>
		<div class="slider-nav">
		<?php foreach ( $images as $image ) : ?>
			<div>
				<img title="<?php echo esc_attr($image->alttext) ?>" alt="<?php echo esc_attr($image->alttext) ?>" src="<?php echo nextgen_esc_url($image->thumbnailURL) ?>" />
			</div>
		<?php endforeach; ?>
		</div>
	</div>

	<script type="text/javascript">
		// Слик слайдер
		$('.slider-for').slick({
		  slidesToShow: 1,
		  slidesToScroll: 1,
		  arrows: true,
		  fade: true,
		  asNavFor: '.slider-nav'
		});
		$('.slider-nav').slick({
		  slidesToShow: 3,
		  slidesToScroll: 1,
		  asNavFor: '.slider-for',
		  dots: false,
		  centerMode: true,
		  focusOnSelect: true
		});
	</script>
	
<?php endif; ?>