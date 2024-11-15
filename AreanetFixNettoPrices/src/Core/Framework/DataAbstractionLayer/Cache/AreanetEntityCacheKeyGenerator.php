<?php declare(strict_types=1);

/**
 * digitvision
 *
 * @category  digitvision
 * @package   Shopware\Plugins\DvsnProductFixedNet
 * @copyright (c) 2021 digitvision
 */

namespace AreanetFixNettoPrices\Core\Framework\DataAbstractionLayer\Cache;

use Shopware\Core\Framework\DataAbstractionLayer\Cache\EntityCacheKeyGenerator;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\System\SalesChannel\SalesChannelContext;

class AreanetEntityCacheKeyGenerator extends EntityCacheKeyGenerator
{
    public function __construct(
        private readonly EntityCacheKeyGenerator $entityCacheKeyGenerator
    ) {
    }

    public function getSalesChannelContextHash(SalesChannelContext $context, array $areas = []): string
    {
        return md5((string) json_encode([
            $context->getShippingLocation()->getCountry()->getId(),
            $this->entityCacheKeyGenerator->getSalesChannelContextHash($context, $areas)
        ], \JSON_THROW_ON_ERROR));
    }

    public function getCriteriaHash(Criteria $criteria): string
    {
        return $this->entityCacheKeyGenerator->getCriteriaHash($criteria);
    }
}
