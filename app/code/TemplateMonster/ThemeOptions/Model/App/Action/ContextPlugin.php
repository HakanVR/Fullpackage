<?php

namespace TemplateMonster\ThemeOptions\Model\App\Action;

use TemplateMonster\ThemeOptions\Helper\Data as ThemeOptionsHelper;

class ContextPlugin
{
    /**
     * @var \Magento\Framework\App\Http\Context
     */
    protected $httpContext;

    protected $helper;

    public function __construct(
        ThemeOptionsHelper $helper,
        \Magento\Framework\App\Http\Context $httpContext
    )
    {
        $this->helper = $helper;
        $this->httpContext = $httpContext;
    }

    public function aroundDispatch($subject, $proceed, $request)
    {
        $this->httpContext->setValue('customer_platform', $this->helper->detectPlatform(), 'desktop');

        return $proceed($request);
    }
}