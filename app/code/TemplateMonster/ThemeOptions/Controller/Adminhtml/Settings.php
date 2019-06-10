<?php

namespace TemplateMonster\ThemeOptions\Controller\Adminhtml;

use Magento\Backend\App\Action;

/**
 * Class Settings
 *
 * @package TemplateMonster\ThemeOptions\Controller\Adminhtml
 */
abstract class Settings extends Action
{
    /**
     * @inheritdoc
     */
    protected function _isAllowed()
    {
        return parent::_isAllowed('TemplateMonster_ThemeOptions::theme_options_config');
    }
}