<?php

$meatGeneral = array(
						'comment-heading'	=> array(	'label'		=> __('Comment Heading', 'nm-wpcomments'),
							'desc'		=> __('Heading will appear before meta, leave blank for none', 'nm-wpcomments'),
							'id'			=> 'wpcomments'.'_comment_heading',
							'type'			=> 'text',
							'help'			=> '',
						),
						
						'comment-postypes'	=> array(	'label'		=> __('Post types', 'nm-wpcomments'),
							'desc'		=> __('Custom post types separated by commas, leave blank for only posts', 'nm-wpcomments'),
							'id'			=> 'wpcomments'.'_comment_posttypes',
							'type'			=> 'text',
							'help'			=> 'e.g: books, animals',
						),
);
					


$meat_comment_meta = array('comment-meta'	=> array(	
									'desc'		=> $proFeatures,
									'type'		=> 'file',
									'id'		=> 'file-meta.php',
									),
								);

$meat_pro_version = array('pro-version'	=> array(	
									'desc'		=> $proFeatures,
									'type'		=> 'file',
									'id'		=> 'pro.php',
									),
								);								


$this -> the_options = array(
					
					'general-settings'	=> array(	'name'		=> __('General Settings', 'nm-wpcomments'),
							'type'	=> 'tab',
							'desc'	=> __('General settings', 'nm-wpcomments'),
							'meat'	=> $meatGeneral,
							'class'	=> 'pro',
					
					),
					'comment-meta'	=> array(	'name'		=> __('Comment Fields', 'nm-wpcomments'),
							'type'	=> 'tab',
							'desc'	=> __('More field can be attached to Comments', 'nm-wpcomments'),
							'meat'	=> $meat_comment_meta,
							'class'	=> 'pro',
					
					),
					'pro-version'	=> array(	'name'		=> __('PRO Version', 'nm-wpcomments'),
							'type'	=> 'tab',
							'desc'	=>	'',
							'meat'	=> $meat_pro_version,
							'class'	=> 'pro',
					
					),
	
);

//print_r($repo_options);