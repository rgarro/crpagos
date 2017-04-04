<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Client Entity
 *
 * @property int $ClientID
 * @property int $CompanyID
 * @property string $Email
 * @property string $Phone
 * @property string $ClientName
 * @property string $ClientLastName
 * @property string $CedulaJuridica
 * @property string $RazonSocial
 * @property int $ClientStatus
 * @property \Cake\I18n\Time $Entered
 * @property string $EnteredBy
 * @property \Cake\I18n\Time $Modified
 * @property string $ModifiedBy
 */
class Client extends Entity
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
        'ClientID' => false
    ];
}
