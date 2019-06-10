<?php

namespace TemplateMonster\Megamenu\Block\Html\Topmenu\Block\Row\Column;

class Category extends Entity
{
    protected $_template = 'html/topmenu/block/row/column/category.phtml';

    public function getCategory()
    {
        return $this->getEntity()->getCategory();
    }

    public function getImage($node)
    {
        $url = "";
        if ($image = $node->getMmImage()) {
            if ($image) {
                $url = $this->_storeManager->getStore()->getBaseUrl(
                        \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
                    ) . 'catalog/category/' . $image;
            }
        }
        return $url;
    }

}