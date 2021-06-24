<?php

namespace OK\Ipstack\Entity;

use OK\Ipstack\Exceptions\InvalidParameterException;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class ParameterBag
{
    const PROTOCOL_HTTP = 'http';
    const PROTOCOL_HTTPS = 'https';
    
    const FORMAT_JSON = 'json';
    const FORMAT_XML = 'xml';
    
    private static $formats = [
        self::FORMAT_JSON,
        self::FORMAT_XML
    ];
    
    private static $protocols = [self::PROTOCOL_HTTP, self::PROTOCOL_HTTPS];
    
    /**
     * @var string
     */
    protected $key;
    
    /**
     * @var string
     */
    protected $protocol;
    
    /**
     * @var string
     */
    protected $format;

    /**
     * @param string|null $key
     */
    public function __construct($key = null)
    {
        $this->key = $key;
        $this->protocol = self::PROTOCOL_HTTPS;
        $this->fields = [];
        $this->language = 'en';
        $this->format = self::FORMAT_JSON;
    }
    
    /**
     * @return string|null
     */
    public function getKey(): ?string
    {
        return $this->key;
    }
    
    /**
     * @return string
     */
    public function getProtocol(): string
    {
        return $this->protocol;
    }
    
    /**
     * @param string $protocol
     * @return ParameterBag
     */
    public function setProtocol(string $protocol): ParameterBag
    {
        if (!in_array($protocol, self::$protocols)) {
            throw new InvalidParameterException(sprintf("Invalid protocol '%s'. Please, use one of existing protocols [%s]", $protocol, implode(',', self::$protocols)));
        }
        
        $this->protocol = $protocol;

        return $this;
    }
    
    /**
     * @return string
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * @param string $format
     * @return ParameterBag
     */
    public function setFormat(string $format): ParameterBag
    {
        if (!in_array($format, self::$formats)) {
            throw new InvalidParameterException(sprintf("Invalid output format '%s'. Please, use one of existing formats [%s]", $format, implode(',', self::$formats)));
        }
        
        $this->format = $format;
        
        return $this;
    }
    
}
