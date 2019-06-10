<?php

namespace TemplateMonster\ThemeOptions\Helper;

use TemplateMonster\ThemeOptions\Model\MobileDetect;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

/**
 * Data Helper
 *
 * @package TemplateMonster\ThemeOptions\Helper
 */
class Data extends AbstractHelper
{
    /**
     * Theme color config option.
     */
    const XML_PATH_THEME_COLOR = 'theme_options/general/theme_color';

    /**
     * Body background color config option.
     */
    const XML_PATH_BODY_BACKGROUND_COLOR = 'theme_options/general/body_background_color';

    /**
     * Body background image active option.
     */
    const XML_PATH_BODY_BACKGROUND_IMAGE_ACTIVE = 'theme_options/general/body_background_image_active';

    /**
     * Body background image option.
     */
    const XML_PATH_BODY_BACKGROUND_IMAGE = 'theme_options/general/body_background_image';

    /**
     * Body background image position option.
     */
    const XML_PATH_BODY_BACKGROUND_IMAGE_POSITION = 'theme_options/general/body_background_image_position';

    /**
     * Body background image repeat option.
     */
    const XML_PATH_BODY_BACKGROUND_IMAGE_REPEAT = 'theme_options/general/body_background_image_repeat';

    /**
     * Body background image size option.
     */
    const XML_PATH_BODY_BACKGROUND_IMAGE_SIZE = 'theme_options/general/body_background_image_size';

    /**
     * Body background image attachment option.
     */
    const XML_PATH_BODY_BACKGROUND_IMAGE_ATTACHMENT = 'theme_options/general/body_background_image_attachment';

    /**
     * Header background color config option.
     */
    const XML_PATH_HEADER_BACKGROUND_COLOR = 'theme_options/general/header_background_color';

    /**
     * Footer background color config option.
     */
    const XML_PATH_FOOTER_BACKGROUND_COLOR = 'theme_options/general/footer_background_color';

    /**
     * Footer background image active option.
     */
    const XML_PATH_FOOTER_BACKGROUND_IMAGE_ACTIVE = 'theme_options/general/footer_background_image_active';

    /**
     * Footer background image config option.
     */
    const XML_PATH_FOOTER_BACKGROUND_IMAGE = 'theme_options/general/footer_background_image';

    /**
     * Footer background image position option.
     */
    const XML_PATH_FOOTER_BACKGROUND_IMAGE_POSITION = 'theme_options/general/footer_background_image_position';

    /**
     * Footer background image repeat option.
     */
    const XML_PATH_FOOTER_BACKGROUND_IMAGE_REPEAT = 'theme_options/general/footer_background_image_repeat';

    /**
     * Footer background image size option.
     */
    const XML_PATH_FOOTER_BACKGROUND_IMAGE_SIZE = 'theme_options/general/footer_background_image_size';

    /**
     * Footer background image attachment option.
     */
    const XML_PATH_FOOTER_BACKGROUND_IMAGE_ATTACHMENT = 'theme_options/general/footer_background_image_attachment';

    /**
     * Show product label config option.
     */
    const XML_PATH_SHOW_PRODUCT_LABEL = 'theme_options/general/show_product_label';

    /**
     * Top head background color config option.
     */
    const XML_PATH_TOP_HEAD_BACKGROUND_COLOR = 'theme_options/main/top_head_background_color';

    /**
     * Top head background image active option.
     */
    const XML_PATH_TOP_HEAD_BACKGROUND_IMAGE_ACTIVE = 'theme_options/main/top_head_background_image_active';

    /**
     * Top head background image config option.
     */
    const XML_PATH_TOP_HEAD_BACKGROUND_IMAGE = 'theme_options/main/top_head_background_image';

    /**
     * Top head background image position option.
     */
    const XML_PATH_TOP_HEAD_BACKGROUND_IMAGE_POSITION = 'theme_options/main/top_head_background_image_position';

    /**
     * Top head background image repeat option.
     */
    const XML_PATH_TOP_HEAD_BACKGROUND_IMAGE_REPEAT = 'theme_options/main/top_head_background_image_repeat';

    /**
     * Top head background image size option.
     */
    const XML_PATH_TOP_HEAD_BACKGROUND_IMAGE_SIZE = 'theme_options/main/top_head_background_image_size';

