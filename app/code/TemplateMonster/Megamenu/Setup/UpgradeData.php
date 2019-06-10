<?php
namespace TemplateMonster\Megamenu\Setup;

use Magento\Catalog\Model\Category;
use Magento\Catalog\Setup\CategorySetupFactory;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

use TemplateMonster\Megamenu\Helper\Data;

class UpgradeData implements UpgradeDataInterface
{

    private $catalogSetupFactory;

    private $_helper;

    public function __construct(
        CategorySetupFactory $categorySetupFactory,
        Data $helper
    ) {
        $this->catalogSetupFactory = $categorySetupFactory;
        $this->_helper = $helper;
    }


    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if ($context->getVersion()
            && version_compare($context->getVersion(), '1.0.4') < 0
        ) {
            $catalogSetup = $this->catalogSetupFactory->create(['setup' => $setup]);

            $group = $this->_helper->getAttributeGroup();

            $code = 'mm_configurator';

            $attribute  = [
                'type'          => 'text',
                'label'         => 'Configurator',
                'input'         => 'text',
                'global'        =>  \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'required'      =>  false,
                //'default'       =>  false,
                'group'         =>  $group,
                'sort_order'    =>  130,
                'frontend'      => 'TemplateMonster\Megamenu\Model\Attribute\Frontend\Configurator',
                'backend'       => 'TemplateMonster\Megamenu\Model\Attribute\Backend\Configurator',
            ];
            //$catalogSetup->removeAttribute(Category::ENTITY, $code);
            $catalogSetup->addAttribute(Category::ENTITY, $code, $attribute);
        }

        $setup->endSetup();
    }
}
