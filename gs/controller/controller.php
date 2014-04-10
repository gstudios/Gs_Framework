<?php

/**
 * Description of Controller
 *
 * @author galbanie <galbanie at setrukmarcroger@gmail.com>
 */

class Controller {

	protected $_model = null;
	protected $_layout = null;

	public function getModel(){
		return $this->_model;
	}

	public function getLayout(){
		return $this->_layout;
	}
}