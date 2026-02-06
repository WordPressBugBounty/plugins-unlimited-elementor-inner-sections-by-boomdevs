<?php 

namespace PrimeElementorAddons\Widgets;

use PrimeElementorAddons\Utils\GradientTextControl;
use PrimeElementorAddons\Utils\TextStrokeControl;
use PrimeElementorAddons\Utils\Helper;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class TeamMember extends Widget_Base {
    
    public function get_name() {
        return 'pea_team_member';
    }
    
    public function get_title() {
        return esc_html__('Team Member', 'unlimited-elementor-inner-sections-by-boomdevs');
    }
    
    public function get_icon() {
        return 'pea_team_member_icon';
    }
    
    public function get_categories() {
        return ['prime-elementor-addons'];
    }
    
    public function get_keywords() {
        return ['heading', 'title', 'text', 'advanced', 'gradient', 'stroke'];
    }
    
    public function get_style_depends() {
        return ['prime-elementor-addons--team-member'];
    }
    
    protected function register_controls() {
        
        // =====================
        // CONTENT TAB
        // =====================
        
        // Section
        $this->start_controls_section(
            'team_member_presets_section',
            [
                'label' => esc_html__('Presets', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
            $this->add_control(
                'preset_styles',
                [
                    'label' => esc_html__('Preset Style', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'default' => 'Preset 1',
                        'preset-2' => 'Preset 2',
                        'preset-3' => 'Preset 3',
                    ],
                    'default' => 'default',
                    'render_type'  => 'template',
                ]
            );
        
        $this->end_controls_section();
        
        // Avatar image Section
        $this->start_controls_section(
            'avatar_section',
            [
                'label' => esc_html__('Avatar', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

            $this->add_control(
                'avatar_image',
                [
                    'label'   => esc_html__( 'Image', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'    => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => PEA_PLUGIN_URL.'assets/images/author.png',
                    ],
                ]
            );
        
            $this->add_control(
                'avatar_image_fit',
                [
                    'label' => esc_html__('Object Fit', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'none' => 'None',
                        'fill' => 'Fill',
                        'contain' => 'Contain',
                        'cover' => 'Cover',
                        'scale-down' => 'Scale Down',
                    ],
                    'default' => 'cover',
                    'selectors' => [
                        '{{WRAPPER}} .pea-team-member-image img' => 'object-fit: {{VALUE}};',
                    ],
                ]
            );
            
            $this->add_control(
                'avatar_image_overlay',
                [
                    'label' => esc_html__('Image Overlay', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
        
        $this->end_controls_section();
        
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
            
            $this->add_control(
                'content_position_in_image',
                [
                    'label' => esc_html__('Content Over Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'team_member_content_over_image_css',
                [
                    'label' => esc_html__('Content Over Image Css', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::HIDDEN,
                    'default' => 'position:absolute;bottom:0;left:0;width:100%;z-index:5;',
                    'selectors' => [
                        '{{WRAPPER}} .pea-team-member-content-wrapper' => '{{VALUE}};',
                    ],
                    'condition' => [
                        'content_position_in_image' => 'yes',
                    ],
                ]
            );
        
            $this->add_control(
                'content_position',
                [
                    'label' => esc_html__('Content Position', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'column-reverse' => 'Top',
                        'row' => 'Right',
                        'column' => 'Bottom',
                        'row-reverse' => 'Left',
                    ],
                    'default' => 'column',
                    'render_type'  => 'template',
                    'selectors' => [
                        '{{WRAPPER}} .pea-team-member-item' => 'flex-direction:{{VALUE}};',
                    ],
                    'condition' => [
                        'content_position_in_image!' => 'yes',
                    ],
                ]
            );
        
            $this->add_control(
                'card_alignment',
                [
                    'label' => esc_html__('Card Alignment', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'start' => 'Left',
                        'center' => 'Center',
                        'end' => 'Right',
                        'space-between' => 'Between',
                    ],
                    'default' => 'start',
                    'render_type'  => 'template',
                    'selectors' => [
                        '{{WRAPPER}} .pea-team-member-item' => 'justify-content:{{VALUE}};',
                    ],
                    'condition' => [
                        'content_position_in_image!' => 'yes',
                        'content_position' => ['row', 'row-reverse'],
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Badge Section
        $this->start_controls_section(
            'badge_section',
            [
                'label' => esc_html__('Badge', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
            
            $this->add_control(
                'show_badge',
                [
                    'label' => esc_html__('Show Badge', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'badge_text', [
                    'label' => esc_html__( 'Badge Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Simply the best' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'label_block' => true,
                    'condition' => [
                        'show_badge' => 'yes',
                    ],
                ]
            );
        
            $this->add_control(
                'badge_position',
                [
                    'label' => esc_html__('Badge Position', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'badge-in-content' => 'In Content',
                        'badge-in-image' => 'In Image',
                    ],
                    'default' => 'badge-in-image',
                    'render_type'  => 'template',
                    'condition' => [
                        'show_badge' => 'yes',
                    ],
                ]
            );
        
            $this->add_control(
                'badge_alignment',
                [
                    'label' => esc_html__('Badge Alignment', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'do-top-left' => 'Top Left',
                        'do-top-center' => 'Top Center',
                        'do-top-right' => 'Top Right',
                        'do-center-left' => 'Center Left',
                        'do-center-center' => 'Center Center',
                        'do-center-right' => 'Center Right',
                        'do-bottom-left' => 'Bottom Left',
                        'do-bottom-center' => 'Bottom Center',
                        'do-bottom-right' => 'Bottom Right',
                    ],
                    'default' => 'do-top-left',
                    'render_type'  => 'template',
                    'condition' => [
                        'show_badge' => 'yes',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Name & Designation Section
        $this->start_controls_section(
            'name_n_designation_section',
            [
                'label' => esc_html__('Name & Designation', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
	
            $this->add_control(
                'name_tag',
                [
                    'label' => esc_html__('Name Tag', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'h1' => 'H1',
                        'h2' => 'H2',
                        'h3' => 'H3',
                        'h4' => 'H4',
                        'h5' => 'H5',
                        'h6' => 'H6',
                        'div' => 'div',
                        'span' => 'span',
                        'p' => 'p',
                    ],
                    'default' => 'h3',
                ]
            );
            $this->add_control(
                'name', [
                    'label' => esc_html__( 'Name', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Tyler Pacocha' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'label_block' => true,
                ]
            );
            $this->add_control(
                'designation',
                [
                    'label' => esc_html__( 'Designation', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'rows' => 10,
                    'default' => 'Software Engineer',
                    'placeholder' => esc_html__( 'Type Designation here', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );
        
        $this->end_controls_section();
        
        // Description Section
        $this->start_controls_section(
            'description_section',
            [
                'label' => esc_html__('Description', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
            
            $this->add_control(
                'show_description',
                [
                    'label' => esc_html__('Show Description', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
            $this->add_control(
                'description',
                [
                    'label' => esc_html__( 'Description', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'rows' => 10,
                    'default' => 'Lorem ipsum dolor sit amet consectetur Aliquam mauris bibendum.',
                    'placeholder' => esc_html__( 'Type Description here', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'condition' => [
                        'show_description' => 'yes',
                    ],
                ]
            );
        
        $this->end_controls_section();

        // Icon Section
		$this->start_controls_section(
			'icon_section',
			[
				'label' => esc_html__( 'Icon Button', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
            
            $this->add_control(
                'show_Icon',
                [
                    'label' => esc_html__('Show Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'icon',
                [
                    'label' => esc_html__( 'Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-arrow-right',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        'show_Icon' => 'yes',
                    ],
                ]
            );
        
        $this->end_controls_section();

        // Social Profiles Section
		$this->start_controls_section(
			'social_profiles_section',
			[
				'label' => esc_html__( 'Social Profiles', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
            
            $this->add_control(
                'show_social_profiles',
                [
                    'label' => esc_html__('Show social profiles', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            $this->add_control(
                'social_icon_direction',
                [
                    'label' => esc_html__('Icon direction', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'row' => 'Horizontal',
                        'row-reverse' => 'Horizontal Reverse',
                        'column' => 'Vertical',
                        'column-reverse' => 'Vertical Reverse',
                    ],
                    'default' => 'row',
                    'render_type'  => 'template',
                    'selectors' => [
                        '{{WRAPPER}} .pea-team-member-social-profile-wrapper' => 'flex-direction:{{VALUE}};',
                        '{{WRAPPER}} .pea-team-member-social-profile' => 'flex-direction:{{VALUE}};',
                    ],
                    'condition' => [
                        'show_social_profiles' => 'yes',
                    ],
                ]
            );
        
            $this->add_control(
                'icon_animation_type',
                [
                    'label' => esc_html__('Icon animation Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'default' => 'Default',
                        'icon-animation-top' => 'Top',
                        'icon-animation-right' => 'Right',
                        'icon-animation-bottom' => 'Bottom',
                        'icon-animation-left' => 'Left',
                    ],
                    'default' => 'default',
                    'render_type'  => 'template',
                ]
            );
            $this->add_control(
                'social_profiles_display',
                [
                    'label' => esc_html__('Icon Dispaly', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'in-content' => 'In Content',
                        'in-image' => 'In Image',
                    ],
                    'default' => 'in-content',
                    'render_type'  => 'template',
                ]
            );
            $this->add_control(
                'team_member_preset_5_css',
                [
                    'label' => esc_html__('css for In Image Select', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::HIDDEN,
                    'default' => 'position:absolute;z-index:5;',
                    'selectors' => [
                        '{{WRAPPER}} .pea-team-member-social-profile-wrapper' => '{{VALUE}};',
                    ],
                    'condition' => [
                        'social_profiles_display' => 'in-image',
                    ],
                ]
            );
			$this->add_responsive_control(
				'social_profiles_alignment',
				[
					'label'     => esc_html__( 'Alignment', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'      => Controls_Manager::CHOOSE,
					'options'   => [
						'start' => [
							'title' => esc_html__( 'Left', 'unlimited-elementor-inner-sections-by-boomdevs' ),
							'icon'  => 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'unlimited-elementor-inner-sections-by-boomdevs' ),
							'icon'  => 'eicon-text-align-center',
						],
						'end' => [
							'title' => esc_html__( 'Right', 'unlimited-elementor-inner-sections-by-boomdevs' ),
							'icon'  => 'eicon-text-align-right',
						],
					],
					'default'     => 'center',
					'toggle'    => true,
					'selectors' => [
						'{{WRAPPER}} .pea-team-member-social-profile-wrapper' => 'justify-content: {{VALUE}};',
					],
                    'render_type'  => 'template',
                    'condition' => [
                        'social_profiles_display' => 'in-content',
                    ],
				]
			);
            $this->add_control(
                'social_icon_position_for_content',
                [
                    'label' => esc_html__('Icon Position', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'column-reverse' => 'Top',
                        'row' => 'Right',
                        'column' => 'Bottom',
                        'row-reverse' => 'Left',
                    ],
                    'default' => 'column',
                    'render_type'  => 'template',
                    'selectors' => [
                        '{{WRAPPER}} .pea-team-member-content-wrapper' => 'flex-direction:{{VALUE}};',
                    ],
                    'condition' => [
                        'social_profiles_display' => 'in-content',
                    ],
                ]
            );
        
            $this->add_control(
                'social_icon_alignment',
                [
                    'label' => esc_html__('Alignment', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'start' => 'Left',
                        'center' => 'Center',
                        'end' => 'Right',
                        'space-between' => 'Between',
                    ],
                    'default' => 'start',
                    'render_type'  => 'template',
                    'selectors' => [
                        '{{WRAPPER}} .pea-team-member-content-wrapper' => 'justify-content:{{VALUE}};',
                    ],
                    'condition' => [
                        'social_profiles_display' => 'in-content',
                        'social_icon_position_for_content' => ['row', 'row-reverse'],
                    ],
                ]
            );
        
            $this->add_control(
                'social_icon_position_for_image',
                [
                    'label' => esc_html__('Icon Position', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'do-top-left' => 'Top Left',
                        'do-top-center' => 'Top Center',
                        'do-top-right' => 'Top Right',
                        'do-center-left' => 'Center Left',
                        'do-center-center' => 'Center Center',
                        'do-center-right' => 'Center Right',
                        'do-bottom-left' => 'Bottom Left',
                        'do-bottom-center' => 'Bottom Center',
                        'do-bottom-right' => 'Bottom Right',
                    ],
                    'default' => 'do-center-center',
                    'render_type'  => 'template',
                    'condition' => [
                        'social_profiles_display' => 'in-image',
                    ],
                ]
            );

            $repeater = new \Elementor\Repeater();
            $repeater->add_control(
                'social_icon_item_title', [
                    'label' => esc_html__( 'Title', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::TEXT,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'default' => esc_html__( 'List Title' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'separator' => 'before',
                    'label_block' => true,
                ]
            );
            $repeater->add_control(
                'social_icon_item_title_url',
                [
                    'label' => esc_html__( 'Link / Url', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::URL,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'placeholder' => esc_html__( 'https://your-link.com', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'default' => [
                        'url' => '',
                        'is_external' => true,
                        'nofollow' => true,
                        'custom_attributes' => '',
                    ],
                    'label_block' => true,
                ]
            );
            $repeater->add_control(
                'social_icon_item_icon',
                [
                    'label' => esc_html__( 'Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'fa-solid',
                    ],
                    'label_block' => true,
                    'skin' => 'inline',
                ]
            );
            $this->add_control(
                'social_icons',
                [
                    'label' => esc_html__( 'Social Items', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'social_icon_item_title' => esc_html__( 'Facebook', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'social_icon_item_icon' => [
                                'value' => 'fab fa-facebook',
                                'library' => 'fa-brands'
                            ],

                        ],
                        [
                            'social_icon_item_title' => esc_html__( 'Twitter (X)', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'social_icon_item_icon' => [
                                'value' => 'fab fa-x-twitter',
                                'library' => 'fa-brands'
                            ],
                        ],
                        [
                            'social_icon_item_title' => esc_html__( 'Linkedin', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'social_icon_item_icon' => [
                                'value' => 'fab fa-linkedin',
                                'library' => 'fa-brands'
                            ],
                        ],
                        [
                            'social_icon_item_title' => esc_html__( 'Dribble', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'social_icon_item_icon' => [
                                'value' => 'fab fa-dribbble',
                                'library' => 'fa-brands'
                            ],
                        ],
                        [
                            'social_icon_item_title' => esc_html__( 'Github', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'social_icon_item_icon' => [
                                'value' => 'fab fa-github',
                                'library' => 'fa-brands'
                            ],
                        ],
                    ],
                    'title_field' => '{{{ social_icon_item_title }}}',
                    'condition' => [
                        'show_social_profiles' => 'yes',
                    ],
                    'render_type'  => 'template',
                ]
            );
            
            $this->add_control(
                'show_separator',
                [
                    'label' => esc_html__('Show Separator', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'condition' => [
                        'show_social_profiles' => 'yes',
                        'social_profiles_display' => 'in-content',
                        'social_icon_position_for_content!' => ['row', 'row-reverse'],
                    ],
                ]
            );
            $this->add_control(
                'separator_position',
                [
                    'label' => esc_html__('Separator Position', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'top' => 'Top',
                        'bottom' => 'Bottom',
                    ],
                    'default' => 'top',
                    'render_type'  => 'template',
                    'condition' => [
                        'show_social_profiles' => 'yes',
                        'social_profiles_display' => 'in-content',
                        'social_icon_position_for_content!' => ['row', 'row-reverse'],
                        'show_separator' => 'yes',
                    ],
                ]
            );

		$this->end_controls_section();
        
        // =====================
        // STYLE TAB
        // =====================            

		$this->start_controls_section(
			'team_member_box_styling_section',
			[
				'label' => esc_html__( 'Box', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

            $this->start_controls_tabs( 'team_member_box_tabs' );

                $this->start_controls_tab(
                    'team_member_box_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'team_member_box_bg_color',
                            'types'          => [ 'classic', 'gradient' ],
                            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                            'exclude'        => [ 'image' ],
                            'fields_options' => [
                                'background' => [
                                    'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                    'default' => 'classic',
                                ],
                                'color' => [
                                    'default' => '#fff', // ✅ Set your default normal color here
                                ],
                            ],
                            'selector'  => '{{WRAPPER}} .pea-team-member-wrapper',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'team_member_box_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-team-member-wrapper',
                            'fields_options' => [
                                'border' => [
                                    'default' => 'solid',
                                ],
                                'width' => [
                                    'default' => [
                                        'top' => 1,
                                        'right' => 1,
                                        'bottom' => 1,
                                        'left' => 1,
                                    ],
                                ],
                                'color' => [
                                    'default' => '#e1e3e8',
                                ],
                            ],
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'team_member_box_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
                
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'team_member_box_hover_bg_color',
                            'types'          => [ 'classic', 'gradient' ],
                            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                            'exclude'        => [ 'image' ],
                            'fields_options' => [
                                'background' => [
                                    'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                    'default' => 'classic',
                                ],
                                'color' => [
                                    'default' => '#EBF5FF', // ✅ Set your default normal color here
                                ],
                            ],
                            'selector'  => '{{WRAPPER}} .pea-team-member-wrapper:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'team_member_box_hover_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-team-member-wrapper:hover',
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs(); 

            $this->add_control(
                'team_member_box_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'team_member_box_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 16,
                        'right' => 16,
                        'bottom' => 16,
                        'left' => 16,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-team-member-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            ); 

            $this->add_responsive_control(
                'team_member_box_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 42,
                        'right' => 32,
                        'bottom' => 42,
                        'left' => 32,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-team-member-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'team_member_box_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => '',
                        'right' => '',
                        'bottom' => '',
                        'left' => '',
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-team-member-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

             $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'team_member_box_shadow',
                    'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				    'selector' => '{{WRAPPER}} .pea-team-member-wrapper',
                ]
            );
		$this->end_controls_section();
        
        // Team Member Avatar Styling Controls
        $this->start_controls_section(
            'team_member_avatar_styling_section',
            [
                'label' => esc_html__('Avatar', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_responsive_control(
                'team_member_avatar_alignment',
                [
                    'label' => esc_html__('Alignment', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => esc_html__('Left', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'end' => [
                            'title' => esc_html__('Right', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-right',
                        ]
                    ],
                    'default' => 'center',
                    'selectors' => [
                        '{{WRAPPER}} .pea-team-member-image-wrapper' => 'justify-content: {{VALUE}};',
                    ],
                    'render_type'  => 'template',
                ]
            );
            
            $this->add_responsive_control(
                'team_member_avatar_width',
                [
                    'label' => esc_html__('Image Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => '',
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-team-member-image' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );   
            
            $this->add_responsive_control(
                'team_member_avatar_height',
                [
                    'label' => esc_html__('Image Height', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => '',
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-team-member-image' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  
        
            // $this->add_control(
            //     'team_member_avatar_fit',
            //     [
            //         'label' => esc_html__('Object Fit', 'unlimited-elementor-inner-sections-by-boomdevs'),
            //         'type' => Controls_Manager::SELECT,
            //         'options' => [
            //             'none' => 'None',
            //             'fill' => 'Fill',
            //             'contain' => 'Contain',
            //             'cover' => 'Cover',
            //             'scale-down' => 'Scale Down',
            //         ],
            //         'default' => 'fill',
            //         'selectors' => [
            //             '{{WRAPPER}} .pea-team-member-image img' => 'object-fit: {{VALUE}};',
            //         ],
            //     ]
            // );

            $this->start_controls_tabs( 'team_member_avatar_tabs' );
                $this->start_controls_tab(
                    'team_member_avatar_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'team_member_avatar_overlay_type',
                            'types'          => [ 'classic', 'gradient' ],
                            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                            'exclude'        => [ 'image' ],
                            'fields_options' => [
                                'background' => [
                                    'label'     => esc_html__( 'Overlay Type ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                    'default' => 'classic',
                                ],
                                'color' => [
                                    'default' => '', // ✅ Set your default normal color here
                                ],
                            ],
                            'selector'  => '{{WRAPPER}} .pea-team-member-image-overlay',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'team_member_avatar_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-team-member-image',
                        ]
                    );
                $this->end_controls_tab();

                $this->start_controls_tab(
                    'team_member_avatar_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'team_member_avatar_hover_overlay_type',
                            'types'          => [ 'classic', 'gradient' ],
                            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                            'exclude'        => [ 'image' ],
                            'fields_options' => [
                                'background' => [
                                    'label'     => esc_html__( 'Overlay Type ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                    'default' => 'classic',
                                ],
                                'color' => [
                                    'default' => '', // ✅ Set your default normal color here
                                ],
                            ],
                            'selector'  => '{{WRAPPER}} .pea-widget-wrapper:hover .pea-team-member-image-overlay',
                        ]
                    );
                    $this->add_control(
                        'team_member_avatar_hover_border_color',
                        [
                            'label'  => esc_html__( 'Border Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-team-member-image' => 'border-color: {{VALUE}}',
                            ],
                        ]
                    );
                $this->end_controls_tab(); 
            $this->end_controls_tabs();   

            $this->add_control(
                'team_member_avatar_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );   
            
            $this->add_responsive_control(
                'team_member_avatar_overlay_opacity',
                [
                    'label' => esc_html__('Overlay Opacity', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [''],
                    'range' => [
                        '' => [
                            'min' => 0,
                            'max' => 1,
                            'step' => 0.01,
                        ],
                    ],
                    'default' => [
                        'unit' => '',
                        'size' => 0.2,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-team-member-item .pea-team-member-image-wrapper .pea-team-member-image-overlay' => 'opacity: {{SIZE}};',
                    ],
                ]
            );  

            $this->add_responsive_control(
                'team_member_avatar_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 200,
                        'right' => 200,
                        'bottom' => 200,
                        'left' => 200,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-team-member-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .pea-team-member-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .pea-team-member-image-overlay' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'team_member_avatar_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 0,
                        'right' => 14,
                        'bottom' => 0,
                        'left' => 0,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-team-member-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
		$this->start_controls_section(
			'team_member_content_styling',
			[
				'label' => esc_html__( 'Content Box', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);	
            $this->add_responsive_control(
                'team_member_content_alignment',
                [
                    'label' => esc_html__('Alignment', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => esc_html__('Left', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'end' => [
                            'title' => esc_html__('Right', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-right',
                        ]
                    ],
                    'default' => 'center',
                    'selectors' => [
                        '{{WRAPPER}} .pea-team-member-name' => 'text-align: {{VALUE}};',
                        '{{WRAPPER}} .pea-team-member-designation' => 'text-align: {{VALUE}};',
                        '{{WRAPPER}} .pea-team-member-desc' => 'text-align: {{VALUE}};',
                    ],
                    'render_type'  => 'template',
                ]
            );
            $this->start_controls_tabs( 'team_member_content_tabs' );
                $this->start_controls_tab(
                    'team_member_content_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                $this->add_control(
                    'team_member_content_bg_type_popover_toggle',
                    [
                        'label' => esc_html__( 'Background Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'type' => Controls_Manager::POPOVER_TOGGLE,
                        'label_off' => esc_html__( 'Default', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'label_on' => esc_html__( 'Custom', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'return_value' => 'yes',
                        'default' => 'yes',
                        'separator' => 'none',
                    ]
                );
                $this->start_popover();
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'team_member_content_bg_color',
                            'types'          => [ 'classic', 'gradient' ],
                            'fields_options' => [
                                'background' => [
                                    'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                    'default' => 'classic',
                                ],
                                'color' => [
                                    'default' => '', // ✅ Set your default normal color here
                                ],
                            ],
                            'selector'  => '{{WRAPPER}} .pea-team-member-content-wrapper',
                        ]
                    );
                $this->end_popover();
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'team_member_content_border',
                        'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'selector' => '{{WRAPPER}} .pea-team-member-content-wrapper',
                    ]
                );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'team_member_content_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );      
                    $this->add_control(
                        'team_member_content_hover_bg_type_popover_toggle',
                        [
                            'label' => esc_html__( 'Background Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::POPOVER_TOGGLE,
                            'label_off' => esc_html__( 'Default', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'label_on' => esc_html__( 'Custom', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'return_value' => 'yes',
                            'default' => 'yes',
                            'separator' => 'none',
                        ]
                    );
                    $this->start_popover();
                        $this->add_group_control(
                            Group_Control_Background::get_type(),
                            [
                                'name'      => 'team_member_content_hover_bg_color',
                                'types'          => [ 'classic', 'gradient' ],
                                'fields_options' => [
                                    'background' => [
                                        'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                        'default' => 'classic',
                                    ],
                                    'color' => [
                                        'default' => '',
                                    ],
                                ],
                                'selector'  => '{{WRAPPER}} .pea-widget-wrapper:hover .pea-team-member-content-wrapper',
                            ]
                        );
                    $this->end_popover();

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'team_member_content_hover_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}}  .pea-widget-wrapper:hover .pea-team-member-content-wrapper',
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'team_member_content_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'team_member_content_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 24,
                        'right' => 24,
                        'bottom' => 24,
                        'left' => 24,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-team-member-content-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            ); 

            $this->add_responsive_control(
                'team_member_content_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 32,
                        'right' => 32,
                        'bottom' => 0,
                        'left' => 32,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-team-member-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'team_member_content_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 0,
                        'right' => 0,
                        'bottom' => 0,
                        'left' => 0,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-team-member-content-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            //  $this->add_group_control(
            //     Group_Control_Box_Shadow::get_type(),
            //     [
            //         'name'     => 'team_member_content_shadow',
            //         'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			// 	    'selector' => '{{WRAPPER}} .pea-team-member-content-wrapper',
            //     ]
            // );    

		$this->end_controls_section();
        
        // Team Member Name Styling Controls
        $this->start_controls_section(
            'team_member_name_styling_section',
            [
                'label' => esc_html__('Name', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'team_member_name_typography',
                    'selector' => '{{WRAPPER}} .pea-team-member-name',
                    'fields_options' => [
                        'typography' => [
                            'default' => 'custom',
                        ],
                        'font_family' => [
                            'default' => 'Plus Jakarta Sans',
                        ],
                        'font_weight' => [
                            'default' => '600',
                        ],
                        'font_size' => [
                            'default' => [
                                'unit' => 'px',
                                'size' => 32,
                            ],
                        ],
                        'line_height' => [
                            'default' => [
                                'unit' => '%',
                                'size' => 130,
                            ],
                        ],
                    ],
                ]
            );

            $this->start_controls_tabs( 'team_member_name_tabs' );
                $this->start_controls_tab(
                    'team_member_name_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'team_member_name_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#15171C',
                            'selectors' => [
                                '{{WRAPPER}} .pea-team-member-name' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'team_member_name_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );

                    $this->add_control(
                        'team_member_name_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-team-member-name' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'team_member_name_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );
            $this->add_responsive_control(
                'team_member_name_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 14,
                        'right' => 0,
                        'bottom' => 14,
                        'left' => 0,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-team-member-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Team Member Badge Styling Controls
        $this->start_controls_section(
            'team_member_badge_styling',
            [
                'label' => esc_html__('Badge', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );  
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'team_member_badge_typography',
                    'selector' => '{{WRAPPER}} .pea-team-member-badge',
                    'fields_options' => [
                        'typography' => [
                            'default' => 'custom',
                        ],
                        'font_family' => [
                            'default' => 'Work Sans',
                        ],
                        'font_weight' => [
                            'default' => '400',
                        ],
                        'font_size' => [
                            'default' => [
                                'unit' => 'px',
                                'size' => 18,
                            ],
                        ],
                        'line_height' => [
                            'default' => [
                                'unit' => '%',
                                'size' => 140,
                            ],
                        ],
                    ],
                ]
            );

            $this->start_controls_tabs( 'team_member_badge_style_tabs' );
            $this->start_controls_tab(
                'team_member_badge_normal_style',
                [
                    'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );
        
                $this->add_control(
                    'team_member_badge_color',
                    [
                        'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '#399CFF',
                        'selectors' => [
                            '{{WRAPPER}} .pea-team-member-badge' => 'color: {{VALUE}}',
                        ],
                    ]
                );
        
                $this->add_control(
                    'team_member_badge_bg_color',
                    [
                        'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-team-member-badge' => 'background: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'team_member_badge_border',
                        'label'    => esc_html__( 'Border', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'selector' => '{{WRAPPER}} .pea-team-member-badge',
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab(
                'team_member_badge_hover_style',
                [
                    'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                ]
            );
        
                $this->add_control(
                    'team_member_badge_hover_color',
                    [
                        'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '#399CFF',
                        'selectors' => [
                            '{{WRAPPER}} .pea-widget-wrapper:hover .pea-team-member-badge' => 'color: {{VALUE}}',
                        ],
                    ]
                );
        
                $this->add_control(
                    'team_member_badge_hover_bg_color',
                    [
                        'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-widget-wrapper:hover .pea-team-member-badge' => 'background-color: {{VALUE}}',
                        ],
                    ]
                );
        
                $this->add_control(
                    'team_member_badge_hover_border_color',
                    [
                        'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-widget-wrapper:hover .pea-team-member-badge' => 'border-color: {{VALUE}}',
                        ],
                    ]
                );

            $this->end_controls_tab(); 
            $this->end_controls_tabs(); 

            $this->add_control(
                'team_member_badge_style_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'team_member_badge_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-team-member-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'team_member_badge_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-team-member-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'team_member_badge_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-team-member-badge' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Team Member Designation Styling Controls
        $this->start_controls_section(
            'team_member_designation_styling_section',
            [
                'label' => esc_html__('Designation', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'team_member_designation_typography',
                    'selector' => '{{WRAPPER}} .pea-team-member-designation',
                    'fields_options' => [
                        'typography' => [
                            'default' => 'custom',
                        ],
                        'font_family' => [
                            'default' => 'Work sans',
                        ],
                        'font_weight' => [
                            'default' => '400',
                        ],
                        'font_size' => [
                            'default' => [
                                'unit' => 'px',
                                'size' => 18,
                            ],
                        ],
                        'line_height' => [
                            'default' => [
                                'unit' => '%',
                                'size' => 140,
                            ],
                        ],
                    ],
                ]
            );

            $this->start_controls_tabs( 'team_member_designation_tabs' );
                $this->start_controls_tab(
                    'team_member_designation_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'team_member_designation_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#15171C',
                            'selectors' => [
                                '{{WRAPPER}} .pea-team-member-designation' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'team_member_designation_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );

                    $this->add_control(
                        'team_member_designation_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-team-member-designation' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'team_member_designation_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );
            $this->add_responsive_control(
                'team_member_designation_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 14,
                        'right' => 0,
                        'bottom' => 14,
                        'left' => 0,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-team-member-designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Team Member Description Styling Controls
        $this->start_controls_section(
            'team_member_description_styling_section',
            [
                'label' => esc_html__('Description', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_description' => 'yes',
                ],
            ]
        );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'team_member_description_typography',
                    'selector' => '{{WRAPPER}} .pea-team-member-desc',
                    'fields_options' => [
                        'typography' => [
                            'default' => 'custom',
                        ],
                        'font_family' => [
                            'default' => 'Work sans',
                        ],
                        'font_weight' => [
                            'default' => '400',
                        ],
                        'font_size' => [
                            'default' => [
                                'unit' => 'px',
                                'size' => 18,
                            ],
                        ],
                        'line_height' => [
                            'default' => [
                                'unit' => '%',
                                'size' => 140,
                            ],
                        ],
                    ],
                ]
            );

            $this->start_controls_tabs( 'team_member_description_tabs' );
                $this->start_controls_tab(
                    'team_member_description_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'team_member_description_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#15171C',
                            'selectors' => [
                                '{{WRAPPER}} .pea-team-member-desc' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'team_member_description_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );

                    $this->add_control(
                        'team_member_description_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-team-member-desc' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'team_member_description_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );
            $this->add_responsive_control(
                'team_member_description_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 14,
                        'right' => 0,
                        'bottom' => 14,
                        'left' => 0,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-team-member-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Social Profile Separator Styling Controls
        $this->start_controls_section(
            'social_profile_separator_styling_section',
            [
                'label' => esc_html__('Social Icon Separator ', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'social_profiles_display' => 'in-content',
                    'social_icon_position_for_content!' => ['row', 'row-reverse'],
                    'show_separator' => 'yes',
                ],
            ]
        );
            $this->add_responsive_control(
                'social_profile_separator_alignment',
                [
                    'label' => esc_html__('Alignment', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => esc_html__('Left', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'end' => [
                            'title' => esc_html__('Right', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-right',
                        ]
                    ],
                    'default' => 'left',
                    'selectors' => [
                        '{{WRAPPER}} .pea-team-member-social-profile-separator' => 'justify-content: {{VALUE}};',
                    ],
                    'render_type'  => 'template',
                ]
            );
            $this->add_responsive_control(
                'social_profile_separator_width',
                [
                    'label' => esc_html__('Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 100,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-team-member-social-profile-separator hr' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  
            $this->add_responsive_control(
                'social_profile_separator_height',
                [
                    'label' => esc_html__('Height', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 1,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-team-member-social-profile-separator hr' => 'border-top-width: {{SIZE}}{{UNIT}};border-top-style:solid;',
                    ],
                ]
            );  
            $this->start_controls_tabs( 'social_profile_separator_tabs' );
                $this->start_controls_tab(
                    'social_profile_separator_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                    $this->add_control(
                        'social_profile_separator_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#E1E3E8',
                            'selectors' => [
                                '{{WRAPPER}} .pea-team-member-social-profile-separator hr' => 'border-top-color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'social_profile_separator_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'social_profile_separator_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-team-member-social-profile-separator hr' => 'border-top-color: {{VALUE}};',
                            ],
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();   

            $this->add_control(
                'social_profile_separator_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'social_profile_separator_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => '',
                        'right' => '',
                        'bottom' => '',
                        'left' => '',
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-team-member-social-profile-separator hr' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Team Member Social Icon Button  Styling Controls
        $this->start_controls_section(
            'team_member_social_icon_button_styling_section',
            [
                'label' => esc_html__('Icon Button', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_Icon' => 'yes',
                ],
            ]
        );
            
            $this->add_responsive_control(
                'team_member_social_icon_button_size',
                [
                    'label' => esc_html__('Icon Size', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 20,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-team-member-social-icon-wrapper-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-team-member-social-icon-wrapper-btn svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            ); 

            $this->start_controls_tabs( 'team_member_social_icon_button_tabs' );
                $this->start_controls_tab(
                    'team_member_social_icon_button_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_responsive_control(
                        'team_member_social_icon_button_rotate',
                        [
                            'label' => esc_html__('Rotate Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => ['deg'],
                            'range' => [
                                'deg' => [
                                    'min' => -360,
                                    'max' => 360,
                                ],
                            ],
                            'default' => [
                                'unit' => 'deg',
                                'size' => 0,
                            ],
                            'selectors'       => [
                                '{{WRAPPER}} .pea-team-member-social-icon-wrapper-btn' => 'transform: rotate({{SIZE}}deg);',
                            ],
                        ]
                    );
            
                    $this->add_control(
                        'team_member_social_icon_button_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#15171C',
                            'selectors' => [
                                '{{WRAPPER}} .pea-team-member-social-icon-wrapper-btn i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-team-member-social-icon-wrapper-btn svg' => 'fill: {{VALUE}};',
                            ]
                        ]
                    );
            
                    $this->add_control(
                        'team_member_social_icon_button_bg_color',
                        [
                            'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#FFFFFF',
                            'selectors' => [
                                '{{WRAPPER}} .pea-team-member-social-icon-wrapper-btn' => 'background-color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'team_member_social_icon_button_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-team-member-social-icon-wrapper-btn',
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'team_member_social_icon_button_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
            
                    $this->add_responsive_control(
                        'team_member_social_icon_button_hover_rotate',
                        [
                            'label' => esc_html__('Rotate Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => ['deg'],
                            'range' => [
                                'deg' => [
                                    'min' => -360,
                                    'max' => 360,
                                ],
                            ],
                            'default' => [
                                'unit' => 'deg',
                                'size' => 0,
                            ],
                            'selectors'       => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-team-member-social-icon-wrapper-btn' => 'transform: rotate({{SIZE}}deg);',
                            ],
                        ]
                    );
                
                    $this->add_control(
                        'team_member_social_icon_button_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-team-member-social-icon-wrapper-btn i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-team-member-social-icon-wrapper-btn svg' => 'fill: {{VALUE}};',
                            ]
                        ]
                    );
                
                    $this->add_control(
                        'team_member_social_icon_button_bg_hover_color',
                        [
                            'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-team-member-social-icon-wrapper-btn' => 'background-color: {{VALUE}};',
                            ]
                        ]
                    );
                
                    $this->add_control(
                        'team_member_social_icon_button_border_hover_color',
                        [
                            'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-team-member-social-icon-wrapper-btn' => 'border-color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'team_member_social_icon_button_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'team_member_social_icon_button_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => '',
                        'right' => '',
                        'bottom' => '',
                        'left' => '',
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-team-member-social-icon-wrapper-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            ); 

            $this->add_responsive_control(
                'team_member_social_icon_button_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => '14',
                        'right' => '14',
                        'bottom' => '14',
                        'left' => '14',
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-team-member-social-icon-wrapper-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            ); 

            $this->add_responsive_control(
                'team_member_social_icon_button_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => '',
                        'right' => '',
                        'bottom' => '',
                        'left' => '',
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-team-member-social-icon-wrapper-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            ); 
        
        $this->end_controls_section();
        
        // Team Member Social Profiles Styling Controls
        $this->start_controls_section(
            'team_member_social_icon_styling_section',
            [
                'label' => esc_html__('Social Profiles', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_social_profiles' => 'yes',
                ],
            ]
        );
            
            $this->add_control(
                'team_member_social_icon_single_switch',
                [
                    'label' => esc_html__('Single Icon Style', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
            
            $this->add_responsive_control(
                'team_member_social_icon_size',
                [
                    'label' => esc_html__('Icon Size', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 18,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-team-member-social-profile .pea-team-member-social-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-team-member-social-profile .pea-team-member-social-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            ); 
            
            $this->add_responsive_control(
                'team_member_social_icon_gap',
                [
                    'label' => esc_html__('Icon Spacing', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 29,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-team-member-social-profile' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->start_controls_tabs( 'team_member_social_icon_tabs' );
                $this->start_controls_tab(
                    'team_member_social_icon_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'team_member_social_icon_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#15171C',
                            'selectors' => [
                                '{{WRAPPER}} .pea-team-member-social-icon i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-team-member-social-icon svg' => 'fill: {{VALUE}};',
                            ]
                        ]
                    );
            
                    $this->add_control(
                        'team_member_social_icon_bg_color',
                        [
                            'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#fff',
                            'selectors' => [
                                '{{WRAPPER}} .single-icon .pea-team-member-social-icon' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .icon-in-group .pea-team-member-social-profile' => 'background-color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'team_member_social_icon_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}}  .single-icon .pea-team-member-social-icon, {{WRAPPER}} .icon-in-group .pea-team-member-social-profile',
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'team_member_social_icon_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
                
                    $this->add_control(
                        'team_member_social_icon_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-team-member-social-icon i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-team-member-social-icon svg' => 'fill: {{VALUE}};',
                            ]
                        ]
                    );
                
                    $this->add_control(
                        'team_member_social_icon_bg_hover_color',
                        [
                            'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover .single-icon .pea-team-member-social-icon' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .pea-widget-wrapper:hover .icon-in-group .pea-team-member-social-profile' => 'background-color: {{VALUE}};',
                            ]
                        ]
                    );
                
                    $this->add_control(
                        'team_member_social_icon_border_hover_color',
                        [
                            'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover .single-icon .pea-team-member-social-icon' => 'border-color: {{VALUE}};',
                                '{{WRAPPER}} .pea-widget-wrapper:hover .icon-in-group .pea-team-member-social-profile' => 'border-color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'team_member_social_icon_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );
            $this->add_control(
                'team_member_social_icon_blur',
                [
                    'label' => __( 'Blur', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [ 
                            'min' => 0, 
                            'max' => 100,
                            'step' => 1 
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .single-icon .pea-team-member-social-icon' => '-webkit-backdrop-filter: blur({{SIZE}}px);backdrop-filter: blur({{SIZE}}px);',
                        '{{WRAPPER}} .icon-in-group .pea-team-member-social-profile' => '-webkit-backdrop-filter: blur({{SIZE}}px);backdrop-filter: blur({{SIZE}}px);',
                    ],
                ]
            );

            $this->add_responsive_control(
                'team_member_social_icon_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 150,
                        'right' => 150,
                        'bottom' => 150,
                        'left' => 150,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .single-icon .pea-team-member-social-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .icon-in-group .pea-team-member-social-profile' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            ); 

            $this->add_responsive_control(
                'team_member_social_icon_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 16,
                        'right' => 16,
                        'bottom' => 16,
                        'left' => 16,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .single-icon .pea-team-member-social-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .icon-in-group .pea-team-member-social-profile' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            ); 

            $this->add_responsive_control(
                'team_member_social_icon_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => '',
                        'right' => '',
                        'bottom' => '',
                        'left' => '',
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .single-icon .pea-team-member-social-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .icon-in-group .pea-team-member-social-profile' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            ); 
        
        $this->end_controls_section();
    }
    
    /**
     * Render widget output on the frontend
     */
    protected function render() {
        $settings = $this->get_settings_for_display(); 
        $preset_styles = isset($settings['preset_styles']) ? $settings['preset_styles'] : '' ;

        $name = isset($settings['name']) ? $settings['name'] : '' ;  
        $name_tag = isset($settings['name_tag']) ? $settings['name_tag'] : '' ;  
        $designation = isset($settings['designation']) ? $settings['designation'] : '' ;
        $show_description = isset($settings['show_description']) ? $settings['show_description'] : '' ;
        $description = isset($settings['description']) ? $settings['description'] : '' ;
        $separator = isset($settings['show_separator']) ? $settings['show_separator'] : '' ;  
        $separator_position = isset($settings['separator_position']) ? $settings['separator_position'] : '' ;  
        $show_Icon = isset($settings['show_Icon']) ? $settings['show_Icon'] : '' ; 
        $icon = isset($settings['icon']) ? $settings['icon'] : '' ; 
        $show_social_icons = isset($settings['show_social_profiles']) ? $settings['show_social_profiles'] : '' ;  
        $display_icon = isset($settings['social_profiles_display']) ? $settings['social_profiles_display'] : '' ;  
        $single_icon_style = isset($settings['team_member_social_icon_single_switch']) ? $settings['team_member_social_icon_single_switch'] : '' ; 
        $single_icon_style = $single_icon_style === 'yes' ? 'single-icon' : 'icon-in-group';
        ?>
        <div class="pea-widget-wrapper pea-team-member-wrapper " id="">
            <div class="pea-team-member-item">
                <?php if($settings['show_badge'] === 'yes' && $settings['badge_position'] === 'badge-in-content'){ ?>
                    <div class="pea-team-member-badge-wrapper <?php echo esc_attr($settings['badge_alignment']); ?>">
                        <span class="pea-team-member-badge"><?php echo esc_html($settings['badge_text']); ?></span>
                    </div>
                <?php } ?>
                <div class="pea-team-member-image-wrapper">
                    <?php if($settings['show_badge'] === 'yes' && $settings['badge_position'] === 'badge-in-image'){ ?>
                        <div class="pea-team-member-badge-wrapper <?php echo esc_attr($settings['badge_alignment']); ?>">
                            <span class="pea-team-member-badge"><?php echo esc_html($settings['badge_text']); ?></span>
                        </div>
                    <?php } ?>
                    <div class="pea-team-member-image">
                        <?php if($settings['avatar_image_overlay'] === 'yes'){ ?> 
                            <div class="pea-team-member-image-overlay"></div>
                        <?php } ?>
                        <?php if(!empty($settings['avatar_image']['url'])){ $image_url = $settings['avatar_image']['url']; ?> 
                            <img src="<?php echo esc_url($image_url) ?>" alt="">
                        <?php } ?> 
                        <?php if($display_icon === 'in-image'){ ?> 
                            <div class="pea-team-member-social-profile-wrapper <?php echo esc_attr($settings['social_icon_position_for_image']); ?> <?php echo esc_attr($single_icon_style); ?> ">
                                <?php if($show_Icon === 'yes'){ ?>  
                                    <button class="pea-team-member-social-icon-wrapper-btn" aria-label="Social Icon">
                                        <?php \Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] ); ?>            
                                    </button> 
                                <?php } ?>
                                <?php if($show_social_icons === 'yes'){ ?>
                                    <div class="pea-team-member-social-profile <?php echo esc_attr($settings['icon_animation_type']); ?>">
                                        <?php foreach ( $settings['social_icons'] as $index => $icon ) : 
                                            $icon_link = $icon['social_icon_item_title_url']['url'];
                                            $icon_target = $icon['social_icon_item_title_url']['is_external'] ? ' target=_blank' : '';
                                            $icon_nofollow = $icon['social_icon_item_title_url']['nofollow'] ? ' rel=nofollow' : ''; 
                                            ?>
                                            
                                            <a 
                                                href="<?php echo esc_url($icon_link); ?>"
                                                <?php echo esc_attr($icon_target); ?>
                                                <?php echo esc_attr($icon_nofollow); ?>
                                                class="pea-team-member-social-icon" 
                                                aria-label="Social Icon"
                                            >
                                                <?php \Elementor\Icons_Manager::render_icon( $icon['social_icon_item_icon'], [ 'aria-hidden' => 'true' ] ); ?>              
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php } ?>    
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="pea-team-member-content-wrapper">
                    <div class="pea-team-member-content">
                        <<?php echo esc_attr($name_tag); ?> class="pea-team-member-name">
                            <?php echo esc_html($name); ?>
                        </<?php echo esc_attr($name_tag); ?>>
                        <span class="pea-team-member-designation">
                            <?php echo esc_html($designation); ?>
                        </span>
                        <?php if($show_description === 'yes'){ ?>
                            <p class="pea-team-member-desc">
                                <?php echo esc_html($description); ?>                         
                            </p>
                        <?php } ?>
                    </div>     
                    
                    <?php if($display_icon === 'in-content'){ ?> 
                        <?php if($separator === 'yes' && $separator_position === 'top'){ ?>  
                            <div class="pea-team-member-social-profile-separator"><hr></div>
                        <?php } ?> 
                        <div class="pea-team-member-social-profile-wrapper <?php echo esc_attr($single_icon_style); ?> ">
                            <?php if($show_Icon === 'yes'){ ?>  
                                <button class="pea-team-member-social-icon-wrapper-btn" aria-label="Social Icon">
                                    <?php \Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] ); ?>            
                                </button> 
                            <?php } ?>
                            <?php if($show_social_icons === 'yes'){ ?>
                                <div class="pea-team-member-social-profile <?php echo esc_attr($settings['icon_animation_type']); ?>">
                                    <?php foreach ( $settings['social_icons'] as $index => $icon ) : 
                                        $icon_link = $icon['social_icon_item_title_url']['url'];
                                        $icon_target = $icon['social_icon_item_title_url']['is_external'] ? ' target=_blank' : '';
                                        $icon_nofollow = $icon['social_icon_item_title_url']['nofollow'] ? ' rel=nofollow' : ''; ?>
                                        
                                        <a 
                                            href="<?php echo esc_url($icon_link); ?>"
                                            <?php echo esc_attr($icon_target); ?>
                                            <?php echo esc_attr($icon_nofollow); ?>
                                            class="pea-team-member-social-icon" 
                                            aria-label="Social Icon"
                                        >
                                            <?php \Elementor\Icons_Manager::render_icon( $icon['social_icon_item_icon'], [ 'aria-hidden' => 'true' ] ); ?>              
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php } ?>     
                        </div>  
                        <?php if($separator === 'yes' && $separator_position === 'bottom'){ ?>  
                            <div class="pea-team-member-social-profile-separator"><hr></div>
                        <?php } ?>  
                    <?php } ?>
                </div>
            </div>   
        </div>
        <?php 
    }
}