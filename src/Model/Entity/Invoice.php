<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Invoice Entity
 *
 * @property int $InvoiceID
 * @property int $CompanyID
 * @property int $StatusID
 * @property int $ClientID
 * @property int $CurrencyID
 * @property string $LocaleCode
 * @property string $InvoiceNumber
 * @property \Cake\I18n\Time $InvoiceDate
 * @property float $Shipping
 * @property float $Tax
 * @property string $Note
 * @property string $EmailSubject
 * @property string $AuthNumber
 * @property \Cake\I18n\Time $VoidDate
 * @property \Cake\I18n\Time $PaidDate
 * @property \Cake\I18n\Time $Entered
 * @property string $EnteredBy
 * @property \Cake\I18n\Time $Modified
 * @property string $ModifiedBy
 * @property int $TransactionID
 */
class Invoice extends Entity
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
        'InvoiceID' => false
    ];
}
