<?php

namespace AlexS;

use RuntimeException;

class JsonException extends RuntimeException
{
    /**
     * @return static
     */
    public static function fromLastError()
    {
        return new static(json_last_error_msg(), json_last_error());
    }

    public function getConstantName()
    {
        $constants = get_defined_constants(true);

        foreach ($constants['json'] as $jsonConstant => $value) {
            if (
                0 === strpos($jsonConstant, 'JSON_ERROR') &&
                $value === $this->code
            ) {
                return $jsonConstant;
            }
        }

        // If nothing is found? It's impossible.
    }
}
