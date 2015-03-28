<?php

/*
 * This file is part of the Indigo Hydra package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Hydra\Hydrator\Generated;

use CodeGenerationUtils\ReflectionBuilder\ClassBuilder;
use CodeGenerationUtils\Visitor\ClassExtensionVisitor;
use CodeGenerationUtils\Visitor\ClassImplementorVisitor;
use CodeGenerationUtils\Visitor\ClassRenamerVisitor;
use CodeGenerationUtils\Visitor\MethodDisablerVisitor;
use PhpParser\NodeTraverser;

/**
 * Hydrator Class generator
 *
 * Heavily inspired by GeneratedHydrator
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Generator
{
    /**
     * @var Configuration
     */
    protected $configuration;

    /**
     * @param Configuration|null $configuration
     */
    public function __construct(Configuration $configuration = null)
    {
        if (!isset($configuration)) {
            $configuration = new Configuration;
        }

        $this->configuration = $configuration;
    }

    /**
     * Returns a hydrator class for an object or a class name
     *
     * @param string $object
     *
     * @return string
     */
    public function getHydratorClass($class)
    {
        $inflector = $this->configuration->getInflector();

        $realClass = $inflector->getUserClassName($class);
        $hydratorClass = $inflector->getGeneratedClassName($realClass, ['generator' => get_class($this)]);

        if (!class_exists($hydratorClass)) {
            $originalClass = new \ReflectionClass($realClass);

            $ast = $this->generateAst($originalClass, $hydratorClass);

            $this->configuration->getGeneratorStrategy()->generate($ast);
            $this->configuration->getAutoloader()->__invoke($hydratorClass);
        }

        return $hydratorClass;
    }

    /**
     * Generates an AST out of a given reflection class and a target hydrator name
     *
     * @param \ReflectionClass $originalClass
     * @param string           $hydratorClass
     *
     * @return \PhpParser\Node[]
     */
    protected function generateAst(\ReflectionClass $originalClass, $hydratorClass)
    {
        $builder = new ClassBuilder;

        $ast = $builder->fromReflection($originalClass);

        // Remove unused methods
        $cleaner = new NodeTraverser;
        $cleaner->addVisitor(new MethodDisablerVisitor(function() { return false; }));
        $ast = $cleaner->traverse($ast);

        // Implement new methods and interfaces, extend original class
        $implementor = new NodeTraverser;
        $implementor->addVisitor(new HydratorMethodsVisitor($originalClass));
        $implementor->addVisitor(new ClassExtensionVisitor($originalClass->getName(), $originalClass->getName()));
        $implementor->addVisitor(new ClassImplementorVisitor($originalClass->getName(), ['Indigo\\Hydra\\Hydrator']));
        $ast = $implementor->traverse($ast);

        $renamer = new NodeTraverser;
        $renamer->addVisitor(new ClassRenamerVisitor($originalClass, $hydratorClass));
        $ast = $renamer->traverse($ast);

        return $ast;
    }
}
