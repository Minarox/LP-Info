<?php

namespace App\Normalizer;

use App\Entity\Container;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class ContainerNormalizer implements ContextAwareNormalizerInterface
{
    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof Container;
    }

    /**
     * @param Container $object
     *
     * @return array|\ArrayObject|bool|float|int|string|null
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        return [
            "id" => $object->getId(),
            "color" => $object->getColor(),
            "container_model" => $object->getContainerModel(),
            "container_ship" => $object->getContainership()
        ];
    }
}
