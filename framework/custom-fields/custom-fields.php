<?php
/**
 *  Install Add-ons
 *  
 *  The following code will include all 4 premium Add-Ons in your theme.
 *  Please do not attempt to include a file which does not exist. This will produce an error.
 *  
 *  The following code assumes you have a folder 'add-ons' inside your theme.
 *
 *  IMPORTANT
 *  Add-ons may be included in a premium theme/plugin as outlined in the terms and conditions.
 *  For more information, please read:
 *  - http://www.advancedcustomfields.com/terms-conditions/
 *  - http://www.advancedcustomfields.com/resources/getting-started/including-lite-mode-in-a-plugin-theme/
 */ 

// Add-ons 
// include_once('add-ons/acf-repeater/acf-repeater.php');
// include_once('add-ons/acf-gallery/acf-gallery.php');
// include_once('add-ons/acf-flexible-content/acf-flexible-content.php');
// include_once( 'add-ons/acf-options-page/acf-options-page.php' );


/**
 *  Register Field Groups
 *
 *  The register_field_group function accepts 1 array which holds the relevant data to register a field group
 *  You may edit the array as you see fit. However, this may result in errors if the array is not compatible with ACF
 */

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_kontakt',
		'title' => 'Kontakt',
		'fields' => array (
			array (
				'key' => 'field_5235b66291027',
				'label' => 'Google maps',
				'name' => 'mapa_google',
				'type' => 'textarea',
				'instructions' => 'Insert google maps iframe code',
				'default_value' => '<iframe width="980" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.pl/maps?f=q&source=s_q&hl=en&geocode=&q=krak%C3%B3w&aq=&sll=51.953751,19.134379&sspn=7.327425,19.753418&ie=UTF8&hq=&hnear=Krakow,+Krak%C3%B3w+County,+Lesser+Poland+Voivodeship&t=m&ll=50.107368,20.031509&spn=0.154133,0.672913&z=11&iwloc=A&output=embed"></iframe>',
				'placeholder' => '',
				'maxlength' => '',
				'formatting' => 'html',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-contact.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_slajder',
		'title' => 'Slajder',
		'fields' => array (
			array (
				'key' => 'field_5250fd6333340',
				'label' => 'Link po przekierowaniu',
				'name' => 'link_po_przekierowaniu',
				'type' => 'text',
				'instructions' => 'Wpisz adres URL do którego ma prowadzić odnośnik.',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'slajdy',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
?>