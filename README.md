# Spam Protection Fields

This module provides a way to apply a variety of spam protection techniques to any Silverstripe form.

## Usage

To protect the default Silverstripe PageComments form (SS 2.4.x), simply add the following to your _config.php file:

	Object::add_extension('PageCommentInterface', 'SpamProtection_ProtectForm');

## Compatibility
This is currently compatible with Silverstripe 2.4.x. Future support for 3.0.x is planned.	
	
## Attribution

* Original module by Jeremy Shipman ([see](https://github.com/burnbright/silverstripe-spamprotection-honeypot)) 
* Extensively modified by Simon Elvery