<?php
return array (
	'acplocart' => array (
		'vat' => '21',
		/**
		 * If true, when insert is called and an item is already present in the cart (item with the same id attribute), an update is performed and the cart item quantity is updated.
		 * false otherwise.
		 * default: false, to mantain original AcploCart->insert() behaviour
		 */
		'on_insert_update_existing_item' => false
	)
);