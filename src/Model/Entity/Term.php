<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Term Entity
 *
 * @property int $CompanyID
 * @property string $LocaleCode
 * @property string $Content
 * @property string $EnteredBy
 * @property \Cake\I18n\Time $Entered
 * @property \Cake\I18n\Time $Modified
 * @property string $ModifiedBy
 */
class Term extends Entity
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
        'CompanyID' => false,
        'LocaleCode' => false
    ];
}
