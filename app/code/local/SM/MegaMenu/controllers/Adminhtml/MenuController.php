<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_MegaMenu_Adminhtml_MenuController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function newitemAction()
    {
        $this->_forward('edititem');
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('menu/menu')->load($id);

        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register('menu_data', $model);

            $this->loadLayout();
            $this->_setActiveMenu('menu/items');

            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addContent($this->getLayout()->createBlock('sm_mega_menu/adminhtml_menu_edit'))
                ->_addLeft($this->getLayout()->createBlock('sm_mega_menu/adminhtml_menu_edit_tabs'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('mega_menu')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function edititemAction()
    {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('menu/items')->load($id);

        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register('item_data', $model);

            $this->loadLayout();
            $this->_setActiveMenu('menu/items');

            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addContent($this->getLayout()->createBlock('sm_mega_menu/adminhtml_menu_items_edit'))
                ->_addLeft($this->getLayout()->createBlock('sm_mega_menu/adminhtml_menu_items_edit_tabs'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('mega_menu')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {
            $modelGroup = Mage::getModel('menu/menu');

            $modelGroup->setData($data)
                ->setId($this->getRequest()->getParam('id'));

            try {
                if ($modelGroup->getCreatedTime == NULL || $modelGroup->getUpdateTime() == NULL) {
                    $modelGroup->setCreatedTime(now())
                        ->setUpdateTime(now());
                } else {
                    $modelGroup->setUpdateTime(now());
                }
                $modelGroup->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('mega_menu')->__('Item was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $modelGroup->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        $this->_redirect('*/*/');
    }

    public function saveitemAction()
    {
        if ($data = $this->getRequest()->getPost()) {
            $modelItems = Mage::getModel('menu/items');
            $modelItems->setData($data)
                ->setId($this->getRequest()->getParam('id'));

            try {
                if ($modelItems->getCreatedTime == NULL || $modelItems->getUpdateTime() == NULL) {
                    $modelItems->setCreatedTime(now())
                        ->setUpdateTime(now());
                } else {
                    $modelItems->setUpdateTime(now());
                }
                $modelItems->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('mega_menu')->__('Item was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('group_id')));
                    return;
                }
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edititem', array('id' => $this->getRequest()->getParam('id'),
                        'group_id' => $this->getRequest()->getParam('group_id')
                    )
                );
                return;
            }
        }
        $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('group_id')));
    }

    public function deleteAction()
    {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model = Mage::getModel('menu/menu');
                $items = Mage::getModel('menu/items');

                $model->setId($this->getRequest()->getParam('id'))
                    ->delete();

                $items->setGroupId($this->getRequest()->getParam('id'))
                    ->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function deleteitemAction()
    {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model = Mage::getModel('menu/items');

                $model->setId($this->getRequest()->getParam('id'))
                    ->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('group_id')));
    }

    public function massDeleteAction()
    {
        $webIds = $this->getRequest()->getParam('menu');
        if (!is_array($webIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
                foreach ($webIds as $webId) {
                    $web = Mage::getModel('menu/menu')->load($webId);
                    $web->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($webIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    public function massStatusAction()
    {
        $webIds = $this->getRequest()->getParam('menu');
        if (!is_array($webIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select item(s)'));
        } else {
            try {
                foreach ($webIds as $webId) {
                    $web = Mage::getSingleton('menu/menu')
                        ->load($webId)
                        ->setStatus($this->getRequest()->getParam('status'))
                        ->setIsMassupdate(true)
                        ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) were successfully updated', count($webIds))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
}
 