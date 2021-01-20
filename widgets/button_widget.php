<?php

namespace WP_Paypal\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly


class WP_Paypal_Button extends Widget_Base
{
    public function get_name()
    {
        return 'wp-paypal-button';
    }

    public function get_title()
    {
        return 'Paypal Button';
    }

    public function get_icon()
    {
        return 'fab fa-cc-paypal';
    }

    public function get_categories()
    {
        return ['general'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'button_content',
            [
         'label' => 'Button',
       ]
        );


        $this->add_control(
            'paypal_type',
            [
         'label' => __('Button Type', 'wp-paypal'),
         'type' => \Elementor\Controls_Manager::SELECT,
         'default' => 'buynow',
         'options' => [
             'buynow'  => __('Buy Now', 'wp-paypal'),
             'cart' => __('Add To Cart', 'wp-paypal'),
             'donate' => __('Donation', 'wp-paypal'),
             'subscribe' => __('Subscription', 'wp-paypal')
         ],
     ]
        );

        $this->add_control(
            'paypal_button_size',
            [
             'label' => __('Button Size', 'wp-paypal'),
             'type' => \Elementor\Controls_Manager::SELECT,
             'default' => 'elementor-size-sm',
             'options' => [
                 'elementor-size-xs'  => __('Extra Small', 'wp-paypal'),
                 'elementor-size-sm' => __('Small', 'wp-paypal'),
                 'elementor-size-md' => __('Medium', 'wp-paypal'),
                 'elementor-size-lg' => __('Large', 'wp-paypal'),
                 'elementor-size-xl' => __('Extra Large', 'wp-paypal'),
             ]
         ]
        );

        $this->add_control(
            'paypal_button_style',
            [
         'label' => __('Button Style', 'wp-paypal'),
         'type' => \Elementor\Controls_Manager::SELECT,
         'default' => 'default',
         'options' => [
             'default'  => __('Default', 'wp-paypal'),
             'custom'  => __('Custom Image', 'wp-paypal'),
             'text' => __('Text', 'wp-paypal')
         ],
     ]
        );

        $this->add_control(
            'paypal_button_text',
            [
     'label' => __('Button Text', 'wp-paypal'),
     'label_block' => true,
     'description' => 'Only used if Button Style is TEXT',
     'type' => \Elementor\Controls_Manager::TEXT,
     'condition' => [ 'paypal_button_style' => 'text' ]
    ]
        );

        $this->add_control(
            'paypal_button_image',
            [
         'label' => __('Custom Button Image', 'wp-paypal'),
         'description' => 'Only used if Button Style is IMAGE',
         'type' => \Elementor\Controls_Manager::MEDIA,
         'default' => [
             'url' => ''
         ],
         'condition' => [ 'paypal_button_style' => 'custom' ]
     ]
        );

        $this->add_control(
            'paypal_target',
            [
         'label' => __('Target', 'wp-paypal'),
         'type' => \Elementor\Controls_Manager::SELECT,
         'description' => 'Opens Paypal either in a new tab or same window.',
         'default' => '_blank',
         'options' => [
             '_blank'  => __('New Window', 'wp-paypal'),
             '_self' => __('Current Window', 'wp-paypal')
         ],
     ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'product_section',
            [
            'label' => 'Product',
          ]
        );

        $this->add_control(
            'paypal_number',
            [
            'label' => __('Product Sku', 'wp-paypal'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'placeholder' => 'ABC123'
          ]
        );

        $this->add_control(
            'paypal_name',
            [
            'label' => __('Product Name', 'wp-paypal'),
            'label_block' => true,
            'type' => \Elementor\Controls_Manager::TEXT,
            'placeholder' => 'My Product'
          ]
        );

        $this->add_control(
            'paypal_quanitity',
            [
            'label' => __('Product Quantity', 'wp-paypal'),
            'description' => 'Set to ZERO to allow user to set quantity.',
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => '0',
            'options' => [
                '0' => '0',
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6',
                '7' => '7',
                '8' => '8',
                '9' => '9',
                '10' => '10'
            ],
            'condition' => ['paypal_type' => 'buynow']
          ]
        );

        $this->add_control(
            'paypal_amount',
            [
            'label' => __('Product Amount', 'wp-paypal'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'placeholder' => '0.00',
            'default' => '1.00',
            'condition' => ['paypal_type!' => 'subscribe']
          ]
        );

        $this->add_control(
            'paypal_currency',
            [
            'label' => __('Currency', 'wp-paypal'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'USD',
            'options' => [
                'USD'  => __('USD', 'wp-paypal'),
                'EUR' => __('EUR', 'wp-paypal'),
                'GBP' => __('GPB', 'wp-paypal'),
                'CAD' => __('CAD', 'wp-paypal')
            ],
        ]
        );

        $this->add_control(
            'paypal_tax',
            [
            'label' => __('Tax', 'wp-paypal'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'placeholder' => '0.00',
          ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'shipping_section',
            [
            'label' => 'Shipping',
          ]
        );

        $this->add_control(
            'paypal_no_shipping',
            [
            'label' => __('Shipping Address', 'wp-paypal'),
            'description' => 'This parameter allows you to control whether or not to prompt buyers for a shipping address.',
            'label_block' => true,
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => '0',
            'options' => [
                '0'  => __('Prompt but do not require address.', 'wp-paypal'),
                '1' => __('Do not prompt for an address.', 'wp-paypal'),
                '2' => __('Require an address', 'wp-paypal'),
            ],
        ]
        );

        $this->add_control(
            'paypal_shipping',
            [
            'label' => __('Shipping Cost', 'wp-paypal'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'placeholder' => '0.00',
            'description' => 'The cost of shipping this item.',
          ]
        );

        $this->add_control(
            'paypal_shipping2',
            [
            'label' => __('Additional Shipping', 'wp-paypal'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'description' => 'The cost of shipping each additional unit of this item. Leave blank to only use main Shipping Cost',
          ]
        );


        $this->end_controls_section();



        $this->start_controls_section(
            'subscription_section',
            [
            'label' => 'Subscription',
            'condition' => [ 'paypal_type' => 'subscribe' ]
        ]
        );

        $this->add_control(
            'paypal_a3',
            [
            'label' => __('Price', 'wp-paypal'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'placeholder' => '0.00'
          ]
        );

        $this->add_control(
            'paypal_p3',
            [
            'label' => __('Duration', 'wp-paypal'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'input_type' => 'num',
            'default' => 1
          ]
        );

        $this->add_control(
            'paypal_t3',
            [
            'label' => __('Interval', 'wp-paypal'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'M',
            'options' => [
                'D'  => __('Day(s)', 'wp-paypal'),
                'W' => __('Week(s)', 'wp-paypal'),
                'M' => __('Month(s)', 'wp-paypal'),
                'Y' => __('Year(s)', 'wp-paypal'),
            ],
        ]
        );

        $this->add_control(
            'paypal_Srt',
            [
            'label' => __('# of Payments', 'wp-paypal'),
            'description' => 'Number of times a subscription payment will recur. Leave blank for infinite.',
            'type' => \Elementor\Controls_Manager::TEXT,
            'input_type' => 'num',
            'default' => ''
          ]
        );


        $this->add_control(
            'trial_options',
            [
            'label' => __('Trial Subscription', 'wp-paypal'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]
        );

        $this->add_control(
            'trial_switcher',
            [
            'label' => __('Allow Trial', 'wp-paypal'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'your-plugin'),
            'label_off' => __('No', 'your-plugin'),
            'return_value' => 'yes',
            'default' => 'no',
        ]
        );

        $this->add_control(
            'paypal_a1',
            [
            'label' => __('Trial Price', 'wp-paypal'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'placeholder' => '0.00',
            'default' => '0.00',
            'condition' => [ 'trial_switcher' => 'yes' ]
          ]
        );

        $this->add_control(
            'paypal_p1',
            [
            'label' => __('Duration', 'wp-paypal'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'input_type' => 'num',
            'default' => 1,
            'condition' => [ 'trial_switcher' => 'yes' ]
          ]
        );

        $this->add_control(
            'paypal_t1',
            [
            'label' => __('Interval', 'wp-paypal'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'M',
            'options' => [
                'D'  => __('Day(s)', 'wp-paypal'),
                'W' => __('Week(s)', 'wp-paypal'),
                'M' => __('Month(s)', 'wp-paypal'),
                'Y' => __('Year(s)', 'wp-paypal'),
            ],
            'condition' => [ 'trial_switcher' => 'yes' ]
        ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'settings_section',
            [
            'label' => 'Settings',

          ]
        );

        $this->add_control(
            'paypal_return',
            [
            'label' => 'Return URL',
            'label_block' => true,
            'type' => \Elementor\Controls_Manager::TEXT,
            'input_type' => 'url',
            'description' => 'The URL to which the user will be redirected after the payment.',
            'placeholder' => 'http://example.com/thank-you'
          ]
        );

        $this->add_control(
            'paypal_cancel_return',
            [
            'label' => 'Cancel URL',
            'label_block' => true,
            'type' => \Elementor\Controls_Manager::TEXT,
            'input_type' => 'url',
            'description' => 'The URL to which PayPal will redirect the buyer if they cancel checkout before completing the payment.',
            'placeholder' => 'http://example.com/payment-cancelled'
          ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'button_style_section',
            [
            'label' => esc_html__('Button Style', 'svg-divider-for-elementor'),
            'tab' => Controls_Manager::TAB_STYLE,
            'condition' => [
                'paypal_button_style' => 'text',
            ]
        ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
            'name' => 'paypal_background',
            'label' => __('Background', 'wp-paypal'),
            'types' => [ 'classic', 'gradient' ],
            'selector' => '{{WRAPPER}} .paypal_custom_button',
        ]
        );

        $this->add_control(
            'border_options',
            [
            'label' => __('Border', 'wp-paypal'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
            'name' => 'paypal_border',
            'label' => __('Border', 'wp-paypal'),
            'selector' => '{{WRAPPER}} .paypal_custom_button',
        ]
        );

        $this->add_control(
            'paypal_border_radius',
            [
            'label' => __('Border Radius', 'wp-paypal'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors' => [
                '{{WRAPPER}} .paypal_custom_button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
        );

        $this->add_control(
            'text_options',
            [
            'label' => __('Text Options', 'wp-paypal'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]
        );

        $this->add_control(
            'paypal_color',
            [
            'label' => __('Text Color', 'wp-paypal'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'scheme' => [
                'type' => \Elementor\Scheme_Color::get_type(),
                'value' => \Elementor\Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .paypal_custom_button' => 'color: {{VALUE}}',
            ],
        ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
            'name' => 'paypal_typography',
            'label' => __('Typography', 'wp-paypal'),
            'selector' => '{{WRAPPER}} .paypal_custom_button',
        ]
        );

        $this->end_controls_section();
    }


    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $options = "";

        switch ($settings['paypal_type']) {
        case "buynow":
            $options .= ' amount="'.$settings['paypal_amount'].'"';
            break;
        case "cart":
            $options .= ' amount="'.$settings['paypal_amount'].'"';
            break;
        case "donate":
            $options .= ' amount="'.$settings['paypal_amount'].'"';
            break;
        case "subscribe":
            $options .= ' a3="'.$settings['paypal_a3'].'" p3="'.$settings['paypal_p3'].'" t3="'.$settings['paypal_t3'].'" Src="1" Srt="'.$settings['paypal_Srt'].'"';
            break;
    }

        if (isset($settings['trial_switcher']) && $settings['trial_switcher'] == "yes") {
            $options .= ' a1="'.$settings['paypal_a1'].'" p1="'.$settings['paypal_p1'].'" t1="'.$settings['paypal_t1'].'"';
        }

        if (isset($settings['paypal_button_style']) && $settings['paypal_button_style'] == "custom") {
            $options .= ' button_image="'.$settings['paypal_button_image']['url'].'"';
        } elseif (isset($settings['paypal_button_style']) && $settings['paypal_button_style'] == "text") {
            $options .= ' button_text="'.$settings['paypal_button_text'].'"';
        }

        if (isset($settings['paypal_shipping']) && $settings['paypal_shipping'] != "") {
            $options .= ' shipping="'.$settings['paypal_shipping'].'"';
        }

        if (isset($settings['paypal_shipping2']) && $settings['paypal_shipping2'] != "") {
            $options .= ' shipping2="'.$settings['paypal_shipping2'].'"';
        }

        if (isset($settings['paypal_return']) && $settings['paypal_return'] != "") {
            $options .= ' return="'.$settings['paypal_return'].'"';
        }

        if (isset($settings['paypal_cancel_return']) && $settings['paypal_cancel_return'] != "") {
            $options .= ' cancel_return="'.$settings['paypal_cancel_return'].'"';
        }

        if (isset($settings['paypal_tax']) && $settings['paypal_tax'] != "") {
            $options .= ' tax="'.$settings['paypal_tax'].'"';
        }

        if (isset($settings['paypal_number']) && $settings['paypal_number'] != "") {
            $options .= ' number="'.$settings['paypal_number'].'"';
        }

        if (isset($settings['paypal_quantity']) && $settings['paypal_quantity'] > 0) {
            $options .= ' quantity="'.$settings['paypal_quantity'].'"';
        } else {
            if ($settings['paypal_type'] == "buynow") {
                $options .= ' undefined_quantity="1"';
            } else {
                $options .= ' quantity="1"';
            }
        }

        if (isset($settings['paypal_button_size']) && $settings['paypal_button_size'] != "") {
            $options .= ' size="'.$settings['paypal_button_size'].'"';
        }

        echo do_shortcode('[wp_paypal button="'.$settings['paypal_type'].'" target="'.$settings['paypal_target'].'" currency="'.$settings['paypal_currency'].'" no_shipping="'.$settings['paypal_no_shipping'].'" name="'.$settings['paypal_name'].'" style="'.$settings['paypal_button_style'].'" '.$options.']');
    }
}
