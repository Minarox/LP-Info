<?php

namespace App\Normalizer;

use App\Entity\Product;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class ProductNormalizer implements ContextAwareNormalizerInterface
{
    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof Product;
    }

    /**
     * @param Product $object
     *
     * @return array|\ArrayObject|bool|float|int|string|null
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        return [
            "id" => $object->getId(),
            "name" => $object->getName(),
            "length" => $object->getLength(),
            "width" => $object->getWidth(),
            "height" => $object->getHeight(),
        ];
    }
}