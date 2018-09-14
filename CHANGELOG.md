# Changelog

All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased](https://github.com/contentful/contentful-core.php/compare/1.0.0-beta1...HEAD)

### Added

* Node renderer `Contentful\StructuredText\NodeRenderer\CatchAll` can be used to avoid having the main renderer throw an exception in the event of an unsupported node. Use it like this:
  ``` php
  $renderer = new Contentful\StructuredText\Renderer();
  $renderer->appendNodeRenderer(new Contentful\StructuredText\NodeRenderer\CatchAll());
  ```
  It's important to use the `appendNodeRenderer` method to make the main renderer use it as last resort, otherwise, it will intercept all calls to other nodes.
    

## [1.0.0-beta1](https://github.com/contentful/contentful-core.php/tree/1.0.0-beta1) (2018-09-13)

### Added

* Initial implementation.
