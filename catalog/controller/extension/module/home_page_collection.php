<?php
class ControllerExtensionModuleHomePageCollection extends Controller {
	public function index($setting) {
		static $module = 0;

		$this->load->model('design/banner');
		$this->load->model('tool/image');
		
		$this->document->addStyle('catalog/view/javascript/jquery/swiper/css/swiper.min.css');
		$this->document->addStyle('catalog/view/javascript/jquery/swiper/css/opencart.css');
		$this->document->addScript('catalog/view/javascript/jquery/swiper/js/swiper.jquery.js');

		$data['banners'] = array();

		$results = $this->model_design_banner->getBanner($setting['banner_id']);

		foreach ($results as $result) {
			if (is_file(DIR_IMAGE . $result['image'])) {
				$data['banners'][] = array(
					'title' => $result['title'],
					'link'  => $result['link'],
					'image' => $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height'])
				);
			}
		}

		$data['module'] = $module++;

		$data['heading1'] = $this->config->get('module_home_page_heading1');
		$data['heading1_data'] = $this->config->get('module_home_page_heading1_data');
		$data['heading1_icon'] = $this->config->get('module_home_page_heading1_icon');
		$data['heading2'] = $this->config->get('module_home_page_heading2');
		$data['heading2_data'] = $this->config->get('module_home_page_heading2_data');
		$data['heading2_icon'] = $this->config->get('module_home_page_heading2_icon');
		$data['heading3'] = $this->config->get('module_home_page_heading3');
		$data['heading3_data'] = $this->config->get('module_home_page_heading3_data');
		$data['heading3_icon'] = $this->config->get('module_home_page_heading3_icon');
		$data['icon_color'] = $this->config->get('module_home_page_icon_color');
		$data['headings_color'] = $this->config->get('module_home_page_headings_color');

		return $this->load->view('extension/module/home_page_collection', $data);
	}
}