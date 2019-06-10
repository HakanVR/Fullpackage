<?php

namespace TemplateMonster\NewsletterPopup\Helper;

use Magento\Framework\App\Config\DataFactory as ConfigDataFactory;
use Magento\Framework\App\Config\Initial as InitialConfig;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

/**
 * Data helper
 *
 * @package TemplateMonster\NewsletterPopup\Helper
 */
class Data extends AbstractHelper
{
    /**
     * Enabled config option.
     */
    const XML_PATH_ENABLED = 'newsletter_popup/general/enabled';

    /**
     * Show on startup config option.
     */
    const XML_PATH_SHOW_ON_STARTUP = 'newsletter_popup/general/show_on_startup';

    /**
     * Show on footer config option.
     */
    const XML_PATH_SHOW_ON_FOOTER = 'newsletter_popup/general/show_on_footer';

    /**
     * Pop-up width.
     */
    const XML_PATH_POPUP_WIDTH = 'newsletter_popup/general/popup_width';

    /**
     * Show footer link config option.
     */
    const XML_PATH_SHOW_FOOTER_LINK = 'newsletter_popup/general/show_footer_link';

    /**
     * Footer link text config option.
     */
    const XML_PATH_FOOTER_LINK_TEXT = 'newsletter_popup/general/footer_link_text';

    /**
     * Pop-up timeout config option.
     */
    const XML_PATH_POPUP_TIMEOUT = 'newsletter_popup/general/popup_timeout';

    /**
     * Button color config option.
     */
    const XML_PATH_BUTTON_COLOR = 'newsletter_popup/general/button_color';

    /**
     * Button hover color config option.
     */
    const XML_PATH_BUTTON_HOVER_COLOR = 'newsletter_popup/general/button_hover_color';

    /**
     * Custom CSS class config option.
     */
    const XML_PATH_CUSTOM_CSS_CLASS = 'newsletter_popup/general/custom_css_class';

    /**
     * Use default colors config option.
     */
    const XML_PATH_USE_DEFAULT_COLORS = 'newsletter_popup/social/general/use_default_icon_colors';

    /**
     * Enable icon config option.
     */
    const XML_PATH_ENABLE_ICON = 'newsletter_popup/social/general/enable_%s_icon';

    /**
     * Icon link config option.
     */
    const XML_PATH_ICON_LINK = 'newsletter_popup/social/%s_settings/link';

    /**
     * Icon background config option.
     */
    const XML_PATH_ICON_BACKGROUND = 'newsletter_popup/social/%s_settings/icon_background';

    /**
     * Icon color config option.
     */
    const XML_PATH_ICON_COLOR = 'newsletter_popup/social/%s_settings/icon_color';

    /**
     * Icon background hover config option.
     */
    const XML_PATH_ICON_BACKGROUND_HOVER = 'newsletter_popup/social/%s_settings/icon_background_hover';

    /**
     * Icon hover color config option.
     */
    const XML_PATH_ICON_HOVER_COLOR = 'newsletter_popup/social/%s_settings/icon_hover_color';

    /**
     * Supported icon types
     *
     * @var array
     */
    protected static $supportedIconTypes = array(
        'facebook',
        'twitter',
        'linkedin',
        'google',
        'youtube',
        'vimeo',
        'pinterest',
        'instagram',
        'foursquare',
        'tumblr',
        'rss'
    );

    /**
     * @var InitialConfig
     */
    protected $initialConfig;

    /**
     * @var ConfigDataFactory
     */
    protected $configDataFactory;

    /**
     * @var null|\Magento\Framework\App\Config\Data
     */
    protected $initialConfigData = null;

    /**
     * Data constructor.
     *
     * @param InitialConfig     $initialConfig
     * @param ConfigDataFactory $configDataFactory
     * @param Context           $context
     */
    public function __construct(
        InitialConfig $initialConfig,
        ConfigDataFactory $configDataFactory,
        Context $context
    )
    {
        $this->initialConfig = $initialConfig;
        $this->configDataFactory = $configDataFactory;
        parent::__construct($context);
    }

