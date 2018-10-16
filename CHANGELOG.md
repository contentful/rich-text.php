# Changelog

All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased](https://github.com/contentful/rich-text.php/compare/1.0.0-beta4...HEAD)

### Changed

* Node `AssetHyperlink` now expects an object implementing `AssetInterface` instead of `ResourceInterface`. **[BREAKING]**
* Nodes `EmbeddedEntryBlock` and `EntryHyperlink` now expects an object implementing `EntryInterface` instead of `ResourceInterface`. **[BREAKING]**

### Removed

* Method `getNodeClass` was removed from `NodeInterface`. **[BREAKING]**

## [1.0.0-beta4](https://github.com/contentful/rich-text.php/tree/1.0.0-beta4) (2018-10-11)

### Changed

* Node `Quote` was renamed `Blockquote`. **[BREAKING]**

## [1.0.0-beta3](https://github.com/contentful/rich-text.php/tree/1.0.0-beta3) (2018-10-11)

### Changed

* The package was renamed from `contentful/structured-text-renderer` to `contentful/rich-text`. **[BREAKING]**

## [1.0.0-beta2](https://github.com/contentful/rich-text.php/tree/1.0.0-beta2) (2018-09-26)

### Added

* Node renderer `Contentful\StructuredText\NodeRenderer\CatchAll` can be used to avoid having the main renderer throw an exception in the event of an unsupported node. Use it like this:
  ``` php
  $renderer = new Contentful\StructuredText\Renderer();
  $renderer->appendNodeRenderer(new Contentful\StructuredText\NodeRenderer\CatchAll());
  ```
  It's important to use the `appendNodeRenderer` method to make the main renderer use it as last resort, otherwise, it will intercept all calls to other nodes.
* `NodeInterface` now includes method `getNodeClass`, for exposing whether a node is of type `block` or `inline`.    

## [1.0.0-beta1](https://github.com/contentful/rich-text.php/tree/1.0.0-beta1) (2018-09-13)

### Added

* Initial implementation.
