<?php

/*
* Create by PhpStorm.
* User: quynh.
* Unit Department: Fresher06.
*/

class SM_MegaMenu_Block_Menu extends Mage_Core_Block_Template
{
    protected $_html = '';

    protected $_level = array();

    /*
     *
     *  Build category
     *
     * */
    public function getMenu()
    {
        $this->_html .= "<ul>";
        $listMenus = $this->_prepareMenu();
        foreach ($listMenus as $items) {
            if ($items['parent_id'] == 0) {
                $this->_html .= "<li><a href='" . Mage::getUrl($items['menu_url']) . "'><span>" . strtoupper($items['menu_name']) . "</span></a>";

                // Print menu level 1.
                if ($this->_hasChild($items['menu_id'], $listMenus)) {
                    $this->_html .= "<ul class='submenu one_col'>";

                    $this->_getChildMenu($items['menu_id'], $listMenus);

                    $this->_html .= "</ul>";
                } else {
                    // Print menu has type = category link and is built by flat
                    if ($items['menu_type'] == 2) {
                        $listItems = explode(",", $items['menu_type_item']);
                        $this->_html .= "<ul class='submenu one_col'>";
                        $this->_html .= "<div class='category-link'>";
                        $listCategories = $this->_getCategoryLinkFlat($listItems);
                        foreach ($listCategories as $categories) {
                            $this->_html .= "<li><a href='" . Mage::getUrl($categories['url']) . "'>" . strtoupper($categories['name']) . "</a></li>";
                        }
                        $this->_html .= "</div></ul>";
                    }

                    // Print menu has type = block link
                    if ($items['menu_type'] == 3) {
                        $this->_html .= "<ul class='submenu'>";
                        $this->_html .= "<li><div class='block-link'>";

                        $this->_html .= $this->getLayout()->createBlock('cms/block')->setBlockId($this->_getBlockLink($items['menu_type_item']))->toHtml();

                        $this->_html .= "</div></li></ul>";
                    }

                    // Print menu has type = category link and is built by tree
                    if ($items['menu_type'] == 4) {
                        $listItems = explode(",", $items['menu_type_item']);
                        $listMenu = $this->_getAllCategoryLink();
                        $this->_html .= "<ul class='submenu one_col'>";
                        $listCategoriesByTree = $this->_getCategoryLinkTree($listItems);
                        foreach ($listCategoriesByTree as $categoriesByTree) {
                            if ($this->_hasChild($categoriesByTree['id'], $listMenu)) {
                                $this->_html .= "<li><a href='" . Mage::getUrl($categoriesByTree['url']) . "'><span>" . strtoupper($categoriesByTree['name']) . "</span></a>";
                                $this->_html .= "<ul class='submenu one_col'>";
                                $this->_getChildCategoryByTree($categoriesByTree['id'], $listMenu);
                                $this->_html .= "</ul>";
                            }
                        }
                        $this->_html .= "</ul>";
                    }
                }
                $this->_html .= "</li>";
            }
        }
        $this->_html .= "</ul>";
        return $this->_html;
    }


    /*
     *
     *  Get list menu from model.
     *
     */
    protected function _prepareMenu()
    {
        $this->_level = Mage::getStoreConfig('mega_menu/config/level');
        $category = Mage::getModel('menu/menu')
            ->getCollection()
            ->addFieldToSelect('group_id')
            ->addFieldToFilter('group_status', 1)
            ->addFieldToFilter('position', '1')
            ->getData();

        $listMenu = Mage::getModel('menu/items')
            ->getCollection()
            ->addFieldToFilter('group_id', array('in' => $category))
            ->addFieldToFilter('menu_status', 1)
            ->addFieldToFilter('level', array('lteq' => $this->_level))
            ->getData();

        return $listMenu;
    }


    /*
     *
     *  Get menu children
     *
     */
    protected function _getChildMenu($menuId, $listMenus)
    {
        foreach ($listMenus as $item) {
            if ($item['parent_id'] == $menuId) {
                $this->_html .= "<li><a href='" . Mage::getUrl($item['menu_url']) . "'><span>" . strtoupper($item['menu_name']) . "</span></a>";
                if ($this->_hasChild($item['menu_id'], $listMenus)) {
                    $this->_html .= "<ul class='submenu one_col'>";

                    $this->_getChildMenu($item['menu_id'], $listMenus);

                    $this->_html .= "</ul>";
                } else {
                    if ($item['menu_type'] == 2) {
                        $listItems = explode(",", $item['menu_type_item']);
                        $this->_html .= "<ul class='submenu'>";
                        $this->_html .= "<li><div class='category-link'>";
                        $listCategories = $this->_getCategoryLinkFlat($listItems);
                        $count = 1;
                        $this->_html .= "<ul>";
                        foreach ($listCategories as $categories) {
                            $this->_html .= "<li><a href='" . Mage::getUrl($categories['url']) . "'>" . $categories['name'] . "</a></li>";
                            $count++;
                        }
                        $this->_html .= "</ul></div></li></ul>";
                    }
                    if ($item['menu_type'] == 3) {
                        $this->_html .= "<ul class='submenu'>";
                        $this->_html .= "<li><div class='block-link'>";

                        $this->_html .= $this->getLayout()->createBlock('cms/block')->setBlockId($this->_getBlockLink($item['menu_type_item']))->toHtml();

                        $this->_html .= "</div></li></ul>";
                    }
                }
            }
            $this->_html .= "</li>";
        }
        return $this->_html;
    }


