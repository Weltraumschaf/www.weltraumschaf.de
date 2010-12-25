<?php
/**
 * ws-model
 *
 * LICENSE
 *
 * "THE BEER-WARE LICENSE" (Revision 42):
 * "Sven Strittmatter" <ich@weltraumschaf.de> wrote this file.
 * As long as you retain this notice you can do whatever you want with
 * this stuff. If we meet some day, and you think this stuff is worth it,
 * you can buy me a beer in return.
 *
 * PHP version 5
 *
 * @category  WS
 * @package   Model
 * @author    Sven Strittmatter <ich@weltraumschaf.de>
 * @copyright 2010 Sven Strittmatter
 * @license   http://www.weltraumschaf.de/the-beer-ware-license.txt
 * @version   0.3
 * @link      https://github.com/Weltraumschaf/ws-view
 */

/**
 * @see WS_Model_Template_Factory
 */
require_once 'WS/Model/Template/Factory.php';
/**
 * @see WS_Model_File
 */
require_once 'WS/Model/File.php';
/**
 * @see WS_Model_AbstractBase
 */
require_once 'WS/Model/AbstractBase.php';

/**
 * Generates class files with classes defined by a model object.
 *
 * Evey entity will be generated to an asbtract base class and a concrete
 * model class. The concrete model clas is intended to hold the custom business
 * logic. The abstract base classes are not intented to be changed, becaus theese
 * will be changed on regenrate the model.
 * 
 * @category  WS
 * @package   Model
 * @author    Sven Strittmatter <ich@weltraumschaf.de>
 * @copyright 2010 Sven Strittmatter
 * @license   http://www.weltraumschaf.de/the-beer-ware-license.txt
 * @version   0.3
 * @link      https://github.com/Weltraumschaf/ws-view
 */
class WS_Model_Generator {
    /**
     * Suffix for the abstract base model classes.
     */
    const BASE_CLASS_SUFFIX = 'Base';
    
    /**
     * Describes the model which will be generated.
     * 
     * @var WS_Model_Xml_Model
     */
    private $model;
    /**
     * FActory which generates the templates for rendering theclasses.
     * 
     * @var WS_Model_Template_Factory
     */
    private $tplFactory;

    /**
     * You need to provide a xml model object which represents the model description
     * loaded from a XML file (@see WS_Model_Xml_ConfigLoader and @see WS_Model_Xml_ConfigPArser)
     * and a template factory.
     *
     * @param WS_Model_Xml_Model        $model      Represents the generated model.
     * @param WS_Model_Template_Factory $tplFactory Generates neccessary templates.
     */
    public function  __construct(WS_Model_Xml_Model $model, WS_Model_Template_Factory $tplFactory) {
        $this->model      = $model;
        $this->tplFactory = $tplFactory;
    }

    /**
     * Generates the class files for the mdel and returns an array of
     * WS_Model_File objects.
     * 
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

    /**
     * Generates the class templates for the models base classes. Will return
     * an array of WS_Model_Template_Class objects.
     * 
     * @return array
     */
    protected function generateModelBaseClasses() {
        $classTpls = array();

        if ($this->model->hasEntites()) {
            $entites = $this->model->getEntities();

            foreach ($entites as $entity) {
                /* @var $entity WS_Model_Xml_Entity */
                $className = $entity->getName() . self::BASE_CLASS_SUFFIX;
                $classTpl  = $this->tplFactory->createClassTemplate();
                $classTpl->setName($className);
                $classTpl->setBaseClass('WS_Model_AbstractBase');
                $classTpl->setAbstract();
                $classTpl->addMethod($this->generateBaseClassConstructor($entity));
                $this->generateEntiyProperties($classTpl, $entity);
                $classTpls[] = $classTpl;
            }
        }
        
        return $classTpls;
    }

    /**
     * Generates the class templates for the models concrete classes. Will return
     * an array of WS_Model_Template_Class objects.
     *
     * @return array
     */
    protected function generateModelConcreteClasses() {
        $classTpls = array();
        $entites   = $this->model->getEntities();

        if ($this->model->hasEntites()) {
            foreach ($entites as $entity) {
                /* @var $entity WS_Model_Xml_Entity */
                $className = $entity->getName();
                $classTpl  = $this->tplFactory->createClassTemplate();
                $classTpl->setName($entity->getName());
                $classTpl->setBaseClass($entity->getName() . self::BASE_CLASS_SUFFIX);
                $classTpls[] = $classTpl;
            }
        }
        
        return $classTpls;
    }

    /**
     * Adds the properties from the models entity to the class template.
     *
     * @param WS_Model_Template_Class $classTpl The clas to which the properties will be added.
     * @param WS_Model_Xml_Entity     $entity   The entity from which the properties will be took.
     *
     * @return void
     */
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

    /**
     * Adds a entites property to the class template.
     *
     * @param WS_Model_Template_Class $classTpl The clas to which the propertys will be added
     * @param WS_Model_Xml_Property   $property The added property.
     *
     * @return void
     */
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
     * Generates a setter method for a given property.
     *
     * @param WS_Model_Xml_Property $property The property used to generate the setter for.
     *
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
     * Generates getter method for a given property.
     *
     * @param WS_Model_Xml_Property $property The property used to generate the getter for.
     *
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
     * GEnerates a generic method template.
     *
     * @param string $name     Name for the method.
     * @param string $modifier Modifier for the method.
     *
     * @return WS_Model_Template_Method
     */
    protected function generateMethod($name, $modifier) {
        $methodTpl = $this->tplFactory->createMethodTemplate();
        $methodTpl->setModifier($modifier);
        $methodTpl->setName($name);

        return $methodTpl;
    }

    /**
     * Generates the models base class constructor.
     *
     * The base class constructor provides an array with all property names to its
     * parent constructor (@see WS_Model_AbstractBase).
     *
     * @param WS_Model_Xml_Entity $entity The entity holds the properties with their names.
     *
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
