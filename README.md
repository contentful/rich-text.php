# rich-text.php

[![Packagist](https://img.shields.io/packagist/v/contentful/rich-text.svg?style=for-the-badge)](https://packagist.org/packages/contentful/rich-text)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/contentful/rich-text.svg?style=for-the-badge)](https://packagist.org/packages/contentful/rich-text)
[![CircleCI (all branches)](https://img.shields.io/circleci/project/github/contentful/rich-text.php.svg?style=for-the-badge)](https://circleci.com/gh/contentful/rich-text.php)
[![Packagist](https://img.shields.io/github/license/contentful/rich-text.php.svg?style=for-the-badge)](https://packagist.org/packages/contentful/rich-text.php)
[![Codecov](https://img.shields.io/codecov/c/github/contentful/rich-text.php.svg?style=for-the-badge)](https://codecov.io/gh/contentful/rich-text.php)

[Contentful](https://www.contentful.com) is a content management platform for web applications, mobile apps and connected devices. It allows you to create, edit & manage content in the cloud and publish it anywhere via powerful API. Contentful offers tools for managing editorial teams and enabling cooperation between organizations.

The library requires at least PHP 7.0.

## Setup

To add this package to your `composer.json` and install it execute the following command:

``` bash
composer require contentful/rich-text
```

Then, if not already done, include the Composer autoloader:

``` php
require_once 'vendor/autoload.php';
```

This library is built to help with the parsing and rendering of the [rich text](https://www.contentful.com/developers/docs/concepts/rich-text/) type in Contentful.

### Parsing

The method `Contentful\RichText\Parser::parse(array $data)` accept a valid, unserialized rich text array, and returns an object which implements `Contentful\RichText\Node\NodeInterface`.

``` php
$parser = new Contentful\RichText\Parser();

// Fetch some data from an entry field from Contentful

/** @var Contentful\RichText\Node\NodeInterface $node */
$node = $parser->parse($data);
```

Depending of which type of node it actually is, the hierarchy can be navigated using getter methods. Please refer to the [full list of available nodes](https://github.com/contentful/rich-text.php/tree/master/src/Node) for a complete reference.

### Rendering

The main purpose of this library is to provide an automated way of rendering nodes. The simplest setup involves just creating an instance of the `Renderer` class:

``` php
$renderer = new Contentful\RichText\Renderer();

$output = $renderer->render($node);
```

The library provides defaults for all types of supported nodes. However, it is likely that you will need to override some of these defaults, in order to customize the output. In order to do this, you have to create `NodeRenderer` classes, which implement the `Contentful\StructuredText\NodeRenderer` interface:

``` php
namespace Contentful\RichText\NodeRenderer;

use Contentful\RichText\Node\NodeInterface;
use Contentful\RichText\RendererInterface;

/**
 * NodeRendererInterface.
 *
 * A class implementing this interface is responsible for
 * turning a limited subset of objects implementing NodeInterface
 * into a string.
 *
 * The node renderer makes the support for a certain node explicit by
 * implementing the "supports" method.
 *
 * The node renderer can also throw an exception during rendering if
 * the given node is not supported.
 */
interface NodeRendererInterface
{
    /**
     * Returns whether the current renderer
     * supports rendering the given node.
     *
     * @param NodeInterface $node The node which will be tested
     *
     * @return bool
     */
    public function supports(NodeInterface $node): bool;

    /**
     * Renders a node into a string.
     *
     * @param RendererInterface $renderer The generic renderer object, which is used for
     *                                    delegating rendering of nested nodes (such as ListItem in lists)
     * @param NodeInterface     $node     The node which must be rendered
     * @param array             $context  Optionally, extra context variables (useful with custom node renderers)
     *
     * @throws \InvalidArgumentException when the given $node is not supported
     *
     * @return string
     */
    public function render(RendererInterface $renderer, NodeInterface $node, array $context = []): string;
}
```

For instance, if you want to add a class to all `h1` tags, you will have something similar to this:

``` php
use Contentful\RichText\NodeRenderer\NodeRendererInterface;
use Contentful\RichText\Node\NodeInterface;
use Contentful\RichText\Node\Heading1;
use Contentful\RichText\RendererInterface;

class CustomHeading1 implements NodeRendererInterface
{
    public function supports(NodeInterface $node): bool
    {
        return $node instanceof Heading1;
    }

    public function render(RendererInterface $renderer, NodeInterface $node, array $context = []): string
    {
        return '<h1 class="my-custom-class">'.$renderer->renderNodeCollection($node->getContent()).'</h1>';
    }
}
```

Finally, you will need to tell the main renderer to use your custom node renderer:

``` php
$renderer->pushNodeRenderer(new CustomHeading1());
```

Now all instances of `Heading1` node will be rendered using the custom node renderer. You can implement any sort of logic in the `supports` method, and since only an interface is required, you can inject any sort of dependency in the constructor. This is done, for instance, for allowing the use of templating engines such as Twig or Plates:

``` php
use Twig\Environment;
use Contentful\RichText\NodeRenderer\NodeRendererInterface;
use Contentful\RichText\Node\NodeInterface;
use Contentful\RichText\Node\Heading1;
use Contentful\RichText\RendererInterface;

class TwigCustomHeading1 implements NodeRendererInterface
{
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function supports(NodeInterface $node): bool
    {
        return $node instanceof Heading1;
    }

    public function render(RendererInterface $renderer, NodeInterface $node, array $context = []): string
    {
        $context['node'] = $node;

        return $this->twig->render('heading1.html.twig', $context);
    }
}
```

This library provides out-of-the-box support for Twig and Plates, which allow you to call `RenderInterface::render()` and `RenderInterface::renderCollection()` methods from a template. To enable the appropriate extension, just let the Twig environment or Plates engine know about it:

### Twig integration

Setup:

``` php
$renderer = new \Contentful\RichText\Renderer();

// Register the Twig extension, which will provide functions
// rich_text_render() and rich_text_render_collection()
// in a Twig template
$extension = new \Contentful\RichText\Bridge\TwigExtension($renderer);
/** @var Twig\Environment $twig */
$twig->addExtension($extension);

// Finally, tell the main renderer about your custom node renderer
$customTwigHeading1NodeRenderer = new TwigCustomHeading1($twig);
$renderer->pushNodeRenderer($customTwigHeading1NodeRenderer);
```

Template:

``` twig
<h1 class="my-custom-class">{{ rich_text_render_collection(node.content) }}</h1>  
```

For an example implementation of a Twig-based rendering process, check the [test node renderer](https://github.com/contentful/rich-text.php/blob/master/tests/Implementation/TwigNodeRenderer.php) and the [complete integration test](https://github.com/contentful/rich-text.php/blob/master/tests/Integration/TwigNodeRendererTest.php).

### Plates integration

Setup:

``` php
$renderer = new \Contentful\RichText\Renderer();

// Register the Plates extension, which will provide functions
// $this->richTextRender() and $this->richTextRenderCollection()
// in a Plates template
$extension = new \Contentful\RichText\Bridge\PlatesExtension($renderer);
/** @var League\Plates\Engine $plates */
$plates->loadExtension($extension);

// Finally, tell the main renderer about your custom node renderer
$customPlatesHeading1NodeRenderer = new PlatesCustomHeading1($plates);
$renderer->pushNodeRenderer($customPlatesHeading1NodeRenderer);
```

Template:

``` php
// The function will output HTML, so remember *not* to escape it using $this->e()
<?= $this->richTextRenderCollection($node->getContent()) ?>
```

For an example implementation of a Plates-based rendering process, check the [test node renderer](https://github.com/contentful/rich-text.php/blob/master/tests/Implementation/PlatesNodeRenderer.php) and the [complete integration test](https://github.com/contentful/rich-text.php/blob/master/tests/Integration/PlatesNodeRendererTest.php).

## Avoid having the main renderer throw an exception

The default renderer behavior when it does not find an appropriate node renderer is to throw an exception. To avoid this, you must set it up to use a special catch-all no renderer:

``` php
$renderer = new Contentful\RichText\Renderer();
$renderer->appendNodeRenderer(new Contentful\RichText\NodeRenderer\CatchAll());
```

The special `Contentful\RichText\NodeRenderer\CatchAll` node renderer will return an empty string regardless of the node type. It's important to use the `appendNodeRenderer` instead of the usual `pushNodeRenderer` method to make this special node renderer have the lowest priority, therefore avoiding it intercepting regular node renderers.

## Glossary

| Name | Interface | Description |
|---|---|---|
| Node | `Contentful\RichText\Node\NodeInterface` | The PHP representation of a rich text node |
| Renderer | `Contentful\RichText\RendererInterface` | A class which accepts all sorts of nodes, and then delegates rendering to the appropriate node renderer |
| Node renderer | `Contentful\RichText\NodeRenderer\NodeRendererInterface` | A class whose purpose is to be able to render a specific type of node |
| Parser | `Contentful\RichText\ParserInterface` | A class that's responsible for turning an array of unserialized JSON data into a tree of node objects |

## License

Copyright (c) 2015-2018 Contentful GmbH. Code released under the MIT license. See [LICENSE](LICENSE) for further details.
