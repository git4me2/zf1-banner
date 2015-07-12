<?php

abstract class Application_Form_AppForm extends Zend_Form
{
    protected $_valuesArr;
    
    /**
     * 
     * @param array $valuesArr
     */
    public function __construct( $valuesArr = null )
    {
        parent::__construct();
    
        $this->_init();
    
        if ( null != $valuesArr ) {
            $this->_valuesArr = $valuesArr;
            $this->_setValues( $this->_valuesArr );
        }
    }
    
    /**
     * FORM decorator
     */
    protected function _setFormDecorator ($decoratorFile)
    {
        $paramsArr = array('viewScript' => $decoratorFile);
        $decorator = new Zend_Form_Decorator_ViewScript($paramsArr);
        $this->setDecorators( array($decorator) );
    }

    /**
     * Set values from DB
     */
    protected function _setValues ( $dataObj )
    {
    	
        if (null != $dataObj) {
        	
        	$elements = $this->getElements();
            
            foreach ($elements as $element) {

            	$id = $element->getId();
                
                try {
                    if ('Zend_Form_Element_Submit' != $element->getType() &&
                        'Zend_Form_Element_Button' != $element->getType()) {

                        if ( isset( $dataObj["$id"] ) ) {
                            $element->setValue($dataObj["$id"]);
                        }
                    }
                } catch (Exception $e) {
                    echo $e;
                }
            }
            
        }
    }
}

?>