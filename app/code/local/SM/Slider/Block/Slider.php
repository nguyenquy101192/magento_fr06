<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_Slider_Block_Slider extends Mage_Core_Block_Template
    implements Mage_Widget_Block_Interface
{
    protected function _toHtml()
    {
        return parent::_toHtml();
    }

    protected $_html = '';


    /*
     *
     *  get slider to view frontend
     *
     * */
    public function getSlider()
    {
        $slider = Mage::getModel('slider/slider')
            ->getCollection()
            ->addFieldToSelect('slider_id')
            ->addFieldToFilter('slider_status', 1)
            ->getData();
        $sliderId = array();
        foreach ($slider as $item) {
            $sliderId[] = $item['slider_id'];
        }

        $listImg = Mage::getModel('slider/image')
            ->getCollection()
            ->addFieldToFilter('image_status', 1)
            ->addFieldToFilter('slider_id', array('in' => $sliderId))
            ->getData();
        foreach ($listImg as $img) {
            $this->_html .= "<img alt='" . $img['image_name'] . "'
                                  src='" . Mage::getBaseUrl('media') . $img['image_link'] . "'/>";
        }
        return $this->_html;
    }


    /*
     *
     *  get caption image
     *
     * */
    public function getCaption()
    {
        $html = '';
        $slider = Mage::getModel('slider/slider')
            ->getCollection()
            ->addFieldToSelect('slider_id')
            ->addFieldToFilter('slider_status', 1)
            ->getData();
        $sliderId = array();
        foreach ($slider as $item) {
            $sliderId[] = $item['slider_id'];
        }

        $listCaptions = Mage::getModel('slider/image')
            ->getCollection()
            ->addFieldToFilter('slider_id', array('in' => $sliderId))
            ->getData();
        foreach ($listCaptions as $tilte) {
            $html .= "<div class='caption-title'><span>" . $tilte['image_caption'] . "</span></div>";
        }
        return $html;
    }


    /*
     * Get effect for slideshow
     */
    public function getWidth()
    {
        $width = Mage::getStoreConfig('slider/size/width');
        return $width;
    }

    public function getHeight()
    {
        $height = Mage::getStoreConfig('slider/size/height');
        return $height;
    }

    public function getTimeInterval()
    {
        $time = Mage::getStoreConfig('slider/config/time');
        return $time;
    }

    public function getEffect()
    {
        $effect = Mage::getStoreConfig('slider/config/effect');
        return $effect;
    }

    public function getAuto()
    {
        $auto = Mage::getStoreConfig('slider/config/auto');
        return $auto;
    }
}
 