    /*
     *
     *  Return true if menu has child
     *
     */
    protected function _hasChild($menuId, $listMenu)
    {
        $flag = false;
        foreach ($listMenu as $item) {
            if ($item['parent_id'] == $menuId) {
                $flag = true;
            }
        }
        return $flag;
    }


    /*
     *
     *  Get block link
     *
     */
    protected function _getBlockLink($item)
    {
        $listBlock = Mage::getResourceModel('cms/block_collection')
            ->addFieldToFilter('block_id', $item)
            ->getData();
        return $listBlock[0]['identifier'];
    }


    /*
     *
     *  Get menu item is built by flat
     *
     */
    protected function _getCategoryLinkFlat($item)
    {
        $storeId = Mage::app()->getStore()->getId();
        if ($this->_level < 0) {
            $this->_level = array();
        }
        $listItems = Mage::getModel('catalog/category')->getCollection()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('is_active', '1')
            ->addAttributeToFilter('include_in_menu', '1')
            ->setStoreId($storeId)
            ->addAttributeToFilter('entity_id', array('in' => $item))
            ->addAttributeToFilter('level', array('lteq' => $this->_level))
            ->addUrlRewriteToResult()
            ->load();
        $data = array();
        foreach ($listItems as $value) {
            $data[] = array(
                'id' => $value->getID(),
                'name' => $value->getName(),
                'url' => $value->getUrlPath(),
            );
        }
        return $data;
    }


    /*
     *
     *  Get menu item is built by tree
     *
     */
    protected function _getCategoryLinkTree($item)
    {
        $storeId = Mage::app()->getStore()->getId();
        if ($this->_level < 0) {
            $this->_level = array();
        }
        $listItems = Mage::getModel('catalog/category')->getCollection()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('is_active', '1')
            ->addAttributeToFilter('include_in_menu', '1')
            ->setStoreId($storeId)
            ->addAttributeToFilter('entity_id', array('in' => $item))
            ->addAttributeToFilter('level', array('lteq' => $this->_level))
            ->load();
        $data = array();
        foreach ($listItems as $value) {
            $data[] = array(
                'id' => $value->getID(),
                'name' => $value->getName(),
                'url' => $value->getUrlPath(),
            );
        }

        return $data;
    }

    protected function _getChildCategoryByTree($parentId, $listCategories)
    {
        foreach ($listCategories as $item) {
            if ($item['parent_id'] == $parentId) {
                $this->_html .= "<li><a href='" . Mage::getUrl($item['url']) . "'><span>" . strtoupper($item['name']) . "</span></a>";
                if ($this->_hasChild($item['id'], $listCategories)) {
                    $this->_html .= "<ul class='submenu one_col'>";

                    $this->_getChildCategoryByTree($item['id'], $listCategories);

                    $this->_html .= "</ul>";
                }
            }
            $this->_html .= "</li>";
        }
        return $this->_html;
    }


    /*
     *
     *  Get all menu item
     *
     */
    protected function _getAllCategoryLink()
    {
        $storeId = Mage::app()->getStore()->getId();
        if ($this->_level < 0) {
            $this->_level = array();
        }
        $listItems = Mage::getModel('catalog/category')->getCollection()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('is_active', '1')
            ->addAttributeToFilter('include_in_menu', '1')
            ->setStoreId($storeId)
            ->addAttributeToFilter('level', array('lteq' => $this->_level))
            ->load();
        $data = array();
        foreach ($listItems as $value) {
            $data[] = array(
                'id' => $value->getID(),
                'name' => $value->getName(),
                'url' => $value->getUrlPath(),
                'parent_id' => $value->getParentId(),
            );
        }
        return $data;
    }


    /*
     *
     *  Get rewrite url of menu item
     *
     */
    public function _getUrlCategory($item)
    {
        $data = Mage::getModel('catalog/category')
            ->getCollection()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('is_active', '1')
            ->addAttributeToFilter('include_in_menu', '1')
            ->addAttributeToFilter('entity_id', $item)
            ->addAttributeToSort('position', 'asc')
            ->addUrlRewriteToResult();
        return $data;
    }
}
 