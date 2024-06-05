<?php

namespace App\Normalizer;

use App\Entity\ContainerModel;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class ContainerModelNormalizer implements ContextAwareNormalizerInterface
{
    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof ContainerModel;
    }

    /**
     * @param ContainerModel $object
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
