<?php

namespace IWA_FormBuilder\Override\SabreXml;

class Reader extends \Sabre\Xml\Reader
{
    /**
     * override
     */
    public function getDeserializerForElementName(string $name): callable
    {
        if (!array_key_exists($name, $this->elementMap)) {
            if ('{}' == substr($name, 0, 2) && array_key_exists(substr($name, 2), $this->elementMap)) {
                $name = substr($name, 2);
            } else {
                return ['Sabre\\Xml\\Element\\Base', 'xmlDeserialize'];
            }
        }

        $deserializer = $this->elementMap[$name];
        if (is_subclass_of($deserializer, 'IWA_FormBuilder\\Override\\SabreXml\\XmlDeserializable')) {
            return [$deserializer, 'xmlDeserialize'];
        }

        return parent::getDeserializerForElementName($name);
    }
}
