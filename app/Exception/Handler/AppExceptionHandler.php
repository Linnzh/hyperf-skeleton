<?php

declare(strict_types=1);

namespace App\Exception\Handler;

use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Logger\LoggerFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Throwable;

class AppExceptionHandler extends ExceptionHandler
{
    /**
     * @var StdoutLoggerInterface
     */
    protected $logger;

    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $fileLogger;

    /**
     * @var RequestInterface
     */
    protected RequestInterface $request;

    public function __construct(StdoutLoggerInterface $logger, LoggerFactory $loggerFactory)
    {
        $this->logger = $logger;
        $this->fileLogger = $loggerFactory->get('api', 'api');
        $this->request = \Hyperf\Utils\ApplicationContext::getContainer()->get(RequestInterface::class);
    }

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->logger->error(sprintf('%s[%s] in %s', $throwable->getMessage(), $throwable->getLine(), $throwable->getFile()));
        $this->logger->error($throwable->getTraceAsString());

        $this->fileLogger->emergency('异常：', [
            'file' => $throwable->getFile(),
            'line' => $throwable->getFile(),
            'message' => $throwable->getMessage(),
            'request' => [
                'url' => $this->request->url(),
                'method' => $this->request->getMethod(),
                'params' => $this->request->getQueryParams(),
                'body' => $this->request->getParsedBody(),
            ]
        ]);// 记录请求异常

        $this->stopPropagation();

        $standardResponseContent = new \Hrb981027\TreasureBag\Lib\ResponseContent\StandardResponseContent();

        $standardResponseContent
            ->setCode($throwable->getCode())
            ->setMessage(sprintf('%s[%s] in %s', $throwable->getMessage(), $throwable->getLine(), $throwable->getFile()));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('charset', 'utf-8')
            ->withStatus(200)
            ->withBody(new SwooleStream($standardResponseContent->toJson()));
    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
