<?php
class ControllerExtensionModuleOcUltraThemeSetting extends Controller {
	private $error = array();

	public function install() {
		$this->db->query("CREATE TABLE IF NOT EXISTS `oc_newsletter` (
			`newsletter_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
			`email` varchar(99) NOT NULL,
			`date_added` datetime NOT NULL
			)");
	}

	public function home_page_setting() {
		
		$this->load->language('extension/module/home_page_setting');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('module_ocUltra_theme_setting', $this->request->post);
			$this->model_setting_setting->editSetting('module_home_page', $this->request->post);
			if ($this->request->post['module_ocUltra_theme_setting_status'] == 1) {
				
				$this->request->post['module_ocUltra_flag'] = 1;
				$this->model_setting_setting->editSetting('module_ocUltra_flag', $this->request->post);
			
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module/ocUltra_theme_setting/home_page_setting', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/ocUltra_theme_setting/home_page_setting', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/module/ocUltra_theme_setting/home_page_setting', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

		$this->load->model('tool/image');

		if (isset($this->request->post['module_ocUltra_theme_setting_status'])) {
			$data['module_ocUltra_theme_setting_status'] = $this->request->post['module_ocUltra_theme_setting_status'];
		} else {
			$data['module_ocUltra_theme_setting_status'] = $this->config->get('module_ocUltra_theme_setting_status');
		}

		if (isset($this->request->post['module_home_page_heading1'])) {
			$data['module_home_page_heading1'] = $this->request->post['module_home_page_heading1'];
		} else {
			$data['module_home_page_heading1'] = $this->config->get('module_home_page_heading1');
		}

        if (isset($this->request->post['module_home_page_heading1_data'])) {
			$data['module_home_page_heading1_data'] = $this->request->post['module_home_page_heading1_data'];
		} else {
			$data['module_home_page_heading1_data'] = $this->config->get('module_home_page_heading1_data');
		}

        if (isset($this->request->post['module_home_page_heading1_icon'])) {
			$data['module_home_page_heading1_icon'] = $this->request->post['module_home_page_heading1_icon'];
		} else {
			$data['module_home_page_heading1_icon'] = $this->config->get('module_home_page_heading1_icon');
		}

        if (isset($this->request->post['module_home_page_heading2'])) {
			$data['module_home_page_heading2'] = $this->request->post['module_home_page_heading2'];
		} else {
			$data['module_home_page_heading2'] = $this->config->get('module_home_page_heading2');
		}

        if (isset($this->request->post['module_home_page_heading2_data'])) {
			$data['module_home_page_heading2_data'] = $this->request->post['module_home_page_heading2_data'];
		} else {
			$data['module_home_page_heading2_data'] = $this->config->get('module_home_page_heading2_data');
		}

        if (isset($this->request->post['module_home_page_heading2_icon'])) {
			$data['module_home_page_heading2_icon'] = $this->request->post['module_home_page_heading2_icon'];
		} else {
			$data['module_home_page_heading2_icon'] = $this->config->get('module_home_page_heading2_icon');
		}

        if (isset($this->request->post['module_home_page_heading3'])) {
			$data['module_home_page_heading3'] = $this->request->post['module_home_page_heading3'];
		} else {
			$data['module_home_page_heading3'] = $this->config->get('module_home_page_heading3');
		}

        if (isset($this->request->post['module_home_page_heading3_data'])) {
			$data['module_home_page_heading3_data'] = $this->request->post['module_home_page_heading3_data'];
		} else {
			$data['module_home_page_heading3_data'] = $this->config->get('module_home_page_heading3_data');
		}

        if (isset($this->request->post['module_home_page_heading3_icon'])) {
			$data['module_home_page_heading3_icon'] = $this->request->post['module_home_page_heading3_icon'];
		} else {
			$data['module_home_page_heading3_icon'] = $this->config->get('module_home_page_heading3_icon');
		}

		if (isset($this->request->post['module_home_page_icon_color'])) {
			$data['module_home_page_icon_color'] = $this->request->post['module_home_page_icon_color'];
		} else {
			$data['module_home_page_icon_color'] = $this->config->get('module_home_page_icon_color');
		}

		if (isset($this->request->post['module_home_page_headings_color'])) {
			$data['module_home_page_headings_color'] = $this->request->post['module_home_page_headings_color'];
		} else {
			$data['module_home_page_headings_color'] = $this->config->get('module_home_page_headings_color');
		}
        
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/home_page_setting', $data));
	}

	public function header_setting() {
		
		$this->load->language('extension/module/header_setting');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('module_header', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module/ocUltra_theme_setting/header_setting', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/ocUltra_theme_setting/header_setting', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/module/ocUltra_theme_setting/header_setting', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

		$this->load->model('tool/image');

        if (isset($this->request->post['module_header_text'])) {
			$data['module_header_text'] = $this->request->post['module_header_text'];
		} else {
			$data['module_header_text'] = $this->config->get('module_header_text');
		}

		if (isset($this->request->post['module_header_text_color'])) {
			$data['module_header_text_color'] = $this->request->post['module_header_text_color'];
		} else {
			$data['module_header_text_color'] = $this->config->get('module_header_text_color');
		}
		
		if (isset($this->request->post['module_header_contact_number_color'])) {
			$data['module_header_contact_number_color'] = $this->request->post['module_header_contact_number_color'];
		} else {
			$data['module_header_contact_number_color'] = $this->config->get('module_header_contact_number_color');
		}

		if (isset($this->request->post['module_header_background_color'])) {
			$data['module_header_background_color'] = $this->request->post['module_header_background_color'];
		} else {
			$data['module_header_background_color'] = $this->config->get('module_header_background_color');
		}

		if (isset($this->request->post['module_header_link_color'])) {
			$data['module_header_link_color'] = $this->request->post['module_header_link_color'];
		} else {
			$data['module_header_link_color'] = $this->config->get('module_header_link_color');
		}

		if (isset($this->request->post['module_header_link_hover_color'])) {
			$data['module_header_link_hover_color'] = $this->request->post['module_header_link_hover_color'];
		} else {
			$data['module_header_link_hover_color'] = $this->config->get('module_header_link_hover_color');
		}

		if (isset($this->request->post['module_header_menu_color'])) {
			$data['module_header_menu_color'] = $this->request->post['module_header_menu_color'];
		} else {
			$data['module_header_menu_color'] = $this->config->get('module_header_menu_color');
		}

		if (isset($this->request->post['module_header_menu_hover_color'])) {
			$data['module_header_menu_hover_color'] = $this->request->post['module_header_menu_hover_color'];
		} else {
			$data['module_header_menu_hover_color'] = $this->config->get('module_header_menu_hover_color');
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/header_setting', $data));
	}

	public function slider_setting() {
		
		$this->load->language('extension/module/slider_setting');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			
			$this->model_setting_setting->editSetting('module_slider', $this->request->post);
			

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module/ocUltra_theme_setting/slider_setting', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/ocUltra_theme_setting/slider_setting', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/module/ocUltra_theme_setting/slider_setting', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

		$this->load->model('tool/image');

		if (isset($this->request->post['module_slider_text'])) {
			$data['module_slider_text'] = $this->request->post['module_slider_text'];
		} else {
			$data['module_slider_text'] = $this->config->get('module_slider_text');
		}

		if (isset($this->request->post['module_slider_text_color'])) {
			$data['module_slider_text_color'] = $this->request->post['module_slider_text_color'];
		} else {
			$data['module_slider_text_color'] = $this->config->get('module_slider_text_color');
		}

		if (isset($this->request->post['module_slider_top_image'])) {
			$data['module_slider_top_image'] = $this->request->post['module_slider_top_image'];
		} else {
			$data['module_slider_top_image'] = $this->config->get('module_slider_top_image');
		}

		if (isset($this->request->post['module_slider_top_image']) && is_file(DIR_IMAGE . $this->request->post['module_slider_top_image'])) {
			$data['slider_top_image'] = $this->model_tool_image->resize($this->request->post['module_slider_top_image'], 100, 100);
		} elseif (!empty($this->config->get('module_slider_top_image')) && is_file(DIR_IMAGE . $this->config->get('module_slider_top_image'))) {
			$data['slider_top_image'] = $this->model_tool_image->resize($this->config->get('module_slider_top_image'), 100, 100);
		} else {
			$data['slider_top_image'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/slider_setting', $data));
	}

	public function footer_setting() {
		
		$this->load->language('extension/module/footer_setting');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('module_footer', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module/ocUltra_theme_setting/footer_setting', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/ocUltra_theme_setting/footer_setting', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/module/ocUltra_theme_setting/footer_setting', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

		$this->load->model('tool/image');

        if (isset($this->request->post['module_footer_text'])) {
			$data['module_footer_text'] = $this->request->post['module_footer_text'];
		} else {
			$data['module_footer_text'] = $this->config->get('module_footer_text');
		}

		if (isset($this->request->post['module_footer_text_color'])) {
			$data['module_footer_text_color'] = $this->request->post['module_footer_text_color'];
		} else {
			$data['module_footer_text_color'] = $this->config->get('module_footer_text_color');
		}

        if (isset($this->request->post['module_footer_top_text'])) {
			$data['module_footer_top_text'] = $this->request->post['module_footer_top_text'];
		} else {
			$data['module_footer_top_text'] = $this->config->get('module_footer_top_text');
		}

		if (isset($this->request->post['module_footer_top_text_color'])) {
			$data['module_footer_top_text_color'] = $this->request->post['module_footer_top_text_color'];
		} else {
			$data['module_footer_top_text_color'] = $this->config->get('module_footer_top_text_color');
		}

		if (isset($this->request->post['module_footer_top_image'])) {
			$data['module_footer_top_image'] = $this->request->post['module_footer_top_image'];
		} else {
			$data['module_footer_top_image'] = $this->config->get('module_footer_top_image');
		}

		if (isset($this->request->post['module_footer_top_image']) && is_file(DIR_IMAGE . $this->request->post['module_footer_top_image'])) {
			$data['footer_top_image'] = $this->model_tool_image->resize($this->request->post['module_footer_top_image'], 100, 100);
		} elseif (!empty($this->config->get('module_footer_top_image')) && is_file(DIR_IMAGE . $this->config->get('module_footer_top_image'))) {
			$data['footer_top_image'] = $this->model_tool_image->resize($this->config->get('module_footer_top_image'), 100, 100);
		} else {
			$data['footer_top_image'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		if (isset($this->request->post['module_footer_background_color'])) {
			$data['module_footer_background_color'] = $this->request->post['module_footer_background_color'];
		} else {
			$data['module_footer_background_color'] = $this->config->get('module_footer_background_color');
		}

		if (isset($this->request->post['module_footer_link_color'])) {
			$data['module_footer_link_color'] = $this->request->post['module_footer_link_color'];
		} else {
			$data['module_footer_link_color'] = $this->config->get('module_footer_link_color');
		}

		if (isset($this->request->post['module_footer_link_hover_color'])) {
			$data['module_footer_link_hover_color'] = $this->request->post['module_footer_link_hover_color'];
		} else {
			$data['module_footer_link_hover_color'] = $this->config->get('module_footer_link_hover_color');
		}

		if (isset($this->request->post['module_footer_heading_color'])) {
			$data['module_footer_heading_color'] = $this->request->post['module_footer_heading_color'];
		} else {
			$data['module_footer_heading_color'] = $this->config->get('module_footer_heading_color');
		}
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/footer_setting', $data));
	}

	public function product_page_setting() {
		
		$this->load->language('extension/module/product_page_setting');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('module_product_page', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module/ocUltra_theme_setting/product_page_setting', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/ocUltra_theme_setting/product_page_setting', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/module/ocUltra_theme_setting/product_page_setting', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

		$this->load->model('tool/image');

        if (isset($this->request->post['module_product_page_button_color'])) {
			$data['module_product_page_button_color'] = $this->request->post['module_product_page_button_color'];
		} else {
			$data['module_product_page_button_color'] = $this->config->get('module_product_page_button_color');
		}

		if (isset($this->request->post['module_product_page_button_text_color'])) {
			$data['module_product_page_button_text_color'] = $this->request->post['module_product_page_button_text_color'];
		} else {
			$data['module_product_page_button_text_color'] = $this->config->get('module_product_page_button_text_color');
		}

		if (isset($this->request->post['module_product_page_button_hover_color'])) {
			$data['module_product_page_button_hover_color'] = $this->request->post['module_product_page_button_hover_color'];
		} else {
			$data['module_product_page_button_hover_color'] = $this->config->get('module_product_page_button_hover_color');
		}
		
		if (isset($this->request->post['module_product_page_button_hover_text_color'])) {
			$data['module_product_page_button_hover_text_color'] = $this->request->post['module_product_page_button_hover_text_color'];
		} else {
			$data['module_product_page_button_hover_text_color'] = $this->config->get('module_product_page_button_hover_text_color');
		}

		if (isset($this->request->post['module_product_page_headings_color'])) {
			$data['module_product_page_headings_color'] = $this->request->post['module_product_page_headings_color'];
		} else {
			$data['module_product_page_headings_color'] = $this->config->get('module_product_page_headings_color');
		}

		if (isset($this->request->post['module_product_page_sub_headings_color'])) {
			$data['module_product_page_sub_headings_color'] = $this->request->post['module_product_page_sub_headings_color'];
		} else {
			$data['module_product_page_sub_headings_color'] = $this->config->get('module_product_page_sub_headings_color');
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/product_page_setting', $data));
	}

	public function checkout_setting() {
		
		$this->load->language('extension/module/checkout_setting');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('module_checkout', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module/ocUltra_theme_setting/checkout_setting', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/ocUltra_theme_setting/checkout_setting', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/module/ocUltra_theme_setting/checkout_setting', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

		$this->load->model('tool/image');

        if (isset($this->request->post['module_checkout_button_color'])) {
			$data['module_checkout_button_color'] = $this->request->post['module_checkout_button_color'];
		} else {
			$data['module_checkout_button_color'] = $this->config->get('module_checkout_button_color');
		}

		if (isset($this->request->post['module_checkout_button_text_color'])) {
			$data['module_checkout_button_text_color'] = $this->request->post['module_checkout_button_text_color'];
		} else {
			$data['module_checkout_button_text_color'] = $this->config->get('module_checkout_button_text_color');
		}

		if (isset($this->request->post['module_checkout_header_color'])) {
			$data['module_checkout_header_color'] = $this->request->post['module_checkout_header_color'];
		} else {
			$data['module_checkout_header_color'] = $this->config->get('module_checkout_header_color');
		}
		
		if (isset($this->request->post['module_checkout_header_text_color'])) {
			$data['module_checkout_header_text_color'] = $this->request->post['module_checkout_header_text_color'];
		} else {
			$data['module_checkout_header_text_color'] = $this->config->get('module_checkout_header_text_color');
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/checkout_setting', $data));
	}

	public function infinite_scroll() {
		$this->load->language('extension/module/infinite_scroll');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('module_infinite_scroll', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module/ocUltra_theme_setting/infinite_scroll', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/ocUltra_theme_setting/infinite_scroll', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/module/ocUltra_theme_setting/infinite_scroll', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

		if (isset($this->request->post['module_infinite_scroll_status'])) {
			$data['module_infinite_scroll_status'] = $this->request->post['module_infinite_scroll_status'];
		} else {
			$data['module_infinite_scroll_status'] = $this->config->get('module_infinite_scroll_status');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/infinite_scroll', $data));
	}

	public function whatsapp_button() {
		
		$this->load->language('extension/module/whatsapp_button');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('module_whatsapp', $this->request->post);
			

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module/ocUltra_theme_setting/whatsapp_button', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/ocUltra_theme_setting/whatsapp_button', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/module/ocUltra_theme_setting/whatsapp_button', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

		$this->load->model('tool/image');

		if (isset($this->request->post['module_whatsapp_button_status'])) {
			$data['module_whatsapp_button_status'] = $this->request->post['module_whatsapp_button_status'];
		} else {
			$data['module_whatsapp_button_status'] = $this->config->get('module_whatsapp_button_status');
		}

		if (isset($this->request->post['module_whatsapp_number'])) {
			$data['module_whatsapp_number'] = $this->request->post['module_whatsapp_number'];
		} else {
			$data['module_whatsapp_number'] = $this->config->get('module_whatsapp_number');
		}

		if (isset($this->request->post['module_whatsapp_message'])) {
			$data['module_whatsapp_message'] = $this->request->post['module_whatsapp_message'];
		} else {
			$data['module_whatsapp_message'] = $this->config->get('module_whatsapp_message');
		}

		if (isset($this->request->post['module_whatsapp_button_color'])) {
			$data['module_whatsapp_button_color'] = $this->request->post['module_whatsapp_button_color'];
		} else {
			$data['module_whatsapp_button_color'] = $this->config->get('module_whatsapp_button_color');
		}

		if (isset($this->request->post['module_whatsapp_button_text_color'])) {
			$data['module_whatsapp_button_text_color'] = $this->request->post['module_whatsapp_button_text_color'];
		} else {
			$data['module_whatsapp_button_text_color'] = $this->config->get('module_whatsapp_button_text_color');
		}

		if (isset($this->request->post['module_whatsapp_button_text'])) {
			$data['module_whatsapp_button_text'] = $this->request->post['module_whatsapp_button_text'];
		} else {
			$data['module_whatsapp_button_text'] = $this->config->get('module_whatsapp_button_text');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/whatsapp_button', $data));
	}

	public function newsletter() {
		
		$this->install();
		$this->load->language('extension/module/newsletter');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('module_newsletter', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module/ocUltra_theme_setting/newsletter', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/ocUltra_theme_setting/newsletter', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/module/ocUltra_theme_setting/newsletter', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

		if (isset($this->request->post['module_newsletter_status'])) {
			$data['module_newsletter_status'] = $this->request->post['module_newsletter_status'];
		} else {
			$data['module_newsletter_status'] = $this->config->get('module_newsletter_status');
		}

		if (isset($this->request->post['module_newsletter_text'])) {
			$data['module_newsletter_text'] = $this->request->post['module_newsletter_text'];
		} else {
			$data['module_newsletter_text'] = $this->config->get('module_newsletter_text');
		}

		if (isset($this->request->post['module_newsletter_text_color'])) {
			$data['module_newsletter_text_color'] = $this->request->post['module_newsletter_text_color'];
		} else {
			$data['module_newsletter_text_color'] = $this->config->get('module_newsletter_text_color');
		}

		if (isset($this->request->post['module_newsletter_button_color'])) {
			$data['module_newsletter_button_color'] = $this->request->post['module_newsletter_button_color'];
		} else {
			$data['module_newsletter_button_color'] = $this->config->get('module_newsletter_button_color');
		}

		if (isset($this->request->post['module_newsletter_image'])) {
			$data['module_newsletter_image'] = $this->request->post['module_newsletter_image'];
		} else {
			$data['module_newsletter_image'] = $this->config->get('module_newsletter_image');
		}

		$this->load->model('tool/image');
		
		if (isset($this->request->post['module_newsletter_image']) && is_file(DIR_IMAGE . $this->request->post['module_newsletter_image'])) {
			$data['newsletter_image'] = $this->model_tool_image->resize($this->request->post['module_newsletter_image'], 100, 100);
		} elseif (!empty($this->config->get('module_newsletter_image')) && is_file(DIR_IMAGE . $this->config->get('module_newsletter_image'))) {
			$data['newsletter_image'] = $this->model_tool_image->resize($this->config->get('module_newsletter_image'), 100, 100);
		} else {
			$data['newsletter_image'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		// get newsletter button
		$data['newsletters'] = array();

		$results = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "newsletter")->rows;

		foreach ($results as $result) {
			$data['newsletters'][] = array(
				'email' => $result['email'],
				'date_added'     => $result['date_added'],
				'newsletter_id' => $result['newsletter_id']
			);
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/newsletter', $data));
	}

	public function custom_css_javascript() {
		
		$this->load->language('extension/module/custom_css_javascript');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->request->post['module_custom_javascript'] = htmlspecialchars_decode($this->request->post['module_custom_javascript']);
			$this->request->post['module_custom_css'] = htmlspecialchars_decode($this->request->post['module_custom_css']);
			$this->model_setting_setting->editSetting('module_custom', $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module/ocUltra_theme_setting/custom_css_javascript', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/ocUltra_theme_setting/custom_css_javascript', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/module/ocUltra_theme_setting/custom_css_javascript', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

		$this->load->model('tool/image');

		if (isset($this->request->post['module_custom_status'])) {
			$data['module_custom_status'] = $this->request->post['module_custom_status'];
		} else {
			$data['module_custom_status'] = $this->config->get('module_custom_status');
		}

		if (isset($this->request->post['module_custom_css'])) {
			$data['module_custom_css'] = $this->request->post['module_custom_css'];
		} else {
			$data['module_custom_css'] = $this->config->get('module_custom_css');
		}

		if (isset($this->request->post['module_custom_javascript'])) {
			$data['module_custom_javascript'] = $this->request->post['module_custom_javascript'];
		} else {
			$data['module_custom_javascript'] = $this->config->get('module_custom_javascript');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/custom_css_javascript', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/ocUltra_theme_setting')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}