    /**
     * Check is enabled.
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_ENABLED,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Check is show on startup.
     *
     * @return bool
     */
    public function isShowOnStartup()
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_SHOW_ON_STARTUP,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Check is show on footer.
     *
     * @return bool
     */
    public function isShowOnFooter()
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_SHOW_ON_FOOTER,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get pop-up width in pixels
     *
     * @return int
     */
    public function getPopupWidth()
    {
        return (int) $this->scopeConfig->getValue(
            self::XML_PATH_POPUP_WIDTH,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Check is show footer link.
     *
     * @return bool
     */
    public function isShowFooterLink()
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_SHOW_FOOTER_LINK,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get footer link text.
     *
     * @return string
     */
    public function getFooterLinkText()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_FOOTER_LINK_TEXT,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get pop-up timeout in seconds.
     *
     * @return int
     */
    public function getPopupTimeout()
    {
        return (int) $this->scopeConfig->getValue(
            self::XML_PATH_POPUP_TIMEOUT,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get button color in hex format.
     *
     * @return string
     */
    public function getButtonColor()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_BUTTON_COLOR,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get button hover color in hex format.
     *
     * @return string
     */
    public function getButtonHoverColor()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_BUTTON_HOVER_COLOR,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get custom CSS class.
     *
     * @return string
     */
    public function getCustomCssClass()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_CUSTOM_CSS_CLASS,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Check if use default icon colors.
     *
     * @return bool
     */
    public function isUseDefaultIconColors()
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_USE_DEFAULT_COLORS,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Check if specified icon is enabled.
     *
     * @param string $iconType
     *
     * @return bool
     */
    public function isIconEnabled($iconType)
    {
        $this->checkIconType($iconType);

        return $this->scopeConfig->isSetFlag(
            sprintf(self::XML_PATH_ENABLE_ICON, $iconType),
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get icon link.
     *
     * @param string $iconType
     *
     * @return string
     */
    public function getIconLink($iconType)
    {
        $this->checkIconType($iconType);

        return $this->scopeConfig->getValue(
            sprintf(self::XML_PATH_ICON_LINK, $iconType),
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get icon background color in hex format.
     *
     * @param string $iconType
     *
     * @return string
     */
    public function getIconBackground($iconType)
    {
        $this->checkIconType($iconType);

        return $this->getConfigValue(sprintf(self::XML_PATH_ICON_BACKGROUND, $iconType));
    }

    /**
     * Get icon color in hex format.
     *
     * @param string $iconType
     *
     * @return string
     */
    public function getIconColor($iconType)
    {
        $this->checkIconType($iconType);

        return $this->getConfigValue(sprintf(self::XML_PATH_ICON_COLOR, $iconType));
    }

    /**
     * Get icon background hover color in hex format.
     *
     * @param string $iconType
     *
     * @return string
     */
    public function getIconBackgroundHover($iconType)
    {
        $this->checkIconType($iconType);

        return $this->getConfigValue(sprintf(self::XML_PATH_ICON_BACKGROUND_HOVER, $iconType));
    }

    /**
     * Get icon hover color in hex format.
     *
     * @param string $iconType
     *
     * @return string
     */
    public function getIconHoverColor($iconType)
    {
        $this->checkIconType($iconType);

        return $this->getConfigValue(sprintf(self::XML_PATH_ICON_HOVER_COLOR, $iconType));
    }

    /**
     * Get supported icon types.
     *
     * @return array
     */
    public static function getSupportedIconTypes()
    {
        return self::$supportedIconTypes;
    }

    /**
     * Get available icons.
     *
     * @return array
     */
    public function getAvailableIcons()
    {
        $icons = array();
        foreach (self::$supportedIconTypes as $iconType) {
            if ($this->isIconEnabled($iconType)) {
                $icons[] = $iconType;
            }
        }

        return $icons;
    }

    /**
     * Check if icon type supported.
     *
     * @param string $type
     * @return void
     * @throws \InvalidArgumentException
     */
    protected function checkIconType($type)
    {
        if (!in_array($type, self::$supportedIconTypes)) {
            throw new \InvalidArgumentException(sprintf('Invalid icon type "%s" provided.', $type));
        }
    }

    /**
     * Get initial config data.
     *
     * @return \Magento\Framework\App\Config\Data|\Magento\Framework\App\Config\DataInterface|null
     */
    protected function getInitialConfigData()
    {
        if (null === $this->initialConfigData) {
            $data = $this->initialConfig->getData(ScopeConfigInterface::SCOPE_TYPE_DEFAULT);
            $this->initialConfigData = $this->configDataFactory->create([
                'data' => $data
            ]);
        }

        return $this->initialConfigData;
    }

    /**
     * Get config value.
     *
     * @param string $path
     *
     * @return array|mixed|null
     */
    protected function getConfigValue($path)
    {
        if ($this->isUseDefaultIconColors()) {
            return $this->getInitialConfigData()->getValue($path);
        }

        return $this->scopeConfig->getValue($path, ScopeInterface::SCOPE_STORE);
    }
}