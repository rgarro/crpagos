<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Transaction Entity
 *
 * @property int $TransactionID
 * @property string $SessionID
 * @property int $CommerceID
 * @property string $IP
 * @property int $InvoiceID
 * @property \Cake\I18n\Time $RequestDate
 * @property \Cake\I18n\Time $ResponseDate
 * @property string $FullResponse
 * @property string $UserAgent
 */
class Transaction extends Entity
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
        'TransactionID' => false
    ];
}
