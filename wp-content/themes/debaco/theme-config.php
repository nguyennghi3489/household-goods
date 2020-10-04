<?php
/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */
if (!class_exists('debaco_Theme_Config')) {
    class debaco_Theme_Config {
        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;
        public function __construct() {
            if (!class_exists('ReduxFramework')) {
                return;
            }
            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }
        }
        public function initSettings() {
            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();
            // Set the default arguments
            $this->setArguments();
            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();
            // Create the sections and fields
            $this->setSections();
            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }
            // If Redux is running as a plugin, this will remove the demo notice and links
            //add_action( 'redux/loaded', array( $this, 'remove_demo' ) );
            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 3);
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));
            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }
        /**
          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field   set with compiler=>true is changed.
         * */
        function compiler_action($options, $css, $changed_values) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r($changed_values); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
        /**
          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.
          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons
         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => esc_html__('Section via hook', 'debaco'),
                'desc' => esc_html__('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'debaco'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );
            return $sections;
        }
        /**
          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;
            return $args;
        }
        /**
          Filter hook for filtering the default value of any given field. Very useful in development mode.
         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';
            return $defaults;
        }
        public function setSections() {
            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();
            ob_start();
            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';
            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'debaco'), $this->theme->display('Name'));
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
                <?php if ($screenshot) : ?>
                    <?php if (current_user_can('edit_theme_options')) : ?>
                            <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                                <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', 'debaco'); ?>" />
                            </a>
                    <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', 'debaco'); ?>" />
                <?php endif; ?>
                <h4><?php echo ''.$this->theme->display('Name'); ?></h4>
                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'debaco'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'debaco'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' .__('Tags', 'debaco') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo ''.$this->theme->display('Description'); ?></p>
                    <?php
                        if ($this->theme->parent()) {
                            printf(' <p class="howto">' .__('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'debaco') . '</p>',__('http://codex.wordpress.org/Child_Themes', 'debaco'), $this->theme->parent()->display('Name'));
                    } ?>
                </div>
            </div>
            <?php
            $item_info = ob_get_contents();
            ob_end_clean();
            $sampleHTML = '';
            // General
            $this->sections[] = array(
                'title'     => esc_html__('General', 'debaco'),
                'desc'      => esc_html__('General theme options', 'debaco'),
                'icon'      => 'el-icon-cog',
                'fields'    => array(
                    array(
                        'id'        => 'background_opt',
                        'type'      => 'background',
                        'output'    => array('body'),
                        'title'     => esc_html__('Body background', 'debaco'),
                        'subtitle'  => esc_html__('Upload image or select color. Only work with box layout', 'debaco'),
                        'default'   => array('background-color' => '#ffffff'),
                    ),
                    array(
                        'id'        => 'page_content_background',
                        'type'      => 'background',
                        'title'     => esc_html__('Page content background', 'debaco'),
                        'subtitle'  => esc_html__('Select background for page content.', 'debaco'),
                        'default'   => array('background-color' => '#ffffff'),
                    ),
                    array( 
                        'id'       => 'border_color',
                        'type'     => 'border',
                        'title'    => esc_html__('Border Option', 'debaco'),
                        'subtitle' => esc_html__('Only color validation can be done on this field type', 'debaco'),
                        'default'  => array('border-color' => '#f0f0f0'),
                    ), 
                    array(
                        'id'        => 'back_to_top',
                        'type'      => 'switch',
                        'title'     => esc_html__('Back To Top', 'debaco'),
                        'desc'      => esc_html__('Show back to top button on all pages', 'debaco'),
                        'default'   => true,
                    ),
                    array(
                        'id'        => 'row_space',
                        'type'      => 'text',
                        'title'     => esc_html__('Row space', 'debaco'),
                        'desc'      => esc_html__('Space between row (example: 50px).', 'debaco'),
                        "default"   => '60px',
                        'display_value' => 'text',
                    ),
                    array(
                        'id'        => 'carousel_topright_position',
                        'type'      => 'text',
                        'title'     => esc_html__('Top position of carousel top right', 'debaco'),
                        'desc'      => esc_html__('When you add more element to Heading title, you can change position of navigation top right (example: 50px).', 'debaco'),
                        "default"   => '52px',
                        'display_value' => 'text',
                    ),
                ),
            );
            // Colors
            $this->sections[] = array(
                'title'     => esc_html__('Colors', 'debaco'),
                'desc'      => esc_html__('Color options', 'debaco'),
                'icon'      => 'el-icon-tint',
                'fields'    => array(
                    array(
                        'id'          => 'primary_color',
                        'type'        => 'color',
                        'title'       => esc_html__('Primary Color', 'debaco'),
                        'subtitle'    => esc_html__('Pick a color for primary color.', 'debaco'),
                        'transparent' => false,
                        'default'     => '#cc2121',
                        'validate'    => 'color',
                    ),
                    
                    array(
                        'id'          => 'sale_color',
                        'type'        => 'color',
                        //'output'    => array(),
                        'title'       => esc_html__('Sale Label BG Color', 'debaco'),
                        'subtitle'    => esc_html__('Pick a color for bg sale label.', 'debaco'),
                        'transparent' => true,
                        'default'     => '#cc2121',
                        'validate'    => 'color',
                    ),
                    
                    array(
                        'id'          => 'saletext_color',
                        'type'        => 'color',
                        //'output'    => array(),
                        'title'       => esc_html__('Sale Label Text Color', 'debaco'),
                        'subtitle'    => esc_html__('Pick a color for sale label text.', 'debaco'),
                        'transparent' => false,
                        'default'     => '#ffffff',
                        'validate'    => 'color',
                    ),
                    
                    array(
                        'id'          => 'rate_color',
                        'type'        => 'color',
                        //'output'    => array(),
                        'title'       => esc_html__('Rating Star Color', 'debaco'),
                        'subtitle'    => esc_html__('Pick a color for star of rating.', 'debaco'),
                        'transparent' => false,
                        'default'     => '#cc2121',
                        'validate'    => 'color',
                    ),
                    array(
                        'id'          => 'link_color',
                        'type'        => 'link_color',
                        //'output'    => array('a'),
                        'title'       => esc_html__('Link Color', 'debaco'),
                        'subtitle'    => esc_html__('Pick a color for link.', 'debaco'),
                        'default'     => array(
                            'regular'  => '#5a5a5a',
                            'hover'    => '#cc2121',
                            'active'   => '#cc2121',
                            'visited'  => '#cc2121',
                        )
                    ),
                    array(
                        'id'          => 'text_selected_bg',
                        'type'        => 'color',
                        'title'       => esc_html__('Text selected background', 'debaco'),
                        'subtitle'    => esc_html__('Select background for selected text.', 'debaco'),
                        'transparent' => false,
                        'default'     => '#91b2c3',
                        'validate'    => 'color',
                    ),
                    array(
                        'id'          => 'text_selected_color',
                        'type'        => 'color',
                        'title'       => esc_html__('Text selected color', 'debaco'),
                        'subtitle'    => esc_html__('Select color for selected text.', 'debaco'),
                        'transparent' => false,
                        'default'     => '#ffffff',
                        'validate'    => 'color',
                    ),
                ),
            );
            //Header
            $header_layouts = array();
            $header_mobile_layouts = array();
            $header_sticky_layouts = array();
            $header_default = '';
            $header_mobile_default = '';
            $header_sticky_default = '';
            $jscomposer_templates_args = array(
                'orderby'          => 'title',
                'order'            => 'ASC',
                'post_type'        => 'templatera',
                'post_status'      => 'publish',
                'posts_per_page'   => 30,
            );
            $jscomposer_templates = get_posts( $jscomposer_templates_args );
            if(count($jscomposer_templates) > 0) {
                foreach($jscomposer_templates as $jscomposer_template){
                    $header_layouts[$jscomposer_template->post_title] = $jscomposer_template->post_title;
                    $header_mobile_layouts[$jscomposer_template->post_title] = $jscomposer_template->post_title;
                    $header_sticky_layouts[$jscomposer_template->post_title] = $jscomposer_template->post_title;
                }
                $header_default = 'Header 1';
                $header_mobile_default = 'Header Mobile';
                $header_sticky_default = 'Header Sticky';
            }
            $this->sections[] = array(
                'title'     => esc_html__('Header', 'debaco'),
                'desc'      => esc_html__('Header options', 'debaco'),
                'icon'      => 'el-icon-tasks',
                'fields'    => array(

                    array(
                        'id'                => 'header_layout',
                        'type'              => 'select',
                        'title'             => esc_html__('Header Layout', 'debaco'),
                        'customizer_only'   => false,
                        'desc'              => esc_html__('Go to WPBakery Page Builder => Templates to create/edit layout', 'debaco'),
                        //Must provide key  => value pairs for select options
                        'options'           => $header_layouts,
                        'default'           => $header_default,
                    ),
                    array(
                        'id'        => 'header_mobile_layout',
                        'type'      => 'select',
                        'title'     => esc_html__('Header Mobile Layout', 'debaco'),
                        'customizer_only'   => false,
                        'desc'      => esc_html__('Go to WPBakery Page Builder => Templates to create/edit layout', 'debaco'),
                        //Must provide key => value pairs for select options
                        'options'   => $header_mobile_layouts,
                        'default'   => $header_mobile_default,
                    ),
                    array(
                        'id'        => 'header_bg',
                        'type'      => 'color',
                        'output'    => array(), 
                        'title'     => esc_html__('Header background', 'debaco'),
                        'subtitle'  => esc_html__('Pick a color for header background.', 'debaco'), 
                        'default'   => '#ffffff',
                        'validate'  => 'color',
                    ),
                    array(
                        'id'          => 'header_color',
                        'type'        => 'color',
                        'title'       => esc_html__('Header text color', 'debaco'),
                        'subtitle'    => esc_html__('Pick a color for header color.', 'debaco'),
                        'transparent' => false,
                        'default'     => '#171e26',
                        'validate'    => 'color',
                    ),
                    array(
                        'id'        => 'header_link_color',
                        'type'      => 'link_color',
                        'title'     => esc_html__('Header link color', 'debaco'),
                        'subtitle'  => esc_html__('Pick a color for header link color.', 'debaco'),
                        'default'   => array(
                            'regular'  => '#171e26',
                            'hover'    => '#cc2121',
                            'active'   => '#cc2121',
                            'visited'  => '#cc2121',
                        )
                    ),
                    array(
                        'id'          => 'dropdown_bg',
                        'type'        => 'color',
                        //'output'    => array(),
                        'title'       => esc_html__('Dropdown menu background', 'debaco'),
                        'subtitle'    => esc_html__('Pick a color for dropdown menu background.', 'debaco'),
                        'transparent' => false,
                        'default'     => '#ffffff',
                        'validate'    => 'color',
                    ),
                ),
            );
            $this->sections[] = array(
                'icon'       => 'el-icon-website',
                'title'      => esc_html__( 'Sticky header', 'debaco' ),
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'        => 'sticky_header',
                        'type'      => 'switch',
                        'title'     => esc_html__('Use sticky header', 'debaco'),
                        'default'   => true,
                    ),
                    array(
                        'id'        => 'header_sticky_bg',
                        'type'      => 'color_rgba',
                        'title'     => esc_html__('Header sticky background', 'debaco'),
                        'subtitle'  => 'Set color and alpha channel',
                        'default'   => array(
                            'color'     => '#ffffff',
                            'alpha'     => 0.95,
                        ),
                        'options'       => array(
                            'show_input'                => true,
                            'show_initial'              => true,
                            'show_alpha'                => true,
                            'show_palette'              => true,
                            'show_palette_only'         => false,
                            'show_selection_palette'    => true,
                            'max_palette_size'          => 10,
                            'allow_empty'               => true,
                            'clickout_fires_change'     => false,
                            'choose_text'               => 'Choose',
                            'cancel_text'               => 'Cancel',
                            'show_buttons'              => true,
                            'use_extended_classes'      => true,
                            'palette'                   => null,
                            'input_text'                => 'Select Color'
                        ),                        
                    ),
                    array(
                        'id'                => 'header_sticky_layout',
                        'type'              => 'select',
                        'title'             => esc_html__('Header Sticky Layout', 'debaco'),
                        'customizer_only'   => false,
                        'desc'              => esc_html__('Go to Visual Composer => Templates to create/edit layout', 'debaco'),
                        //Must provide key  => value pairs for select options
                        'options'           => $header_sticky_layouts,
                        'default'           => $header_sticky_default,
                    ),
                )
            );
            $this->sections[] = array(
                'icon'       => 'el-icon-website',
                'title'      => esc_html__( 'Top Bar', 'debaco' ),
                'subsection' => true,
                'fields'     => array(
                    
                    array(
                        'id'          => 'topbar_color',
                        'type'        => 'color',
                        'output'      => array('.top-bar'),
                        'title'       => esc_html__('Top bar text color', 'debaco'),
                        'subtitle'    => esc_html__('Pick a color for top bar text color.', 'debaco'),
                        'transparent' => false,
                        'default'     => '#242424',
                        'validate'    => 'color',
                    ),
                    array(
                        'id'        => 'topbar_link_color',
                        'type'      => 'link_color',
                        'output'    => array('.top-bar a'),
                        'title'     => esc_html__('Top bar link color', 'debaco'),
                        'subtitle'  => esc_html__('Pick a color for top bar link color .', 'debaco'),
                        'default'   => array(
                            'regular'  => '#242424',
                            'hover'    => '#cc2121',
                            'active'   => '#cc2121',
                            'visited'  => '#cc2121',
                        )
                    ), 
                )
            );
            $this->sections[] = array(
                'icon'       => 'el-icon-website',
                'title'      => esc_html__( 'Main Menu', 'debaco' ),
                'fields'     => array(
                    array(
                        'id'        => 'mobile_menu_label',
                        'type'      => 'text',
                        'title'     => esc_html__('Mobile menu label', 'debaco'),
                        'subtitle'  => esc_html__('The label for mobile menu (example: Menu, Go to...', 'debaco'),
                        'default'   => 'Menu'
                    ), 
                    array(
                        'id'          => 'sub_menu_bg',
                        'type'        => 'color',
                        //'output'    => array(),
                        'title'       => esc_html__('Submenu background', 'debaco'),
                        'subtitle'    => esc_html__('Pick a color for sub menu bg .', 'debaco'),
                        'transparent' => false,
                        'default'     => '#ffffff',
                        'validate'    => 'color',
                    ),
                )
            ); 
            $this->sections[] = array(
                'icon'       => 'el-icon-website',
                'title'      => esc_html__( 'Categories Menu', 'debaco' ),
                'fields'     => array(
                    array(
                        'id'        => 'categories_menu_label',
                        'type'      => 'text',
                        'title'     => esc_html__('Category menu label', 'debaco'),
                        'subtitle'  => esc_html__('The label for category menu', 'debaco'),
                        'default'   => 'Browse categories'
                    ),
                    array(
                        'id'          => 'categories_menu_label_bg',
                        'type'        => 'color',
                        //'output'    => array(),
                        'title'       => esc_html__('Category menu label background', 'debaco'),
                        'subtitle'    => esc_html__('Pick a color for category menu label background.', 'debaco'),
                        'transparent' => false,
                        'default'     => '#222222',
                        'validate'    => 'color',
                    ),
                    array(
                        'id'          => 'categories_menu_bg',
                        'type'        => 'color',
                        //'output'    => array(),
                        'title'       => esc_html__('Category menu background', 'debaco'),
                        'subtitle'    => esc_html__('Pick a color for category menu background.', 'debaco'),
                        'transparent' => false,
                        'default'     => '#ffffff',
                        'validate'    => 'color',
                    ),
                    array(
                        'id'          => 'categories_sub_menu_bg',
                        'type'        => 'color',
                        //'output'    => array(),
                        'title'       => esc_html__('Sub category menu background', 'debaco'),
                        'subtitle'    => esc_html__('Pick a color for category sub menu background.', 'debaco'),
                        'transparent' => false,
                        'default'     => '#ffffff',
                        'validate'    => 'color',
                    ),
                    array(
                        'id'            => 'categories_menu_items',
                        'type'          => 'slider',
                        'title'         => esc_html__('Number of items', 'debaco'),
                        'desc'          => esc_html__('Number of menu items level 1 to show.', 'debaco'),
                        "default"       => 9,
                        "min"           => 1,
                        "step"          => 1,
                        "max"           => 15,
                        'display_value' => 'text'
                    ),
                    array(
                        'id'        => 'categories_more_label',
                        'type'      => 'text',
                        'title'     => esc_html__('More items label', 'debaco'),
                        'subtitle'  => esc_html__('The label for more items button', 'debaco'),
                        'default'   => 'More Categories'
                    ),
                    array(
                        'id'        => 'categories_less_label',
                        'type'      => 'text',
                        'title'     => esc_html__('Less items label', 'debaco'),
                        'subtitle'  => esc_html__('The label for less items button', 'debaco'),
                        'default'   => 'Less Categories'
                    ),
                )
            );
            //Footer
            $footer_layouts = array();
            $footer_default = '';
            $jscomposer_templates_args = array(
                'orderby'          => 'title',
                'order'            => 'ASC',
                'post_type'        => 'templatera',
                'post_status'      => 'publish',
                'posts_per_page'   => 30,
            );
            $jscomposer_templates = get_posts( $jscomposer_templates_args );
            if(count($jscomposer_templates) > 0) {
                foreach($jscomposer_templates as $jscomposer_template){
                    $footer_layouts[$jscomposer_template->post_title] = $jscomposer_template->post_title;
                }
                $footer_default = 'Footer 1';
            }
            $this->sections[] = array(
                'title'     => esc_html__('Footer', 'debaco'),
                'desc'      => esc_html__('Footer options', 'debaco'),
                'icon'      => 'el-icon-cog',
                'fields'    => array(

                    array(
                        'id'                => 'footer_layout',
                        'type'              => 'select',
                        'title'             => esc_html__('Footer Layout', 'debaco'),
                        'customizer_only'   => false,
                        'desc'              => esc_html__('Go to Visual Composer => Templates to create/edit layout', 'debaco'),
                        //Must provide key  => value pairs for select options
                        'options'           => $footer_layouts,
                        'default'           => $footer_default
                    ),
                    array(
                        'id'        => 'footer_bg',
                        'type'      => 'color',
                        'output'    => array(), 
                        'title'     => esc_html__('Footer background', 'debaco'),
                        'subtitle'  => esc_html__('Upload image or select color.', 'debaco'), 
                        'default'   => '#f6f6f6',
                    ), 
                    array(
                        'id'          => 'footer_color',
                        'type'        => 'color',
                        'title'       => esc_html__('Footer text color', 'debaco'),
                        'subtitle'    => esc_html__('Pick a color for footer color.', 'debaco'),
                        'transparent' => false,
                        'default'     => '#707070',
                        'validate'    => 'color',
                    ),
                    array(
                        'id'        => 'footer_link_color',
                        'type'      => 'link_color',
                        'output'    => array('.footer a'),
                        'title'     => esc_html__('Footer link color', 'debaco'),
                        'subtitle'  => esc_html__('Pick a color for footer link color.', 'debaco'),
                        'default'   => array(
                            'regular'  => '#707070',
                            'hover'    => '#cc2121',
                            'active'   => '#cc2121',
                            'visited'  => '#cc2121',
                        )
                    ),
                ),
            );
            $this->sections[] = array(
                'title'     => esc_html__('Social Icons', 'debaco'),
                'icon'      => 'el-icon-website',
                'fields'     => array(
                    array(
                        'id'       => 'social_icons',
                        'type'     => 'sortable',
                        'title'    => esc_html__('Social Icons', 'debaco'),
                        'subtitle' => esc_html__('Enter social links', 'debaco'),
                        'desc'     => esc_html__('Drag/drop to re-arrange', 'debaco'),
                        'mode'     => 'text',
                        'label'    => true,
                        'options'  => array(
                            'facebook'     => 'Facebook',
                            'twitter'      => 'Twitter',
                            'instagram'    => 'Instagram',
                            'tumblr'       => 'Tumblr',
                            'pinterest'    => 'Pinterest',
                            'google-plus'  => 'Google+',
                            'linkedin'     => 'LinkedIn',
                            'behance'      => 'Behance',
                            'dribbble'     => 'Dribbble',
                            'youtube'      => 'Youtube',
                            'vimeo'        => 'Vimeo',
                            'rss'          => 'Rss',
                        ),
                        'default' => array(
                            'facebook'    => 'https://www.facebook.com/roadthemes/',
                            'twitter'     => 'https://twitter.com/roadthemes',
                            'instagram'   => 'https://www.instagram.com',
                            'tumblr'      => '',
                            'pinterest'   => '',
                            'google-plus' => '',
                            'linkedin'    => 'https://vn.linkedin.com/in/kevin-sobo-082878b6',
                            'behance'     => '',
                            'dribbble'    => '',
                            'youtube'     => '',
                            'vimeo'       => '',
                            'rss'         => 'https://www.rss.com',
                        ),
                    ),
                )
            );
            //Fonts
            $this->sections[] = array(
                'title'     => esc_html__('Fonts', 'debaco'),
                'desc'      => esc_html__('Fonts options', 'debaco'),
                'icon'      => 'el-icon-font',
                'fields'    => array(

                    array(
                        'id'              => 'bodyfont',
                        'type'            => 'typography',
                        'title'           => esc_html__('Body font', 'debaco'),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'          => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'     => true,    // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'         => false, // Only appears if google is true and subsets not set to false
                        'text-align'      => false,
                        //'font-size'     => false,
                        //'line-height'   => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles'      => true,    // Enable all Google Font style/weight variations to be added to the page
                        //'output'        => array('body'), // An array of CSS selectors to apply this font style to dynamically
                        //'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
                        'units'           => 'px', // Defaults to px
                        'subtitle'        => esc_html__('Main body font.', 'debaco'),
                        'default'         => array(
                            'color'         => '#5a5a5a',
                            'font-weight'   => '400',
                            'font-family'   => 'Rubik',
                            'google'        => true,
                            'font-size'     => '14px',
                        ),
                    ),
                    array(
                        'id'              => 'headingfont',
                        'type'            => 'typography',
                        'title'           => esc_html__('Heading font', 'debaco'),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'          => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'     => false,    // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'         => false, // Only appears if google is true and subsets not set to false
                        'font-size'       => false,
                        'line-height'     => false,
                        'text-align'      => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles'      => true,    // Enable all Google Font style/weight variations to be added to the page
                        //'output'        => array('h1, h2, h3, h4, h5, h6'), // An array of CSS selectors to apply this font style to dynamically
                        //'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
                        'units'           => 'px', // Defaults to px
                        'subtitle'        => esc_html__('Heading font.', 'debaco'),
                        'default'         => array(
                            'color'         => '#242424',
                            'font-weight'   => '500',
                            'font-family'   => 'Rubik',
                            'google'        => true,
                        ),
                    ),
                    array(
                        'id'              => 'menufont',
                        'type'            => 'typography',
                        'title'           => esc_html__('Menu font', 'debaco'),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'          => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'     => false,    // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'         => false, // Only appears if google is true and subsets not set to false
                        'font-size'       => true,
                        'line-height'     => false,
                        'text-align'      => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles'      => true,    // Enable all Google Font style/weight variations to be added to the page
                        //'output'        => array('h1, h2, h3, h4, h5, h6'), // An array of CSS selectors to apply this font style to dynamically
                        //'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
                        'units'           => 'px', // Defaults to px
                        'subtitle'        => esc_html__('Menu font.', 'debaco'),
                        'default'         => array(
                            'color'         => '#242424',
                            'font-weight'   => '500',
                            'font-family'   => 'Rubik',
                            'font-size'     => '12px',
                            'google'        => true,
                        ),
                    ),
                    array(
                        'id'              => 'submenufont',
                        'type'            => 'typography',
                        'title'           => esc_html__('Sub menu font', 'debaco'),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'          => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'     => false,    // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'         => false, // Only appears if google is true and subsets not set to false
                        'font-size'       => true,
                        'line-height'     => false,
                        'text-align'      => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles'      => true,    // Enable all Google Font style/weight variations to be added to the page
                        //'output'        => array('h1, h2, h3, h4, h5, h6'), // An array of CSS selectors to apply this font style to dynamically
                        //'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
                        'units'           => 'px', // Defaults to px
                        'subtitle'        => esc_html__('sub menu font.', 'debaco'),
                        'default'         => array(
                            'color'         => '#707070',
                            'font-weight'   => '400',
                            'font-family'   => 'Rubik',
                            'font-size'     => '14px',
                            'google'        => true,
                        ),
                    ),
                    array(
                        'id'              => 'dropdownfont',
                        'type'            => 'typography',
                        'title'           => esc_html__('Dropdown menu font', 'debaco'),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'          => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'     => false,    // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'         => false, // Only appears if google is true and subsets not set to false
                        'font-size'       => true,
                        'line-height'     => false,
                        'text-align'      => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles'      => true,    // Enable all Google Font style/weight variations to be added to the page
                        //'output'        => array('h1, h2, h3, h4, h5, h6'), // An array of CSS selectors to apply this font style to dynamically
                        //'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
                        'units'           => 'px', // Defaults to px
                        'subtitle'        => esc_html__('Dropdown menu font.', 'debaco'),
                        'default'         => array(
                            'color'         => '#8a8e90',
                            'font-weight'   => '400',
                            'font-family'   => 'Rubik',
                            'font-size'     => '13px',
                            'google'        => true,
                        ),
                    ),
                    array(
                        'id'              => 'categoriesfont',
                        'type'            => 'typography',
                        'title'           => esc_html__('Category menu font', 'debaco'),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'          => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'     => false,    // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'         => false, // Only appears if google is true and subsets not set to false
                        'font-size'       => true,
                        'line-height'     => false,
                        'text-align'      => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles'      => true,    // Enable all Google Font style/weight variations to be added to the page
                        //'output'        => array('h1, h2, h3, h4, h5, h6'), // An array of CSS selectors to apply this font style to dynamically
                        //'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
                        'units'           => 'px', // Defaults to px
                        'subtitle'        => esc_html__('Category menu font.', 'debaco'),
                        'default'         => array(
                            'color'         => '#222222',
                            'font-weight'   => '400',
                            'font-family'   => 'Rubik',
                            'font-size'     => '14px',
                            'google'        => true,
                        ),
                    ),
                    array(
                        'id'              => 'categoriessubmenufont',
                        'type'            => 'typography',
                        'title'           => esc_html__('Category sub menu font', 'debaco'),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'          => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'     => false,    // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'         => false, // Only appears if google is true and subsets not set to false
                        'font-size'       => true,
                        'line-height'     => false,
                        'text-align'      => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles'      => true,    // Enable all Google Font style/weight variations to be added to the page
                        //'output'        => array('h1, h2, h3, h4, h5, h6'), // An array of CSS selectors to apply this font style to dynamically
                        //'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
                        'units'           => 'px', // Defaults to px
                        'subtitle'        => esc_html__('Category sub menu font.', 'debaco'),
                        'default'         => array(
                            'color'         => '#222222',
                            'font-weight'   => '500',
                            'font-family'   => 'Rubik',
                            'font-size'     => '14px',
                            'google'        => true,
                        ),
                    ),
                    array(
                        'id'              => 'pricefont',
                        'type'            => 'typography',
                        'title'           => esc_html__('Price font', 'debaco'),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'          => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'     => false,    // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'         => false, // Only appears if google is true and subsets not set to false
                        'font-size'       => true,
                        'line-height'     => false,
                        'text-align'      => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles'      => true,    // Enable all Google Font style/weight variations to be added to the page
                        //'output'        => array('h1, h2, h3, h4, h5, h6'), // An array of CSS selectors to apply this font style to dynamically
                        //'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
                        'units'           => 'px', // Defaults to px
                        'subtitle'        => esc_html__('Price font.', 'debaco'),
                        'default'         => array(
                            'color'         => '#cc2121',
                            'font-weight'   => '500',
                            'font-family'   => 'Rubik', 
                            'font-size'     => '18px', 
                            'google'        => true,
                        ),
                    ),
                ),
            );
            //Image slider
            $this->sections[] = array(
                'title'     => esc_html__('Image slider', 'debaco'),
                'desc'      => esc_html__('Upload images and links', 'debaco'),
                'icon'      => 'el-icon-website',
                'fields'    => array(
                    array(
                        'id'          => 'image_slider',
                        'type'        => 'slides',
                        'title'       => esc_html__('Images', 'debaco'),
                        'desc'        => esc_html__('Upload images and enter links.', 'debaco'),
                        'placeholder' => array(
                            'title'           => esc_html__('Title', 'debaco'),
                            'description'     => esc_html__('Description', 'debaco'),
                            'url'             => esc_html__('Link', 'debaco'),
                        ),
                    ),
                ),
            );
            //Brand logos
            $this->sections[] = array(
                'title'     => esc_html__('Brand Logos', 'debaco'),
                'desc'      => esc_html__('Upload brand logos and links', 'debaco'),
                'icon'      => 'el-icon-briefcase',
                'fields'    => array(
                    array(
                        'id'          => 'brand_logos',
                        'type'        => 'slides',
                        'title'       => esc_html__('Logos', 'debaco'),
                        'desc'        => esc_html__('Upload logo image and enter logo link.', 'debaco'),
                        'placeholder' => array(
                            'title'           => esc_html__('Title', 'debaco'),
                            'description'     => esc_html__('Description', 'debaco'),
                            'url'             => esc_html__('Link', 'debaco'),
                        ),
                    ),
                ),
            );
            //Inner brand logos
            $this->sections[] = array(
                'title'     => esc_html__('Inner Brand Logos', 'debaco'),
                'subsection'=> true,
                'icon'      => 'el-icon-website',
                'fields'    => array(
                    array(
                        'id'        => 'inner_brand',
                        'type'      => 'switch',
                        'title'     => esc_html__('Brand carousel in inner pages', 'debaco'),
                        'subtitle'  => esc_html__('Show brand carousel in inner pages', 'debaco'),
                        'default'   => false,
                    ),
                    array(
                        'id'       => 'brandscroll',
                        'type'     => 'switch',
                        'title'    => esc_html__('Auto scroll', 'debaco'),
                        'default'  => true,
                    ),
                    array(
                        'id'            => 'brandscrollnumber',
                        'type'          => 'slider',
                        'title'         => esc_html__('Scroll amount', 'debaco'),
                        'desc'          => esc_html__('Number of logos to scroll one time, default value: 1', 'debaco'),
                        "default"       => 1,
                        "min"           => 1,
                        "step"          => 1,
                        "max"           => 12,
                        'display_value' => 'text'
                    ),
                    array(
                        'id'            => 'brandpause',
                        'type'          => 'slider',
                        'title'         => esc_html__('Pause in (seconds)', 'debaco'),
                        'desc'          => esc_html__('Pause time, default value: 3000', 'debaco'),
                        "default"       => 3000,
                        "min"           => 1000,
                        "step"          => 500,
                        "max"           => 10000,
                        'display_value' => 'text'
                    ),
                    array(
                        'id'            => 'brandanimate',
                        'type'          => 'slider',
                        'title'         => esc_html__('Animate in (seconds)', 'debaco'),
                        'desc'          => esc_html__('Animate time, default value: 2000', 'debaco'),
                        "default"       => 2000,
                        "min"           => 300,
                        "step"          => 100,
                        "max"           => 5000,
                        'display_value' => 'text'
                    ),
                ),
            );
            // Sidebar
            $this->sections[] = array(
                'title'     => esc_html__('Sidebar', 'debaco'),
                'desc'      => esc_html__('Sidebar options. Shop/Product sidebar and Blog sidebar are in Product and Blog sections', 'debaco'),
                'icon'      => 'el-icon-cog',
                'fields'    => array(
                    array(
                        'id'       => 'sidebarse_pos',
                        'type'     => 'radio',
                        'title'    => esc_html__('Inner Pages Sidebar Position', 'debaco'),
                        'subtitle' => esc_html__('Sidebar Position on pages (default pages). If there is no widget in this sidebar, the layout will be nosidebar', 'debaco'),
                        'options'  => array(
                            'left' => 'Left',
                            'right'=> 'Right'),
                        'default'  => 'left'
                    ),
                    array(
                        'id'       =>'custom-sidebars',
                        'type'     => 'multi_text',
                        'title'    => esc_html__('Custom Sidebars', 'debaco'),
                        'subtitle' => esc_html__('Add more sidebars', 'debaco'),
                        'desc'     => esc_html__('Enter sidebar name (Only allow digits and letters). click Add more to add more sidebar. Edit your page to select a sidebar ', 'debaco')
                    ),
                ),
            );
            // Product
            $this->sections[] = array(
                'title'     => esc_html__('Product', 'debaco'),
                'desc'      => esc_html__('Use this section to select options for product', 'debaco'),
                'icon'      => 'el-icon-tags',
                'fields'    => array(
                    array(
                        'id'        => 'shop_banner',
                        'type'      => 'media',
                        'title'     => esc_html__('Banner image in shop pages', 'debaco'),
                        'compiler'  => 'true',
                        'mode'      => false,
                        'desc'      => esc_html__('Upload image here.', 'debaco'),
                    ),
                    array(
                        'id'        => 'show_category_image',
                        'type'      => 'switch',
                        'title'     => esc_html__('Show individual category thumbnail', 'debaco'),
                        'subtitle'  => esc_html__('Show individual category thumbnail in product shop/product category pages. ', 'debaco'),
                        'desc'      => esc_html__('If yes, product shop/product category page will display the thumbnail as banner. If no, product shop/product category page will display the shop banner (image uploaded above)', 'debaco'),
                        'default'   => true,
                    ),
                    array(
                        'id'        => 'shop_layout',
                        'type'      => 'select',
                        'title'     => esc_html__('Shop Layout', 'debaco'),
                        'subtitle'  => esc_html__('If there is no widget in this sidebar, the layout will be nosidebar', 'debaco'),
                        'options'   => array(
                            'sidebar'   => 'Sidebar',
                            'fullwidth' => 'Full Width',
                        ),
                        'default'   => 'sidebar',
                    ),
                    array(
                        'id'       => 'sidebarshop_pos',
                        'type'     => 'radio',
                        'title'    => esc_html__('Shop Sidebar Position', 'debaco'),
                        'subtitle' => esc_html__('Sidebar Position on shop page.', 'debaco'),
                        'options'  => array(
                            'left' => 'Left',
                            'right'=> 'Right'),
                        'default'  => 'left'
                    ),
                    array(
                        'id'        => 'default_view',
                        'type'      => 'select',
                        'title'     => esc_html__('Shop default view', 'debaco'),
                        'default'   => 'grid-view',
                        'options'   => array(
                            'grid-view' => 'Grid View',
                            'list-view' => 'List View',
                        ),
                    ),
                    array(
                        'id'          => 'product_bg',
                        'type'        => 'color',
                        'title'       => esc_html__('Product background color', 'debaco'),
                        'subtitle'    => esc_html__('Upload image or select color', 'debaco'),
                        'transparent' => false,
                        'default'     => '#ffffff',
                        'validate'    => 'color',
                    ),
                    array(
                        'id'            => 'product_per_page',
                        'type'          => 'slider',
                        'title'         => esc_html__('Products per page', 'debaco'),
                        'subtitle'      => esc_html__('Amount of products per page in shop/product category page', 'debaco'),
                        "default"       => 15,
                        "min"           => 4,
                        "step"          => 1,
                        "max"           => 30,
                        'display_value' => 'text',
                    ),
                    array(
                        'id'            => 'product_per_row_over1600',
                        'type'          => 'slider',
                        'title'         => esc_html__('Product columns', 'debaco'),
                        'subtitle'      => esc_html__('Amount of product columns in shop/product category page (over 1600px)', 'debaco'),
                        'desc'          => esc_html__('Only works with: 1, 2, 3, 4, 5, 6', 'debaco'),
                        "default"       => 5,
                        "min"           => 1,
                        "step"          => 1,
                        "max"           => 6,
                        'display_value' => 'text',
                    ),
                    array(
                        'id'            => 'product_per_row_fw_over1600',
                        'type'          => 'slider',
                        'title'         => esc_html__('Product columns on full width shop', 'debaco'),
                        'subtitle'      => esc_html__('Amount of product columns in full width shop/product category page (over 1600px)', 'debaco'),
                        'desc'          => esc_html__('Only works with: 1, 2, 3, 4, 5, 6', 'debaco'),
                        "default"       => 6,
                        "min"           => 1,
                        "step"          => 1,
                        "max"           => 6,
                        'display_value' => 'text',
                    ),
                    array(
                        'id'            => 'product_per_row',
                        'type'          => 'slider',
                        'title'         => esc_html__('Product columns', 'debaco'),
                        'subtitle'      => esc_html__('Amount of product columns in shop/product category page (992px-1600px)', 'debaco'),
                        'desc'          => esc_html__('Only works with: 1, 2, 3, 4, 6', 'debaco'),
                        "default"       => 3,
                        "min"           => 1,
                        "step"          => 1,
                        "max"           => 6,
                        'display_value' => 'text',
                    ),
                    array(
                        'id'            => 'product_per_row_fw',
                        'type'          => 'slider',
                        'title'         => esc_html__('Product columns on full width shop', 'debaco'),
                        'subtitle'      => esc_html__('Amount of product columns in full width shop/product category page (992px-1600px)', 'debaco'),
                        'desc'          => esc_html__('Only works with: 1, 2, 3, 4, 6', 'debaco'),
                        "default"       => 4,
                        "min"           => 1,
                        "step"          => 1,
                        "max"           => 6,
                        'display_value' => 'text',
                    ),
                ),
            );
            $this->sections[] = array(
                'icon'       => 'el-icon-website',
                'title'      => esc_html__( 'Product page', 'debaco' ),
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'        => 'single_product_layout',
                        'type'      => 'select',
                        'title'     => esc_html__('Single Product Layout', 'debaco'),
                        'subtitle'  => esc_html__('If there is no widget in this sidebar, the layout will be nosidebar', 'debaco'),
                        'default'   => 'fullwidth',
                        'options'   => array(
                            'sidebar'   => 'Sidebar',
                            'fullwidth' => 'Full Width',
                        ),
                    ),
                    array(
                        'id'       => 'sidebarsingleproduct_pos',
                        'type'     => 'radio',
                        'title'    => esc_html__('Single Product Sidebar Position', 'debaco'),
                        'subtitle' => esc_html__('Sidebar Position on single product page.', 'debaco'),
                        'options'  => array(
                            'left' => 'Left',
                            'right'=> 'Right'),
                        'default'  => 'left'
                    ),
                    array(
                        'id'        => 'product_banner',
                        'type'      => 'media',
                        'title'     => esc_html__('Banner image for single product pages', 'debaco'),
                        'compiler'  => 'true',
                        'mode'      => false,
                        'desc'      => esc_html__('Upload image here.', 'debaco'),
                    ),
                    array(
                        'id'        => 'single_product_header_text',
                        'type'      => 'text',
                        'title'     => esc_html__('Single Product header text', 'debaco'),
                        'default'   => esc_html__('Product Details', 'debaco'),
                    ), 
                    array(
                        'id'        => 'related_product_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Related product title', 'debaco'),
                        'default'   => esc_html__('Related Products', 'debaco'),
                    ),
                    array(
                        'id'        => 'upsell_product_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Upsell product title', 'debaco'),
                        'default'   => esc_html__('Upsell Products', 'debaco'),
                    ),
                    array(
                        'id'        => 'cross_sell_product_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Cross sell product title', 'debaco'),
                        'default'   => esc_html__('You may be interested in ... ', 'debaco'),
                    ),
                    array(
                        'id'            => 'related_amount',
                        'type'          => 'slider',
                        'title'         => esc_html__('Number of related products', 'debaco'),
                        "default"       => 10,
                        "min"           => 1,
                        "step"          => 1,
                        "max"           => 16,
                        'display_value' => 'text',
                    ),
                    array(
                        'id'        => 'product_share_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Product share title', 'debaco'),
                        'default'   => 'Share this product',
                    ),
                )
            );
            $this->sections[] = array(
                'icon'       => 'el-icon-website',
                'title'      => esc_html__( 'Quick View', 'debaco' ),
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'        => 'detail_link_text',
                        'type'      => 'text',
                        'title'     => esc_html__('View details text', 'debaco'),
                        'default'   => esc_html__('Quick View', 'debaco'),
                    ),
                    array(
                        'id'        => 'quickview_link_text',
                        'type'      => 'text',
                        'title'     => esc_html__('View all features text', 'debaco'),
                        'desc'      => esc_html__('This is the text on quick view box', 'debaco'),
                        'default'   => esc_html__('See all features', 'debaco'),
                    ),
                    array(
                        'id'        => 'quickview',
                        'type'      => 'switch',
                        'title'     => esc_html__('Quick View', 'debaco'),
                        'desc'      => esc_html__('Show quick view button on all pages', 'debaco'),
                        'default'   => true,
                    ),
                )
            );
            // Blog options
            $this->sections[] = array(
                'title'     => esc_html__('Blog', 'debaco'),
                'desc'      => esc_html__('Use this section to select options for blog', 'debaco'),
                'icon'      => 'el-icon-file',
                'fields'    => array( 					
					 array(
                        'id'        => 'blog_banner',
                        'type'      => 'media',
                        'title'     => esc_html__('Banner image in blog pages', 'debaco'),
                        'compiler'  => 'true',
                        'mode'      => false,
                        'desc'      => esc_html__('Upload image here.', 'debaco'),
                    ),
                    array(
                        'id'        => 'blog_header_text',
                        'type'      => 'text',
                        'title'     => esc_html__('Blog header text', 'debaco'),
                        'default'   => esc_html__('Blog', 'debaco'),
                    ), 
                    array(
                        'id'        => 'blog_layout',
                        'type'      => 'select',
                        'title'     => esc_html__('Blog Layout', 'debaco'),
                        'subtitle'  => esc_html__('If there is no widget in this sidebar, the layout will be nosidebar', 'debaco'),
                        'options'   => array(
                            'sidebar'       => 'Sidebar',
                            'nosidebar'     => 'No Sidebar',
                            'largeimage'    => 'Large Image',
                            'grid'          => 'Grid',
                        ),
                        'default'   => 'grid',
                    ),
                    array(
                        'id'       => 'sidebarblog_pos',
                        'type'     => 'radio',
                        'title'    => esc_html__('Blog Sidebar Position', 'debaco'),
                        'subtitle' => esc_html__('Sidebar Position on Blog pages.', 'debaco'),
                        'options'  => array(
                            'left' => 'Left',
                            'right'=> 'Right'),
                        'default'  => 'right'
                    ),
                    array(
                        'id'        => 'readmore_text',
                        'type'      => 'text',
                        'title'     => esc_html__('Read more text', 'debaco'),
                        'default'   => esc_html__('Read more', 'debaco'),
                    ),
                    array(
                        'id'        => 'blog_share_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Blog share title', 'debaco'),
                        'default'   => esc_html__('Share this post', 'debaco'),
                    ),
                ),
            );
            // Testimonials options
            $this->sections[] = array(
                'title'     => esc_html__('Testimonials', 'debaco'),
                'desc'      => esc_html__('Use this section to select options for Testimonials', 'debaco'),
                'icon'      => 'el-icon-comment',
                'fields'    => array(
                    array(
                        'id'       => 'testiscroll',
                        'type'     => 'switch',
                        'title'    => esc_html__('Auto scroll', 'debaco'),
                        'default'  => false,
                    ),
                    array(
                        'id'            => 'testipause',
                        'type'          => 'slider',
                        'title'         => esc_html__('Pause in (seconds)', 'debaco'),
                        'desc'          => esc_html__('Pause time, default value: 3000', 'debaco'),
                        "default"       => 3000,
                        "min"           => 1000,
                        "step"          => 500,
                        "max"           => 10000,
                        'display_value' => 'text'
                    ),
                    array(
                        'id'            => 'testianimate',
                        'type'          => 'slider',
                        'title'         => esc_html__('Animate in (seconds)', 'debaco'),
                        'desc'          => esc_html__('Animate time, default value: 2000', 'debaco'),
                        "default"       => 2000,
                        "min"           => 300,
                        "step"          => 100,
                        "max"           => 5000,
                        'display_value' => 'text'
                    ),
                ),
            );
            // Error 404 page
            $this->sections[] = array(
                'title'     => esc_html__('Error 404 Page', 'debaco'),
                'desc'      => esc_html__('Error 404 page options', 'debaco'),
                'icon'      => 'el-icon-cog',
                'fields'    => array(
                    array(
                        'id'        => 'background_error',
                        'type'      => 'background',
                        'output'    => array('body.error404'),
                        'title'     => esc_html__('Error 404 background', 'debaco'),
                        'subtitle'  => esc_html__('Upload image or select color.', 'debaco'),
                        'default'   => array('background-color' => '#ffffff'),
                    ),
                ),
            );
            // Less Compiler
            $this->sections[] = array(
                'title'     => esc_html__('Less Compiler', 'debaco'),
                'desc'      => esc_html__('Turn on this option to apply all theme options. Turn of when you have finished changing theme options and your site is ready.', 'debaco'),
                'icon'      => 'el-icon-wrench',
                'fields'    => array(
                    array(
                        'id'        => 'enable_less',
                        'type'      => 'switch',
                        'title'     => esc_html__('Enable Less Compiler', 'debaco'),
                        'default'   => true,
                    ),
                ),
            );
            $theme_info  = '<div class="redux-framework-section-desc">';
            $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . esc_html__('<strong>Theme URL:</strong> ', 'debaco') . '<a href="' . $this->theme->get('ThemeURI') . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . esc_html__('<strong>Author:</strong> ', 'debaco') . $this->theme->get('Author') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . esc_html__('<strong>Version:</strong> ', 'debaco') . $this->theme->get('Version') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
            $tabs = $this->theme->get('Tags');
            if (!empty($tabs)) {
                $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . esc_html__('<strong>Tags:</strong> ', 'debaco') . implode(', ', $tabs) . '</p>';
            }
            $theme_info .= '</div>';
            $this->sections[] = array(
                'title'     => esc_html__('Import / Export', 'debaco'),
                'desc'      => esc_html__('Import and Export your Redux Framework settings from file, text or URL.', 'debaco'),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => false,
                    ),
                ),
            );
            $this->sections[] = array(
                'icon'      => 'el-icon-info-sign',
                'title'     => esc_html__('Theme Information', 'debaco'),
                'fields'    => array(
                    array(
                        'id'        => 'opt-raw-info',
                        'type'      => 'raw',
                        'content'   => $item_info,
                    )
                ),
            );
        }
        public function setHelpTabs() {
            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => esc_html__('Theme Information 1', 'debaco'),
                'content'   => esc_html__('<p>This is the tab content, HTML is allowed.</p>', 'debaco')
            );
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => esc_html__('Theme Information 2', 'debaco'),
                'content'   => esc_html__('<p>This is the tab content, HTML is allowed.</p>', 'debaco')
            );
            // Set the help sidebar
            $this->args['help_sidebar'] = esc_html__('<p>This is the sidebar content, HTML is allowed.</p>', 'debaco');
        }
        /**
          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */
        public function setArguments() {
            $theme = wp_get_theme(); // For use with some settings. Not necessary.
            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'          => 'debaco_opt',            // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
                'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
                'menu_type'         => 'menu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
                'menu_title'        => esc_html__('Theme Options', 'debaco'),
                'page_title'        => esc_html__('Theme Options', 'debaco'),
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key'    => '', // Must be defined to add google fonts to the typography module
                'async_typography'  => true,                    // Use a asynchronous font on the front end or font string
                //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                'admin_bar'         => false,                    // Show the panel pages on the admin bar
                'global_variable'   => '',                      // Set a different name for your global variable other than the opt_name
                'dev_mode'          => false,                    // Show the time the page took to load, etc
                'customizer'        => true,                    // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
                // OPTIONAL -> Give you extra features
                'page_priority'     => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
                'menu_icon'         => '',                      // Specify a custom URL to an icon
                'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
                'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
                'page_slug'         => '_options',              // Page slug used to denote the panel
                'save_defaults'     => true,                    // On load save the defaults to DB before user clicks save or not
                'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
                'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,                   // Shows the Import/Export panel when not used as a field.
                // CAREFUL -> These options are for advanced use only
                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'           => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'        => false, // REMOVE
                // HINTS
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            );
            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
                'title' => 'Visit us on GitHub',
                'icon'  => 'el-icon-github'
                //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
            );
            $this->args['share_icons'][] = array(
                'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
                'title' => 'Like us on Facebook',
                'icon'  => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://twitter.com/reduxframework',
                'title' => 'Follow us on Twitter',
                'icon'  => 'el-icon-twitter'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://www.linkedin.com/company/redux-framework',
                'title' => 'Find us on LinkedIn',
                'icon'  => 'el-icon-linkedin'
            );
            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
              } else {
            }
        }
    }
    global $reduxConfig;
    $reduxConfig = new debaco_Theme_Config();
}
/**
  Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;
/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';
        /*
          do your validation
          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */
        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;