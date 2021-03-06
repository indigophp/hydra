# Indigo Hydra

[![Latest Version](https://img.shields.io/github/release/indigophp/hydra.svg?style=flat-square)](https://github.com/indigophp/hydra/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/indigophp/hydra.svg?style=flat-square)](https://travis-ci.org/indigophp/hydra)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/indigophp/hydra.svg?style=flat-square)](https://scrutinizer-ci.com/g/indigophp/hydra)
[![Quality Score](https://img.shields.io/scrutinizer/g/indigophp/hydra.svg?style=flat-square)](https://scrutinizer-ci.com/g/indigophp/hydra)
[![HHVM Status](https://img.shields.io/hhvm/indigophp/hydra.svg?style=flat-square)](http://hhvm.h4cc.de/package/indigophp/hydra)
[![Total Downloads](https://img.shields.io/packagist/dt/indigophp/hydra.svg?style=flat-square)](https://packagist.org/packages/indigophp/hydra)

**Easily convert array to object and object to array.**


## Install

Via Composer

``` bash
$ composer require indigophp/hydra
```


## Usage


### Currently supported hydrators

Hydrators can be found under `Indigo\Hydra\Hydrator` namespace.

- Generated: Inspired by **GeneratedHydrator**. Contains some custom logic, but generation logic is heavily based on the original code
- GeneratedHydrator: Uses [GeneratedHydrator](https://github.com/Ocramius/GeneratedHydrator) created by **[@Ocramius](https://github.com/Ocramius)**
- HydratableAware: It is a decorator which checks if the object implements `Indigo\Hydra\Hydratable` interface and falls back to the hydrator if not
- ObjectProperty: Maps data to, reads from public properties
- Reflection: Uses reflection to access all object properties (non-static ones)
- Zend: Allows to use hydrators from [zendframework/zend-stdlib](https://github.com/zendframework/Component_ZendStdlib) package


## Testing

``` bash
$ phpspec run
```


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.


## Credits

- [Márk Sági-Kazár](https://github.com/sagikazarmark)
- [Marco Pivetta](https://github.com/Ocramius)
- [All Contributors](https://github.com/indigophp/hydra/contributors)

This library is heavily influenced by [Zend Stdlib](https://github.com/zendframework/Component_ZendStdlib), [Doctrine Hydration](https://github.com/doctrine/doctrine2/tree/master/lib/Doctrine/ORM/Internal/Hydration) and [GeneratedHydrator](https://github.com/Ocramius/GeneratedHydrator) package created by **[@Ocramius](https://github.com/Ocramius)**.


## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
