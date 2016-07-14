<?php
/**
 * Used with the User Defined Forms module (if installed) to allow the users to have captcha fields with their custom forms.
 * Class EditableRecaptchaField
 */
if(class_exists('EditableFormField')) {
    class EditableHoneypotField extends EditableFormField {
        private static $singular_name = 'Spam Protection Honeypot Field';
        private static $plural_name = 'Spam Protection Honeypot Fields';

        public function getFormField() {
            return SpamProtection_HoneypotField::create($this->Name);
        }

        public function getRequired() {
            return false;
        }

        public function showInReports() {
            return false;
        }
		
		/**
		 * @return FieldList
		 */
		public function getCMSFields() {
			$fields = parent::getCMSFields();			
			$fields->removeByName("Default");
			return $fields;
		}
		
		/**
		 * Validate the field taking into account its custom rules.
		 *
		 * @param Array $data
		 * @param UserForm $form
		 *
		 * @return boolean
		 */
		public function validateField($data, $form) {
            // Get the related field
            $formField = $this->getFormField();			
			$name = $formField->name;
			
			// Set the value
			$formField->setValue($data[$name]);

            // Validate the field, check the result and set the message
            if (!$formField->validate($form->getValidator())) {
                foreach($form->getValidator()->getErrors() as $error) {
                    if ($error['fieldName'] == $name) {
                        $form->addErrorMessage($this->Name, $error['message'], 'error', false);
					}
                }
			}

            return true;
		}
    }
}