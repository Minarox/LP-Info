<?php

namespace App\Normalizer;

use App\Entity\ContainerProduct;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class ContainerProductNormalizer implements ContextAwareNormalizerInterface
{
    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof ContainerProduct;
    }

    /**
     * @param ContainerProduct $object
     *
     * @return array|\ArrayObject|bool|float|int|string|null
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        return [
            "id" => $object->getId(),
            "container_id" => $object->getContainer() ? $object->getContainer()->getId() : null,
            "product_id" => $object->getProduct() ? $object->getProduct()->getId() : null,
            "quantity" => $object->getQuantity()
        ];
    }
}
