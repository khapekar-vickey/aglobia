=== Advanced Shipment Tracking for WooCommerce  ===
Contributors: zorem
Tags: woocommerce, delivery, shipping, shipment tracking, tracking
Requires at least: 5.0
Tested up to: 5.4
Requires PHP: 7.0
Stable tag: 4.0.1
License: GPLv2 
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add shipment tracking information to your WooCommerce orders and provide your customers with an easy way to track their orders, reduce customer service inquiries and Improve the overall post-purchase experience.

== Description ==

The AST plugin provides you with easy ways to add shipment tracking information to orders. Your customers will receive the tracking information and a link to track their order on the order emails and my-account area. 

AST provides a pre-defined list of more than 150 shipping providers (carriers) from around the globe, you can add custom providers, customize the tracking display on emails, create custom order statuses, customize the emails, bulk upload tracking info to orders with CSV files, use the API endpoint to update tracking in orders and more...

== Key Features ==

* Add shipment tracking info to orders – shipping provider, tracking number and shipping date
* Add multiple tracking numbers to orders
* Add tracking info to orders from the orders admin (inline)
* Select shipping providers to use when adding tracking info to orders
* Set the default provider when adding tracking info to orders
* Add custom shipping providers
* Sync your shipping providers list with TrackShip
* Display shipment tracking information and tracking link on user accounts
* Display shipment tracking information and tracking link on customer order emails
* Customize and preview the tracking info display on customer emails using email customizer.
* Choose on which Customer emails to include the tracking info.
* Bulk import tracking info to orders with CSV file.
* WooCommerce REST API endpoint to update shipment tracking information
* Rename the Completed Order status to Shipped
* Enable custom order statuses - Delivered, Partially Shipped, Updated Tracking
* Enable  custom order status emails to customers
* Customize and preview the Delivered status email using email designer.

== PREMIUM ADD-ONS ==

