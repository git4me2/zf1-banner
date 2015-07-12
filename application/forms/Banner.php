<?php

class Application_Form_Banner extends Application_Form_AppForm
{

    public function _init()
    {
        $this->_setForm();
        $this->_setFormDecorator('banner/formDecorator/banner.phtml');
        $this->_setValues( $this->_user );

        $this->_setName();
        $this->_setUrl();
        $this->_setContent();
        $this->_setStatus();
        $this->_setSubButton();
    }

    protected function _setForm()
    {
        $this->setMethod('post')
             ->setName('bannerForm')
             ->setAttrib('id', 'BannerForm');
    }

    /**
     * banner name
     */
    protected function _setName()
    {
        $lengthVal = array('min' => 10, 'max' => 100);
        $validators[] = new Zend_Validate_StringLength($lengthVal);

        $element = new Zend_Form_Element_Text('name');
        $element->setName('name')
                ->setLabel('Nazwa banera: ')
                ->setRequired(true)
                ->setValidators($validators)
                ->setAttrib('class', 'longInput');

        $this->addElement($element);
    }

    /**
     * banner url
     */
    protected function _setUrl()
    {
        $lengthVal = array('min' => 10, 'max' => 100);
        $validators[] = new Zend_Validate_StringLength($lengthVal);
        // @TODO add filter http:// and working url

        $element = new Zend_Form_Element_Text('url');
        $element->setName('url')
                ->setLabel('Docelowy adres url: ')
                ->setRequired(true)
                ->setValidators($validators)
                ->setAttrib('class', 'longInput');

        $this->addElement($element);
    }

    /**
     * banner status
     */
    protected function _setContent()
    {
        $element = new Zend_Form_Element_Text('content');
        $element->setName('content')
                ->setIsArray(true)
                ->removeDecorator('Label')
                ->removeDecorator('HtmlTag')
                ->removeDecorator('DtDdWrapper')
                ->setAttrib('class', 'longInput');

        $this->addElement( $element );
    }

    /**
     * banner status
     */
    protected function _setStatus()
    {
        $element = new Zend_Form_Element_Checkbox('status');
        $element->setName('status')
                ->removeDecorator('Label')
                ->removeDecorator('HtmlTag')
                ->removeDecorator('DtDdWrapper');

        $this->addElement( $element );
    }


    protected function _setSubButton()
    {
        $subButton = new Zend_Form_Element_Submit('submitButton');
        $subButton->setLabel('Utwórz banner');

        $this->addElement($subButton);
    }
}

