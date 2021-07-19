<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Notifier\Bridge\Smsc\Tests;

use Symfony\Component\Notifier\Bridge\Smsc\SmscTransportFactory;
use Symfony\Component\Notifier\Test\TransportFactoryTestCase;
use Symfony\Component\Notifier\Transport\TransportFactoryInterface;

final class SmscTransportFactoryTest extends TransportFactoryTestCase
{
    /**
     * @return SmscTransportFactory
     */
    public function createFactory(): TransportFactoryInterface
    {
        return new SmscTransportFactory();
    }

    public function createProvider(): iterable
    {
        yield [
            'smsc://host.test?from=MyApp',
            'smsc://login:password@host.test?from=MyApp',
        ];
    }

    public function supportsProvider(): iterable
    {
        yield [true, 'smsc://login:password@default?from=MyApp'];
        yield [false, 'somethingElse://login:password@default?from=MyApp'];
    }

    public function missingRequiredOptionProvider(): iterable
    {
        yield 'missing option: from' => ['smsc://login:password@default'];
    }

    public function unsupportedSchemeProvider(): iterable
    {
        yield ['somethingElse://login:password@default?from=MyApp'];
        yield ['somethingElse://login:password@default']; // missing "from" option
    }
}
