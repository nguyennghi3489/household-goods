<?php
//Shortcodes for Visual Composer
add_action( 'vc_before_init', 'debaco_vc_shortcodes' );
function debaco_vc_shortcodes() { 
	//Site logo
	vc_map( array(
		'name' => esc_html__( 'Logo', 'debaco'),
		'description' => __( 'Insert logo image', 'debaco' ),
		'base' => 'roadlogo',
		'class' => '',
		'category' => esc_html__( 'Theme', 'debaco'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params' => array(
			array(
				'type'       => 'attach_image',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Upload logo image', 'debaco' ),
				'description'=> esc_html__( 'Note: For retina screen, logo image size is at least twice as width and height (width is set below) to display clearly', 'debaco' ),
				'param_name' => 'logo_image',
				'value'      => '',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Insert logo link or not', 'debaco' ),
				'param_name' => 'logo_link',
				'value'      => array(
					'Yes'	=> 'yes',
					'No'	=> 'no',
				),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => __( 'Logo width (unit: px)', 'debaco' ),
				'description'=> esc_html__( 'Insert number. Leave blank if you want to use original image size', 'debaco' ),
				'param_name' => 'logo_width',
				'value'      => esc_html__( '150', 'debaco' ),
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'debaco' ),
				'param_name' => 'style',
				'value'      => array(
					__( 'Style 1', 'debaco' )  => 'style1',
					__( 'Style 2', 'debaco' )  => 'style2',
				),
			),
		)
	) );
	//Main Menu
	vc_map( array(
		'name'        => esc_html__( 'Main Menu', 'debaco'),
		'description' => __( 'Set Primary Menu in Apperance - Menus - Manage Locations', 'debaco' ),
		'base'        => 'roadmainmenu',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'debaco'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'holder'      => 'div',
				'class'       => '',
				'heading'     => __( 'Set Primary Menu in Apperance - Menus - Manage Locations', 'debaco' ),
				'description' => esc_html__( 'More settings in Theme Options - Main Menu', 'debaco' ),
				'param_name'  => 'no_settings',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'debaco' ),
				'param_name' => 'style',
				'value'      => array(
					__( 'Style 1', 'debaco' )  => 'style1',
					__( 'Style 2', 'debaco' )  => 'style2',
				),
			),
		),
	) );
	//Sticky Menu
	vc_map( array(
		'name'        => esc_html__( 'Sticky Menu', 'debaco'),
		'description' => __( 'Set Sticky Menu in Apperance - Menus - Manage Locations', 'debaco' ),
		'base'        => 'roadstickymenu',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'debaco'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'holder'      => 'div',
				'class'       => '',
				'heading'     => __( 'Set Sticky Menu in Apperance - Menus - Manage Locations', 'debaco' ),
				'description' => esc_html__( 'More settings in Theme Options - Main Menu', 'debaco' ),
				'param_name'  => 'no_settings',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Style', 'debaco' ),
				'param_name' => 'style',
				'value'      => array(
					__( 'Style 1', 'debaco' )  => 'style1',
					__( 'Style 2', 'debaco' )  => 'style2',
				),
			),
		),
	) );
	//Mobile Menu
	vc_map( array(
		'name'        => esc_html__( 'Mobile Menu', 'debaco'),
		'description' => __( 'Set Mobile Menu in Apperance - Menus - Manage Locations', 'debaco' ),
		'base'        => 'roadmobilemenu',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'debaco'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'holder'      => 'div',
				'class'       => '',
				'heading'     => __( 'Set Mobile Menu in Apperance - Menus - Manage Locations', 'debaco' ),
				'description' => esc_html__( 'More settings in Theme Options - Main Menu', 'debaco' ),
				'param_name'  => 'no_settings',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Style', 'debaco' ),
				'param_name' => 'style',
				'value'      => array(
					__( 'Style 1', 'debaco' )  => 'style1',
					__( 'Style 2', 'debaco' )  => 'style2',
				),
			),
		),
	) );
	//Categories Menu
	vc_map( array(
		'name'        => esc_html__( 'Categories Menu', 'debaco'),
		'description' => __( 'Set Categories Menu in Apperance - Menus - Manage Locations', 'debaco' ),
		'base'        => 'roadcategoriesmenu',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'debaco'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'holder'      => 'div',
				'class'       => '',
				'heading'     => __( 'Set Categories Menu in Apperance - Menus - Manage Locations', 'debaco' ),
				'description' => esc_html__( 'More settings in Theme Options - Categories Menu', 'debaco' ),
				'param_name'  => 'no_settings',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => __( 'Show full Categories in home page ?', 'debaco' ),
				'description' => esc_html__( 'In inner pages, it only shows the toogle', 'debaco' ),
				'param_name' => 'categories_show_home',
				'value'      => array(
					__( 'No', 'debaco' )  => 'false',
					__( 'Yes', 'debaco' ) => 'true',
				),
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'debaco' ),
				'param_name' => 'style',
				'value'      => array(
					__( 'Style 1', 'debaco' )  => 'style1',
					__( 'Style 2', 'debaco' )  => 'style2',
				),
			),
		),
	) );
	//Social Icons
	vc_map( array(
		'name'        => esc_html__( 'Social Icons', 'debaco'),
		'description' => __( 'Configure icons and links in Theme Options', 'debaco' ),
		'base'        => 'roadsocialicons',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'debaco'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'holder'     => 'div',
				'class'      => '',
				'heading'    => __( 'Configure icons and links in Theme Options > Social Icons', 'debaco' ),
				'param_name' => 'no_settings',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'debaco' ),
				'param_name' => 'style',
				'value'      => array(
					__( 'Style 1', 'debaco' )  => 'style1',
				),
			),
		),
	) );
	//Mini Cart
	vc_map( array(
		'name'        => esc_html__( 'Mini Cart', 'debaco'),
		'description' => __( 'Mini Cart', 'debaco' ),
		'base'        => 'roadminicart',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'debaco'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'debaco' ),
				'param_name' => 'style',
				'value'      => array(
					__( 'Style 1', 'debaco' )  => 'style1',
					__( 'Style 2', 'debaco' )  => 'style2',
					__( 'Style 3', 'debaco' )  => 'style3',
				),
			),
		),
	) );
	//Wishlist
	vc_map( array(
		'name'        => esc_html__( 'Wishlist', 'debaco'),
		'description' => __( 'Wishlist', 'debaco' ),
		'base'        => 'roadwishlist',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'debaco'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'debaco' ),
				'param_name' => 'style',
				'value'      => array(
					__( 'Style 1', 'debaco' )  => 'style1',
					__( 'Style 2', 'debaco' )  => 'style2',
				),
			),
		),
	) );
	//Products Search without dropdown
	vc_map( array(
		'name'        => esc_html__( 'Product Search (No dropdown)', 'debaco'),
		'description' => __( 'Product Search (No dropdown)', 'debaco' ),
		'base'        => 'roadproductssearch',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'debaco'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'debaco' ),
				'param_name' => 'style',
				'value'      => array(
					__( 'Style 1', 'debaco' )  => 'style1',
					__( 'Style 2', 'debaco' )  => 'style2',
					__( 'Style 3', 'debaco' )  => 'style3',
				),
			),
		),
	) );
	//Products Search with dropdown
	vc_map( array(
		'name'        => esc_html__( 'Product Search (Dropdown)', 'debaco'),
		'description' => __( 'Product Search (Dropdown)', 'debaco' ),
		'base'        => 'roadproductssearchdropdown',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'debaco'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'holder'     => 'div',
				'class'      => '',
				'heading'    => __( 'This widget does not have settings', 'debaco' ),
				'param_name' => 'no_settings',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'debaco' ),
				'param_name' => 'style',
				'value'      => array(
					__( 'Style 1', 'debaco' )  => 'style1',
				),
			),
		),
	) );
	//Image slider
	vc_map( array(
		'name'        => esc_html__( 'Image slider', 'debaco' ),
		'description' => __( 'Upload images and links in Theme Options', 'debaco' ),
		'base'        => 'image_slider',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'debaco'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Number of rows', 'debaco' ),
				'param_name' => 'rows',
				'value'      => array(
					'1'	=> '1',
					'2'	=> '2',
					'3'	=> '3',
					'4'	=> '4',
					'5'	=> '5',
					'6'	=> '6',
				),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Number of columns (screen: over 1500px)', 'debaco' ),
				'param_name' => 'items_1500up',
				'group'      => __( 'Slider Options', 'debaco' ),
				'value'      => esc_html__( '4', 'debaco' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Number of columns (screen: 1200px - 1499px)', 'debaco' ),
				'param_name' => 'items_1200_1499',
				'group'      => __( 'Slider Options', 'debaco' ),
				'value'      => esc_html__( '4', 'debaco' ),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => __( 'Number of columns (screen: 992px - 1199px)', 'debaco' ),
				'param_name' => 'items_992_1199',
				'value'      => esc_html__( '4', 'debaco' ),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => __( 'Number of columns (screen: 768px - 991px)', 'debaco' ),
				'param_name' => 'items_768_991',
				'value'      => esc_html__( '3', 'debaco' ),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => __( 'Number of columns (screen: 640px - 767px)', 'debaco' ),
				'param_name' => 'items_640_767',
				'value'      => esc_html__( '2', 'debaco' ),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => __( 'Number of columns (screen: 480px - 639px)', 'debaco' ),
				'param_name' => 'items_480_639',
				'value'      => esc_html__( '2', 'debaco' ),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => __( 'Number of columns (screen: under 479px)', 'debaco' ),
				'param_name' => 'items_0_479',
				'value'      => esc_html__( '1', 'debaco' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Navigation', 'debaco' ),
				'param_name' => 'navigation',
				'value'      => array(
					__( 'Yes', 'debaco' ) => true,
					__( 'No', 'debaco' )  => false,
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Pagination', 'debaco' ),
				'param_name' => 'pagination',
				'value'      => array(
					__( 'No', 'debaco' )  => false,
					__( 'Yes', 'debaco' ) => true,
				),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Item Margin (unit: pixel)', 'debaco' ),
				'param_name' => 'item_margin',
				'value'      => 30,
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Slider speed number (unit: second)', 'debaco' ),
				'param_name' => 'speed',
				'value'      => '500',
			),
			array(
				'type'       => 'checkbox',
				'value'      => true,
				'heading'    => __( 'Slider loop', 'debaco' ),
				'param_name' => 'loop',
			),
			array(
				'type'       => 'checkbox',
				'value'      => true,
				'heading'    => __( 'Slider Auto', 'debaco' ),
				'param_name' => 'auto',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Style', 'debaco' ),
				'param_name' => 'style',
				'value'      => array(
					__( 'Style 1', 'debaco' )  => 'style1',
				),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Navigation style', 'debaco' ),
				'param_name'  => 'navigation_style',
				'value'       => array(
					__( 'Navigation top-right', 'debaco' )          => 'navigation-style1',
					__( 'Navigation center horizontal', 'debaco' )  => 'navigation-style2',
				),
			),
		),
	) );
	//Brand logos
	vc_map( array(
		'name'        => esc_html__( 'Brand Logos', 'debaco' ),
		'description' => __( 'Upload images and links in Theme Options', 'debaco' ),
		'base'        => 'ourbrands',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'debaco'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Number of rows', 'debaco' ),
				'param_name' => 'rows',
				'value'      => array(
					'1'	=> '1',
					'2'	=> '2',
					'3'	=> '3',
					'4'	=> '4',
				),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'heading'    => __( 'Number of columns (screen: over 1500px)', 'debaco' ),
				'param_name' => 'items_1500up',
				'value'      => esc_html__( '5', 'debaco' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Number of columns (screen: 1200px - 1499px)', 'debaco' ),
				'param_name' => 'items_1200_1499',
				'value'      => esc_html__( '5', 'debaco' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Number of columns (screen: 992px - 1199px)', 'debaco' ),
				'param_name' => 'items_992_1199',
				'value'      => esc_html__( '5', 'debaco' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Number of columns (screen: 768px - 991px)', 'debaco' ),
				'param_name' => 'items_768_991',
				'value'      => esc_html__( '4', 'debaco' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Number of columns (screen: 640px - 767px)', 'debaco' ),
				'param_name' => 'items_640_767',
				'value'      => esc_html__( '3', 'debaco' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Number of columns (screen: 480px - 639px)', 'debaco' ),
				'param_name' => 'items_480_639',
				'value'      => esc_html__( '2', 'debaco' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Number of columns (screen: under 479px)', 'debaco' ),
				'param_name' => 'items_0_479',
				'value'      => esc_html__( '1', 'debaco' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Navigation', 'debaco' ),
				'param_name' => 'navigation',
				'value'      => array(
					__( 'Yes', 'debaco' ) => true,
					__( 'No', 'debaco' )  => false,
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Pagination', 'debaco' ),
				'param_name' => 'pagination',
				'value'      => array(
					__( 'No', 'debaco' )  => false,
					__( 'Yes', 'debaco' ) => true,
				),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Item Margin (unit: pixel)', 'debaco' ),
				'param_name' => 'item_margin',
				'value'      => 0,
			),
			array(
				'type'       => 'textfield',
				'heading'    =>  __( 'Slider speed number (unit: second)', 'debaco' ),
				'param_name' => 'speed',
				'value'      => '500',
			),
			array(
				'type'       => 'checkbox',
				'value'      => true,
				'heading'    => __( 'Slider loop', 'debaco' ),
				'param_name' => 'loop',
			),
			array(
				'type'       => 'checkbox',
				'value'      => true,
				'heading'    => __( 'Slider Auto', 'debaco' ),
				'param_name' => 'auto',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'heading'    => esc_html__( 'Style', 'debaco' ),
				'param_name' => 'style',
				'value'      => array(
					__( 'Style 1', 'debaco' )       => 'style1',
				),
			),
			array(
				'type'        => 'dropdown',
				'holder'     => 'div',
				'heading'     => esc_html__( 'Navigation style', 'debaco' ),
				'param_name'  => 'navigation_style',
				'value'       => array(
					__( 'Navigation center horizontal', 'debaco' )  => 'navigation-style1',
					__( 'Navigation top-right', 'debaco' )          => 'navigation-style2',
				),
			),
		),
	) );
	//Latest posts
	vc_map( array(
		'name'        => esc_html__( 'Latest posts', 'debaco' ),
		'description' => __( 'List posts', 'debaco' ),
		'base'        => 'latestposts',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'debaco'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Number of posts', 'debaco' ),
				'param_name' => 'posts_per_page',
				'value'      => esc_html__( '10', 'debaco' ),
			),
			array(
				'type'        => 'textfield',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Category', 'debaco' ),
				'param_name'  => 'category',
				'value'       => esc_html__( '0', 'debaco' ),
				'description' => esc_html__( 'Slug of the category (example: slug-1, slug-2). Default is 0 : show all posts', 'debaco' ),
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Image scale', 'debaco' ),
				'param_name' => 'image',
				'value'      => array(
					'Wide'	=> 'wide',
					'Square'=> 'square',
				),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Excerpt length', 'debaco' ),
				'param_name' => 'length',
				'value'      => esc_html__( '20', 'debaco' ),
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Number of columns', 'debaco' ),
				'param_name' => 'colsnumber',
				'value'      => array(
					'1'	=> '1',
					'2'	=> '2',
					'3'	=> '3',
					'4'	=> '4',
					'5'	=> '5',
					'6'	=> '6',
				),
			),
			array(
				'type'        => 'dropdown',
				'holder'     => 'div',
				'heading'     => esc_html__( 'Style', 'debaco' ),
				'param_name'  => 'style',
				'value'       => array(
					__( 'Style 1', 'debaco' )           => 'style1',
					__( 'Style 2 (footer)', 'debaco' )  => 'style2',
				),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => __( 'Enable slider', 'debaco' ),
				'param_name'  => 'enable_slider',
				'value'       => true,
				'save_always' => true, 
				'group'       => __( 'Slider Options', 'debaco' ),
			),
			array(
				'type'       => 'dropdown',
				'class'      => '',
				'heading'    => esc_html__( 'Number of rows', 'debaco' ),
				'param_name' => 'rowsnumber',
				'group'      => __( 'Slider Options', 'debaco' ),
				'value'      => array(
						'1'	=> '1',
						'2'	=> '2',
						'3'	=> '3',
						'4'	=> '4',
					),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Number of columns (screen: 1200px - 1499px)', 'debaco' ),
				'param_name' => 'items_1200_1499',
				'group'      => __( 'Slider Options', 'debaco' ),
				'value'      => esc_html__( '3', 'debaco' ),
			),
			array(
				'type'       => 'textfield',
				'class'      => '',
				'heading'    => __( 'Number of columns (screen: 992px - 1199px)', 'debaco' ),
				'param_name' => 'items_992_1199',
				'value'      => esc_html__( '3', 'debaco' ),
				'group'      => __( 'Slider Options', 'debaco' ),
			),
			array(
				'type'       => 'textfield',
				'class'      => '',
				'heading'    => __( 'Number of columns (screen: 768px - 991px)', 'debaco' ),
				'param_name' => 'items_768_991',
				'value'      => esc_html__( '3', 'debaco' ),
				'group'      => __( 'Slider Options', 'debaco' ),
			),
			array(
				'type'       => 'textfield',
				'class'      => '',
				'heading'    => __( 'Number of columns (screen: 640px - 767px)', 'debaco' ),
				'param_name' => 'items_640_767',
				'value'      => esc_html__( '2', 'debaco' ),
				'group'      => __( 'Slider Options', 'debaco' ),
			),
			array(
				'type'       => 'textfield',
				'class'      => '',
				'heading'    => __( 'Number of columns (screen: 480px - 639px)', 'debaco' ),
				'param_name' => 'items_480_639',
				'value'      => esc_html__( '2', 'debaco' ),
				'group'      => __( 'Slider Options', 'debaco' ),
			),
			array(
				'type'       => 'textfield',
				'class'      => '',
				'heading'    => __( 'Number of columns (screen: under 479px)', 'debaco' ),
				'param_name' => 'items_0_479',
				'value'      => esc_html__( '1', 'debaco' ),
				'group'      => __( 'Slider Options', 'debaco' ),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Navigation', 'debaco' ),
				'param_name'  => 'navigation',
				'save_always' => true,
				'group'       => __( 'Slider Options', 'debaco' ),
				'value'       => array(
					__( 'Yes', 'debaco' ) => true,
					__( 'No', 'debaco' )  => false,
				),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Pagination', 'debaco' ),
				'param_name'  => 'pagination',
				'save_always' => true,
				'group'       => __( 'Slider Options', 'debaco' ),
				'value'       => array(
					__( 'No', 'debaco' )  => false,
					__( 'Yes', 'debaco' ) => true,
				),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Item Margin (unit: pixel)', 'debaco' ),
				'param_name'  => 'item_margin',
				'value'       => 30,
				'save_always' => true,
				'group'       => __( 'Slider Options', 'debaco' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Slider speed number (unit: second)', 'debaco' ),
				'param_name'  => 'speed',
				'value'       => '500',
				'save_always' => true,
				'group'       => __( 'Slider Options', 'debaco' ),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => __( 'Slider loop', 'debaco' ),
				'param_name'  => 'loop',
				'value'       => true,
				'group'       => __( 'Slider Options', 'debaco' ),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => __( 'Slider Auto', 'debaco' ),
				'param_name'  => 'auto',
				'value'       => true,
				'group'       => __( 'Slider Options', 'debaco' ),
			),
			array(
				'type'        => 'dropdown',
				'holder'      => 'div',
				'heading'     => esc_html__( 'Navigation style', 'debaco' ),
				'param_name'  => 'navigation_style',
				'group'       => __( 'Slider Options', 'debaco' ),
				'value'       => array(
					__( 'Navigation center horizontal', 'debaco' )  => 'navigation-style1',
					__( 'Navigation top-right', 'debaco' )          => 'navigation-style2',
				),
			),
		),
	) );
	//Testimonials
	vc_map( array(
		'name'        => esc_html__( 'Testimonials', 'debaco' ),
		'description' => __( 'Testimonial slider', 'debaco' ),
		'base'        => 'testimonials',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'debaco'),
		"icon"     	  => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Number of testimonial', 'debaco' ),
				'param_name' => 'limit',
				'value'      => esc_html__( '10', 'debaco' ),
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Display Author', 'debaco' ),
				'param_name' => 'display_author',
				'value'      => array(
					'Yes'	=> '1',
					'No'	=> '0',
				),
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Display Avatar', 'debaco' ),
				'param_name' => 'display_avatar',
				'value'      => array(
					'Yes'=> '1',
					'No' => '0',
				),
			),
			array(
				'type'        => 'textfield',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Avatar image size', 'debaco' ),
				'param_name'  => 'size',
				'value'       => '150',
				'description' => esc_html__( 'Avatar image size in pixels. Default is 150', 'debaco' ),
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Display URL', 'debaco' ),
				'param_name' => 'display_url',
				'value'      => array(
					'Yes'	=> '1',
					'No'	=> '0',
				),
			),
			array(
				'type'        => 'textfield',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Category', 'debaco' ),
				'param_name'  => 'category',
				'value'       => esc_html__( '0', 'debaco' ),
				'description' => esc_html__( 'Slug of the category. Default is 0 : show all testimonials', 'debaco' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Navigation', 'debaco' ),
				'param_name' => 'navigation',
				'value'      => array(
					__( 'No', 'debaco' )  => false,
					__( 'Yes', 'debaco' ) => true,
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Pagination', 'debaco' ),
				'param_name' => 'pagination',
				'value'      => array(
					__( 'Yes', 'debaco' ) => true,
					__( 'No', 'debaco' )  => false,
				),
			),
			array(
				'type'       => 'textfield',
				'heading'    =>  __( 'Slider speed number (unit: second)', 'debaco' ),
				'param_name' => 'speed',
				'value'      => '500',
			),
			array(
				'type'       => 'checkbox',
				'value'      => true,
				'heading'    => __( 'Slider loop', 'debaco' ),
				'param_name' => 'loop',
			),
			array(
				'type'       => 'checkbox',
				'value'      => true,
				'heading'    => __( 'Slider Auto', 'debaco' ),
				'param_name' => 'auto',
			),
			array(
				'type'        => 'dropdown',
				'holder'      => 'div',
				'heading'     => esc_html__( 'Style', 'debaco' ),
				'param_name'  => 'style',
				'value'       => array(
					__( 'Style 1', 'debaco' )                => 'style1',
					__( 'Style 2 (about page)', 'debaco' )   => 'style-about-page',
				),
			),
			array(
				'type'        => 'dropdown',
				'holder'      => 'div',
				'heading'     => esc_html__( 'Navigation style', 'debaco' ),
				'param_name'  => 'navigation_style',
				'value'       => array(
					__( 'Navigation top-right', 'debaco' )          => 'navigation-style1',
					__( 'Navigation center horizontal', 'debaco' )  => 'navigation-style2',
				),
			),
		),
	) );
	//Counter
	vc_map( array(
		'name'     => esc_html__( 'Counter', 'debaco' ),
		'description' => __( 'Counter', 'debaco' ),
		'base'     => 'debaco_counter',
		'class'    => '',
		'category' => esc_html__( 'Theme', 'debaco'),
		"icon"     => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'   => array(
			array(
				'type'        => 'attach_image',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Image icon', 'debaco' ),
				'param_name'  => 'image',
				'value'       => '',
				'description' => esc_html__( 'Upload icon image', 'debaco' ),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Number', 'debaco' ),
				'param_name' => 'number',
				'value'      => '',
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Text', 'debaco' ),
				'param_name' => 'text',
				'value'      => '',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'debaco' ),
				'param_name' => 'style',
				'value'      => array(
					__( 'Style 1', 'debaco' )  => 'style1',
				),
			),
		),
	) );
	//Heading title
	vc_map( array(
		'name'     => esc_html__( 'Heading Title', 'debaco' ),
		'description' => __( 'Heading Title', 'debaco' ),
		'base'     => 'roadthemes_title',
		'class'    => '',
		'category' => esc_html__( 'Theme', 'debaco'),
		"icon"     => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'   => array(
			array(
				'type'       => 'textarea',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Heading title element', 'debaco' ),
				'param_name' => 'heading_title',
				'value'      => 'Title',
			),
			array(
				'type'       => 'textarea',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Heading sub-title element', 'debaco' ),
				'param_name' => 'sub_heading_title',
				'value'      => '',
			),
			array(
				'type'       => 'attach_image',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Upload heading title image', 'debaco' ),
				'param_name' => 'heading_image',
				'value'      => '',
			),
			array(
				'type'        => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'     => esc_html__( 'Style', 'debaco' ),
				'param_name'  => 'style',
				'value'       => array(
					__( 'Style 1 (Default)', 'debaco' )             => 'style1',
					__( 'Style 2 (sidebar, smaller)', 'debaco' )    => 'style2',
					__( 'Style 3 (Footer title)', 'debaco' )        => 'style3',
				),
			),
		),
	) );
	//Countdown
	vc_map( array(
		'name'     => esc_html__( 'Countdown', 'debaco' ),
		'description' => __( 'Countdown', 'debaco' ),
		'base'     => 'roadthemes_countdown',
		'class'    => '',
		'category' => esc_html__( 'Theme', 'debaco'),
		"icon"     => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'   => array(
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'End date (day)', 'debaco' ),
				'param_name' => 'countdown_day',
				'value'      => '1',
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'End date (month)', 'debaco' ),
				'param_name' => 'countdown_month',
				'value'      => '1',
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'End date (year)', 'debaco' ),
				'param_name' => 'countdown_year',
				'value'      => '2020',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'debaco' ),
				'param_name' => 'style',
				'value'      => array(
					__( 'Style 1', 'debaco' )  => 'style1',
				),
			),
		),
	) );
	//Mailchimp newsletter
	vc_map( array(
		'name'     => esc_html__( 'Mailchimp Newsletter', 'debaco' ),
		'description' => __( 'Mailchimp Newsletter ', 'debaco' ),
		'base'     => 'roadthemes_newsletter',
		'class'    => '',
		'category' => esc_html__( 'Theme', 'debaco'),
		"icon"     => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'   => array(
			array(
				'type'        => 'textarea',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Newsletter title', 'debaco' ),
				'param_name'  => 'newsletter_title',
				'value'       => '',
			),
			array(
				'type'        => 'textarea',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Newsletter sub-title', 'debaco' ),
				'param_name'  => 'newsletter_sub_title',
				'value'       => '',
			),
			array(
				'type'        => 'attach_image',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Upload newsletter title image', 'debaco' ),
				'param_name'  => 'newsletter_image',
				'value'       => '',
			),
			array(
				'type'        => 'textfield',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Insert id of Mailchimp Form', 'debaco' ),
				'description' => esc_html__( 'See id in admin -> MailChimp for WP -> Form, under the form title', 'debaco' ),
				'param_name'  => 'newsletter_form_id',
				'value'       => '',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'     => esc_html__( 'Style', 'debaco' ),
				'param_name'  => 'style',
				'value'       => array(
					__( 'Style 1 (Default)', 'debaco' )    => 'style1',
					__( 'Style 2', 'debaco' )              => 'style2',
				),
			),
		),
	) );
	//Custom Menu
	$custom_menus = array();
	if ( 'vc_edit_form' === vc_post_param( 'action' ) && vc_verify_admin_nonce() ) {
		$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
		if ( is_array( $menus ) && ! empty( $menus ) ) {
			foreach ( $menus as $single_menu ) {
				if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->term_id ) ) {
					$custom_menus[ $single_menu->name ] = $single_menu->term_id;
				}
			}
		}
	}
	vc_map( array(
		'name'     => esc_html__( 'Custom Menu', 'debaco' ),
		'description' => __( 'Custom Menu', 'debaco' ),
		'base'     => 'roadthemes_menu',
		'class'    => '',
		'category' => esc_html__( 'Theme', 'debaco'),
		"icon"     => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'   => array(
			array(
				'type'       => 'attach_image',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Upload menu image', 'debaco' ),
				'param_name' => 'menu_image',
				'value'      => '',
			),
			array(
				'type'       => 'textarea',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Menu title', 'debaco' ),
				'param_name' => 'menu_title',
				'value'      => 'Title',
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Choose Menu', 'debaco' ),
				'param_name'  => 'nav_menu',
				'value'       => $custom_menus,
				'description' => empty( $custom_menus ) ? __( 'Custom menus not found. Please visit <b>Appearance > Menus</b> page to create new menu.', 'debaco' ) : __( 'Select menu to display.', 'debaco' ),
				'admin_label' => true,
				'save_always' => true,
			),
			array(
				'type'       => 'textarea',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Menu text', 'debaco' ),
				'param_name' => 'menu_text',
				'value'      => '',
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Menu link text', 'debaco' ),
				'param_name' => 'menu_link_text',
				'value'      => '',
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Menu link url', 'debaco' ),
				'param_name' => 'menu_link_url',
				'value'      => '',
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Style', 'debaco' ),
				'param_name'  => 'style',
				'value'       => array(
					__( 'Style 1 (Default)', 'debaco' )    => 'style1',
				),
			),
		),
	) );
}
?>