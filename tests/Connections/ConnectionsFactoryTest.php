<?php

declare(strict_types = 1);

namespace Avtocod\B2BApi\Laravel\Tests\Connections;

use ErrorException;
use RuntimeException;
use Illuminate\Support\Str;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Avtocod\B2BApi\Events\RequestFailedEvent;
use AvtoDev\GuzzleUrlMock\UrlsMockHandler;
use Illuminate\Support\Testing\Fakes\EventFake;
use Avtocod\B2BApi\Laravel\Tests\AbstractTestCase;
use Avtocod\B2BApi\Events\AfterRequestSendingEvent;
use Avtocod\B2BApi\Events\BeforeRequestSendingEvent;
use Avtocod\B2BApi\Laravel\Connections\ConnectionsFactory;
use Illuminate\Contracts\Events\Dispatcher as EventsDispatcher;
use Avtocod\B2BApi\Laravel\Connections\ConnectionsFactoryInterface;

/**
 * @covers \Avtocod\B2BApi\Laravel\Connections\ConnectionsFactory
 */
class ConnectionsFactoryTest extends AbstractTestCase
{
    /**
     * @var ConnectionsFactory
     */
    protected $factory;

    /**
     * @var array[]
     */
    protected $settings = [
        'conn-1' => [
            'base_uri'       => 'https://httpbin.org/post',
            'auth'           => [
                'token'    => 'token-1',
                'username' => 'username-1',
                'password' => 'password-1',
                'domain'   => 'domain-1',
                'lifetime' => 123,
            ],
            'guzzle_options' => [
                'foo' => 'bar',
            ],
        ],
        'conn-2' => [
            'base_uri'       => 'https://httpbin.org/put',
            'auth'           => [
                'token'    => 'token-2',
                'username' => 'username-2',
                'password' => 'password-2',
                'domain'   => 'domain-2',
                'lifetime' => 321,
            ],
            'guzzle_options' => [
                'bar' => 'baz',
            ],
        ],
    ];

    /**
     * @var string
     */
    protected $default = 'conn-1';

    /**
     * @var EventFake
     */
    protected $events;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->events = new EventFake($this->app->make(EventsDispatcher::class));

