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
            "container_model_id" => $object->getContainerModel() ? $object->getContainerModel()->getId() : null,
            "containership_id" => $object->getContainership() ? $object->getContainership()->getId() : null
        ];
    }
}
