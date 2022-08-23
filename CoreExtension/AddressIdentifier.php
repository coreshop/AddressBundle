<?php
/**
 * CoreShop.
 *
 * This source file is subject to the GNU General Public License version 3 (GPLv3)
 * For the full copyright and license information, please view the LICENSE.md and gpl-3.0.txt
 * files that are distributed with this source code.
 *
 * @copyright  Copyright (c) CoreShop GmbH (https://www.coreshop.org)
 * @license    https://www.coreshop.org/license     GPLv3 and CCL
 */

declare(strict_types=1);

namespace CoreShop\Bundle\AddressBundle\CoreExtension;

use CoreShop\Bundle\ResourceBundle\CoreExtension\Select;
use CoreShop\Component\Address\Model\AddressIdentifierInterface;
use CoreShop\Component\Address\Repository\AddressIdentifierRepositoryInterface;

/**
 * @psalm-suppress InvalidReturnType, InvalidReturnStatement
 */
class AddressIdentifier extends Select
{
    public $fieldtype = 'coreShopAddressIdentifier';

    protected function getRepository(): AddressIdentifierRepositoryInterface
    {
        return \Pimcore::getContainer()->get('coreshop.repository.address_identifier');
    }

    protected function getModel(): string
    {
        return \Pimcore::getContainer()->getParameter('coreshop.model.address_identifier.class');
    }

    protected function getInterface(): string
    {
        return '\\' . AddressIdentifierInterface::class;
    }

    protected function getNullable(): bool
    {
        return true;
    }
}
