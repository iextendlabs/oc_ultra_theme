<?php
class ControllerCommonHeader extends Controller {
	public function newsletter() {

		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			
			$this->db->query("INSERT INTO " . DB_PREFIX . "newsletter SET email = '" . $this->request->post['email'] . "', date_added = NOW()");
		
		}
	}
	public function index() {
		// Analytics
		$this->load->model('setting/extension');

		$data['analytics'] = array();

		$analytics = $this->model_setting_extension->getExtensions('analytics');

		foreach ($analytics as $analytic) {
			if ($this->config->get('analytics_' . $analytic['code'] . '_status')) {
				$data['analytics'][] = $this->load->controller('extension/analytics/' . $analytic['code'], $this->config->get('analytics_' . $analytic['code'] . '_status'));
			}
		}

		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		if (is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
			$this->document->addLink($server . 'image/' . $this->config->get('config_icon'), 'icon');
		}

		$data['title'] = $this->document->getTitle();

		$data['base'] = $server;
		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts('header');
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');

		$data['name'] = $this->config->get('config_name');

		if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
			$data['logo'] = $server . 'image/' . $this->config->get('config_logo');
		} else {
			$data['logo'] = '';
		}

		$this->load->language('common/header');

		// Wishlist
		if ($this->customer->isLogged()) {
			$this->load->model('account/wishlist');

			$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), $this->model_account_wishlist->getTotalWishlist());
		} else {
			$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));
		}

		$data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('account/account', '', true), $this->customer->getFirstName(), $this->url->link('account/logout', '', true));
		
		$data['home'] = $this->url->link('common/home');
		$data['wishlist'] = $this->url->link('account/wishlist', '', true);
		$data['logged'] = $this->customer->isLogged();
		$data['account'] = $this->url->link('account/account', '', true);
		$data['register'] = $this->url->link('account/register', '', true);
		$data['login'] = $this->url->link('account/login', '', true);
		$data['order'] = $this->url->link('account/order', '', true);
		$data['transaction'] = $this->url->link('account/transaction', '', true);
		$data['download'] = $this->url->link('account/download', '', true);
		$data['logout'] = $this->url->link('account/logout', '', true);
		$data['shopping_cart'] = $this->url->link('checkout/cart');
		$data['checkout'] = $this->url->link('checkout/checkout', '', true);
		$data['contact'] = $this->url->link('information/contact');
		$data['telephone'] = $this->config->get('config_telephone');
		
		$data['language'] = $this->load->controller('common/language');
		$data['currency'] = $this->load->controller('common/currency');
		$data['search'] = $this->load->controller('common/search');
		$data['cart'] = $this->load->controller('common/cart');
		$data['menu'] = $this->load->controller('common/menu');
		// Header
		$data['header_text'] = $this->config->get('module_header_text');
		$data['header_text_color'] = $this->config->get('module_header_text_color');
		$data['contact_number_color'] = $this->config->get('module_header_contact_number_color');
		$data['header_background_color'] = $this->config->get('module_header_background_color');
		$data['header_link_color'] = $this->config->get('module_header_link_color');
		$data['header_link_hover_color'] = $this->config->get('module_header_link_hover_color');
		$data['header_menu_color'] = $this->config->get('module_header_menu_color');
		$data['header_menu_hover_color'] = $this->config->get('module_header_menu_hover_color');

		// Footer
		$data['footer_background_color'] = $this->config->get('module_footer_background_color');
		$data['footer_link_color'] = $this->config->get('module_footer_link_color');
		$data['footer_link_hover_color'] = $this->config->get('module_footer_link_hover_color');
		$data['footer_heading_color'] = $this->config->get('module_footer_heading_color');

		// Newsletter

		$this->load->model('tool/image');

		$data['newsletter_status'] = $this->config->get('module_newsletter_status');
		$data['newsletter_text'] = $this->config->get('module_newsletter_text');
		$data['newsletter_text_color'] = $this->config->get('module_newsletter_text_color');
		$data['newsletter_button_color'] = $this->config->get('module_newsletter_button_color');
		
		if(!empty($this->config->get('module_newsletter_image'))){
			$data['newsletter_image'] = $this->model_tool_image->resize($this->config->get('module_newsletter_image'), 514, 250);
		}else{
			$data['newsletter_image'] = $this->model_tool_image->resize('no_image.png', 500, 500);
		}

		// Checkout Setting
		$data['module_checkout_button_color'] = $this->config->get('module_checkout_button_color');
		$data['module_checkout_header_color'] = $this->config->get('module_checkout_header_color');
		$data['module_checkout_header_text_color'] = $this->config->get('module_checkout_header_text_color');
		$data['module_checkout_button_text_color'] = $this->config->get('module_checkout_button_text_color');

		//Custom CSS
		$data['custom_css'] = $this->config->get('module_custom_css');
		$data['custom_status'] = $this->config->get('module_custom_status');

		return $this->load->view('common/header', $data);
	}
}
