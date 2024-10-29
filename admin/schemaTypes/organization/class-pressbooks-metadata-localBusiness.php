<?php

namespace schemaTypes\organization;
use schemaTypes;
use schemaTypes\Pressbooks_Metadata_Type;

/**
 * The class for the localBusiness
 *
 * @link       https://github.com/Books4Languages/pressbooks-metadata
 * @since      0.12
 *
 * @package    Pressbooks_Metadata
 * @subpackage Pressbooks_Metadata/admin/schemaTypes
 * @author     Christos Amyrotos <christosv2@hotmail.com>
 * @author     Vasilis Georgoudis <vasilios.georgoudis@gmail.com>
 * @author    Corentin Perrot <perrotcore@gmail.com>
 */

class Pressbooks_Metadata_LocalBusiness extends Pressbooks_Metadata_Type {

    /**
     * The variable that holds all parent required properties
     *
     * @since    0.13
     * @access   public
     */
    static $required_parent_props = array(
		'image', 'name'
    );

    /**
	 * The variable that holds the values for the settings for this schema type
	 *
	 * @since    0.12
	 * @access   public
	 */
	static $type_setting = array('localBusiness_type' => array('LocalBusiness Type','http://schema.org/LocalBusiness'));

	/**
	 * The variable that holds the parents for the type
	 *
	 * @since    0.12
	 * @access   public
	 */
	static $type_parents = array(
		'schemaTypes\Pressbooks_Metadata_Thing',
		'schemaTypes\Pressbooks_Metadata_Organization'
	);

	/**
	 * The variable that holds the properties of this schema type
	 *
	 * @since    0.12
	 * @access   public
	 */
	static $type_properties = array(
    'currenciesAccepted' => array(false,'Currencies Accepted','The currency accepted (in <a href="http://en.wikipedia.org/wiki/ISO_4217">ISO 4217 currency format</a>).'),
		'openingHours' => array(false,'Opening Hours','The general opening hours for a business.'),
		'paymentAccepted' => array(false,'Payment Accepted','Cash, credit card, etc.'),
		'priceRange' => array(false,'Price Range','The price range of the business, for example $$$.')
	);

	public function __construct($type_level_input) {
		parent::__construct($type_level_input);
		$this->type_fields = $this->get_all_properties();
		$this->class_name = __CLASS__ .'_'. $this->type_level;
		$this->pmdt_populate_names(self::$type_setting);
		$this->pmdt_add_metabox($this->type_level);
	}

	/**
	 * Function used for combining the current types properties with its parents fields
	 *
	 * @since    0.12
	 * @access   public
	 */
	public function get_all_properties() {
		$properties = self::$type_properties;
		foreach(self::$type_parents as $parentType){
			$properties = array_merge($properties,$parentType::type_properties);
		}
		return $properties;
	}

	/**
	 * Function used for comparing the instances of the schema types
	 *
	 * @since    0.12
	 * @access   public
	 */
	public function __toString() {
		return $this->class_name;
	}
}
