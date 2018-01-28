<?php
	
	namespace KhanComponent\Http;
	use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
  use \KhanComponent\Http\Interfaces\Response as ResponseInterface;

	/**
	* Response Class and Interface Implement
	*/

	class Response extends SymfonyResponse implements ResponseInterface{
    
		private static $use = [];
    
		public function __construct($use){
			parent::__construct();
			self::$use = $use;
			
			$folder = (!isset($uses['views'])) ? 'views/' : $uses['views'];
			$loader = new \Twig_Loader_Filesystem($folder);
			$this->twig = new \Twig_Environment($loader, array(
					'cache' => $folder . 'compilation_cache',
			));
			//$this->render = $this->twig->render;
			foreach(self::$use as $key => $value){
				$this->$key = $value;
			}
		}
		
		public function render($file, $data){
			// print_r($this->twig->render);
			echo $this->twig->render($file, $data);
		}/**/
		
		public function send($string = ''){
			echo $string;
		}
    
	}