
=== <%= nameFriendly %> ===
Contributors: <%= authorWordPressName %>
Donate link: <%= pluginDonateUrl %>
Tags: <%= pluginTags %>
Requires at least: <%= wpVersion %>
Tested up to: <%= wpVersion %>
Stable tag: <%= version %>
License: <%= pluginLicense %>
License URI: <%= pluginLicenseUrl %>

<%= description %>

== Description ==

<%= description %>

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/<%= name %>` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Use the Settings->Plugin Name screen to configure the plugin

== Frequently Asked Questions ==

= How do I use the widget? =

One or more widgets can be displayed within one or more sidebars:

1. Locate the widget: Appearance > Widgets > *<%= nameFriendly %> Widget*
2. Drag and drop the widget into one of your sidebars
3. Add a *Title*
4. Specify *Number of blocks to display*
5. Toggle *Link to enlargement?*

= How do I use the shortcode? =

One or more shortcodes can be used within the content editor:

* Specify *Number of blocks to display* - `number`
* Toggle *Link to enlargement?* - `enlargement` (`yes` | `no`)

```
[<%= nameSafe %>_blocks number="2" enlargement="yes"]

[<%= nameSafe %>_blocks number="4" enlargement="no"]
```

= How do I use the template tag? =

One or more template tags can be used within your `.php` templates:

* Specify *Number of blocks to display* - `number`
* Toggle *Link to enlargement?* - `enlargement` (`yes` | `no`)

```
<?php
    do_shortcode( '[<%= nameSafe %>_blocks number="2" enlargement="yes"]' );
?>

<?php
    do_shortcode( '[<%= nameSafe %>_blocks number="4" enlargement="no"]' );
?>
```

== Screenshots ==

1. The caption for ./assets/screenshot-1.(png|jpg|jpeg|gif)
2. The caption for ./assets/screenshot-2.(png|jpg|jpeg|gif)

== Changelog ==

= 0.1 =
* Initial version

== Upgrade Notice ==

= 0.1 =
* Initial release
