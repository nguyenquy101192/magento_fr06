<?php

/*
* create by user: quynh.
* unit department: fresher 06.
*/

class SM_ProductLabel_Adminhtml_LabelController extends Mage_Adminhtml_Controller_Action
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

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('label/label')->load($id);

        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register('product_label_data', $model);

            $this->loadLayout();
            $this->_setActiveMenu('product_label/product_label');

            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addContent($this->getLayout()->createBlock('sm_product_label/adminhtml_label_edit'))
                ->_addLeft($this->getLayout()->createBlock('sm_product_label/adminhtml_label_edit_tabs'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('product_label')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {
            $modelGroup = Mage::getModel('label/label');
            $modelGroup->setData($data)
                ->setId($this->getRequest()->getParam('id'));

            //upload image to directory /media/slide/
            if (isset($_FILES['label_link']['name']) and (file_exists($_FILES['label_link']['tmp_name']))) {
                try {
                    $uploader = new Varien_File_Uploader('label_link');
                    $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
                    $uploader->setAllowRenameFiles(false);
                    $uploader->setFilesDispersion(false);
                    $path = Mage::getBaseDir('media') . DS . 'logo' . DS;
                    $uploader->save($path, $_FILES['label_link']['name']);
                } catch (Exception $e) {
                    Mage::getSingleton('adminhtml/session')
                        ->addError(Mage::helper('product_label')->__('Unable upload image'));
                }
            } else {
                if (isset($data['label_link']['delete']) && $data['label_link']['delete'] == 1)
                    $data['label_main'] = '';
                else
                    unset($data['label_link']);
            }


            //save params.
            try {
                if ($modelGroup->getCreatedTime == NULL || $modelGroup->getUpdateTime() == NULL) {
                    $modelGroup->setCreatedTime(now())
                        ->setUpdateTime(now());
                } else {
                    $modelGroup->setUpdateTime(now());
                }
                $modelGroup->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('product_label')->__('Item was successfully saved'));
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
        //Mage::getSingleton('adminhtml/session')->addError(Mage::helper('megamenu')->__('Unable to find item to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model = Mage::getModel('label/label');

                $model->setId($this->getRequest()->getParam('id'))
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

    public function massDeleteAction()
    {
        $label = $this->getRequest()->getParam('product_label');
        if (!is_array($label)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
                foreach ($label as $label) {
                    $web = Mage::getModel('label/label')->load($label);
                    $web->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($label)
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
        $label = $this->getRequest()->getParam('product_label');
        if (!is_array($label)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select item(s)'));
        } else {
            try {
                foreach ($label as $label) {
                    $web = Mage::getSingleton('label/label')
                        ->load($label)
                        ->setStatus($this->getRequest()->getParam('status'))
                        ->setIsMassupdate(true)
                        ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) were successfully updated', count($label))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
}