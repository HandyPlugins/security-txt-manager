=== Security txt Manager ===
Contributors:      handyplugins, m_uysl
Tags:              security.txt, security, responsible disclosure, bug bounty
Requires at least: 5.7
Tested up to:      6.2
Requires PHP:      7.2
Stable tag:        1.0
License:           GPLv2 or later
License URI:       http://www.gnu.org/licenses/gpl-2.0.html
Donate link:       https://handyplugins.co/donate/

Create and manage your security.txt from within WordPress. The easiest way to manage security policy.

== Description ==

This powerful yet user-friendly WordPress plugin enables you to create, edit, and manage your "security.txt" file directly from the WordPress dashboard. As one of the most critical files on any site, the "security.txt" file communicates your security policy and contact information to security researchers.

=== What is security.txt? ===

A proposed standard which allows websites to define security policies.

[Read the RFC](https://www.rfc-editor.org/rfc/rfc9116)

===  Can I use this with multisite? ===

Yes! However, if you are using a subfolder installation it will only work for the main site. This is because you can only have one `security.txt` for a given domain or subdomain per the [security.txt spec](https://www.rfc-editor.org/rfc/rfc9116#section-3.1).


=== Technical Notes ===

* Requires PHP 7.2+.
* Requires WordPress 5.7+.
* Rewrites need to be enabled. Without rewrites, WordPress cannot know to supply `/security.txt` when requested.
* Your site URL must not contain a path (e.g. `https://example.com/site/` or path-based multisite installs). [Learn more on spec](https://www.rfc-editor.org/rfc/rfc9116#section-3.1).


= Contributing & Bug Report =
Bug reports and pull requests are welcome on [Github](https://github.com/HandyPlugins/security-txt-manager).


== Installation ==

= Manual Installation =

1. Upload the entire `/security-txt-manager` directory to the `/wp-content/plugins/` directory.
2. Activate Security.txt Manager through the 'Plugins' menu in WordPress.

== Frequently Asked Questions ==

= How can I create security policy? =

You can create it on https://securitytxt.org/ website.

= Can I use this with multisite? =

Yes! But won't work for the child sites on subdirectory setup due to [security.txt spec](https://www.rfc-editor.org/rfc/rfc9116#section-3.1)

= Do I have to upload any files? =

No. The plugin handles ".well-known/security.txt" and "security.txt" requests for your domain.


== Screenshots ==

1. Settings Page

== Changelog ==

= 1.0 (Draft)  =
* First release

== Upgrade Notice ==
