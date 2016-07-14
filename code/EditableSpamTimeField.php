<?php
/**
 * Used with the User Defined Forms module (if installed) to allow the users to have captcha fields with their custom forms.
 * Class EditableRecaptchaField
 */
if(class_exists('EditableFormField')) {
    class EditableSpamTimeField extends EditableFormField {
        private static $singular_name = 'Spam Protection Time Field';
        private static $plural_name = 'Spam Protection Time Fields';

        public function getFormField() {
            return SpamProtection_TimeField::create($this->Name);
        }

        public function getRequired() {
            return true;
        }

        public function showInReports() {
            return false;
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
			
			// Set the value
			$formField->setValue($data["SPT"]);

            // Validate the field, check the result and set the message
            if (!$formField->validate($form->getValidator())) {
                foreach($form->getValidator()->getErrors() as $error) {
                    if ($error['fieldName'] == "SPT") {
                        $form->addErrorMessage($this->Name, $error['message'], 'error', false);
					}
                }
			}

            return true;
		}
    }
}