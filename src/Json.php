<?php

namespace AlexS;

class Json
{
    private $decodeOptions;
    private $encodeOptions;

    /**
     * Default instance.
     *
     * @var static
     */
    private static $default;

    private static function instance()
    {
        if (!static::$default) {
            static::$default = new static();
        }

         return static::$default;
    }

    public static function d($data, $toArray = true)
    {
        return static::instance()->decode($data, $toArray);
    }

    public static function e($data)
    {
        return static::instance()->encode($data);
    }

    /**
     * @param int $decodeOptions
     * @param int $encodeOptions
     */
    public function __construct($decodeOptions = 0, $encodeOptions = JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    {
        $this->decodeOptions = $decodeOptions;
        $this->encodeOptions = $encodeOptions;
    }

    /**
     * @param string $data
     * @param string $toArray
     *
     * @throws JsonException In case of error.
     *
     * @return mixed
     */
    public function decode($data, $toArray = true)
    {
        $result = json_decode($data, $toArray, 512, $this->decodeOptions);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw JsonException::fromLastError();
        }

        return $result;
    }

    /**
     * @param mixed $data
     *
     * @throws JsonException In case of error.
     *
     * @return string
     */
    public function encode($data)
    {
        $result = json_encode($data, $this->encodeOptions);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw JsonException::fromLastError();
        }

        return $result;
    }
}
