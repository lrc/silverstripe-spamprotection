<?php
/**
 * Honey Pot Spam Protection
 * @author Jeremy Shipman - jeremy [at] burnbright [dot] co [dot] nz
 * 
 * Adds a CSS-hidden field to a form, which if populated will fail validation.
 * Simply add it to a form's fields to use.
 * 
 */
class SpamProtection_HoneypotField extends TextField {
	
	static $validate_members = false;
	
	function __construct($name = "Email"){
		parent::__construct($name);
		$this->title = _t('SpamProtectionHoneyPotField.TITLE', "Please do not fill out this field. It prevents spam.");
	}
	
	function Field(){
		//display field after validation if it fails
		if(!$this->messageType){
			$htmlid = $this->name;		
			$css =<<<CSS
				form div#$htmlid{
					margin:0;padding-left:1px;
					height:1px;
					width:0;
					overflow:hidden;
				}
CSS;
			Requirements::customCSS($css,$this->name);
		}
		return parent::Field();
	}
	
	function validate($validator){
		
		// Never reject admins
		if(Permission::check('ADMIN')){
			return true;
		}
		
		// Validate members?
		if(self::$validate_members && Member::currentUserID()){
			return true;	
		}	
		
		// Everyone else
		if($this->value){
			$validator->validationError(
 				$this->name,
				_t('SpamProtection_Honeypotfield.ERROR', "This field should be empty."),
				"validation"
			);
			return false;
		}
		return true;		
	}
	
}