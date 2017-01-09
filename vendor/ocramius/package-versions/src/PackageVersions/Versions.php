<?php

namespace PackageVersions;

/**
 * This class is generated by ocramius/package-versions, specifically by
 * @see \PackageVersions\Installer
 *
 * This file is overwritten at every run of `composer install` or `composer update`.
 */
final class Versions
{
    const VERSIONS = array (
  'doctrine/annotations' => 'v1.2.7@f25c8aab83e0c3e976fd7d19875f198ccf2f7535',
  'doctrine/cache' => 'v1.6.1@b6f544a20f4807e81f7044d31e679ccbb1866dc3',
  'doctrine/collections' => 'v1.3.0@6c1e4eef75f310ea1b3e30945e9f06e652128b8a',
  'doctrine/common' => 'v2.6.1@a579557bc689580c19fee4e27487a67fe60defc0',
  'doctrine/dbal' => 'v2.5.5@9f8c05cd5225a320d56d4bfdb4772f10d045a0c9',
  'doctrine/doctrine-bundle' => '1.6.4@dd40b0a7fb16658cda9def9786992b8df8a49be7',
  'doctrine/doctrine-cache-bundle' => '1.3.0@18c600a9b82f6454d2e81ca4957cdd56a1cf3504',
  'doctrine/doctrine-migrations-bundle' => 'v1.2.1@6276139e0b913a4e5120fc36bb5b0eae8ac549bc',
  'doctrine/inflector' => 'v1.1.0@90b2128806bfde671b6952ab8bea493942c1fdae',
  'doctrine/instantiator' => '1.0.5@8e884e78f9f0eb1329e445619e04456e64d8051d',
  'doctrine/lexer' => 'v1.0.1@83893c552fd2045dd78aef794c31e694c37c0b8c',
  'doctrine/migrations' => 'v1.5.0@c81147c0f2938a6566594455367e095150547f72',
  'doctrine/orm' => 'v2.5.5@73e4be7c7b3ba26f96b781a40b33feba4dfa6d45',
  'incenteev/composer-parameter-handler' => 'v2.1.2@d7ce7f06136109e81d1cb9d57066c4d4a99cf1cc',
  'jdorn/sql-formatter' => 'v1.2.17@64990d96e0959dff8e059dfcdc1af130728d92bc',
  'monolog/monolog' => '1.22.0@bad29cb8d18ab0315e6c477751418a82c850d558',
  'ocramius/package-versions' => '1.1.2@51e867c70f0799790b3e82276875414ce13daaca',
  'ocramius/proxy-manager' => '2.0.4@a55d08229f4f614bf335759ed0cf63378feeb2e6',
  'paragonie/random_compat' => 'v2.0.4@a9b97968bcde1c4de2a5ec6cbd06a0f6c919b46e',
  'psr/cache' => '1.0.1@d11b50ad223250cf17b86e38383413f5a6764bf8',
  'psr/log' => '1.0.2@4ebe3a8bf773a19edfe0a84b6585ba3d401b724d',
  'sensio/distribution-bundle' => 'v5.0.14@e64947de9ebc37732a62f5115164484a9bee7fa6',
  'sensio/framework-extra-bundle' => 'v3.0.16@507a15f56fa7699f6cc8c2c7de4080b19ce22546',
  'sensiolabs/security-checker' => 'v4.0.0@116027b57b568ed61b7b1c80eeb4f6ee9e8c599c',
  'swiftmailer/swiftmailer' => 'v5.4.4@545ce9136690cea74f98f86fbb9c92dd9ab1a756',
  'symfony/monolog-bundle' => '3.0.1@5f2d2d62530cd66be361216107869a3b061045db',
  'symfony/polyfill-apcu' => 'v1.3.0@5d4474f447403c3348e37b70acc2b95475b7befa',
  'symfony/polyfill-intl-icu' => 'v1.3.0@2d6e2b20d457603eefb6e614286c22efca30fdb4',
  'symfony/polyfill-mbstring' => 'v1.3.0@e79d363049d1c2128f133a2667e4f4190904f7f4',
  'symfony/polyfill-php56' => 'v1.3.0@1dd42b9b89556f18092f3d1ada22cb05ac85383c',
  'symfony/polyfill-php70' => 'v1.3.0@13ce343935f0f91ca89605a2f6ca6f5c2f3faac2',
  'symfony/polyfill-util' => 'v1.3.0@746bce0fca664ac0a575e465f65c6643faddf7fb',
  'symfony/swiftmailer-bundle' => 'v2.4.0@d7b7bd6bb6e9b32ebc5f9778f94d4b4e4af5d069',
  'symfony/symfony' => 'v3.2.0@b96a144bc875684f3338f697687147a2696d73eb',
  'twig/twig' => 'v1.28.2@b22ce0eb070e41f7cba65d78fe216de29726459c',
  'zendframework/zend-code' => '3.1.0@2899c17f83a7207f2d7f53ec2f421204d3beea27',
  'zendframework/zend-eventmanager' => '3.1.0@c3bce7b7d47c54040b9ae51bc55491c72513b75d',
  'sensio/generator-bundle' => 'v3.1.1@0d3c9c4864142dc6a368fa0d952a8b83215e8740',
  'symfony/phpunit-bridge' => 'v3.2.0@a56acfdb96be7c82f4bcf16b7c77f1960690b0e2',
  'santi/.checkout' => '9999999-dev@5586e406eca024579c9731d69fccf32c0c3f68ce',
);

    private function __construct()
    {
    }

    /**
     * @throws \OutOfBoundsException if a version cannot be located
     */
    public static function getVersion(string $packageName) : string
    {
        if (! isset(self::VERSIONS[$packageName])) {
            throw new \OutOfBoundsException(
                'Required package "' . $packageName . '" is not installed: cannot detect its version'
            );
        }

        return self::VERSIONS[$packageName];
    }
}
