<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * InvoiceLog Entity
 *
 * @property int $LogID
 * @property int $InvoiceID
 * @property int $ActionID
 * @property \Cake\I18n\Time $ActionDate
 * @property string $ActionBy
 * @property string $IP
 * @property string $Comment
 */
class InvoiceLog extends Entity
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
        'LogID' => false
    ];
}
