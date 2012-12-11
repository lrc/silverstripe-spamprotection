# Spam Protection Fields

This module provides a way to apply a variety of spam protection techniques to any Silverstripe form.

## Usage

To protect the default Silverstripe PageComments form (SS 2.4.x), simply add the following to your _config.php file:

	Object::add_extension('PageCommentInterface', 'SpamProtection_ProtectForm');

## Compatibility
Compatible with Silverstripe 3.0.x. For a 2.4.x compatible version see the [2.4 branch](https://github.com/lrc/silverstripe-spamprotection/tree/2.4).
	
## Attribution

* Original module by Jeremy Shipman ([see](https://github.com/burnbright/silverstripe-spamprotection-honeypot)) 
* Extensively modified by Simon Elvery