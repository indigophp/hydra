<?php

/*
 * This file is part of the Indigo Hydra package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Hydra\Hydrator\Generated\Visitor;

use Indigo\Hydra\Hydrator\Generated\PropertyAccessor;
use PhpParser\Lexer;
use PhpParser\Node;
use PhpParser\Node\Param;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\NodeVisitorAbstract;
use PhpParser\Parser;

/**
 * Visitor for adding hydrator methods to the generated class
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @link https://github.com/Ocramius/GeneratedHydrator/blob/master/src/GeneratedHydrator/CodeGenerator/Visitor/HydratorMethodsVisitor.php
 */
abstract class HydratorMethods extends NodeVisitorAbstract
{
    /**
     * @var \ReflectionProperty[]
     */
    protected $accessibleProperties;

    /**
     * @var PropertyAccessor[]
     */
    protected $propertyWriters = [];

    /**
     * @var Parser
     */
    protected $parser;

    /**
     * @param \ReflectionProperty[] $accessibleProperties
     * @param PropertyAccessor[]    $propertyWriters
     */
    public function __construct(array $accessibleProperties, array $propertyWriters)
    {
        $this->accessibleProperties = $accessibleProperties;
        $this->propertyWriters = $propertyWriters;
        $this->parser = new Parser(new Lexer());
    }
    /**
     * @param Node $node
     *
     * @return null|Class_|void
     */
    public function leaveNode(Node $node)
    {
        if (!$node instanceof Class_) {
            return null;
        }

        $method = $this->findOrCreateMethod($node, $this->getName);

        $this->replaceMethod($method);

        return $node;
    }

    /**
     * @param ClassMethod $method
     */
    abstract protected function replaceMethod(ClassMethod $method);

    /**
     * @return string
     */
    abstract protected function getMethodName();

    /**
     * Finds or creates a class method (and eventually attaches it to the class itself)
     *
     * @param Class_ $class
     * @param string $name
     *
     * @return ClassMethod
     */
    protected function findOrCreateMethod(Class_ $class, $name)
    {
        $foundMethods = array_filter(
            $class->getMethods(),
            function (ClassMethod $method) use ($name) {
                return $name === $method->name;
            }
        );

        $method = reset($foundMethods);

        if (!$method) {
            $class->stmts[] = $method = new ClassMethod($name);
        }

        return $method;
    }
}
