<?php
class ControllerExtensionModuleSlideshow extends Controller {
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

			$data['slider_taxt']  = $this->config->get('module_slider_text');
			
			$data['slider_taxt_color']  = $this->config->get('module_slider_text_color');
			if(!empty($this->config->get('module_slider_top_image'))){
				$data['slider_top_image'] = $this->model_tool_image->resize($this->config->get('module_slider_top_image'), 250, 250);
			}else{
				$data['slider_top_image'] = $this->model_tool_image->resize('no_image.png', 250, 250);
			}
			
		}

		$data['module'] = $module++;

		return $this->load->view('extension/module/slideshow', $data);
	}
}