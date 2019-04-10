<?php
namespace Chanshige\Backlog\Http;

use Chanshige\Backlog\Interfaces\RequestInterface;
use Chanshige\SimpleCurl\CurlInterface;
use Chanshige\SimpleCurl\Exception\CurlException;

use function json_unescaped_encode;

/**
 * Class Request
 *
 * @package Chanshige\Backlog\Http
 */
final class Request implements RequestInterface
{
    /** @var int */
    private const ERROR_MAX_RETRY = 3;

    /** @var CurlInterface */
    private $curl;

    /** @var array */
    private $parameters;

    /** @var string|null */
    private $header;

    /**
     * Request constructor.
     *
     * @param CurlInterface $curl
     */
    public function __construct(CurlInterface $curl)
    {
        $this->curl = $curl->init();
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(string $url, $parameters = null, array $header = [])
    {
        $this->setCommonOptions($url);
        $this->header = $header;
        $this->parameters = $parameters;

        return $this;
    }

    /**
     * @return string
     */
    public function get()
    {
        return $this->invoke();
    }

    /**
     * @return string
     */
    public function post()
    {
        $this->curl->setOpt(CURLOPT_POST, true);
        $this->setCommonPostFields();
        return $this->invoke();
    }

    /**
     * @return string
     */
    public function put()
    {
        $this->curl->setOpt(CURLOPT_PUT, true);
        $this->setCommonPostFields();
        return $this->invoke();
    }

    /**
     * @return string
     */
    public function patch()
    {
        $this->curl->setOpt(CURLOPT_CUSTOMREQUEST, 'PATCH');
        $this->setCommonPostFields();
        return $this->invoke();
    }

    /**
     * @return string
     */
    public function delete()
    {
        $this->curl->setOpt(CURLOPT_CUSTOMREQUEST, 'DELETE');
        $this->setCommonPostFields();
        return $this->invoke();
    }

    /**
     * @param string $url
     */
    private function setCommonOptions(string $url): void
    {
        $this->curl->setOpt(CURLOPT_URL, $url);
        $this->curl->setOpt(CURLOPT_PORT, 443);
        $this->curl->setOpt(CURLOPT_SSL_VERIFYPEER, true);
        $this->curl->setOpt(CURLOPT_SSL_VERIFYHOST, 2);
        $this->curl->setOpt(CURLOPT_RETURNTRANSFER, true);
    }

    /**
     * @return void
     */
    private function setCommonPostFields(): void
    {
        if (count($this->header) > 0) {
            $this->curl->setOpt(CURLOPT_HTTPHEADER, $this->header);
        }
        if (!is_null($this->parameters)) {
            $this->curl->setOpt(CURLOPT_POSTFIELDS, $this->parameters);
        }
    }

    /**
     * Request.
     *
     * @return string
     */
    private function invoke(): string
    {
        $retry = false;
        $cnt = 0;
        try {
            do {
                $response = $this->curl->exec();
                $info = $this->curl->getInfo();
                if ($info['http_code'] === 500 || $info['http_code'] === 503) {
                    $this->pauseOnRetry(++$cnt, $info['http_code']);
                    $retry = true;
                }
            } while ($retry);

            return $response;
        } catch (CurlException $e) {
            return json_unescaped_encode($this->errorFormat($e->getMessage(), $e->getCode()));
        } finally {
            $this->curl->close();
        }
    }

    /**
     * @param int $retries
     * @param int $status
     * @throws CurlException
     */
    private function pauseOnRetry(int $retries, int $status)
    {
        if ($retries <= self::ERROR_MAX_RETRY) {
            usleep((int)(pow(4, $retries) * 100000) + 600000);
            return;
        }
        throw new CurlException('Maximum number of retry attempts - ' . $retries . ' reached', $status);
    }

    /**
     * @param string  $msg
     * @param integer $code
     * @return array
     */
    private function errorFormat(string $msg, ?int $code = null)
    {
        return [
            'errors' => [
                [
                    'message' => $msg,
                    'code' => $code
                ]
            ]
        ];
    }
}
