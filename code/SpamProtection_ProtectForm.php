<?php
/**
 * This is a decorator for form classes which provides a method of attaching various spam protection techniques.
 * 
 * @author Jeremy Shipman
 * @author Simon Elvery
 */
class SpamProtection_ProtectForm extends Extension {
	
	/**
	 * An array to specify which fields are enabled by default.
	 * @var array
	 */
	public static $default_methods = array(
		'SpamProtection_HoneypotField',
		'SpamProtection_TimeField'
	);
	
	/**
	 * An array to specify form specific fields to use for spam protection
	 * @var array
	 */
	public static $form_methods = array();
	
	/**
	 * Modify the form to include the selected spam protection methods.
	 * 
	 * @param Form $form The form to be protected.
	 */
	public function updatePageCommentForm(&$form){
		
		$methods = ( isset(self::$form_methods[$form->class]) ) ? self::$form_methods[$form->class] : self::$default_methods;
		
		foreach($methods as $class) {
			$form->Fields()->push(new $class());
		}
	}
}