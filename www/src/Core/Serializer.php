<?php

namespace App\Core;

class Serializer
{

    public function serialize(array $data, string $class, object &$objectToPopulate = null): object
    {

        $object = isset($objectToPopulate) ? $objectToPopulate : new $class();

        if (!is_a($object, $class)) {
            throw new \Exception("L'objet n'est pas du bon type");
        }

        foreach ($data as $key => $value) {
            $method = "set" . ucfirst($key);
            if (method_exists($object, $method)) {
                $object->$method($value);
            }
        }

        return $object;
    }
}
