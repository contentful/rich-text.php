# Changelog

All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased](https://github.com/contentful/rich-text.php/compare/4.0.3...HEAD)

## [4.0.3](https://github.com/contentful/rich-text.php/tree/4.0.3) (2025-11-18)

* Added support for strikethrough mark

## [4.0.2](https://github.com/contentful/rich-text.php/tree/4.0.2) (2024-06-03)

* Fixed a bug where localization was lost on Embedded{Asset,Entry}Block
* Updated for PHP8.3

## [4.0.1](https://github.com/contentful/rich-text.php/tree/4.0.1) (2022-12-22)

### Added

* Support for Contentful/Core v4.0.0

## [4.0.0](https://github.com/contentful/rich-text.php/tree/4.0.0) (2022-12-22)

### Changed

* **Breaking change:** Added locale support to the richtext parser. This avoids bugs when parsing embedded fields using a different locale (see [#65](https://github.com/contentful/rich-text.php/issues/65)). This change changes the `ParserInterface` and `NodeMapperInterface` - any implementation using a custom parser or NodeMapper will need to update the entries accordingly. Additionally, the `ParserInterface::parse()` and `ParserInterface::parseCollection()` methods have been deprecated in favor of their localized version (`ParserInterface::parseLocalized()` and `ParserInterface::parseCollectionLocalized()`, respectively).
* **Breaking change:** Dropped support for PHP7.
* Added the embedded asset to the serialized version of `EmbeddedAssetBlock` and `EmbeddedAssetInline` (see [#61](https://github.com/contentful/rich-text.php/issues/61)).
* Added support for superscript and subscript.

### Internal

* Overall CI cleanup
* Added CI tests for PHP8.2



<!-- PENDING-CHANGES -->
> No meaningful changes since last release.
<!-- /PENDING-CHANGES -->

## [3.4.0](https://github.com/contentful/rich-text.php/tree/3.4.0) (2022-07-17)

### Added

* Added support for table-header-cell

### Internal

* Updated header comments
* Added CI tests for PHP8.1


## [3.3.0](https://github.com/contentful/rich-text.php/tree/3.3.0) (2022-04-25)

### Added

* Added support for rich-text tables

## [3.2.0](https://github.com/contentful/rich-text.php/tree/3.2.0) (2021-03-20)

### Added

* Added support for PHP8

### Internal

* Small CI updates
* Edited source for PHP sami

## [3.1.2](https://github.com/contentful/rich-text.php/tree/3.1.2) (2020-09-10)

### Changed

* DRY applied for Node/Heading classes by introducing new AbstractClass
* performance improvements in create-redirector script

## [3.1.1](https://github.com/contentful/rich-text.php/tree/3.1.1) (2020-08-20)

### Changed

* Node renderers now forward context

## [3.1.0](https://github.com/contentful/rich-text.php/tree/3.1.0) (2020-04-08)

### Changed

> Drop MapperException and let the code simply throw the exception in the same form it was raised.

## [3.0.0](https://github.com/contentful/rich-text.php/tree/3.0.0) (2020-03-03)

### Changed

> Added support for PHP 7.4. Removed support for PHP 7.0 & 7.1. Updated dependencies.

## [2.0.0](https://github.com/contentful/rich-text.php/tree/2.0.0) (2020-02-19)

### Changed

* Nested references are not fetched recursively upfront, they are now resolved dynamically when used
* Changed parameters/signatures for EmbeddedEntryBlock, EmbeddedEntryInline, EntryHyperlink, 
* Added EntryReferenceInterface and implementation
* MapperException not thrown anymore

## [1.2.1](https://github.com/contentful/rich-text.php/tree/1.2.1) (2019-11-26)

* Fixed documentation
* Escape html in text values

## [1.2.0](https://github.com/contentful/rich-text.php/tree/1.2.0) (2018-10-31)

### Added

* The library now supports `embedded-entry-inline` and `embedded-asset-inline` nodes.

## [1.1.1](https://github.com/contentful/rich-text.php/tree/1.1.1) (2018-10-30)

### Fixed

* Configuration constraint for `contentful-core.php` required strictly version 2.0.0, now it was fixed to allow for all v2 versions.

## [1.1.0](https://github.com/contentful/rich-text.php/tree/1.1.0) (2018-10-30)

### Added

* Method `Parser::setNodeMapper(string $nodeType, NodeMapperInterface $nodeMapper)` was added, now it's possible to define custom mappers after the parser's creation.

## [1.0.0](https://github.com/contentful/rich-text.php/tree/1.0.0) (2018-10-25)

### Added

* Node `Nothing` has been implemented, which is used as a replacement for when creating other nodes does not succeed (e.g. a link can't be resolved).
* Node `EmbeddedAssetBlock` has been implemented.

## [1.0.0-beta5](https://github.com/contentful/rich-text.php/tree/1.0.0-beta5) (2018-10-16)

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
