<?php
namespace PrimeElementorAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit;

class CodeSnippet extends Widget_Base {

    public function get_name() {
        return 'pea_code_snippet';
    }

    public function get_title() {
        return __( 'Code Snippet', 'unlimited-elementor-inner-sections-by-boomdevs' );
    }

    public function get_icon() {
        return 'pea_code_snippet_icon';
    }

    public function get_categories() {
        return [ 'prime-elementor-addons' ];
    }

    public function get_keywords() {
        return [ 'code', 'snippet', 'highlight', 'syntax', 'prism' ];
    }

//     public function get_style_depends() {
//         return [ 'prismjs', 'code-snippet' ];
//     }

//     public function get_script_depends() {
//         return [ 'prismjs', 'code-snippet' ];
//     }

     public function get_style_depends() {
        return ['prismjs', 'prismjs-line-numbers', 'prismjs-line-highlight', 'prime-elementor-addons--code-snippet'];
     }

     public function get_script_depends() {
        return ['prismjs', 'prismjs-line-numbers', 'prismjs-line-highlight', 'prime-elementor-addons--code-snippet'];
     }

    protected function register_controls() {

        // =====================================================
        // SECTION: Code Tabs (Repeater)
        // =====================================================
        $this->start_controls_section(
            'section_code_tabs',
            [
                'label' => __( 'Code Tabs', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );


        $repeater = new Repeater();

        $repeater->add_control(
            'tab_title',
            [
                'label'       => __( 'Tab Title', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'style.css',
                'placeholder' => 'filename.ext',
            ]
        );

        $repeater->add_control(
            'code_language',
            [
                'label'   => __( 'Language', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'css',
                'options' => [
                    'html'       => 'HTML',
                    'css'        => 'CSS',
                    'javascript' => 'JavaScript',
                    'php'        => 'PHP',
                    'python'     => 'Python',
                    'java'       => 'Java',
                    'cpp'        => 'C++',
                    'c'          => 'C',
                    'typescript' => 'TypeScript',
                    'json'       => 'JSON',
                    'bash'       => 'Bash/Shell',
                    'sql'        => 'SQL',
                    'ruby'       => 'Ruby',
                    'go'         => 'Go',
                    'rust'       => 'Rust',
                    'swift'      => 'Swift',
                    'kotlin'     => 'Kotlin',
                    'yaml'       => 'YAML',
                    'markdown'   => 'Markdown',
                    'xml'        => 'XML',
                ],
            ]
        );

        $repeater->add_control(
            'code_source',
            [
                'label'   => __( 'Code Source', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'manual',
                'options' => [
                    'manual' => __( 'Manual Input', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'github' => __( 'GitHub / Gist URL', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ],
            ]
        );

        $repeater->add_control(
            'code_content',
            [
                'label'       => __( 'Code', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'        => Controls_Manager::CODE,
                'language'    => 'css',
                'rows'        => 12,
                'default'     => "body {\n  margin: 0;\n  padding: 0;\n  font-family: 'Fira Code', monospace;\n}",
                'condition'   => [ 'code_source' => 'manual' ],
            ]
        );

        $repeater->add_control(
            'github_url',
            [
                'label'       => __( 'GitHub / Gist URL', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => 'https://gist.github.com/username/...',
                'condition'   => [ 'code_source' => 'github' ],
            ]
        );


        $repeater->add_control(
            'highlight_lines',
            [
                'label'       => __( 'Highlight Lines', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'        => Controls_Manager::NUMBER,
                'placeholder' => '1,3,5,7',
                'description' => __( 'You can highlight your code line by the line number. Use comma-separated values (e.g., 1,3,5)', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            ]
        );

        $this->add_control(
            'code_tabs',
            [
                'label'       => __( 'Code Tabs', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'tab_title'    => 'style.css',
                        'code_language'=> 'css',
                        'code_source'  => 'manual',
                        'code_content' => "body {\n  margin: 0;\n  padding: 0;\n  background: #1a1a2e;\n  color: #eee;\n}",
                    ],
                    [
                        'tab_title'    => 'script.js',
                        'code_language'=> 'javascript',
                        'code_source'  => 'manual',
                        'code_content' => "document.addEventListener('DOMContentLoaded', function() {\n  console.log('Hello World!');\n});",
                    ],
                ],
                'title_field' => '{{{ tab_title }}}',
            ]
        );

        $this->end_controls_section();

        // =====================================================
        // SECTION: Window & Header Settings
        // =====================================================
        $this->start_controls_section(
            'section_window',
            [
                'label' => __( 'Window & Header', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_macos_dots',
            [
                'label'        => __( 'Mac-OS Window Dots', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'label_off'    => __( 'Hide', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'window_title',
            [
                'label'       => __( 'Window Title', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'Code Snippet',
                'placeholder' => 'Enter title...',
            ]
        );

        $this->add_control(
            'show_language_badge',
            [
                'label'        => __( 'Language Badge', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'label_off'    => __( 'Hide', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'show_copy_button',
            [
                'label'        => __( 'Copy to Clipboard Button', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'copy_text',
            [
                'label'     => __( 'Copy Button Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => 'Copy',
                'condition' => [ 'show_copy_button' => 'yes' ],
            ]
        );

        $this->add_control(
            'copied_text',
            [
                'label'     => __( 'Copied! Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => 'Copied!',
                'condition' => [ 'show_copy_button' => 'yes' ],
            ]
        );

        $this->add_control(
            'show_download_button',
            [
                'label'        => __( 'Download Button', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->end_controls_section();

        // =====================================================
        // SECTION: Display Options
        // =====================================================
        $this->start_controls_section(
            'section_display',
            [
                'label' => __( 'Display Options', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_line_numbers',
            [
                'label'        => __( 'Line Numbers', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'word_wrap',
            [
                'label'        => __( 'Word Wrap', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => '',
            ]
        );

        $this->add_control(
            'enable_code_folding',
            [
                'label'        => __( 'Code Folding', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'enable_live_preview',
            [
                'label'        => __( 'Live Preview (HTML/CSS)', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => '',
                'description'  => __( 'Shows a live rendered preview below the code block.', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            ]
        );

        $this->add_control(
            'max_height',
            [
                'label'      => __( 'Max Height (px)', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [ 'min' => 100, 'max' => 1000, 'step' => 10 ],
                ],
                'default'    => [ 'unit' => 'px', 'size' => 400 ],
            ]
        );

        $this->add_control(
            'syntax_theme',
            [
                'label'   => __( 'Syntax Theme', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'GitHub Light',
                'options' => [
                    'dracula'          => 'Dracula',
                    'monokai'          => 'Monokai',
                    'oceanic-next'     => 'Oceanic Next',
                    'one-dark'         => 'One Dark',
                    'nord'             => 'Nord',
                    'tomorrow-night'   => 'Tomorrow Night',
                    'solarized-dark'   => 'Solarized Dark',
                    'solarized-light'  => 'Solarized Light',
                    'github-dark'      => 'GitHub Dark',
                    'github-light'     => 'GitHub Light',
                    'material-dark'    => 'Material Dark',
                    'material-light'   => 'Material Light',
                    'vs-dark'          => 'VS Code Dark',
                    'vs-light'         => 'VS Code Light',
                    'atom-dark'        => 'Atom Dark',
                    'ayu-dark'         => 'Ayu Dark',
                    'ayu-mirage'       => 'Ayu Mirage',
                    'night-owl'        => 'Night Owl',
                    'cobalt'           => 'Cobalt',
                    'twilight'         => 'Twilight',
                    'zenburn'          => 'Zenburn',
                    'base16-ocean'     => 'Base16 Ocean',
                ],
            ]
        );

        $this->end_controls_section();

        // =====================================================
        // SECTION: Style - Container
        // =====================================================
        $this->start_controls_section(
            'section_style_container',
            [
                'label' => __( 'Container Style', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'enable_glassmorphism',
            [
                'label'        => __( 'Glassmorphism Effect', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => '',
            ]
        );

        $this->add_control(
            'glass_blur',
            [
                'label'      => __( 'Glass Blur (px)', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [ 'px' => [ 'min' => 0, 'max' => 40 ] ],
                'default'    => [ 'unit' => 'px', 'size' => 10 ],
                'condition'  => [ 'enable_glassmorphism' => 'yes' ],
                'selectors'  => [
                    '{{WRAPPER}} .prime-code-snippet-wrapper' => 'backdrop-filter: blur({{SIZE}}px); -webkit-backdrop-filter: blur({{SIZE}}px);',
                ],
            ]
        );

        $this->add_control(
            'enable_gradient_border',
            [
                'label'        => __( 'Gradient Border', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => '',
            ]
        );

        $this->add_control(
            'gradient_border_color_1',
            [
                'label'     => __( 'Gradient Color 1', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#7c3aed',
                'condition' => [ 'enable_gradient_border' => 'yes' ],
            ]
        );

        $this->add_control(
            'gradient_border_color_2',
            [
                'label'     => __( 'Gradient Color 2', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#06b6d4',
                'condition' => [ 'enable_gradient_border' => 'yes' ],
            ]
        );

        $this->add_control(
            'gradient_border_width',
            [
                'label'     => __( 'Border Width (px)', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [ 'px' => [ 'min' => 1, 'max' => 6 ] ],
                'default'   => [ 'unit' => 'px', 'size' => 2 ],
                'condition' => [ 'enable_gradient_border' => 'yes' ],
            ]
        );

        $this->add_control(
            'enable_glow',
            [
                'label'        => __( 'Box Shadow / Glow Effect', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'glow_color',
            [
                'label'     => __( 'Glow Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => 'rgba(124, 58, 237, 0.4)',
                'condition' => [ 'enable_glow' => 'yes' ],
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label'      => __( 'Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'top'    => 12,
                    'right'  => 12,
                    'bottom' => 12,
                    'left'   => 12,
                    'unit'   => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .prime-code-snippet-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'container_padding',
            [
                'label'      => __( 'Container Padding', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .prime-code-snippet-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'container_margin',
            [
                'label'      => __( 'Container Margin', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .prime-code-snippet-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // =====================================================
        // SECTION: Style - Typography
        // =====================================================
        $this->start_controls_section(
            'section_style_typography',
            [
                'label' => __( 'Code Typography', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'code_font_family',
            [
                'label'   => __( 'Font Family', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'fira-code',
                'options' => [
                    'fira-code'        => 'Fira Code',
                    'source-code-pro'  => 'Source Code Pro',
                    'jetbrains-mono'   => 'JetBrains Mono',
                    'cascadia-code'    => 'Cascadia Code',
                    'inconsolata'      => 'Inconsolata',
                    'hack'             => 'Hack',
                    'ubuntu-mono'      => 'Ubuntu Mono',
                    'courier-new'      => 'Courier New',
                    'monospace'        => 'System Monospace',
                ],
            ]
        );

        $this->add_control(
            'code_font_size',
            [
                'label'      => __( 'Font Size', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'range'      => [ 'px' => [ 'min' => 10, 'max' => 24 ] ],
                'default'    => [ 'unit' => 'px', 'size' => 14 ],
                'selectors'  => [
                    '{{WRAPPER}} .prime-code-snippet-wrapper pre code' => 'font-size: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_control(
            'code_line_height',
            [
                'label'      => __( 'Line Height', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'em' ],
                'range'      => [ 'em' => [ 'min' => 1, 'max' => 3, 'step' => 0.1 ] ],
                'default'    => [ 'unit' => 'em', 'size' => 1.6 ],
                'selectors'  => [
                    '{{WRAPPER}} .prime-code-snippet-wrapper pre code' => 'line-height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->end_controls_section();

        // =====================================================
        // SECTION: Style - Header
        // =====================================================
        $this->start_controls_section(
            'section_style_header',
            [
                'label' => __( 'Header Style', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'header_bg_color',
            [
                'label'     => __( 'Header Background', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#1e1e2e',
                'selectors' => [
                    '{{WRAPPER}} .prime-cs-header' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'header_text_color',
            [
                'label'     => __( 'Header Text Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#cdd6f4',
                'selectors' => [
                    '{{WRAPPER}} .prime-cs-window-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tab_active_color',
            [
                'label'     => __( 'Active Tab Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#7c3aed',
                'selectors' => [
                    '{{WRAPPER}} .prime-cs-tab.active' => 'border-bottom-color: {{VALUE}}; color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'copy_btn_bg',
            [
                'label'     => __( 'Copy Button Background', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#7c3aed',
                'selectors' => [
                    '{{WRAPPER}} .prime-cs-copy-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'copy_btn_text_color',
            [
                'label'     => __( 'Copy Button Text Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .prime-cs-copy-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $tabs           = $settings['code_tabs'];
        $show_macos     = $settings['show_macos_dots'] === 'yes';
        $window_title   = $settings['window_title'];
        $show_badge     = $settings['show_language_badge'] === 'yes';
        $show_copy      = $settings['show_copy_button'] === 'yes';
        $copy_text      = esc_html( $settings['copy_text'] );
        $copied_text    = esc_html( $settings['copied_text'] );
        $show_download  = $settings['show_download_button'] === 'yes';
        $show_line_nums = $settings['show_line_numbers'] === 'yes';
        $word_wrap      = $settings['word_wrap'] === 'yes';
        $code_folding   = $settings['enable_code_folding'] === 'yes';
        $live_preview   = $settings['enable_live_preview'] === 'yes';
        $max_height     = isset( $settings['max_height']['size'] ) ? intval( $settings['max_height']['size'] ) : 400;
        $syntax_theme   = esc_attr( $settings['syntax_theme'] );
        $glass          = $settings['enable_glassmorphism'] === 'yes';
        $grad_border    = $settings['enable_gradient_border'] === 'yes';
        $grad_color1    = esc_attr( $settings['gradient_border_color_1'] );
        $grad_color2    = esc_attr( $settings['gradient_border_color_2'] );
        $grad_width     = isset( $settings['gradient_border_width']['size'] ) ? intval( $settings['gradient_border_width']['size'] ) : 2;
        $glow           = $settings['enable_glow'] === 'yes';
        $glow_color     = esc_attr( $settings['glow_color'] );
        $font_family    = esc_attr( $settings['code_font_family'] );

        $wrapper_classes = [ 'prime-code-snippet-wrapper' ];
        $wrapper_classes[] = 'prime-theme-' . $syntax_theme;
        $wrapper_classes[] = 'prime-font-' . $font_family;
        if ( $glass ) $wrapper_classes[] = 'prime-glass';
        if ( $word_wrap ) $wrapper_classes[] = 'prime-word-wrap';

        $wrapper_style = '';
        if ( $glow ) {
            $wrapper_style .= 'box-shadow: 0 0 30px ' . $glow_color . ', 0 8px 32px rgba(0,0,0,0.4);';
        }
        if ( $grad_border ) {
            $wrapper_style .= 'border: ' . $grad_width . 'px solid transparent;';
            $wrapper_style .= 'background-clip: padding-box;';
        }

        $data_attrs = 'data-theme="' . $syntax_theme . '"'
            . ' data-max-height="' . $max_height . '"'
            . ' data-line-numbers="' . ( $show_line_nums ? '1' : '0' ) . '"'
            . ' data-word-wrap="' . ( $word_wrap ? '1' : '0' ) . '"'
            . ' data-folding="' . ( $code_folding ? '1' : '0' ) . '"'
            . ' data-live-preview="' . ( $live_preview ? '1' : '0' ) . '"'
            . ' data-copy-text="' . $copy_text . '"'
            . ' data-copied-text="' . $copied_text . '"';

        if ( $grad_border ) {
            $data_attrs .= ' data-grad-border="1"'
                . ' data-grad-color1="' . $grad_color1 . '"'
                . ' data-grad-color2="' . $grad_color2 . '"'
                . ' data-grad-width="' . $grad_width . '"';
        }

        ?>
        <div class="<?php echo esc_attr( implode( ' ', $wrapper_classes ) ); ?>"
             style="<?php echo esc_attr( $wrapper_style ); ?>"
             <?php echo $data_attrs; ?>>

            <?php // ---- Header ---- ?>
            <div class="prime-cs-header">
                <div class="prime-cs-header-left">
                    <?php if ( $show_macos ) : ?>
                    <div class="prime-cs-macos-dots">
                        <span class="dot dot-red"></span>
                        <span class="dot dot-yellow"></span>
                        <span class="dot dot-green"></span>
                    </div>
                    <?php endif; ?>
                    <?php if ( $window_title ) : ?>
                    <span class="prime-cs-window-title"><?php echo esc_html( $window_title ); ?></span>
                    <?php endif; ?>
                </div>

                <div class="prime-cs-header-right">
                    <?php if ( $show_copy ) : ?>
                    <button class="prime-cs-copy-btn" type="button" title="Copy to clipboard">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                        <span class="prime-cs-copy-label"><?php echo $copy_text; ?></span>
                    </button>
                    <?php endif; ?>

                    <?php if ( $show_download ) : ?>
                    <button class="prime-cs-download-btn" type="button" title="Download file">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                        <span class="prime-cs-download-label">Download</span>
                    </button>
                    <?php endif; ?>

                    <button class="prime-cs-refresh-btn" type="button" title="Refresh code from source" style="display: none;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.5 2v6h-6M2.5 22v-6h6M2 11.5a10 10 0 0 1 18.8-4.3M22 12.5a10 10 0 0 1-18.8 4.2"></path></svg>
                    </button>

                    <button class="prime-cs-wrap-btn" type="button" title="Toggle word wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="17 1 21 5 17 9"></polyline><path d="M3 11V9a4 4 0 0 1 4-4h14"></path><polyline points="7 23 3 19 7 15"></polyline><path d="M21 13v2a4 4 0 0 1-4 4H3"></path></svg>
                    </button>
                </div>
            </div>

            <?php // ---- Tabs ---- ?>
            <?php if ( count( $tabs ) > 1 ) : ?>
            <div class="prime-cs-tabs-bar">
                <?php foreach ( $tabs as $index => $tab ) : ?>
                <button class="prime-cs-tab <?php echo $index === 0 ? 'active' : ''; ?>"
                        data-tab="<?php echo esc_attr( $index ); ?>">
                    <?php echo esc_html( $tab['tab_title'] ); ?>
                </button>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <?php // ---- Code Panels ---- ?>
            <?php foreach ( $tabs as $index => $tab ) :
                $lang       = esc_attr( $tab['code_language'] );
                $source     = $tab['code_source'];
                $code       = $source === 'manual' ? $tab['code_content'] : '';
                $github_url = $source === 'github' ? esc_url( $tab['github_url']['url'] ) : '';
                $hl_lines   = esc_attr( $tab['highlight_lines'] );
                $tab_title  = esc_attr( $tab['tab_title'] );

                $panel_cls = 'prime-cs-panel' . ( $index === 0 ? ' active' : '' );
                $pre_cls   = 'language-' . $lang . ( $show_line_nums ? ' line-numbers' : '' );
            ?>
            <div class="<?php echo $panel_cls; ?>"
                 data-tab="<?php echo esc_attr( $index ); ?>"
                 data-filename="<?php echo $tab_title; ?>"
                 data-github-url="<?php echo $github_url; ?>">

                <?php if ( $show_badge ) : ?>
                <span class="prime-cs-lang-badge prime-lang-<?php echo $lang; ?>">
                    <?php echo strtoupper( $lang ); ?>
                </span>
                <?php endif; ?>

                <div class="prime-cs-code-wrap" style="max-height:<?php echo $max_height; ?>px;">
                    <pre class="<?php echo $pre_cls; ?>"
                         <?php echo $hl_lines ? 'data-line="' . $hl_lines . '"' : ''; ?>><code class="language-<?php echo $lang; ?>"><?php echo esc_html( $code ); ?></code></pre>
                </div>

                <?php if ( $live_preview && in_array( $lang, [ 'html', 'css' ] ) ) : ?>
                <div class="prime-cs-live-preview">
                    <div class="prime-cs-live-preview-header">Live Preview</div>
                    <iframe class="prime-cs-preview-frame" sandbox="allow-scripts allow-same-origin"></iframe>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>

        </div>
        <?php
    }

    protected function content_template() {
        // JS template for Elementor editor live preview
        ?>
        <# 
        var tabs = settings.code_tabs;
        var show_macos = settings.show_macos_dots === 'yes';
        var show_badge = settings.show_language_badge === 'yes';
        var show_copy = settings.show_copy_button === 'yes';
        var show_download = settings.show_download_button === 'yes';
        var show_line_numbers = settings.show_line_numbers === 'yes';
        var syntax_theme = settings.syntax_theme;
        var max_height = settings.max_height.size || 400;
        var glass = settings.enable_glassmorphism === 'yes';
        var wrapper_cls = 'prime-code-snippet-wrapper prime-theme-' + syntax_theme + ' prime-font-' + settings.code_font_family;
        if (glass) wrapper_cls += ' prime-glass';
        if (settings.word_wrap === 'yes') wrapper_cls += ' prime-word-wrap';
        #>
        <div class="{{ wrapper_cls }}" data-theme="{{ syntax_theme }}" data-max-height="{{ max_height }}" data-line-numbers="{{ show_line_numbers ? '1' : '0' }}" data-word-wrap="{{ settings.word_wrap === 'yes' ? '1' : '0' }}" data-copy-text="{{ settings.copy_text }}" data-copied-text="{{ settings.copied_text }}">
            <div class="prime-cs-header">
                <div class="prime-cs-header-left">
                    <# if (show_macos) { #>
                    <div class="prime-cs-macos-dots">
                        <span class="dot dot-red"></span>
                        <span class="dot dot-yellow"></span>
                        <span class="dot dot-green"></span>
                    </div>
                    <# } #>
                    <span class="prime-cs-window-title">{{ settings.window_title }}</span>
                </div>
                <div class="prime-cs-header-right">
                    <# if (show_copy) { #>
                    <button class="prime-cs-copy-btn" type="button" title="Copy to clipboard">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                        <span class="prime-cs-copy-label">{{ settings.copy_text }}</span>
                    </button>
                    <# } #>
                    <# if (show_download) { #>
                    <button class="prime-cs-download-btn" type="button" title="Download file">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                        <span class="prime-cs-download-label">Download</span>
                    </button>
                    <# } #>

                    <button class="prime-cs-refresh-btn" type="button" title="Refresh code from source" style="display: none;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.5 2v6h-6M2.5 22v-6h6M2 11.5a10 10 0 0 1 18.8-4.3M22 12.5a10 10 0 0 1-18.8 4.2"></path></svg>
                    </button>

                    <button class="prime-cs-wrap-btn" type="button" title="Toggle word wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="17 1 21 5 17 9"></polyline><path d="M3 11V9a4 4 0 0 1 4-4h14"></path><polyline points="7 23 3 19 7 15"></polyline><path d="M21 13v2a4 4 0 0 1-4 4H3"></path></svg>
                    </button>
                </div>
            </div>

            <# if (tabs.length > 1) { #>
            <div class="prime-cs-tabs-bar">
                <# _.each(tabs, function(tab, i) { #>
                <button class="prime-cs-tab {{ i === 0 ? 'active' : '' }}" data-tab="{{ i }}">{{ tab.tab_title }}</button>
                <# }); #>
            </div>
            <# } #>

            <# _.each(tabs, function(tab, i) { 
                var lang = tab.code_language;
                var pre_cls = 'language-' + lang + (show_line_numbers ? ' line-numbers' : '');
                var hlLines = tab.highlight_lines || '';
            #>
            <div class="prime-cs-panel {{ i === 0 ? 'active' : '' }}" data-tab="{{ i }}" data-filename="{{ tab.tab_title }}">
                <# if (show_badge) { #>
                <span class="prime-cs-lang-badge prime-lang-{{ lang }}">{{ lang.toUpperCase() }}</span>
                <# } #>
                <div class="prime-cs-code-wrap" style="max-height: {{ max_height }}px;">
                    <pre class="{{ pre_cls }}" <# if (hlLines) { #>data-line="{{ hlLines }}"<# } #>><code class="language-{{ lang }}">{{{ tab.code_content }}}</code></pre>
                </div>
            </div>
            <# }); #>
        </div>
        <?php
    }
}