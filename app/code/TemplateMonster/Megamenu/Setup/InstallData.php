<?php

namespace TemplateMonster\Megamenu\Setup;

use Magento\Catalog\Model\Category;
use Magento\Catalog\Setup\CategorySetupFactory;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

use TemplateMonster\Megamenu\Helper\Data;

class InstallData implements InstallDataInterface
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

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $catalogSetup = $this->catalogSetupFactory->create(['setup' => $setup]);

        $group = $this->_helper->getAttributeGroup();

        $code = 'mm_turn_on';
        $attribute  = [
            'type'          => 'int',
            'label'         => 'Turn on megamenu for this category',
            'input'         => 'select',
            'source'        => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
            'global'        =>  \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'required'      =>  false,
            'default'       =>  false,
            'group'         =>  $group,
            'sort_order'    =>  10,
        ];
        //$catalogSetup->removeAttribute(Category::ENTITY, $code);
        $catalogSetup->addAttribute(Category::ENTITY, $code, $attribute);

        $code = 'mm_image';
        $attribute  = [
            'type'          => 'varchar',
            'label'         => 'Category image',
            'input'         => 'image',
            'backend'       => 'Magento\Catalog\Model\Category\Attribute\Backend\Image',
            'global'        =>  \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'required'      =>  false,
            //'default'       =>  false,
            'group'         =>  $group,
            'sort_order'    =>  50,
        ];
        //$catalogSetup->removeAttribute(Category::ENTITY, $code);
        $catalogSetup->addAttribute(Category::ENTITY, $code, $attribute);

        $code = 'mm_label';
        $attribute  = [
            'type'          => 'varchar',
            'label'         => 'Label',
            'input'         => 'text',
            'global'        =>  \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'required'      =>  false,
            //'default'       =>  false,
            'group'         =>  $group,
            'sort_order'    =>  110,
        ];
        //$catalogSetup->removeAttribute(Category::ENTITY, $code);
        $catalogSetup->addAttribute(Category::ENTITY, $code, $attribute);

        $code = 'mm_css_class';
        $attribute  = [
            'type'          => 'varchar',
            'label'         => 'Css class',
            'input'         => 'text',
            'global'        =>  \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'required'      =>  false,
            //'default'       =>  false,
            'group'         =>  $group,
            'sort_order'    =>  120,
        ];
        //$catalogSetup->removeAttribute(Category::ENTITY, $code);
        $catalogSetup->addAttribute(Category::ENTITY, $code, $attribute);

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
}