= Tracking Per Item Add-on =
The Tracking per item add-on allows you to attach tracking numbers to specific order items and also to attach tracking numbers to different quantities of the same line item.
[Get this Add-on](https://www.zorem.com/shop/tracking-per-item-ast-add-on/)

= TrackShip Add-on = 
[TrackShip](https://trackship.info/) is a shipment tracking API that fully integrates with WooCommerce with the Advanced Shipment Tracking. TrackShip automates the order management workflows, reduces customer inquiries, reduces time spent on customer service, and improves the post-purchase experience and satisfaction of your customers.

* Automatically track shipments with 150+ shipping providers
* View the latest shipment status, update date, and est. delivery date on your orders admin
* Automatically change the order status to Delivered once it’s delivered to your customers
* Send personalized emails to notify the customer when their shipments are In Transit, Out For Delivery, Delivered or have an exception
* Direct customers to a Tracking page on your store

You must have a [TrackShip](https://trackship.info/) account to activate these advanced features.

== Translations == 

The AST plugin is localized/ translatable by default, we added translation to the following languages: 

* English - default, always included
* German (Deutsch)
* Hebrew
* Hindi
* Italian
* Norwegian (Bokmål)
* Russian
* Swedish
* Turkish
* Bulgarian
* Danish
* Spanish (Spain)
* French (France)
* Greek
* Português Brasil
* Dutch (Nederlands)

If your lenguage is not in this list and you  want us to include it in the plugin, you can send us the translation files (po/mo) [here](https://www.zorem.com/docs/woocommerce-advanced-shipment-tracking/translations/#upload-your-language-files)

== Shipping Providers == 

The AST plugin supports more then 150 shipping providers (carriers) with pre-defined tracking link:

USPS, ePacket, Delhivery, Yun Express Tracking, UPS, Australia Post, FedEx, Aramex, DHL eCommerce, ELTA Courier, Colissimo, DHL Express, La Poste, DHLParcel NL, Purolator, 4px, Brazil Correios, Deutsche Post DHL, Bpost, DHL US, EMS, DPD.de, GLS, China Post, Loomis Express, DHL Express, DHL Express UK, Poste Maroc, PostNL International 3S, Royal Mail and many more..

== Compatibility == 

The Advanced Shipment Tracking plugin is compatible with many other plguins such as shipping label plugins and services, email customizer plugins, Customer order number plugins, PDF invoices plugins,  multi vendor plugins, SMS plugins and more. Check out [AST's full list of plugins compatibility](https://www.zorem.com/docs/woocommerce-advanced-shipment-tracking/compatibility/). 

== Documentation ==
[documentation](https://www.zorem.com/docs/woocommerce-advanced-shipment-tracking) for more details.

https://www.youtube.com/watch?v=Mw7laecPtyw

== Frequently Asked Questions == 

= Where will my customer see the tracking info?
The tracking info and a tracking link to track the order on the shipping provider website will be added to the **Shipped** (Completed) order status emails.  We will also display the tracking info in my-account area for each order in the order history tab.
= Can I add multiple tracking numbers to orders?
Yes, you can add as many tracking numbers to orders and they will all be displayed to your customers. 
= Can I add a shipping provider that is not on your list?
Yes, you can add custom providers, choose your default shipment provider, Change the providers order in the list and enable only providers that are relevant to you.
= Can I design the display of Tracking info on WooCommerce emails?
Yes, you have full control over the design and display of the tracking info and you can customize it.
= can I track my order and send shipment status and delivery notifications to my customers?
Yes, you can sign up to [Trackship](https://trackship.info) and connect your store, TrackShip will auto-track your shipments and update your orders with shipment status and delivery updates to your WooCommerce store and automates your order management process, you can send shipment status notifications to your customers and direct them to tracking page on your store.
= How do I set the custom provider URL so it will direct exactly to the tracking number results?
You can add tracking number parameter in this format:
http://shippingprovider.com?tracking_number=%number% , %number% - this variable will hold the tracking number for the order.
= is it possible to import multiple tracking numbers to orders in bulk?
Yes, you can use our Bulk import option to import multiple tracking inumbers to orders, you need to add each tracking number is one row.
= is it possible to add tracking number to specific products?
Yes, you can use the [Tracking Per Item pro add-on](https://www.zorem.com/products/tracking-per-item-ast-add-on/) which add the option to attach tracking numbers to specific line items and even to attach tracking numbers to specific line item quantities.
=How do I use the Rest API to add/retrieve/delete tracking info to my orders?
you can use the plugin to add, retrieve, delete tracking information for orders using WooCommerce REST API. 
For example, in order to add tracking number to order:
use the order id that you wish to update in the URL instead of <order-id>, add the shipping provider and tracking code. 

curl -X POST 
http://a32694-tmp.s415.upress.link/wp-json/wc/v1/orders/<order-id>/shipment-trackings \
    -u consumer_key:consumer_secret \
    -H "Content-Type: application/json" \
    -d '{
  "tracking_provider": "USPS",
  "tracking_number": "123456789",
}'

== Installation ==

1. Upload the folder `woo-advanced-shipment-tracking` to the `/wp-content/plugins/` folder
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Select default shipping provider from setting page and add tracking number in order page.

== Changelog ==

= 3.0 =
* Enhancement - Updated CSV Upload page design in settings page
* Enhancement - Updated TrackShip dashboard page design
* Enhancement - Added On Hold Shipment status emails for TrackShip
* Enhancement - Redesign Shipping Providers List in settings page
* Enhancement - Added option for hard sync shipping providers in Sync Providers option
* Dev - Updated plugin code for better security and optimize
* Dev - Removed compatibility code for WC – APG SMS Notifications from plugin
* Dev - Added all shipping provider image under wp-content/uploads/ast-shipping-providers folder. So load shipping provider image from there
* Dev - Optimized all shipping provider image
* Dev - Added new functions for add tracking information and get tracking information
* Dev - Removed all kind of special character validation from adding tracking number 
* Fix - Fixed issue of set order status shipped from order details page when "mark order as shipped" without page refresh
* Localization - Updated Swedish, Turkish and French Translations

= 2.9.9.6 =
* Dev - When user disconnect Trackship and connect again than Trackship enable automatically
* Fix - Removed custom order status from the Documents tab of WooCommerce PDF Invoices & Packing Slips plugin if the custom order status is disabled
* Dev - Removed Woocommerce PDF Invoices & Packing Slips plugin compatibility code from the plugin
* Enhancement - Added option for hiding Tracking Header in tracking display customizer
* Dev - Change return URL of shipment status customizer, so it will return back to the notifications tab

= 2.9.9.5 =
* Enhancement - Update TrackShip link on WordPress dashboard and on the AST settings page
* Fix - Responsive issue of the shipping provider list
* Enhancement - Added shipping providers filter dropdown in the orders page
* Fix - Fixed warning - Undefined variable: trackship_supported in plugins/woo-advanced-shipment-tracking/includes/class-wc-advanced-shipment-tracking.php on line 1056
* Dev - Remove query SHOW TABLES LIKE 'wp\\_shipment\\_batch\\_process'
* Dev - Added compatibility with Yith custom order numbers plugin
* Enhancement - Added option for remove tracking info from Customer note emails

= 2.9.9.4 =
* Enhancement - Added new option for create new order status shipped not just rename, so user can use completed and shipped both order status for virtual orders and Local Pickup shipping method
* Enhancement - Set tracking number field focus on orders ans single order page
* Enhancement Change tracking_number input field name- Update TrackShip link on WordPress dashboard and on the AST settings page
* Dev - Limit get orders to 100 on TrackShip tools page
* Dev - Fix slow load issue of WordPress dashboard because of TrckShip Analytics dashboard

= 2.9.9.3 =
* Dev - Limit get orders to 100 on TrackShip tools page
* Fix - version 2.9.8 rollback

= 2.9.9.2 =
* Fix - Fatal error: Uncaught Error: Call to a member function get() on null in /home/jh1ua38qa95m/public_html/store/wp-includes/query.php:28 Stack trace: woo-advanced-shipment-tracking/includes/class-wc-advanced-shipment-tracking-settings.php(444)

= 2.9.9.1 =
* Fix - Fatal error: Uncaught Error: Call to a member function get_items() on bool in woo-advanced-shipment-tracking/includes/class-wc-advanced-shipment-tracking.php:328  

= 2.9.9 =
* Enhancement - Added new option for create new order status shipped not just rename, so user can use completed and shipped both order status for virtual orders and Local Pickup shipping method
* Enhancement - Set tracking number field focus on orders ans single order page
* Enhancement - Update TrackShip link on WordPress dashboard and on the AST settings page
* Dev - Limit get orders to 100 on TrackShip tools page

= 2.9.8 =
* Fix - fixed issue so trackship_supported column adding in shipping providers table and based on that use carrier website as tracking link if TrackShip not sot supported

= 2.9.7 =
* Dev - Added trackship_supported column in shipping providers table and based on that use carrier website as tracking link if TrackShip not sot supported
* Dev - Added custom order number compatibility in TrackShip tracking form
* Dev - Remove dot validation in tracking number
* Dev - Remove dot and underscore validation from Bulk Upload trackig information
* Enhancement - Added Order Id in Inline Tracking Form
* Enhancement - Remove Add Tracking button form orders action if order status is On Hold, Failed , Cancelled, Ready for Pickup and Picked up
* Enhancement - Updated design of TrackShip dashboard

= 2.9.6 =
* Dev - Pass custom order number generate by custom order plugin in TrackShip
* Dev - Remove underscore validation in tracking number
* Dev - Updated code of add_tracking_item() function so it will take current date as date shipped if it's blank
* Enhancement – Added validation message in Tracking page if order id not found
* Enhancement - Added adin notice message for Advanced Local Pickup for WooCommerce plugin
* Fix - Fixed warning Undefined offset: 0 in [path]\wp-content\plugins\woo-advanced-shipment-tracking\includes\class-wc-advanced-shipment-tracking-settings.php on line 542 

= 2.9.5 = 
* Enhancement - Edit button visible always in shipment status notification section in Trackship
* Dev - When TrackShip shipment status change to delivered change order status to delivered only if order status is Completed(Shipped)
* Fix - Fix php warning in TrackShip tracking page 'Uncaught Error: Cannot use object of type WP_Error as array'
* Fix - Mobile issue of Shipping provider image in TrackShip tracking page templates

= 2.9.4 =
* Fix - Bulk import csv issue

= 2.9.3 =
* Fix - Bulk import csv issue

= 2.9.2 =
* Enhancement - Added product code field in tracking info form for this shipping provider - Post Haste,Now Couriers,Dx Mail and Castle Parcels
* Enhancement - Updated settings page design
* Dev - Added compatibility with custom order number functionality for Booster for WooCommerce plugin
* Dev - Added On Hold shipment status for DHL Us shipping provider
* Fix - Tracking display customizer doesn’t load in Enfold
* Fix - Notice: Undefined variable: value in woo-advanced-shipment-tracking/includes/class-wc-advanced-shipment-tracking.php on line 1624
* Fix - Duplicate tracking in simple layout tracking info in my-account orders page

= 2.9.1 =
* Dev - rename update tracking, partially shipped and delivered order status we will use that update order status name in Bulk action dropdown in orders page
* Dev - Added functionality to override  tracking info email template in theme
* Enhancement - Update Tracking display customizer link
* Dev - Updated functionality for Custom Order Numbers for WooCommerce plugin for custom order numbers in bulk import tracking info
* Fix - NZ Couriers shipping provider, the conditional fields are missing on add tracking form
* Fix - Duplicate tracking in simple layout tracking info 
* Fix - Undefined index: simple_layout_content in /woo-advanced-shipment-tracking/includes/class-wc-advanced-shipment-tracking.php on line 1604



= 2.9.0 =
* Enhancement - Added functionality for add product code in add tracking info form if the provider is NZ Courier
* Enhancement - Added message in Shipment tracking page if the Trackship is not connected
* Enhancement - Updated sidebar addons image
* Enhancement - Redesign Shipment Tracking Customizer
* Fix - Fixed issue in tracking display customizer table background-color

[For the complete changelog](https://www.zorem.com/docs/woocommerce-advanced-shipment-tracking/changelog/)