    /**
     * Top head background image attachment option.
     */
    const XML_PATH_TOP_HEAD_BACKGROUND_IMAGE_ATTACHMENT = 'theme_options/main/top_head_background_image_attachment';

    /**
     * Block title background color config option.
     */
    const XML_PATH_BLOCK_TITLE_BACKGROUND_COLOR = 'theme_options/main/block_title_background_color';

    /**
     * Block title background image active option.
     */
    const XML_PATH_BLOCK_TITLE_BACKGROUND_IMAGE_ACTIVE = 'theme_options/main/block_title_background_image_active';

    /**
     * Block title background image config option.
     */
    const XML_PATH_BLOCK_TITLE_BACKGROUND_IMAGE = 'theme_options/main/block_title_background_image';

    /**
     * Block title background image position option.
     */
    const XML_PATH_BLOCK_TITLE_BACKGROUND_IMAGE_POSITION = 'theme_options/main/block_title_background_image_position';

    /**
     * Block title background image repeat option.
     */
    const XML_PATH_BLOCK_TITLE_BACKGROUND_IMAGE_REPEAT = 'theme_options/main/block_title_background_image_repeat';

    /**
     * Block title background image size option.
     */
    const XML_PATH_BLOCK_TITLE_BACKGROUND_IMAGE_SIZE = 'theme_options/main/block_title_background_image_size';

    /**
     * Block title background image attachment option.
     */
    const XML_PATH_BLOCK_TITLE_BACKGROUND_IMAGE_ATTACHMENT = 'theme_options/main/block_title_background_image_attachment';

    /**
     * Social links background image config option.
     */
    const XML_PATH_SOCIAL_LINKS_BACKGROUND_IMAGE = 'theme_options/main/social_links_background_image';

    /**
     * Social links background color config option.
     */
    const XML_PATH_SOCIAL_LINKS_BACKGROUND_COLOR = 'theme_options/main/social_links_background_color';

    /**
     * Items per row config option.
     */
    const XML_PATH_ITEMS_PER_ROW = 'theme_options/%s/grid/items_per_row';

    /**
     * Products per page config option.
     */
    const XML_PATH_PRODUCTS_PER_PAGE = 'theme_options/%s/grid/products_per_page';

    /**
     * Product image height config option.
     */
    const XML_PATH_PRODUCT_IMAGE_HEIGHT = 'theme_options/%s/%s/product_image_height';

    /**
     * Product image width config option.
     */
    const XML_PATH_PRODUCT_IMAGE_WIDTH = 'theme_options/%s/%s/product_image_width';

    /**
     * Short description length config option.
     */
    const XML_PATH_SHORT_DESCRIPTION_LENGTH = 'theme_options/%s/list/short_description_length';

    /**
     * Product detail image height config option.
     */
    const XML_PATH_PRODUCT_DETAIL_IMAGE_HEIGHT = 'theme_options/product_details/product_image_height';

    /**
     * Product detail image width config option.
     */
    const XML_PATH_PRODUCT_DETAIL_IMAGE_WIDTH = 'theme_options/product_details/product_image_width';

    /**
     * Product detail show upsell config option.
     */
    const XML_PATH_PRODUCT_DETAIL_SHOW_UPSELL = 'theme_options/product_details/show_upsell';

    /**
     * Product detail upsell limit config option.
     */
    const XML_PATH_PRODUCT_DETAIL_UPSELL_LIMIT = 'theme_options/product_details/upsell_limit';

    /**
     * Product detail upsell image height config option.
     */
    const XML_PATH_PRODUCT_DETAIL_UPSELL_IMAGE_HEIGHT = 'theme_options/product_details/upsell_image_height';

    /**
     * Product detail upsell image width config option.
     */
    const XML_PATH_PRODUCT_DETAIL_UPSELL_IMAGE_WIDTH = 'theme_options/product_details/upsell_image_width';

    /**
     * Show social links config option.
     */
    const XML_PATH_SHOW_SOCIAL_LINKS = 'theme_options/social_links/%s_social_links';

    /**
     * Social link config option.
     */
    const XML_PATH_SOCIAL_LINK = 'theme_options/social_links/%s_link';
	
	/**
     * Swatch enable config option.
     */
    const XML_PATH_SWATCH_GRID = 'theme_options/swatch_visibility/grid_swatch_visibility';
	const XML_PATH_SWATCH_LIST = 'theme_options/swatch_visibility/list_swatch_visibility';