        $this->factory = new ConnectionsFactory($this->settings, $this->default, $this->events);
    }

    /**
     * @small
     *
     * @return void
     */
    public function testInstanceOf(): void
    {
        $this->assertInstanceOf(ConnectionsFactoryInterface::class, $this->factory);
    }

    /**
     * @small
     *
     * @return void
     */
    public function testNames(): void
    {
        $this->assertSame(\array_keys($this->settings), $this->factory->names());
    }

    /**
     * @small
     *
     * @return void
     */
    public function testDefault(): void
    {
        $this->assertSame(
            $this->settings[$this->default]['base_uri'] . '/',
            $this->factory->default()->getSettings()->getBaseUri()
        );
    }

    /**
     * @small
     *
     * @return void
     */
    public function testDefaultThrowsAnException(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessageMatches('~Default.*not set~i');

        $this->factory = new ConnectionsFactory($this->settings);

        $this->factory->default();
    }

    /**
     * @small
     *
     * @return void
     */
    public function testHas(): void
    {
        $this->assertTrue($this->factory->has($this->default));
        $this->assertTrue($this->factory->has('conn-1'));
        $this->assertTrue($this->factory->has('conn-2'));

        $this->assertFalse($this->factory->has(Str::random()));
    }

    /**
     * @small
     *
     * @return void
     */
    public function testMake(): void
    {
        $this->assertSame(
            'https://httpbin.org/put/',
            $this->factory->make('conn-2')->getSettings()->getBaseUri()
        );

        $this->assertSame(
            'baz',
            $this->factory->make('conn-2')->getSettings()->getGuzzleOptions()['bar']
        );

        $this->assertSame(
            'https://httpbin.org/post/',
            $this->factory->make('conn-1')->getSettings()->getBaseUri()
        );

        $this->assertSame(
            'bar',
            $this->factory->make('conn-1')->getSettings()->getGuzzleOptions()['foo']
        );

        $this->assertNotSame(
            $this->factory->make($this->default),
            $this->factory->make($this->default)
        );
    }

    /**
     * @small
     *
     * @return void
     */
    public function testMakeThrowsAnExceptionWhenUnknownConnectionNamePassed(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessageMatches('~named.*not exist~i');

        $this->factory->make(Str::random());
    }

    /**
     * @small
     *
     * @return void
     */
    public function testAddAndRemoveFactory(): void
    {
        $this->factory->addFactory($name = Str::random(), [
            'base_uri'       => $base_uri = 'https://httpbin.org/delete/',
            'auth'           => [
                'token' => 'token-2',
            ],
            'guzzle_options' => [
                'bar' => 'baz',
            ],
        ]);

        $this->assertSame($base_uri, $this->factory->make($name)->getSettings()->getBaseUri());

        $this->assertSame(
            'baz',
            $this->factory->make($name)->getSettings()->getGuzzleOptions()['bar']
        );

        $this->factory->removeFactory($name);

        $this->assertFalse($this->factory->has($name));
    }

    /**
     * @return void
     */
    public function testFactoryThrownAnExceptionWhenAuthPasswordAndTokenNotPassed(): void
    {
        $this->expectException(ErrorException::class);
        $this->expectExceptionMessageMatches('~password~');

        $this->factory->addFactory($name = Str::random(), [
            'base_uri' => 'https://httpbin.org/delete/',
            'auth'     => [
                'username' => 'username-2',
                //'password' => 'password-2',
                'domain'   => 'domain-2',
            ],
        ]);

        $this->factory->make($name);
    }

    /**
     * @return void
     */
    public function testFactoryThrownAnExceptionWhenAuthUserAndTokenNotPassed(): void
    {
        $this->expectException(ErrorException::class);
        $this->expectExceptionMessageMatches('~username~');

        $this->factory->addFactory($name = Str::random(), [
            'base_uri' => 'https://httpbin.org/delete/',
            'auth'     => [
                //'username' => 'username-2',
                'password' => 'password-2',
                'domain'   => 'domain-2',
            ],
        ]);

        $this->factory->make($name);
    }

    /**
     * @return void
     */
    public function testFactoryThrownAnExceptionWhenAuthDomainAndTokenNotPassed(): void
    {
        $this->expectException(ErrorException::class);
        $this->expectExceptionMessageMatches('~domain~');

        $this->factory->addFactory($name = Str::random(), [
            'base_uri' => 'https://httpbin.org/delete/',
            'auth'     => [
                'username' => 'username-2',
                'password' => 'password-2',
                //'domain'   => 'domain-2',
            ],
        ]);

        $this->factory->make($name);
    }

    /**
     * @return void
     */
    public function testFactoryIsOkThenOnlyAuthTokenPassed(): void
    {
        $this->factory->addFactory($name = Str::random(), [
            'base_uri' => 'https://httpbin.org/delete/',
            'auth'     => [
                'token' => $token = Str::random(),
            ],
        ]);

        $this->assertSame($token, $this->factory->make($name)->getSettings()->getAuthToken());
    }

    /**
     * @return void
     */
    public function testEventsFiring(): void
    {
        $this->factory->addFactory($name = Str::random(), [
            'base_uri' => 'https://httpbin.org/delete/',
            'auth'     => [
                'token' => $token = Str::random(),
            ],
            'guzzle_options' => [
                'handler' => HandlerStack::create($guzzle_handler = new UrlsMockHandler),
            ],
        ]);

        $connection = $this->factory->make($name);

        $guzzle_handler->onUriRegexpRequested(
            '~' . \preg_quote($connection->getSettings()->getBaseUri() . 'dev/ping', '/') . '.*~i',
            'get',
            $response = new Response(
                200, ['content-type' => 'application/json;charset=utf-8'], \json_encode((object) [
                    'value' => (string) \time(),
                    'in'    => $in = \random_int(0, 100),
                    'out'   => $out = (\time() * 1000),
                    'delay' => $out + 1,
                ])
            ),
            true
        );

        $client_response = $connection->devPing();

        $this->assertSame($in, $client_response->getIn());
        $this->assertSame($out, $client_response->getOut());

        $this->events->assertDispatched(BeforeRequestSendingEvent::class);
        $this->events->assertDispatched(AfterRequestSendingEvent::class);
        $this->events->assertNotDispatched(RequestFailedEvent::class);
    }
}
