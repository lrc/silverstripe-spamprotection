<?php
/**
 * A hidden timestamp field which can be added to forms to ensure there's a reasonable 
 * time between when the page was requested and the form was submitted.
 * 
 * @author Simon Elvery - simon@leftrightandcentre.com.au
 * 
 */
class SpamProtection_TimeField extends HiddenField {
	
	public static $validate_members = false; // Should members be validated?
	public static $time_limit = 3; // Time limit in seconds.
	public static $field_name = 'SPT'; // Name to use for the form field.
	
	/**
	 * Construct the field.
	 * @param type $name 
	 */
	public function __construct() {
		parent::__construct(self::$field_name, '', time());
	}
	
	/**
	 * Check that the form submission time was long enough after the form generation time.
	 * 
	 * @param Validator $validator The form validator.
	 * @return boolean TRUE if the field passes validation, FALSE otherwise.
	 */
	public function validate(Validator $validator){
		
		// Never reject admins.
		if(Permission::check('ADMIN')){
			return true;
		}
		
		// Check if we should reject members
		if(self::$validate_members && Member::currentUserID()){
			return true;	
		}
		
		// Validate everyone else.
		if ( ($this->value + self::$time_limit) > time() ) {
			$validator->validationError(
 				$this->name,
				_t('SpamProtectionTimeField.ERROR', "You were too quick. Take a breath and try again."),
				"validation"
			);
			return false;
		}
		return true;
	}
}