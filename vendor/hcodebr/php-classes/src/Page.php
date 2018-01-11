<?php
	namespace Hcode;
	use Rain\Tpl;
	/**
	* 
	*/
	class Page 
	{
		private $tpl;
		private $options = [];
		private $defaults = [
			"data"=>[]
		];

		private function setData($data = array()){
			foreach ($data as $key => $value) {
				$this->tpl->assign($key, $value);
			}

		}

		function __construct($opts = array(), $tpl_dir = "/views/")
		{
			$this->options = array_merge($this->defaults, $opts);
			$config = array(
				"tpl_dir"   => $_SERVER["DOCUMENT_ROOT"] . $tpl_dir,
				"cache_dir" => $_SERVER["DOCUMENT_ROOT"] . "/views-cache/",
				"debug"     => false // set to false to improve the speed
			);

			Tpl::configure( $config );

			$this->tpl = new Tpl;

			$this->setData($this->options["data"]);

			$this->tpl->draw("header");
		}

		public function setTpl($name, $data = array(), $returnHTML = false)
		{
			$this->setData($data);
			$this->tpl->draw($name, $returnHTML);	
		}

		function __destruct()
		{
			$this->tpl->draw("footer");
		}

	}
?>