<?php

namespace TemplateMonster\ThemeOptions\Block\Product\ProductList;

use \Magento\Catalog\Block\Product\ProductList\Toolbar;
use \TemplateMonster\ThemeOptions\Helper\Data;

/**
 * Toolbar edit plugin.
 *
 * @package TemplateMonster\ThemeOptions\Block\Product\ProductList
 */
class ToolbarPlugin
{
    /**
     * Config sections.
     *
     * @var helper
     */
    protected $_helper;

    /**
     * Plugin constructor.
     *
     * @param Data $helper
     */
    public function __construct(Data $helper)
    {
        $this->_helper = $helper;
    }

    /**
     * Around available limits for current view mode
     *
     * @param Toolbar $subject
     * @param \Closure $proceed
     *
     * @return array
     */
    public function aroundGetAvailableLimit(Toolbar $subject, \Closure $proceed)
    {
        $platform = $this->_helper->detectPlatform();
        if ($platform != 'desktop') {
            $limitProducts = $this->_helper->getProductsPerPage($platform);
            if ($limitProducts != 0){
                $limitProducts = (array) $limitProducts;
                $limitProducts = array_combine($limitProducts, $limitProducts);
                return $limitProducts;
            }
        }
        return $proceed();
    }

}