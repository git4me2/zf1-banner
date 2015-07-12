<?php

class BannerController extends Zend_Controller_Action
{

    public function init()
    {
        if ($this->_request->isXmlHttpRequest())
        {
            $this->_helper->layout()->disableLayout();
            $this->getHelper('viewRenderer')->setNoRender();
        }

        $this->view->actionName = $this->_request->getActionName();
        $this->view->controllerName = $this->_request->getControllerName();

        $this->_flashMessenger	= $this->_helper->getHelper('FlashMessenger');

        if ( Zend_Auth::getInstance()->hasIdentity() ) {
            $this->_logedUserId = Zend_Auth::getInstance()->getStorage()->read()->iduser;
            $this->_logedUserRole = Zend_Auth::getInstance()->getStorage()->read()->role;
        }

    }

    public function indexAction()
    {
        $this->view->banners = Model_ORM_BannerTable::getAll();
    }

    public function createAction()
    {
        $createBannerForm = new Application_Form_Banner();
        $this->view->createBannerForm = $createBannerForm;

        if ($this->_request->isPost() ) {

           $this->storeAction();
        }

    }

    public function editAction()
    {
        $editBannerForm = new Application_Form_Banner();


    }

    public function storeAction()
    {
        $this->_helper->layout()->disableLayout();
        $this->getHelper('viewRenderer')->setNoRender();

        $params = $this->_request->getParams();
        $params['content'] = json_encode($params['content']);
        $params['creator'] = $this->_logedUserId;
        $params['created_at'] =  date('Y-m-d H:i:s');

        Model_ORM_BannerTable::store($params);
        $this->redirect('banner');
    }

    public function deleteAction()
    {
        $this->_helper->layout()->disableLayout();
        $this->getHelper('viewRenderer')->setNoRender();

        $id = $this->_request->getParam('id',null);

        if (null != $id) {
            Model_ORM_BannerTable::getInstance()->find($id)->delete();
        }
        $this->redirect('banner');
    }

}

