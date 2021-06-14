<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WOO_MSTORE_SINGLE_ACTIVATION_HOOK {

	/**
	 * Default plugin options
	 **/
	public $default_options = array();

	/**
	 * Init
	 **/
	public function __construct() {
		$this->default_options = array(
			'synchronize-stock'   => 'no',
			'synchronize-trash'   => 'no',
			'publish-capability'  => 'administrator',
			'sync-all-metadata'   => 'no',

			'child_inherit_changes_fields_control__title'  => 'yes',
			'child_inherit_changes_fields_control__description' => 'yes',
			'child_inherit_changes_fields_control__short_description' => 'yes',
			'child_inherit_changes_fields_control__price'  => 'yes',
			'child_inherit_changes_fields_control__product_cat' => 'yes',
			'child_inherit_changes_fields_control__product_tag' => 'yes',
			'child_inherit_changes_fields_control__variations' => 'yes',
			'child_inherit_changes_fields_control__attributes' => 'yes',
			'child_inherit_changes_fields_control__category_changes' => 'yes',
			'child_inherit_changes_fields_control__reviews' => 'yes',
			'child_inherit_changes_fields_control__slug'   => 'yes',
			'child_inherit_changes_fields_control__purchase_note' => 'yes',
			'child_inherit_changes_fields_control__upsell' => 'no',
			'child_inherit_changes_fields_control__cross_sells' => 'no',
		);

		$this->run();
	}

	/**
	 * Init
	 **/
	public function run() {
		$options  = get_option( 'woonet_options', array() );

		foreach ( $this->default_options as $key => $value ) {
			if ( ! isset( $options[ $key ] ) ) {
				$options[ $key ] = $value;
			}
		}

		update_option( 'woonet_options', $options );
	}
}

new WOO_MSTORE_SINGLE_ACTIVATION_HOOK();
