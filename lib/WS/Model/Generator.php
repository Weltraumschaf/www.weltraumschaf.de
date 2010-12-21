<?php
/**
 * LICENSE
 *
 * "THE BEER-WARE LICENSE" (Revision 42):
 * "Sven Strittmatter" <ich@weltraumschaf.de> wrote this file.
 * As long as you retain this notice you can do whatever you want with
 * this stuff. If we meet some day, and you think this stuff is worth it,
 * you can buy me a beer in return.
 *
 * @author    Weltraumschaf
 * @copyright Copyright (c) 02.12.2010, Sven Strittmatter.
 * @version   0.2
 * @license   http://www.weltraumschaf.de/the-beer-ware-license.txt
 */

require_once 'WS/Model/Template/Factory.php';
require_once 'WS/Model/File.php';
require_once 'WS/Model/AbstractBase.php';

class WS_Model_Generator {
    const BASE_CLASS_PREFIX = 'Base';
    
    /**
     *
     * @var WS_Model_Xml_Model
     */
    private $model;
    /**
     *
     * @var WS_Model_Template_Factory
     */
    private $tplFactory;
    
    public function  __construct(WS_Model_Xml_Model $m, WS_Model_Template_Factory $tplFactory) {
        $this->model      = $m;
        $this->tplFactory = $tplFactory;
    }

    /**
     * @return array
     */
    public function generateFiles() {
        $classTpls  = array_merge($this->generateModelBaseClasses(),
                                  $this->generateModelConcreteClasses());
        $classFiles = array();

        if (!empty($classTpls)) {
            foreach ($classTpls as $tpl) {
                /* @var $tpl WS_Model_Template_Class */
                $classFiles[] = new WS_Model_File($tpl->getName(),
                                                  '<?php' . PHP_EOL . $tpl->render());
            }
        }

        return $classFiles;
    }

    protected function generateModelBaseClasses() {
        $classTpls = array();

        if ($this->model->hasEntites()) {
            $entites = $this->model->getEntities();

            foreach ($entites as $entity) {
                /* @var $entity WS_Model_Xml_Entity */
                $className = $entity->getName() . self::BASE_CLASS_PREFIX;
                $classTpl  = $this->tplFactory->createClassTemplate();
                $classTpl->setName($className);
                $classTpl->setBaseClass('WS_Model_AbstractBase');
                $classTpl->addMethod($this->generateBaseClassConstructor($entity));
                $this->generateEntiyProperties($classTpl, $entity);
                $classTpls[] = $classTpl;
            }
        }
        
        return $classTpls;
    }

    protected function generateModelConcreteClasses() {
        $classTpls = array();
        $entites   = $this->model->getEntities();

        if ($this->model->hasEntites()) {
            foreach ($entites as $entity) {
                /* @var $entity WS_Model_Xml_Entity */
                $className = $entity->getName();
                $classTpl  = $this->tplFactory->createClassTemplate();
                $classTpl->setName($entity->getName());
                $classTpl->setBaseClass($entity->getName() . self::BASE_CLASS_PREFIX);
                $classTpls[] = $classTpl;
            }
        }
        
        return $classTpls;
    }
    
    protected function generateEntiyProperties(WS_Model_Template_Class $classTpl, WS_Model_Xml_Entity $entity) {
        if ($entity->countProperties() === 0) {
            return;
        }
        
        $properties = $entity->getProperties();

        foreach ($properties as $property) {
            /* @var $property WS_Model_Xml_Property */
            $this->generateEntityProperty($classTpl, $property);
        }
    }

    protected function generateEntityProperty(WS_Model_Template_Class $classTpl, WS_Model_Xml_Property $property) {
        $classProperty = $this->tplFactory->createPropertyTemplate();
        $classProperty->setModifier(WS_Model_Template_Abstract::MODIFIER_PRIVATE);
        $classProperty->setName($property->getName());
        $classTpl->addProperty($classProperty);

        $setterMethod = $this->generateSetterMethod($property);
        $classTpl->addMethod($setterMethod);
        
        $getterMethod = $this->generateGetterMethod($property);
        $classTpl->addMethod($getterMethod);
    }

    /**
     *
     * @param WS_Model_Xml_Property $property
     * @return WS_Model_Template_Method
     */
    protected function generateSetterMethod(WS_Model_Xml_Property $property) {
        $methodName = WS_Model_AbstractBase::generateSetterName($property->getName());
        $methodTpl  = $this->generateMethod($methodName, WS_Model_Template_Abstract::MODIFIER_PUBLIC);
        $valueToSet = $this->tplFactory->createArgumentTemplate();
        $valueToSet->setName('value');

        if ($property->isObjectType() || $property->isArrayType()) {
            $valueToSet->setTypeHint($property->getType());
        }
        
        $methodTpl->addArgument($valueToSet);
        $body = '$this->' . $property->getName() . ' = ';
        
        if ($property->isNativeType() && !$property->isArrayType()) {
            $body .= '(' . $property->getType() . ') ';
        }

        $body .= '$value;';
        $methodTpl->setBody($body);

        return $methodTpl;
    }

    /**
     *
     * @param WS_Model_Xml_Property $property
     * @return WS_Model_Template_Method
     */
    protected function generateGetterMethod(WS_Model_Xml_Property $property) {
        $methodName = WS_Model_AbstractBase::generateGetterName($property->getName());
        $methodTpl  = $this->generateMethod($methodName, WS_Model_Template_Abstract::MODIFIER_PUBLIC);
        $body       = "return \$this->{$property->getName()};";
        $methodTpl->setBody($body);

        return $methodTpl;
    }

    /**
     *
     * @param string $name
     * @param string $modifier
     * @return WS_Model_Template_Method
     */
    protected function generateMethod($name, $modifier) {
        $methodTpl = $this->tplFactory->createMethodTemplate();
        $methodTpl->setModifier($modifier);
        $methodTpl->setName($name);

        return $methodTpl;
    }

    /**
     *
     * @param WS_Model_Xml_Entity $entity
     * @return WS_Model_Template_Method
     */
    protected function generateBaseClassConstructor(WS_Model_Xml_Entity $entity) {
        $methodTpl = $this->generateMethod('__construct', WS_Model_Template_Abstract::MODIFIER_PUBLIC);
        $body      = 'parent::__construct(array(';

        if ($entity->countProperties()) {
            $body .= PHP_EOL;
            $index = 0;
            foreach ($entity->getProperties() as $property) {
                /* @var $property WS_Model_Xml_Property */
                if ($index > 0) {
                    $body .= ',' . PHP_EOL;
                }

                $body .= WS_Model_Template_Abstract::getIndentation(3);
                $body .= "'{$property->getName()}'";
                $index++;
            }

            $body .= PHP_EOL . WS_Model_Template_Abstract::getIndentation(2);
        }

        $body .= '));';
        $methodTpl->setBody($body);
        
        return $methodTpl;
    }
}