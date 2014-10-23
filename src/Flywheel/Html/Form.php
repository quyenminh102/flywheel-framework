<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nobita
 * Date: 4/25/13
 * Time: 10:07 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Flywheel\Html;

use Flywheel\Factory;
use Flywheel\Html\Form\RadioButton;
use Flywheel\Html\Form\SelectOption;

class Form extends Html {
    public $name = '';
    public $action = '';
    public $method = 'POST';

    public function __construct($name = '', $action = '', $method = 'POST') {
        $this->action = $action;
        $this->method = $method;
        $this->name = $name;
    }

    /**
     * generate beginning form html tag
     */
    public function beginForm() {
        echo "<form name=\"{$this->name}\" action=\"{$this->action}\" method=\"{$this->method}\""
            . $this->_serializeHtmlOption()
        .">";
    }

    public function endForm($csrfProtection = true) {
        $s = '';
        if ($csrfProtection) {
            $s .= '<input type="hidden" name="' .Factory::getRequest()->getCsrfToken() .'" value=1>';
        }
        $s .= '</form>';

        echo $s;
    }

    public function radioButton($name, $checkValue = '', $htmlOptions = array()) {
        return new RadioButton($name, $checkValue, $htmlOptions);
    }

    public function selectOption($name, $selectValues = array(), $htmlOptions = array()) {
        return new SelectOption($name, $selectValues, $htmlOptions);
    }
}