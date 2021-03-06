<?php
	/**
	 * Admin boot
	 * @author Webcraftic <wordpress.webraftic@gmail.com>
	 * @copyright Webcraftic 25.05.2017
	 * @version 1.0
	 */

	// Exit if accessed directly
	if( !defined('ABSPATH') ) {
		exit;
	}

	/**
	 * Заменяем премиум возможности в бизнес виджете
	 * @param array $features
	 * @param string $page_id
	 * @param string $plugin
	 */
	add_filter('wbcr/clearfy/page_bussines_suggetion_features', function ($features, $plugin_name, $page_id) {

		if( !empty($plugin_name) && ($plugin_name == WGZ_Plugin::app()->getPluginName()) ) {
			$upgrade_feature = array();
			$upgrade_feature[] = __('Disable plugins (groups of scripts)', 'gonzales');
			$upgrade_feature[] = __('Conditions by the link template', 'gonzales');
			$upgrade_feature[] = __('Conditions by the regular expression', 'gonzales');
			$upgrade_feature[] = __('Safe mode', 'gonzales');
			$upgrade_feature[] = __('Statistics and optimization results', 'gonzales');

			return $upgrade_feature;
		}

		return $features;
	}, 20, 3);

	/**
	 * Удаляем лишние виджеты в левом сайдбаре
	 *
	 * @param array $widgets
	 * @param string $position
	 * @param Wbcr_Factory409_Plugin $plugin
	 */
	add_filter('wbcr/factory/pages/impressive/widgets', function ($widgets, $position, $plugin) {
		if( $plugin->getPluginName() == WGZ_Plugin::app()->getPluginName() ) {
			if( $position == 'right' ) {
				unset($widgets['donate_widget']);
				unset($widgets['rating_widget']);
				unset($widgets['info_widget']);
			}
		}

		return $widgets;
	}, 20, 3);

	if( defined('LOADING_ASSETS_MANAGER_AS_ADDON') ) {

		/**
		 * This action is executed when the component of the Clearfy plugin is activate and if this component is name ga_cache
		 * @param string $component_name
		 */
		add_action('wbcr/clearfy/activated_component', function ($component_name) {
			if( $component_name == 'assets_manager' ) {
				if( class_exists('WCL_Plugin') ) {
					$license = WCL_Plugin::app()->getLicense();
					if( ($license->isLicenseValid() || (defined('WCL_PLUGIN_DEBUG') && WCL_PLUGIN_DEBUG)) && !WCL_Plugin::app()->isActivateComponent('assets-manager-premium') ) {
						WCL_Plugin::app()->activateComponent('assets-manager-premium');
					}
				}
			}
		});

		/**
		 * This action is executed when the component of the Clearfy plugin is activate and if this component is name ga_cache
		 * @param string $component_name
		 */
		add_action('wbcr_clearfy_deactivated_component', function ($component_name) {
			if( $component_name == 'assets_manager' ) {
				if( class_exists('WCL_Plugin') ) {
					$license = WCL_Plugin::app()->getLicense();
					if( ($license->isLicenseValid() || (defined('WCL_PLUGIN_DEBUG') && WCL_PLUGIN_DEBUG)) && WCL_Plugin::app()->isActivateComponent('assets-manager-premium') ) {
						WCL_Plugin::app()->deactivateComponent('assets-manager-premium');
					}
				}
			}
		});

		function wbcr_gnz_group_options($options)
		{
			$options[] = array(
				'name' => 'disable_assets_manager',
				'title' => __('Disable assets manager', 'gonzales'),
				'tags' => array(),
				'values' => array()
			);

			$options[] = array(
				'name' => 'disable_assets_manager_panel',
				'title' => __('Disable assets manager panel', 'gonzales'),
				'tags' => array()
			);

			$options[] = array(
				'name' => 'disable_assets_manager_on_front',
				'title' => __('Disable assets manager on front', 'gonzales'),
				'tags' => array()
			);

			$options[] = array(
				'name' => 'disable_assets_manager_on_backend',
				'title' => __('Disable assets manager on back-end', 'gonzales'),
				'tags' => array()
			);

			$options[] = array(
				'name' => 'manager_options',
				'title' => __('Assets manager options', 'gonzales'),
				'tags' => array()
			);

			return $options;
		}

		add_filter("wbcr_clearfy_group_options", 'wbcr_gnz_group_options');
	} else {
		function wbcr_gnz_set_plugin_meta($links, $file)
		{
			if( $file == WGZ_PLUGIN_BASE ) {
				$url = WbcrFactoryClearfy206_Helpers::getWebcrafticSitePageUrl(WGZ_Plugin::app()->getPluginName(), 'assets-manager', 'plugin_row');
				$links[] = '<a href="' . $url . '" style="color: #FF5722;font-weight: bold;" target="_blank">' . __('Get premium', 'gonzales') . '</a>';
			}

			return $links;
		}

		add_filter('plugin_row_meta', 'wbcr_gnz_set_plugin_meta', 10, 2);

		function wbcr_gnz_rating_widget_url($page_url, $plugin_name)
		{
			if( !defined('LOADING_ASSETS_MANAGER_AS_ADDON') && ($plugin_name == WGZ_Plugin::app()->getPluginName()) ) {
				return 'https://goo.gl/zyNV6z';
			}

			return $page_url;
		}

		add_filter('wbcr_factory_pages_410_imppage_rating_widget_url', 'wbcr_gnz_rating_widget_url', 10, 2);
	}