    /**
     * Supported platform types.
     *
     * @var array
     */
    protected static $supportedPlatformTypes = array(
        'desktop', 'tablet', 'mobile'
    );

    protected static $supportedOrientationTypes = array(
        'portrait', 'landscape', NULL
    );

    /**
     * Supported view types.
     *
     * @var array
     */
    protected static $supportedViewTypes = array(
        'grid', 'list'
    );

    /**
     * Supported social link types.
     *
     * @var array
     */
    protected static $supportedSocialLinkTypes = array(
        'rss', 'facebook', 'twitter', 'google', 'instagram', 'linkedin', 'dribble', 'youtube'
    );

    /**
     * @var Mobile Detector
     */
    public $_mobileDetector;

    /**
     * Data constructor.
     *
     * @param MobileDetect $mobileDetect
     * @param Context      $context
     */
    public function __construct(
        MobileDetect $mobileDetect,
        Context $context
    )
    {
       $this->_mobileDetector = $mobileDetect;
        parent::__construct($context);
    }

    /**
     * Check platform.
     *
     * @return string
     */
    public function detectPlatform()
    {
        $deviceType = 'desktop';
        if ($this->_mobileDetector->isMobile()) {
            if ($this->_mobileDetector->isTablet()) {
                $deviceType = 'tablet';
            } else {
                $deviceType = 'mobile';
            }
        }
        return $deviceType;

    }

