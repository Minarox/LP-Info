<?php

namespace App\Normalizer;

use App\Entity\ContainerShip;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class ContainerShipNormalizer implements ContextAwareNormalizerInterface
{
    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof ContainerShip;
    }

    /**
     * @param ContainerShip $object
     *
     * @return array|\ArrayObject|bool|float|int|string|null
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        return [
            "id" => $object->getId(),
            "name" => $object->getName(),
            "captain_name" => $object->getCaptainName(),
            "container_limit" => $object->getContainerLimit()
        ];
    }
}