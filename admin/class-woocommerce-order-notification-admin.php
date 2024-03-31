<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://https://github.com/Charl12-gb/WooCommerce-Order-Notification/
 * @since      1.0.0
 *
 * @package    Woocommerce_Order_Notification
 * @subpackage Woocommerce_Order_Notification/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Woocommerce_Order_Notification
 * @subpackage Woocommerce_Order_Notification/admin
 * @author     Charles GBOYOU <gboyoucharles22@gmail.com>
 */
class Woocommerce_Order_Notification_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woocommerce_Order_Notification_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woocommerce_Order_Notification_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woocommerce-order-notification-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woocommerce_Order_Notification_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woocommerce_Order_Notification_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/woocommerce-order-notification-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function woocommerce_order_notification_admin_menu()
	{
		add_options_page(
			'Woocommerce Order Notification',
			'Order Notification',
			'manage_options',
			'woocommerce_order_notification_settings',
			array( $this, 'woocommerce_order_notification_settings_page' )
		);
	}

	public function woocommerce_order_notification_settings_page() {
		?>
		<div class="wrap">
			<h2>WooCommerce Order Notification Settings</h2>
			<div style="display: flex;">
				<div style="flex: 2;">
					<div class="postbox" style="border-radius: 10px; margin: 10px; padding: 10px;">
						<h2 class="hndle"><span>Configuration de l'e-mail</span></h2>
						<div class="inside">
							<form method="post" action="options.php">
								<?php
								settings_fields( 'woocommerce_order_notification_settings' );
								do_settings_sections( 'woocommerce_order_notification_settings' );
								submit_button();
								?>
							</form>
						</div>
					</div>
				</div>
				<div style="flex: 1;">
					<div class="postbox" style="border-radius: 10px; margin: 10px; padding: 10px;">
						<h2 class="hndle" style="color: red;"><span>Important</span></h2>
						<div class="inside">
							<p>
								Pour que les e-mails de notification de commande soient envoyés correctement, il est recommandé de configurer l'envoi de mails SMTP. Si vous n'avez pas encore configuré l'envoi de mails SMTP, vous pouvez installer et configurer le plugin <a href="https://wordpress.org/plugins/wp-mail-smtp/" target="_blank">WP Mail SMTP</a>.
							</p>
							<p>
								La configuration de l'envoi de mails SMTP améliore la fiabilité de la livraison des e-mails, en particulier pour les grands fournisseurs de messagerie qui peuvent marquer les e-mails envoyés par WordPress comme spam.
							</p>
						</div>
					</div>
					<div class="postbox" style="border-radius: 10px; margin: 10px; padding: 10px;">
						<h2 class="hndle"><span>Clés possibles pour le contenu de l'e-mail</span></h2>
						<div class="inside">
							<p>Vous pouvez utiliser les clés suivantes dans le contenu de l'e-mail :</p>
							<ul>
								<li><strong>@order_total_price@</strong> - Prix total de la commande</li>
								<li><strong>@customer_name@</strong> - Nom du client</li>
								<li><strong>@product_list@</strong> - Liste des produits et leurs quantités</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
	public function woocommerce_order_notification_register_settings() {
		register_setting( 'woocommerce_order_notification_settings', 'woocommerce_order_notification_admin_email' );
		register_setting( 'woocommerce_order_notification_settings', 'woocommerce_order_notification_email_subject' ); // Ne pas passer de callback de sanitization
		register_setting( 'woocommerce_order_notification_settings', 'woocommerce_order_notification_email_content' ); // Ne pas passer de callback de sanitization
	
		// Définir le titre par défaut
		if ( ! get_option( 'woocommerce_order_notification_email_subject' ) ) {
			update_option( 'woocommerce_order_notification_email_subject', 'Nouvelle commande passée sur votre site' );
		}
	
		// Définir le contenu par défaut avec les clés
		if ( ! get_option( 'woocommerce_order_notification_email_content' ) ) {
			$default_content = "Bonjour,\n\nUne nouvelle commande a été passée sur votre site.\n\nDétails de la commande :\n\nPrix total de la commande : @order_total_price@\nNom du client : @customer_name@\nListe des produits et leurs quantités : @product_list@\n\nCordialement";
			update_option( 'woocommerce_order_notification_email_content', $default_content );
		}
	}

	public function woocommerce_order_notification_settings_fields() {
		add_settings_section(
			'woocommerce_order_notification_email_section', 
			'Email Settings', 
			array( $this, 'woocommerce_order_notification_email_section_callback' ),
			'woocommerce_order_notification_settings'
		);

		add_settings_field( 'woocommerce_order_notification_admin_email', 'Administrator Email', array( $this, 'woocommerce_order_notification_admin_email_field' ), 'woocommerce_order_notification_settings', 'woocommerce_order_notification_email_section' );
        add_settings_field( 'woocommerce_order_notification_email_subject', 'Email Subject', array( $this, 'woocommerce_order_notification_email_subject_field' ), 'woocommerce_order_notification_settings', 'woocommerce_order_notification_email_section' );
        add_settings_field( 'woocommerce_order_notification_email_content', 'Email Content', array( $this, 'woocommerce_order_notification_email_content_field' ), 'woocommerce_order_notification_settings', 'woocommerce_order_notification_email_section' );
	}
	
	// Callback pour la section d'e-mail
	public function woocommerce_order_notification_email_section_callback() {
		echo '<p>Configure email settings for order notifications.</p>';
	}
	
	// Champ de saisie pour l'e-mail de l'administrateur
	public function woocommerce_order_notification_admin_email_field() {
		$admin_email = get_option( 'woocommerce_order_notification_admin_email' );
		echo '<input type="text" name="woocommerce_order_notification_admin_email" value="' . esc_attr( $admin_email ) . '" style="width: 500px;" />';
	}
	
	// Champ de saisie pour le sujet de l'e-mail
	public function woocommerce_order_notification_email_subject_field() {
		$email_subject = get_option( 'woocommerce_order_notification_email_subject' );
		echo '<input type="text" name="woocommerce_order_notification_email_subject" value="' . esc_attr( $email_subject ) . '" style="width: 500px;" />';
	}
	
	// Champ de saisie pour le contenu de l'e-mail
	public function woocommerce_order_notification_email_content_field() {
		$email_content = get_option( 'woocommerce_order_notification_email_content' );
		echo '<textarea name="woocommerce_order_notification_email_content" rows="5" style="width: 500px;">' . esc_textarea( $email_content ) . '</textarea>';
	}

	public function customize_checkout_button_text() {
		return __( 'Buy Now', 'woocommerce' );
	}

	public function replace_email_placeholders( $order_id, $content ) {
		// Récupérer les données de la commande
		$order = wc_get_order( $order_id );
	
		// Remplacer les clés par les valeurs correspondantes
		$placeholders = array(
			'order_total_price' => $order->get_total(),
			'customer_name' => $order->get_billing_first_name() . ' ' . $order->get_billing_last_name(),
			'product_list' => '',
			// Ajoutez d'autres clés et leurs valeurs associées ici
		);
	
		// Générer la liste des produits et leurs quantités
		$product_list = '';
		foreach ( $order->get_items() as $item_id => $item ) {
			$product = $item->get_product();
			$product_list .= $product->get_name() . ' x' . $item->get_quantity() . ', ';
		}
		$placeholders['product_list'] = rtrim( $product_list, ', ' );
	
		// Remplacer les clés dans le contenu de l'e-mail
		foreach ( $placeholders as $key => $value ) {
			$content = str_replace( '@' . $key . '@', $value, $content );
		}
	
		return $content;
	}

	public function woocommerce_order_notification_send_email( $order_id ) {
		// Récupérer les options de configuration
		$admin_email = get_option( 'woocommerce_order_notification_admin_email' );
		$email_subject = get_option( 'woocommerce_order_notification_email_subject' );
		$email_content = get_option( 'woocommerce_order_notification_email_content' );
	
		// Vérifier si l'e-mail de l'administrateur existe
		if ( ! empty( $admin_email ) && is_email( $admin_email ) ) {
			// Remplacer les clés dans le contenu de l'e-mail
			$content = $this->replace_email_placeholders( $order_id, $email_content );
	
			// Envoyer l'e-mail à l'administrateur du site
			wp_mail( $admin_email, $email_subject, $content );
		}
	}

}