    /**
     * Get theme color.
     *
     * @return string
     */
    public function getThemeColor()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_THEME_COLOR,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get body background color.
     *
     * @return string
     */
    public function getBodyBackgroundColor()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_BODY_BACKGROUND_COLOR,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Check is enable body background image.
     *
     * @return bool
     */
    public function isBodyBackgroundImage()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_BODY_BACKGROUND_IMAGE_ACTIVE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get body background image.
     *
     * @return string
     */
    public function getBodyBackgroundImage()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_BODY_BACKGROUND_IMAGE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get body background image position.
     *
     * @return string
     */
    public function getBodyBackgroundImagePosition()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_BODY_BACKGROUND_IMAGE_POSITION,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get body background image repeat.
     *
     * @return string
     */
    public function getBodyBackgroundImageRepeat()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_BODY_BACKGROUND_IMAGE_REPEAT,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get body background image size.
     *
     * @return string
     */
    public function getBodyBackgroundImageSize()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_BODY_BACKGROUND_IMAGE_SIZE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get body background image attachment.
     *
     * @return string
     */
    public function getBodyBackgroundImageAttachment()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_BODY_BACKGROUND_IMAGE_ATTACHMENT,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get header background color.
     *
     * @return string
     */
    public function getHeaderBackgroundColor()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_HEADER_BACKGROUND_COLOR,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get footer background color.
     *
     * @return string
     */
    public function getFooterBackgroundColor()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_FOOTER_BACKGROUND_COLOR,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Check is enable footer background image.
     *
     * @return bool
     */
    public function isFooterBackgroundImage()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_FOOTER_BACKGROUND_IMAGE_ACTIVE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get footer background image.
     *
     * @return string
     */
    public function getFooterBackgroundImage()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_FOOTER_BACKGROUND_IMAGE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get footer background image position.
     *
     * @return string
     */
    public function getFooterBackgroundImagePosition()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_FOOTER_BACKGROUND_IMAGE_POSITION,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get footer background image repeat.
     *
     * @return string
     */
    public function getFooterBackgroundImageRepeat()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_FOOTER_BACKGROUND_IMAGE_REPEAT,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get footer background image size.
     *
     * @return string
     */
    public function getFooterBackgroundImageSize()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_FOOTER_BACKGROUND_IMAGE_SIZE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get footer background image attachment.
     *
     * @return string
     */
    public function getFooterBackgroundImageAttachment()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_FOOTER_BACKGROUND_IMAGE_ATTACHMENT,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Check is show product label.
     *
     * @return bool
     */
    public function isShowProductLabel()
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_SHOW_PRODUCT_LABEL,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get items per row.
     *
     * @param string $platformType
     * @param null|string $orientationType
     *
     * @throws \InvalidArgumentException
     *
     * @return int
     */
    public function getItemsPerRow($platformType, $orientationType = null)
    {
        $this->checkPlatformType($platformType);
        $this->checkOrientationType($orientationType);

        $xpath = sprintf(self::XML_PATH_ITEMS_PER_ROW, $platformType);
        if (null !== $orientationType) {
            $xpath .= "_{$orientationType}";
        }

        return (int) $this->scopeConfig->getValue(
            $xpath,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get products per page count.
     *
     * @param string $platformType
     *
     * @throws \InvalidArgumentException
     *
     * @return int
     */
    public function getProductsPerPage($platformType)
    {
        $this->checkPlatformType($platformType);

        return (int) $this->scopeConfig->getValue(
            sprintf(self::XML_PATH_PRODUCTS_PER_PAGE, $platformType),
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get image height.
     *
     * @param string $platformType
     * @param string $viewType
     *
     * @throws \InvalidArgumentException
     *
     * @return int
     */
    public function getImageHeight($platformType, $viewType)
    {
        $this->checkPlatformType($platformType);
        $this->checkViewType($viewType);

        return (int) $this->scopeConfig->getValue(
            sprintf(self::XML_PATH_PRODUCT_IMAGE_HEIGHT, $platformType, $viewType),
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get image width.
     *
     * @param string $platformType
     * @param string $viewType
     *
     * @throws \InvalidArgumentException
     *
     * @return int
     */
    public function getImageWidth($platformType, $viewType)
    {
        $this->checkPlatformType($platformType);
        $this->checkViewType($viewType);

        return (int) $this->scopeConfig->getValue(
            sprintf(self::XML_PATH_PRODUCT_IMAGE_WIDTH, $platformType, $viewType),
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get short description length.
     *
     * @param string $platformType
     *
     * @throws \InvalidArgumentException
     *
     * @return int
     */
    public function getShortDescriptionLength($platformType)
    {
        $this->checkPlatformType($platformType);

        return (int) $this->scopeConfig->getValue(
            sprintf(self::XML_PATH_SHORT_DESCRIPTION_LENGTH, $platformType),
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get top head background color.
     *
     * @return string
     */
    public function getTopHeadBackgroundColor()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_TOP_HEAD_BACKGROUND_COLOR,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Check is enable Top Head background image.
     *
     * @return bool
     */
    public function isTopHeadBackgroundImage()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_TOP_HEAD_BACKGROUND_IMAGE_ACTIVE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get Top Head background image.
     *
     * @return string
     */
    public function getTopHeadBackgroundImage()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_TOP_HEAD_BACKGROUND_IMAGE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get Top Head background image position.
     *
     * @return string
     */
    public function getTopHeadBackgroundImagePosition()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_TOP_HEAD_BACKGROUND_IMAGE_POSITION,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get Top Head background image repeat.
     *
     * @return string
     */
    public function getTopHeadBackgroundImageRepeat()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_TOP_HEAD_BACKGROUND_IMAGE_REPEAT,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get Top Head background image size.
     *
     * @return string
     */
    public function getTopHeadBackgroundImageSize()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_TOP_HEAD_BACKGROUND_IMAGE_SIZE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get Top Head background image attachment.
     *
     * @return string
     */
    public function getTopHeadBackgroundImageAttachment()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_TOP_HEAD_BACKGROUND_IMAGE_ATTACHMENT,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get block title background color.
     *
     * @return string
     */
    public function getBlockTitleBackgroundColor()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_BLOCK_TITLE_BACKGROUND_COLOR,
            ScopeInterface::SCOPE_STORE
        );
    }



    /**
     * Check is enable block title background image.
     *
     * @return bool
     */
    public function isBlockTitleBackgroundImage()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_BLOCK_TITLE_BACKGROUND_IMAGE_ACTIVE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get block title background image.
     *
     * @return string
     */
    public function getBlockTitleBackgroundImage()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_BLOCK_TITLE_BACKGROUND_IMAGE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get block title background image position.
     *
     * @return string
     */
    public function getBlockTitleBackgroundImagePosition()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_BLOCK_TITLE_BACKGROUND_IMAGE_POSITION,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get block title background image repeat.
     *
     * @return string
     */
    public function getBlockTitleBackgroundImageRepeat()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_BLOCK_TITLE_BACKGROUND_IMAGE_REPEAT,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get block title background image size.
     *
     * @return string
     */
    public function getBlockTitleBackgroundImageSize()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_BLOCK_TITLE_BACKGROUND_IMAGE_SIZE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get block title background image attachment.
     *
     * @return string
     */
    public function getBlockTitleBackgroundImageAttachment()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_BLOCK_TITLE_BACKGROUND_IMAGE_ATTACHMENT,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get social links background image.
     *
     * @return string
     */
    public function getSocialLinksBackgroundImage()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_SOCIAL_LINKS_BACKGROUND_IMAGE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get social links background color.
     *
     * @return string
     */
    public function getSocialLinksBackgroundColor()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_SOCIAL_LINKS_BACKGROUND_COLOR,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get product detail image height.
     *
     * @return int
     */
    public function getProductDetailImageHeight()
    {
        return (int) $this->scopeConfig->getValue(
            self::XML_PATH_PRODUCT_DETAIL_IMAGE_HEIGHT,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get product detail image width.
     *
     * @return int
     */
    public function getProductDetailImageWidth()
    {
        return (int) $this->scopeConfig->getValue(
            self::XML_PATH_PRODUCT_DETAIL_IMAGE_WIDTH,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Check is show product detail upsell.
     *
     * @return bool
     */
    public function isShowProductDetailUpsell()
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_PRODUCT_DETAIL_SHOW_UPSELL,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get product detail upsell limit.
     *
     * @return int
     */
    public function getProductDetailUpsellLimit()
    {
        return (int) $this->scopeConfig->getValue(
            self::XML_PATH_PRODUCT_DETAIL_UPSELL_LIMIT,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get product detail upsell image height.
     *
     * @return int
     */
    public function getProductDetailUpsellImageHeight()
    {
        return (int) $this->scopeConfig->getValue(
            self::XML_PATH_PRODUCT_DETAIL_UPSELL_IMAGE_HEIGHT,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get product detail upsell image width.
     *
     * @return int
     */
    public function getProductDetailUpsellImageWidth()
    {
        return (int) $this->scopeConfig->getValue(
            self::XML_PATH_PRODUCT_DETAIL_UPSELL_IMAGE_WIDTH,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Check is show social links.
     *
     * @param string $position
     *
     * @return bool
     */
    public function isShowSocialLinks($position)
    {
        return $this->scopeConfig->isSetFlag(
            sprintf(self::XML_PATH_SHOW_SOCIAL_LINKS, $position),
            ScopeInterface::SCOPE_STORE
        );
    }

    public static function getSocialLinkTypes()
    {
        return self::$supportedSocialLinkTypes;
    }

    /**
     * Get social link by type.
     *
     * @param string $linkType
     * @return string
     */
    public function getSocialLink($linkType)
    {
        $this->checkSocialLinkType($linkType);

        return $this->scopeConfig->getValue(
           sprintf(self::XML_PATH_SOCIAL_LINK, $linkType),
           ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Check platform type.
     *
     * @param string $type
     * @return void
     */
    protected function checkPlatformType($type)
    {
        if (!in_array($type, self::$supportedPlatformTypes)) {
            throw new \InvalidArgumentException(sprintf('Invalid platform type "%s" provided.', $type));
        }
    }

    protected function checkOrientationType($type)
    {
        if (!in_array($type, self::$supportedOrientationTypes)) {
            throw new \InvalidArgumentException(sprintf('Invalid orientation type "%s" provided.', $type));
        }
    }

    /**
     * Check product view type.
     *
     * @param string $type
     * @return void
     */
    protected function checkViewType($type)
    {
        if (!in_array($type, self::$supportedViewTypes)) {
            throw new \InvalidArgumentException(sprintf('Invalid view type "%s" provided.', $type));
        }
    }

    /**
     * Check social link type.
     *
     * @param string $type
     * @return void
     */
    protected static function checkSocialLinkType($type)
    {
        if (!in_array($type, self::$supportedSocialLinkTypes)) {
            throw new \InvalidArgumentException(sprintf('Invalid social link type "%s" provided.', $type));
        }
    }
	
	/**
     * Check is show product label.
     *
     * @return bool
     */
    public function isShowSwatchGrid()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_SWATCH_GRID,
            ScopeInterface::SCOPE_STORE
        );
    }
	
	public function isShowSwatchList()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_SWATCH_LIST,
            ScopeInterface::SCOPE_STORE
        );
    }
}