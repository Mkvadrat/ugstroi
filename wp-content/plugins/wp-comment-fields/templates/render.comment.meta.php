<?php
/**
 * Rendering comment extra fields
 * generated with N-Media plugin
 */

global $nmwpcomment;

$existing_meta = get_option('wpcomment_meta');

//$existing_meta = json_encode($existing_meta);

//wpcomment_pa($existing_meta);

if($existing_meta){

$columns = 0;
echo '<div class="row">';
	foreach($existing_meta as $key => $meta)
		{
			$columns+= $meta['width'];
			
			echo '<div class="col-lg-'.$meta['width'].'">';
			$type 			= $meta['type'];
			$name 			= strtolower( preg_replace("![^a-z0-9]+!i", "_", $meta['data_name']) );
			$field_class 	= (isset($meta['class']) ? $meta['class'] : '');
			$title 			= (isset($meta['title']) ? $meta['title'] : '');
			$p_class		= 'comment-'.$name;
			
			$title = stripslashes( $title );

			if($meta['required'] == 'on'){
				$required = 'true';
				$label = sprintf(__('%s <span class="required">*</span>', 'wp-comments'), $title);
			}else{
				$required = 'false';
				$label = sprintf(__('%s', 'wp-comments'), $title);
			}
			
			

			switch ($type) {

				case 'text':
					
					echo '<p class="'.$p_class.'">';
					echo '<label for="'.$name.'">'.$label.'</label>';
					echo '<input class="form-control" id="'.$name.'" name="'.$name.'" type="text" aria-required="'.$required.'" class="'.$field_class.'">';
					echo '</p>';

					break;

				case 'select':
					
					$options 	= (isset($meta['options']) ? $meta['options'] : '');
					$options 	= explode("\n", $options);

					$selected 	= (isset($meta['selected']) ? $meta['selected'] : '');

					echo '<p class="'.$p_class.'">';
					echo '<label for="'.$name.'">'.$label.'</label>';
					echo '<select class="form-control" name="'.$name.'">';

						foreach ($options as $key) {
							
							$selected_option = ($selected == $key ? 'selected="selected"' : '');
							echo '<option value="'.esc_attr($key).'" '.$selected_option.'>'.esc_attr($key).'</option>';
						}

					echo '</select>';
					echo '</p>';

					break;

				case 'radio':
					
					$options 	= (isset($meta['options']) ? $meta['options'] : '');
					$options 	= explode("\n", $options);

					$selected 	= (isset($meta['selected']) ? $meta['selected'] : '');

					echo '<p class="'.$p_class.'">';
					echo '<label for="'.$name.'">' .$label. ' </label> ';

						foreach ($options as $key=>$value) {
							
							$selected_option = ($selected == $value ? 'selected="selected"' : '');
							echo ' <input name="'.$name.'" id="'.$name.$key.'" type="radio" value="'.esc_attr($value).'" '.$selected_option.' /><label style="display:inline;" for="'.$name.$key.'"> '.esc_attr($value).' &nbsp;</label>';
						}

					echo '</p>';

					break;

				case 'checkbox':
					
					$options 	= (isset($meta['options']) ? $meta['options'] : '');
					$options 	= explode("\n", $options);

					$selected 	= (isset($meta['selected']) ? $meta['selected'] : '');

					echo '<p class="'.$p_class.'">';
					echo '<label for="'.$name.'"> ' .$label. ' </label>';

						foreach ($options as $key=>$value) {
							// var_dump($key);
							$selected_option = ($selected == $value ? 'selected="selected"' : '');
							echo ' <input name="'.$name.'" id="'.$name.$key.'" type="checkbox" value="'.esc_attr($value).'" '.$selected_option.' /><label style="display:inline;" for="'.$name.$key.'"> '.esc_attr($value).'  &nbsp;</label>';
						}

					echo '</p>';

					break;
			}
			echo '</div>';
			if ($columns == 12) {
				echo '</div><div class="row">';
			}
		}
		
		
		echo '</div>';

}

