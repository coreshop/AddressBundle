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

namespace CoreShop\Bundle\AddressBundle\Validator\Constraints;

use CoreShop\Component\Address\Model\AddressIdentifierInterface;
use CoreShop\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

final class ValidAddressIdentifierValidator extends ConstraintValidator
{
    public function __construct(private RepositoryInterface $addressIdentifierRepository)
    {
    }

    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof ValidAddressIdentifier) {
            throw new UnexpectedTypeException($constraint, ValidAddressIdentifier::class);
        }

        if ($value === null || $value === '') {
            return;
        }

        $addressIdentifier = $this->addressIdentifierRepository->find($value);

        if (!$addressIdentifier instanceof AddressIdentifierInterface) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%address_identifier%', $value)
                ->addViolation();
        }
    }
}
