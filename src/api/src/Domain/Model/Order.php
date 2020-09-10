<?php
/*
 * This file has been automatically generated by TDBM.
 * You can edit this file as it will not be overwritten.
 */

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Model\Generated\BaseOrder;
use Symfony\Component\Validator\Constraints as Assert;
use TheCodingMachine\GraphQLite\Annotations\Field;
use TheCodingMachine\GraphQLite\Annotations\Type;

/**
 * The Order class maps the 'orders' table in database.
 *
 * @Type
 */
class Order extends BaseOrder
{
    /**
     * @Field()
     * @Assert\Positive(message="positive")
     */
    public function getQuantity(): int
    {
        return parent::getQuantity();
    }

    /**
     * @Field()
     * @Assert\Positive(message="positive")
     */
    public function getUnitPrice(): float
    {
        return parent::getUnitPrice();
    }

    /**
     * @Field()
     * @Assert\NotBlank(message="not_blank", allowNull=true)
     * @Assert\Length(max=255, maxMessage="max_length_255")
     */
    public function getInvoice(): ?string
    {
        // TODO not provided by user, useless asserts?
        return parent::getInvoice();
    }
}