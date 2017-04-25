
<?php

$this->start_element('nextgen_gallery.gallery_container', 'container', $displayed_gallery);

?>
<div
	class="ngg-galleryoverview<?php if (!intval($ajax_pagination)) echo ' ngg-ajax-pagination-none'; ?>"
	id="ngg-gallery-<?php echo esc_attr($displayed_gallery_id)?>-<?php echo esc_attr($current_page)?>">

    <?php if (!empty($slideshow_link)): ?>
	<div class="slideshowlink">
        <a href='<?php echo esc_attr($slideshow_link) ?>'><?php echo esc_html($slideshow_link_text) ?></a>

	</div>
	<?php endif ?>
	<?php

	$this->start_element('nextgen_gallery.image_list_container', 'container', $images);

	?>
	<!-- Thumbnails -->
	<div class="list-galery">
	<p>
		<?php for ($i=0; $i<count($images); $i++):
		   $image = $images[$i];
		   $thumb_size = $storage->get_image_dimensions($image, $thumbnail_size_name);
		   $style = isset($image->style) ? $image->style : null;
	
		   if (isset($image->hidden) && $image->hidden) {
			  $style = 'style="display: none;"';
		   }
		   else {
				$style = null;
		   }
	
				 $this->start_element('nextgen_gallery.image_panel', 'item', $image);
	
				?>
					<?php
	
					$this->start_element('nextgen_gallery.image', 'item', $image);
	
					?>
				<a class="gallery" rel="group" href="<?php echo esc_attr($storage->get_image_url($image, 'full', TRUE))?>"
				   title="<?php echo esc_attr($image->description)?>"
				   data-src="<?php echo esc_attr($storage->get_image_url($image)); ?>"
				   data-thumbnail="<?php echo esc_attr($storage->get_image_url($image, 'thumb')); ?>"
				   data-image-id="<?php echo esc_attr($image->{$image->id_field}); ?>"
				   data-title="<?php echo esc_attr($image->alttext); ?>"
				   data-description="<?php echo esc_attr(stripslashes($image->description)); ?>"
				   <?php echo $effect_code ?>>
					<img
						title="<?php echo esc_attr($image->alttext)?>"
						alt="<?php echo esc_attr($image->alttext)?>"
						src="<?php echo esc_attr($storage->get_image_url($image, $thumbnail_size_name, TRUE))?>"
						width="<?php echo esc_attr($thumb_size['width'])?>"
						height="<?php echo esc_attr($thumb_size['height'])?>"
						style="max-width:100%;"
					/>
				</a>
					<?php
	
					$this->end_element();
	
					?>
				<?php
	
				$this->end_element();
	
				?>
		<?php endfor ?>
	</p>
	</div>
	<?php

	$this->end_element();

	?>

	<?php if ($pagination): ?>
	<!-- Pagination -->
	<?php echo $pagination ?>
	<?php else: ?>
	<div class="ngg-clear"></div>
	<?php endif ?>
</div>
<?php $this->end_element(); ?>
