<?php

namespace TemplateMonster\ThemeOptions\Block;

use TemplateMonster\ThemeOptions\Helper\Data as ThemeOptionsHelper;
use Magento\Framework\View\Element\Template;

/**
 * SocialLinks block.
 *
 * @package TemplateMonster\ThemeOptions\Block
 */
class SocialLinks extends Template
{
    /**
     * @var string
     */
    protected $_template = 'social_links.phtml';

    /**
     * @var array
     */
    protected $_positions = ['header', 'footer'];

    /**
     * @var ThemeOptionsHelper
     */
    protected $_helper;

    /**
     * SocialLinks constructor.
     *
     * @param ThemeOptionsHelper $helper
     * @param Template\Context   $context
     * @param array              $data
     */
    public function __construct(
        ThemeOptionsHelper $helper,
        Template\Context $context,
        array $data
    )
    {
        $this->_helper = $helper;
        parent::__construct($context, $data);
    }

    /**
     * Set block position.
     *
     * @param string $position
     * @return $this
     */
    public function setPosition($position)
    {
        if (!in_array($position, $this->_positions)) {
            throw new \InvalidArgumentException(sprintf('Invalid position "%s" provided.', $position));
        }
        $this->setData('position', $position);

        return $this;
    }

    /**
     * Get available social links.
     *
     * @return array
     */
    public function getAvailableSocialLinks()
    {
        $links = [];
        foreach ($this->_helper->getSocialLinkTypes() as $linkType) {
            $link = $this->_helper->getSocialLink($linkType);
            if (!empty($link)) {
                $links[$linkType] = $link;
            }
        }

        return $links;
    }

    /**
     * Check if has available links.
     *
     * @return bool
     */
    public function hasAvailableSocialLinks()
    {
        return count($this->getAvailableSocialLinks()) > 0;
    }

    /**
     * Get social link image.
     *
     * @param string $type
     *
     * @return string
     */
    public function getSocialLinkImage($type)
    {
        return $this->getViewFileUrl(sprintf('TemplateMonster_ThemeOptions::images/%s.png', $type));
    }

    /**
     * Get social link url.
     *
     * @param $type
     *
     * @return string
     */
    public function getSocialLinkUrl($type)
    {
        return $this->_helper->getSocialLink($type);
    }

    /**
     * @inheritdoc
     */
    protected function _toHtml()
    {
        if (!$this->hasData('position')) {
            throw new \RuntimeException('Social links position is not specified.');
        }

        $position = $this->getData('position');
        if (!$this->_helper->isShowSocialLinks($position)) {
            return '';
        }

        if (!$this->hasAvailableSocialLinks()) {
            return '';
        }

        return parent::_toHtml();
    }
}