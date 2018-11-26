<?php
namespace App\SlackMessage;

trait JsonSerializeTrait
{
    public function jsonSerialize()
    {
        $reflect = new \ReflectionClass($this);
        $properties = $reflect->getProperties();

        $result = [];
        foreach ($properties as $property) {
            $result[$this->convertCase($property->getName())] = $this->{$property->getName()};
        }

        return $result;
    }

    private function convertCase($input)
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }
}