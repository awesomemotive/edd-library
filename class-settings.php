<?php
if ( !class_exists( "EDD_Modules_Settings" ) ) {

    class EDD_Modules_Settings {

        public $args = array();
        public $sections = array();
        public $ReduxFramework;
        public function __construct() {

            if ( !class_exists( "ReduxFramework" ) ) {
                require_once( dirname( __FILE__ ) . '/redux/ReduxCore/framework.php' );
            }

            $this->initSettings();
        }

        public function initSettings() {
            // Set the default arguments
            $this->setArguments();

            // Create the sections and fields
            $this->setSections();

            if ( !isset( $this->args['opt_name'] ) ) { // No errors please
                return;
            }

            $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
        }


        public function setSections() {
            $this->sections[] = array(
                'title' => __( 'Modules Settings', 'edd_modules' ),
                'desc' => __( 'These settings are used to hide modules that aren\'t applicable to you', 'edd_modules' ),
                'icon' => 'el-icon-home',
                'fields' => array(
                    // todo: coming soon
                    array(
                        'id'=> 'enable-developer-fields',
                        'type' => 'switch',
                        'title' => __( 'Show Developer Fields', 'edd_modules' ),
                        'subtitle' => __( 'Hide all the extensions that are for developers, not users.', 'edd_modules' ),
                        'default'   => 0,
                    ),
                )
            );
            $this->sections[] = array(
                'title' => __( 'Admin', 'edd_modules' ),
                'desc' => __( 'This set of snippets affects the admin area of EDD', 'edd_modules' ),
                'icon' => '',
                'fields' => array(
                    array(
                        'id'=> 'admin-add-settings-hidden-field-type',
                        'type' => 'switch',
                        'title' => __( 'Add hidden field type to admin', 'edd_modules' ),
                        'subtitle' => __( 'Sometimes it might be useful to have a hidden field type if you\'re building an extension for EDD. This setting enables a hidden field type you can use in the EDD settings API.', 'edd_modules' ),
                        'default'   => false,
                        'required' => array( 'enable-developer-fields', 'equals', array( '1' ) ),
                    ),
                    array(
                        'id'=> 'admin-add-username-to-customer-details',
                        'type' => 'switch',
                        'title' => __( 'Add username to customer details', 'edd_modules' ),
                        'subtitle' => __( 'Adds the customer’s username to the "Customer Details" section on the payment screen, and links it through to the user’s profile.', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'admin-add-username-to-customer-details',
                        'type' => 'switch',
                        'title' => __( 'Remove Delete from Payment List Quick Actions', 'edd_modules' ),
                        'subtitle' => __( 'Useful for when you want to hide the ability to delete payments. Warning: requires you to add a custom cap \'delete_shop_payment\' to users who can delete payments to work', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'admin-bulk-delete-orders',
                        'type' => 'switch',
                        'title' => __( 'Add bulk delete orders panel', 'edd_modules' ),
                        'subtitle' => __( 'Useful for when you want to quickly delete a lot of purchases. Found under it\'s own menu item under download when turned on', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'admin-disable-dashboard-summary-widget',
                        'type' => 'switch',
                        'title' => __( 'Disable EDD Dashboard Widget', 'edd_modules' ),
                        'subtitle' => __( 'Removes the EDD sales sumamry widget', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'admin-download-archive-menu-item',
                        'type' => 'switch',
                        'title' => __( 'Show Download Archive Menu Item', 'edd_modules' ),
                        'subtitle' => __( 'Displays the download archive link in the "View All" tab of the "Pages" menu items meta box.', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'admin-download-column-thumbnail',
                        'type' => 'switch',
                        'title' => __( 'Show Download Column Thumbnail', 'edd_modules' ),
                        'subtitle' => __( 'Render a new post column featuring the download thumbnail.', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'admin-menu-icon',
                        'type' => 'switch',
                        'title' => __( 'Replace Menu Icon', 'edd_modules' ),
                        'subtitle' => __( 'Replace the standard menu icon in Easy Digital Downloads with an icon from Dashicons', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id' => 'admin-menu-icon-new',
                        'type' => 'text',
                        'title' => __( 'New Menu Icon', 'edd_modules' ),
                        'subtitle' => __( 'You can find other images you can use ', 'edd_modules' ) . '<a href="https://developer.wordpress.org/resource/dashicons/#index-card" target="_blank">'. __( 'here', 'edd_modules' ) . '</a>',
                        'desc' => __( 'A valid setting value begins with dashicons- ', 'edd_modules' ),
                        'default' => 'dashicons-cart',
                        'required' => array( 'admin-menu-icon', 'equals', array( '1' ) ),
                    ),
                )
            );
            $this->sections[] = array(
                'title' => __( 'Checkout', 'edd_modules' ),
                'desc' => __( 'This set of modules affects the admin area of EDD', 'edd_modules' ),
                'icon' => '',
                'fields' => array(
                    array(
                        'id'=> 'checkout-add-text-before-purchase-button',
                        'type' => 'switch',
                        'title' => __( 'Text before Purchase Button', 'edd_modules' ),
                        'subtitle' => __( 'Add custom text just before the "Purchase" button at checkout', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id' => 'checkout-add-text-before-purchase-button-text',
                        'type' => 'text',
                        'title' => __( 'Text before Purchase Button', 'edd_modules' ),
                        'subtitle' => __( 'What would you like to say?', 'edd_modules' ),
                        'default' => '',
                        'required' => array( 'checkout-add-text-before-purchase-button', 'equals', array( '1' ) ),
                    ),
                    array(
                        'id'=> 'checkout-continue-shopping-button',
                        'type' => 'switch',
                        'title' => __( 'Continue shopping button', 'edd_modules' ),
                        'subtitle' => __( 'Show a continue shopping button on the checkout page', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'checkout-custom-cart-row',
                        'type' => 'switch',
                        'title' => __( 'Custom Cart Row', 'edd_modules' ),
                        'subtitle' => __( 'Add a custom row of HTML to the checkout shopping cart', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id' => 'checkout-custom-cart-row-text',
                        'type' => 'text',
                        'title' => __( 'Custom Cart Row HTML', 'edd_modules' ),
                        'subtitle' => __( 'What would you like to say?', 'edd_modules' ),
                        'default' => '',
                        'required' => array( 'checkout-custom-cart-row', 'equals', array( '1' ) ),
                    ),
                    array(
                        'id'=> 'checkout-custom-gateway-icons',
                        'type' => 'switch',
                        'title' => __( 'Custom Gateway Icons', 'edd_modules' ),
                        'subtitle' => __( 'Add a custom gateway icons that show on the checkout page', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'         => 'checkout-custom-gateway-icons-select',
                        'type'       => 'repeater',
                        'title'      => __( 'Payment Icons To Show', 'edd_modules' ),
                        'required' => array( 'checkout-custom-gateway-icons', 'equals', array( '1' ) ),
                        'sortable' => true, 
                        'fields'     => array(
                            array(
                                'id'          => 'Name of Gateway To Show',
                                'type'        => 'text',
                                'placeholder' => __( 'Text Field', 'edd_modules' ),
                            ),
                            array(
                                'id'       => 'icon',
                                'type'     => 'media', 
                                'url'      => true,
                                'title'    => __('Icon', 'edd_modules'),
                                'default'  => '',
                            )
                        )
                    ),
                    array(
                        'id'=> 'checkout-custom-terms-page',
                        'type' => 'switch',
                        'title' => __( 'Custom Terms Page', 'edd_modules' ),
                        'subtitle' => __( 'Custom page for "agree to terms" and link to it instead of opening terms in slidedown panel. Good for when you have a lot of text.', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'checkout-custom-terms-page-select',
                        'type' => 'select',
                        'title' => __( 'Select Custom Terms Page', 'edd_modules' ),
                        'subtitle' => __( '', 'edd_modules' ),
                        'data' => 'pages',
                        'required' => array( 'checkout-custom-terms-page', 'equals', array( '1' ) ),
                    ),
                    array(
                        'id'=> 'checkout-force-account-creation-by-total',
                        'type' => 'switch',
                        'title' => __( 'Force Account Creation When Order Exceeds $x', 'edd_modules' ),
                        'subtitle' => __( 'Force account creation at checkout if the cart total is a certain amount', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'checkout-force-account-creation-by-total-select',
                        'type' => 'text',
                        'title' => __( 'How much (enter using XX.XX format)', 'edd_modules' ),
                        'subtitle' => __( '', 'edd_modules' ),
                        'default' => 10,
                        'required' => array( 'checkout-force-account-creation-by-total', 'equals', array( '1' ) ),
                    ),
                    array(
                        'id'=> 'checkout-force-account-creation-by-tag',
                        'type' => 'switch',
                        'title' => __( 'Force Account Creation When Order Contains Product With Tag', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'checkout-force-account-creation-by-tag-select',
                        'type' => 'select',
                        'title' => __( 'Which tag(s)', 'edd_modules' ),
                        'subtitle' => __( '', 'edd_modules' ),
                        'data' => 'terms',
                        'args' => array('taxonomies'=>'download_tag', 'args'=>array()),
                        'multi' => true,
                        'required' => array( 'checkout-force-account-creation-by-tag', 'equals', array( '1' ) ),
                    ),
                    array(
                        'id'=> 'checkout-force-account-creation-by-category',
                        'type' => 'switch',
                        'title' => __( 'Force Account Creation When Order Contains Product With Category', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'checkout-force-account-creation-by-category-select',
                        'type' => 'select',
                        'title' => __( 'Which category(s)', 'edd_modules' ),
                        'data' => 'terms',
                        'args' => array('taxonomies'=>'download_category', 'args'=>array()),
                        'multi' => true,
                        'required' => array( 'checkout-force-account-creation-by-category', 'equals', array( '1' ) ),
                    ),
                    array(
                        'id'=> 'checkout-force-minimum-password-length',
                        'type' => 'switch',
                        'title' => __( 'Force minimum password length', 'edd_modules' ),
                        'subtitle' => __( '', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id' => 'checkout-force-minimum-password-length-select',
                        'type' => 'text',
                        'title' => __( 'What should the minimum password length be?', 'edd_modules' ),
                        'desc' => __( 'Enter a number', 'edd_modules' ),
                        'default' => '8',
                        'required' => array( 'checkout-force-minimum-password-length', 'equals', array( '1' ) ),
                    ),
                    array(
                        'id'=> 'checkout-hide-payment-icons-when-free',
                        'type' => 'switch',
                        'title' => __( 'When cart total is $0, hide payment icons', 'edd_modules' ),
                        'subtitle' => __( '', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'checkout-max-cart-amount',
                        'type' => 'switch',
                        'title' => __( 'Have a maximum cart amount', 'edd_modules' ),
                        'subtitle' => __( 'Useful when you want to limit the size a cart can be in $', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id' => 'checkout-max-cart-amount-select',
                        'type' => 'text',
                        'title' => __( 'What should the max cart total be?', 'edd_modules' ),
                        'desc' => __( 'Enter a number (in xx.yy format)', 'edd_modules' ),
                        'default' => '100.00',
                        'required' => array( 'checkout-max-cart-amount', 'equals', array( '1' ) ),
                    ),
                    array(
                        'id'=> 'checkout-move-user-fields-below-account-creation',
                        'type' => 'switch',
                        'title' => __( 'Move user fields below acount creation', 'edd_modules' ),
                        'subtitle' => __( '', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'checkout-require-card-state',
                        'type' => 'switch',
                        'title' => __( 'Require state field for credit cards', 'edd_modules' ),
                        'subtitle' => __( '', 'edd_modules' ),
                        'default'   => true,
                    ),
                    array(
                        'id'=> 'checkout-one-product-checkout',
                        'type' => 'switch',
                        'title' => __( 'Only allow carts to contain 1 item', 'edd_modules' ),
                        'subtitle' => __( '', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'checkout-prevent-discounts-wtih-sl-renewals',
                        'type' => 'switch',
                        'title' => __( 'Prevent Discounts with Software Licensing renewals', 'edd_modules' ),
                        'subtitle' => __( '', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'checkout-prevent-duplicate-cart-items',
                        'type' => 'switch',
                        'title' => __( 'Prevent Duplicate cart items', 'edd_modules' ),
                        'subtitle' => __( '', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'checkout-remove-download-links',
                        'type' => 'switch',
                        'title' => __( 'Remove download links from checkout page for all downloads', 'edd_modules' ),
                        'subtitle' => __( '', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'checkout-remove-last-name',
                        'type' => 'switch',
                        'title' => __( 'Remove last name field', 'edd_modules' ),
                        'subtitle' => __( '', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'checkout-make-last-name-required',
                        'type' => 'switch',
                        'title' => __( 'Make last name required', 'edd_modules' ),
                        'subtitle' => __( '', 'edd_modules' ),
                        'default'   => false,
                        'required' => array( 'checkout-max-cart-amount', 'equals', array( '0' ) ),
                    ),
                    array(
                        'id'=> 'checkout-remove-last-name',
                        'type' => 'switch',
                        'title' => __( 'Remove last-name', 'edd_modules' ),
                        'subtitle' => __( '', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'checkout-send-sale-alerts-from-customer-email',
                        'type' => 'switch',
                        'title' => __( 'Send Admin sale alerts from customer email', 'edd_modules' ),
                        'subtitle' => __( 'This makes it easier for users who wish to contact customers after purchase', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'checkout-show-discount-field',
                        'type' => 'switch',
                        'title' => __( 'Always show discount field', 'edd_modules' ),
                        'subtitle' => __( '', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'checkout-show-checkout-terms-by-default',
                        'type' => 'switch',
                        'title' => __( 'Show checkout terms by default', 'edd_modules' ),
                        'subtitle' => __( '', 'edd_modules' ),
                        'default'   => false,
                        'required' => array( 'checkout-custom-terms-page', 'equals', array( '0' ) ),
                    ),
                    array(
                        'id'=> 'checkout-show-ssl-seal',
                        'type' => 'switch',
                        'title' => __( 'Show an SSL seal on checkout', 'edd_modules' ),
                        'subtitle' => __( '', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'       => 'checkout-show-ssl-seal-select',
                        'type'     => 'media', 
                        'url'      => true,
                        'title'    => __('SSL Seal', 'edd_modules'),
                        'default'  => '',
                        'required' => array( 'checkout-show-ssl-seal', 'equals', array( '1' ) ),
                    ),
                    array(
                        'id'       => 'checkout-custom-user-role',
                        'type'     => 'switch', 
                        'url'      => true,
                        'title'    => __('Give Customers a custom user role on checkout', 'edd_modules'),
                        'default'  => '',
                    ),
                    array(
                        'id'=> 'checkout-custom-user-role-select',
                        'type' => 'select',
                        'title' => __( 'Which role', 'edd_modules' ),
                        'data' => 'roles',
                        'multi' => false,
                        'required' => array( 'checkout-custom-user-role', 'equals', array( '1' ) ),
                    ),
                )
            );
            $this->sections[] = array(
                'title' => __( 'Downloads', 'edd_modules' ),
                'desc' => __( 'This set of modules affects downloads', 'edd_modules' ),
                'icon' => '',
                'fields' => array(
                    array(
                        'id'=> 'downloads-disable-quantity-field-on-download',
                        'type' => 'switch',
                        'title' => __( 'Disable quantity field on download', 'edd_modules' ),
                        'subtitle' => __( '', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'downloads-',
                        'type' => 'switch',
                        'title' => __( 'After Download show filesizes', 'edd_modules' ),
                        'subtitle' => __( 'After the download content, shows a list of the download files and their sizes', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'downloads-comments',
                        'type' => 'switch',
                        'title' => __( 'Add comments to download post type', 'edd_modules' ),
                        'subtitle' => __( '', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'downloads-revisions',
                        'type' => 'switch',
                        'title' => __( 'Add revisions to download post type', 'edd_modules' ),
                        'subtitle' => __( '', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'downloads-exclude-from-search',
                        'type' => 'switch',
                        'title' => __( 'Exclude downloads from search', 'edd_modules' ),
                        'subtitle' => __( '', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'downloads-no-variable-default',
                        'type' => 'switch',
                        'title' => __( 'No default for variable prices', 'edd_modules' ),
                        'subtitle' => __( 'Prevent variable pricing options from being checked by default', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'downloads-remove-free-text',
                        'type' => 'switch',
                        'title' => __( 'Remove free text', 'edd_modules' ),
                        'subtitle' => __( '', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'downloads-remove-product-notes-for-all-downloads',
                        'type' => 'switch',
                        'title' => __( 'Remove Product Notes For All Downloads', 'edd_modules' ),
                        'subtitle' => __( '', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'downloads-remove-product-notes-for-some-downloads-select',
                        'type' => 'switch',
                        'title' => __( 'Select which downloads to remove product notes for', 'edd_modules' ),
                        'subtitle' => __( '', 'edd_modules' ),
                        'default'   => false,
                        'required' => array( 'downloads-remove-product-notes-for-all-downloads', 'equals', array( '0' ) ),
                    ),
                    array(
                        'id'=> 'checkout-force-account-creation-by-tag-select',
                        'type' => 'select',
                        'title' => __( 'Which tag(s)', 'edd_modules' ),
                        'subtitle' => __( '', 'edd_modules' ),
                        'data' => 'posts',
                        'args' => array('post_types'=>'download', 'args'=>array()),
                        'multi' => true,
                        'required' => array( 'downloads-remove-product-notes-for-some-downloads', 'equals', array( '1' ) ),
                    ),
                    array(
                        'id'=> 'downloads-replace-add-to-cart-with-download',
                        'type' => 'switch',
                        'title' => __( 'Replace add to cart with download', 'edd_modules' ),
                        'subtitle' => __( 'If the user has purcahsed the product already, show a links to download each file associated with the product instead of an Add To Cart Button', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'downloads-reverse-variable-pricing',
                        'type' => 'switch',
                        'title' => __( 'Reverse variable pricing', 'edd_modules' ),
                        'subtitle' => __( '', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'downloads-show-featured-image-with-purchase-link',
                        'type' => 'switch',
                        'title' => __( 'Show featured image with purchase link', 'edd_modules' ),
                        'subtitle' => __( '', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'downloads-top-pagination',
                        'type' => 'switch',
                        'title' => __( 'Show pagination at top of [download] shortcode', 'edd_modules' ),
                        'subtitle' => __( '', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'downloads-variable-pricing-dropdown',
                        'type' => 'switch',
                        'title' => __( 'Dropdown for variable prices', 'edd_modules' ),
                        'subtitle' => __( '', 'edd_modules' ),
                        'default'   => false,
                    ),
                )
            );
            $this->sections[] = array(
                'title' => __( 'Emails', 'edd_modules' ),
                'desc' => __( 'This set of modules affects the emails sent from EDD', 'edd_modules' ),
                'icon' => '',
                'fields' => array(
                    array(
                        'id'=> 'emails-disable-emails-free-purchases',
                        'type' => 'switch',
                        'title' => __( 'Disable purchase emails for free pruchases', 'edd_modules' ),
                        'subtitle' => __( '', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'emails-disable-new-user-notifications',
                        'type' => 'switch',
                        'title' => __( 'Disable new user notifications', 'edd_modules' ),
                        'subtitle' => __( '', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'emails-download-email-tag',
                        'type' => 'switch',
                        'title' => __( 'Downloads Email Tag', 'edd_modules' ),
                        'subtitle' => __( 'Adds a {downloads} email tag for use in email templates that outputs a simple list of linked downloads without file names', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'emails-pre-approval-emails',
                        'type' => 'switch',
                        'title' => __( 'Email Pre-Approval Emails', 'edd_modules' ),
                        'subtitle' => __( '', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'emails-show-vendor-emails',
                        'type' => 'switch',
                        'title' => __( 'Show the Shop Vendor\'s email for each download purchased', 'edd_modules' ),
                        'subtitle' => __( '', 'edd_modules' ),
                        'default'   => false,
                    ),
                )
            );
            $this->sections[] = array(
                'title' => __( 'Extensions', 'edd_modules' ),
                'desc' => __( 'This set of modules are for EDD extensions', 'edd_modules' ),
                'icon' => '',
                'fields' => array(
                    array(
                        'id'   =>'extensions-commissions',
                        'title' => __( 'Commissions', 'edd_modules' ),
                        'type' => 'section',
                        'indent'   => true,
                    ),
                        array(
                            'id'=> 'extensions-adjust-rate-for-referrals',
                            'type' => 'switch',
                            'title' => __( 'Adjust rate for referrals', 'edd_modules' ),
                            'subtitle' => __( 'Adjusts the commission rate for payments that were referred by an affiliate', 'edd_modules' ),
                            'default'   => false,
                        ),
                        array(
                            'id'=> 'extensions-adjust-rate-for-referrals-select',
                            'text' => 'text',
                            'title' => __( 'Amount to reduce commissions by', 'edd_modules' ),
                            'subtitle' => __( 'Enter a percentage to reduce commission by without the % sign. Example: 70', 'edd_modules' ),
                            'default'   => 70,
                        ),
                
                    array(
                        'id'   =>'extensions-content-restriction',
                        'title' => __( 'Content Restriction', 'edd_modules' ),
                        'type' => 'section',
                        'indent'   => true,
                    ),
                        array(
                            'id'=> 'extensions-cr-login-form',
                            'type' => 'switch',
                            'title' => __( 'Show login form for logged out users', 'edd_modules' ),
                            'subtitle' => __( 'Shows the [edd_login] form on restricted content for logged out users.', 'edd_modules' ),
                            'default'   => false,
                        ),
                
                array(
                        'id'   =>'extensions-frontend-submissions',
                        'title' => __( 'Frontend Submissions', 'edd_modules' ),
                        'type' => 'section',
                        'indent'   => true,
                    ),
                        array(
                            'id'=> 'extensions-change-vendor-pending-message',
                            'type' => 'switch',
                            'title' => __( 'Change Vendor Pending Message', 'edd_modules' ),
                            'default'   => false,
                        ),
                        array(
                            'id'=> 'extensions-change-vendor-pending-message-select',
                            'type' => 'text',
                            'title' => __( 'Vendor Pending Message Text', 'edd_modules' ),
                            'default'   => '',
                            'required' => array( 'extensions-change-vendor-pending-message', 'equals', array( '1' ) ),
 
                        ),


                array(
                        'id'   =>'extensions-gateway-fees',
                        'title' => __( 'Gateway Fees', 'edd_modules' ),
                        'type' => 'section',
                        'indent'   => true,
                    ),
                    array(
                        'id'=> 'extensions-no-fee-over-cart-total',
                        'type' => 'switch',
                        'title' => __( 'No gateway fees when order is over', 'edd_modules' ),
                        'default'   => false,
                    ),
                    array(
                        'id'=> 'extensions-no-fee-over-cart-total-select',
                        'type' => 'text',
                        'title' => __( 'What cart total would you like to start ', 'edd_modules' ),
                        'default'   => '',
                        'required' => array( 'extensions-change-vendor-pending-message', 'equals', array( '1' ) ),

                    ),
                
                    ),

            );
            $this->sections[] = array(
                'title' => __( 'Output', 'edd_modules' ),
                'desc' => __( 'This set of snippets affects the admin area of EDD', 'edd_modules' ),
                'icon' => '',
                'fields' => array(
                    array(
                        'id'=> 'admin-add-settings-hidden-field-type',
                        'type' => 'switch',
                        'title' => __( 'Add hidden field type to admin', 'edd_modules' ),
                        'subtitle' => __( 'Sometimes it might be useful to have a hidden field type if you\'re building an extension for EDD. This setting enables a hidden field type you can use in the EDD settings API.', 'edd_modules' ),
                        'default'   => false,
                        'required' => array( 'enable-developer-fields', 'equals', array( '1' ) ),
                    ),
                )
            );
            $this->sections[] = array(
                'title' => __( 'Misc', 'edd_modules' ),
                'desc' => __( 'This set of snippets affects the admin area of EDD', 'edd_modules' ),
                'icon' => '',
                'fields' => array(
                    array(
                        'id'=> 'admin-add-settings-hidden-field-type',
                        'type' => 'switch',
                        'title' => __( 'Add hidden field type to admin', 'edd_modules' ),
                        'subtitle' => __( 'Sometimes it might be useful to have a hidden field type if you\'re building an extension for EDD. This setting enables a hidden field type you can use in the EDD settings API.', 'edd_modules' ),
                        'default'   => false,
                        'required' => array( 'enable-developer-fields', 'equals', array( '1' ) ),
                    ),
                )
            );
            do_action( 'edd_modules_settings_panel_sections', $this->sections );
        }

        /**
         * All the possible arguments for Redux.
         * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */
        public function setArguments() {
            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name' => 'edd_modules_settings', // This is where your data is stored in the database and also becomes your global variable name.
                'display_name' => __( 'Easy Digital Downloads Modules', 'edd_modules' ), // Name that appears at the top of your panel
                'display_version' => edd_modules_plugin_version, // Version that appears at the top of your panel
                'menu_type' => 'submenu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu' => false, // Show the sections below the admin menu item or not
                'menu_title' => __( 'Modules', 'edd_modules' ),
                'page_title' => __( 'EDD Modules', 'edd_modules' ),
                'admin_bar' => false, // Show the panel pages on the admin bar
                'global_variable' => '', // Set a different name for your global variable other than the opt_name
                'dev_mode' => false, // Show the time the page took to load, etc
                'page_priority' => null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent' => 'edit.php?post_type=download', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions' => 'manage_shop_settings', // Permissions needed to access the options panel.
                'menu_icon' => '', // Specify a custom URL to an icon
                'last_tab' => '', // Force your panel to always open to a specific tab (by id)
                'page_icon' => 'icon-themes', // Icon displayed in the admin panel next to your menu_title
                'page_slug' => 'edd-modules', // Page slug used to denote the panel
                'save_defaults' => true, // On load save the defaults to DB before user clicks save or not
				'use_cdn' => true,
				'customizer' => false,
                'update_notice' => false,
                'allow_tracking' => false,
                'redux_notice_check' => false,
				'forced_dev_mode_off' => true,
                'default_show' => false, // If true, shows the default value next to each field that is not the default value.
                'default_mark' => '', // What to print by the field's title if the value shown is default. Suggested: *
                // CAREFUL -> These options are for advanced use only
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag' => true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                //'domain'              => 'redux-framework', // Translation domain key. Don't change this unless you want to retranslate all of Redux.
                'footer_credit'       => __( 'Thanks for using the EDD Modules plugin', 'edd_modules' ), // Disable the footer credit of Redux. Please leave if you can help it.
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database' => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'show_import_export' => true, // REMOVE
                'system_info' => false, // REMOVE
                'help_tabs' => array(),
                'help_sidebar' => '', // __( '', $this->args['domain'] );
                'hints' => array(
                    'icon'              => 'icon-question-sign',
                    'icon_position'     => 'right',
                    'icon_color'        => 'lightgray',
                    'icon_size'         => 'normal',

                    'tip_style'         => array(
                        'color'     => 'light',
                        'shadow'    => true,
                        'rounded'   => false,
                        'style'     => '',
                    ),
                    'tip_position'      => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect' => array(
                        'show' => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'mouseover',
                        ),
                        'hide' => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            );

            // Panel Intro text -> before the form
            if ( !isset( $this->args['global_variable'] ) || $this->args['global_variable'] !== false ) {
                if ( !empty( $this->args['global_variable'] ) ) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace( "-", "_", $this->args['opt_name'] );
                }
                $this->args['intro_text'] = __( 'Note: As a snippets library, there is no support for this plugin.', 'edd_modules' );
            }
        }

    }
    global $edd_modules_settings_save;
   $edd_modules_settings_save = new EDD_Modules_Settings();
}
