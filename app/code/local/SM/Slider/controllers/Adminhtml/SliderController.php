<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_Slider_Adminhtml_SliderController extends Mage_Adminhtml_Controller_Action
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
        $model = Mage::getModel('slider/slider')->load($id);

        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register('slider_data', $model);

            $this->loadLayout();
            $this->_setActiveMenu('slider/slider');

            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addContent($this->getLayout()->createBlock('sm_slider/adminhtml_slider_edit'))
                ->_addLeft($this->getLayout()->createBlock('sm_slider/adminhtml_slider_edit_tabs'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('slider')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function newimageAction()
    {
        $this->_forward('editImage');
    }

    public function editimageAction()
    {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('slider/image')->load($id);

        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register('image_data', $model);

            $this->loadLayout();
            $this->_setActiveMenu('slider/image');

            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addContent($this->getLayout()->createBlock('sm_slider/adminhtml_slider_image_edit'))
                ->_addLeft($this->getLayout()->createBlock('sm_slider/adminhtml_slider_image_edit_tabs'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('image')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {
            $modelGroup = Mage::getModel('slider/slider');

            $modelGroup->setData($data)
                ->setId($this->getRequest()->getParam('id'));

            //save param
            try {
                if ($modelGroup->getCreatedTime == NULL || $modelGroup->getUpdateTime() == NULL) {
                    $modelGroup->setCreatedTime(now())
                        ->setUpdateTime(now());
                } else {
                    $modelGroup->setUpdateTime(now());
                }
                $modelGroup->_beforeSave();;
                $modelGroup->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('slider')->__('Item was successfully saved'));
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

    public function saveimageAction()
    {
        if ($data = $this->getRequest()->getPost()) {
            $modelItems = Mage::getModel('slider/image');
            $modelItems->setData($data)
                ->setId($this->getRequest()->getParam('id'));

            //upload image to directory /media/slide/
            if (isset($_FILES['image_link']['name']) and (file_exists($_FILES['image_link']['tmp_name']))) {
                try {
                    $uploader = new Varien_File_Uploader('image_link');
                    $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
                    $uploader->setAllowRenameFiles(false);
                    $uploader->setFilesDispersion(false);
                    $path = Mage::getBaseDir('media') . DS . 'slide' . DS;
                    $uploader->save($path, $_FILES['image_link']['name']);
                } catch (Exception $e) {
                    Mage::getSingleton('adminhtml/session')
                        ->addError(Mage::helper('slider')->__('Unable upload image'));
                }
            } else {

                if (isset($data['image_link']['delete']) && $data['image_link']['delete'] == 1)
                    $data['image_main'] = '';
                else
                    unset($data['image_link']);
            }

            //save params.
            try {
                if ($modelItems->getCreatedTime == NULL || $modelItems->getUpdateTime() == NULL) {
                    $modelItems->setCreatedTime(now())
                        ->setUpdateTime(now());
                } else {
                    $modelItems->setUpdateTime(now());
                }

                $modelItems->_beforeSave();
                $modelItems->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('slider')->__('Item was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/editimage', array('id' => $this->getRequest()->getParam('slider_id')));
                    return;
                }
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id'),
                        'slider_id' => $this->getRequest()->getParam('slider_id')
                    )
                );
                return;
            }
        }
        $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('slider_id')));
    }

    public function deleteAction()
    {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model = Mage::getModel('slider/slider');

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

    public function deleteimageAction()
    {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model = Mage::getModel('slider/image');

                $model->setId($this->getRequest()->getParam('id'))
                    ->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('slider_id')));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('slider_id')));
            }
        }
        $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('slider_id')));
    }

    public function massDeleteAction()
    {
        $webIds = $this->getRequest()->getParam('slider');
        if (!is_array($webIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
                foreach ($webIds as $webId) {
                    $web = Mage::getModel('slider/slider')->load($webId);
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
        $webIds = $this->getRequest()->getParam('slider');
        if (!is_array($webIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select item(s)'));
        } else {
            try {
                foreach ($webIds as $webId) {
                    $web = Mage::getSingleton('slider/slider')
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
 