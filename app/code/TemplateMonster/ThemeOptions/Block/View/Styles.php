<?php

namespace TemplateMonster\ThemeOptions\Block\View;

use Magento\Framework\View\Element\Template;
use TemplateMonster\ThemeOptions\Helper\Data as OptionsHelper;

/**
 * Theme options styles block.
 *
 * @package TemplateMonster\ThemeOptions\Block\View
 */
class Styles extends Template
{
    /**
     * @var OptionsHelper
     */
    protected $_optionsHelper;

    /**
     * Styles constructor.
     *
     * @param OptionsHelper    $optionsHelper
     * @param Template\Context $context
     * @param array            $data
     */
    public function __construct(
        OptionsHelper $optionsHelper,
        Template\Context $context,
        array $data
    )
    {
        $this->_optionsHelper = $optionsHelper;
        parent::__construct($context, $data);
    }

    /**
     * Get product item width.
     *
     * @param int $itemsCount
     * @return string
     */
    public function getProductItemWidth($itemsCount)
    {
        return 100 / $itemsCount . '%';
    }

}