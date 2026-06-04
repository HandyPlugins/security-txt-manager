# [Security.txt Manager](https://wordpress.org/plugins/security-txt-manager/) #

![Support Level](https://img.shields.io/badge/support-active-green.svg) [![Release Version](https://img.shields.io/wordpress/plugin/v/security-txt-manager?label=Release%20Version)](https://github.com/handyplugins/security-txt-manager/releases) ![WordPress tested up to version](https://img.shields.io/wordpress/plugin/tested/security-txt-manager?label=WordPress) ![Required PHP Version](https://img.shields.io/wordpress/plugin/required-php/security-txt-manager?label=PHP)

### What does this plugin do?

This powerful yet user-friendly WordPress plugin enables you to create, edit, and manage your "security.txt" file directly from the WordPress dashboard. As one of the most critical files on any site, the "security.txt" file communicates your security policy and contact information to security researchers.


### What is security.txt

A proposed standard which allows websites to define security policies.

[Read the RFC](https://www.rfc-editor.org/rfc/rfc9116)

### Summary

When security risks in web services are discovered by independent security researchers who understand the severity of
the risk, they often lack the channels to disclose them properly. As a result, security issues may be left unreported.
`security.txt` defines a standard to help organizations define the process for security researchers to disclose security
vulnerabilities securely.

[Learn More](https://securitytxt.org/)

### Can I use this with multisite?

Yes! However, if you are using a subfolder installation it will only work for the main site. This is because you can
only have one `security.txt` for a given domain or subdomain per
the [security.txt spec](https://www.rfc-editor.org/rfc/rfc9116#section-3.1).

### Technical Notes ###

* Requires PHP 7.2+.
* Requires WordPress 5.7+.
* Rewrites need to be enabled. Without rewrites, WordPress cannot know to supply `/security.txt` when requested.
* Your site URL must not contain a path (e.g. `https://example.com/site/` or path-based multisite installs). [Learn more on spec](https://www.rfc-editor.org/rfc/rfc9116#section-3.1).


## Support ##

This is a developer's portal for Security.txt Manager and should _not_ be used for support. Please visit
the [support forums](https://wordpress.org/support/plugin/security-txt-manager/) if you need to submit a support request.


## Other Projects ##

If you like Security.txt Manager, then consider checking out our other projects:

* <a href="https://poweredcache.com/" rel="friend">Powered Cache</a> – Caching and optimization for WordPress to help improve PageSpeed and Core Web Vitals.
* <a href="https://handyplugins.co/magic-login-pro/" rel="friend">Magic Login Pro</a> – Easy, secure, and passwordless authentication for WordPress.
* <a href="https://handyplugins.co/sessionquota-pro/" rel="friend">SessionQuota Pro</a> – Limit concurrent sessions in WordPress.
* <a href="https://handyplugins.co/stream-integration-pro/" rel="friend">Stream Integration Pro</a> – Upload, sync, restore, and manage WordPress videos with Cloudflare Stream.
* <a href="https://handyplugins.co/easy-text-to-speech/" rel="friend">Easy Text-to-Speech</a> – Convert written content into high-quality synthesized speech for WordPress.
* <a href="https://handyplugins.co/handywriter/" rel="friend">Handywriter</a> – AI-powered writing assistant for WordPress.
* <a href="https://handyplugins.co/paddlepress-pro/" rel="friend">PaddlePress PRO</a> – Paddle plugin for WordPress.

