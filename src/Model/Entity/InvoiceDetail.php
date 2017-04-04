<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * InvoiceDetail Entity
 *
 * @property int $InvoiceDetailID
 * @property int $InvoiceID
 * @property float $UnitPrice
 * @property int $Qty
 * @property float $Amount
 * @property string $Description
 * @property int $Taxable
 */
class InvoiceDetail extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'InvoiceDetailID' => false
    ];
}
