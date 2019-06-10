<?php
/**
 * Copyright © 2016 TemplateMonster. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace TemplateMonster\ThemeOptions\Block\Config;

use \TemplateMonster\ThemeOptions\Helper\Data;
use \Magento\Framework\Config\FileResolverInterface;
use \Magento\Framework\Config\ConverterInterface;
use \Magento\Framework\Config\SchemaLocatorInterface;
use \Magento\Framework\Config\ValidationStateInterface;

class View extends \Magento\Framework\Config\View
{
    /**
     * Theme options helper
     */
    protected $_helper;

    /**
     * @param FileResolverInterface $fileResolver
     * @param ConverterInterface $converter
     * @param SchemaLocatorInterface $schemaLocator
     * @param ValidationStateInterface $validationState
     * @param string $fileName
     * @param array $idAttributes
     * @param string $domDocumentClass
     * @param string $defaultScope
     * @param array $xpath
     */
    public function __construct(
        Data $helper,
        FileResolverInterface $fileResolver,
        ConverterInterface $converter,
        SchemaLocatorInterface $schemaLocator,
        ValidationStateInterface $validationState,
        $fileName,
        $idAttributes = [],
        $domDocumentClass = 'Magento\Framework\Config\Dom',
        $defaultScope = 'global',
        $xpath = []
    ) {
        parent::__construct(
            $fileResolver,
            $converter,
            $schemaLocator,
            $validationState,
            $fileName,
            $idAttributes,
            $domDocumentClass,
            $defaultScope,
            $xpath
        );
        $this->_helper = $helper;
    }

    /**
     * Retrieve array of media attributes
     *
     * @param string $module
     * @param string $mediaType
     * @param string $mediaId
     * @return array
     */
    public function getMediaAttributes($module, $mediaType, $mediaId)
    {
        $this->initData();
        $mediaData = isset($this->data['media'][$module][$mediaType][$mediaId])
            ? $this->data['media'][$module][$mediaType][$mediaId]
            : [];
        $imageDimensions = $this->getImagesDimensions($module, $mediaType, $mediaId);

        if ($imageDimensions && $mediaData) {
            return $this->substituteValue($mediaData, $imageDimensions);
        }
        return parent::getMediaAttributes($module, $mediaType, $mediaId);
    }

    /**
     * Retrieve image dimensions from Theme Options.
     *
     * @param string $module
     * @param string $mediaType
     * @param string $mediaId
     * @return array
     */
    protected function getImagesDimensions($module, $mediaType, $mediaId)
    {
        $dimensions = [];
        if ($module == 'Magento_Catalog' && $mediaType == 'images') {
            if ($mediaId == 'category_page_grid') {
                if (!empty($this->_helper->getImageWidth('desktop', 'grid'))) {
                    $dimensions['grid_image_width'] = $this->_helper->getImageWidth('desktop', 'grid');
                }
                if (!empty($this->_helper->getImageHeight('desktop', 'grid'))) {
                    $dimensions['grid_image_height'] = $this->_helper->getImageHeight('desktop', 'grid');
                }
            }
            if ($mediaId == 'category_page_list') {
                if (!empty($this->_helper->getImageWidth('desktop', 'list'))) {
                    $dimensions['list_image_width'] = $this->_helper->getImageWidth('desktop', 'list');
                }
                if (!empty($this->_helper->getImageHeight('desktop', 'list'))) {
                    $dimensions['list_image_height'] = $this->_helper->getImageHeight('desktop', 'list');
                }
            }
            if ($mediaId == 'upsell_products_list') {
                if (!empty($this->_helper->getProductDetailUpsellImageWidth())) {
                    $dimensions['upsell_image_width'] = $this->_helper->getProductDetailUpsellImageWidth();
                }
                if (!empty($this->_helper->getProductDetailUpsellImageHeight('desktop', 'list'))) {
                    $dimensions['upsell_image_height'] = $this->_helper->getProductDetailUpsellImageHeight();
                }
            }
            if ($mediaId == 'product_page_image_medium') {
                if (!empty($this->_helper->getProductDetailImageWidth())) {
                    $dimensions['page_image_width'] = $this->_helper->getProductDetailImageWidth();
                }
                if (!empty($this->_helper->getProductDetailImageHeight())) {
                    $dimensions['page_image_height'] = $this->_helper->getProductDetailImageHeight();
                }
            }
        }
        return $dimensions;
    }

    /**
     * Substitute value in media data
     *
     * @param array $mediaData
     * @param array $value
     * @return array
     */
    protected function substituteValue($mediaData, $value)
    {
        if (isset($value['grid_image_width'])) {
            $mediaData['width'] = $value['grid_image_width'];
        }
        if (isset($value['grid_image_height'])) {
            $mediaData['height'] = $value['grid_image_height'];
        }
        if (isset($value['list_image_width'])) {
            $mediaData['width'] = $value['list_image_width'];
        }
        if (isset($value['list_image_height'])) {
            $mediaData['height'] = $value['list_image_height'];
        }
        if (isset($value['upsell_image_width'])) {
            $mediaData['width'] = $value['upsell_image_width'];
        }
        if (isset($value['upsell_image_height'])) {
            $mediaData['height'] = $value['upsell_image_height'];
        }
        if (isset($value['page_image_width'])) {
            $mediaData['width'] = $value['page_image_width'];
        }
        if (isset($value['page_image_height'])) {
            $mediaData['height'] = $value['page_image_height'];
        }
        return $mediaData;
    }



}
