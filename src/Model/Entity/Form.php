<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Form Entity
 *
 * @property int $FormID
 * @property string $LocaleCode
 * @property int $FormType
 * @property string $Name
 * @property string $LastName
 * @property string $IdNumber
 * @property string $JobPosition
 * @property string $BusinessName
 * @property string $RazonSocial
 * @property string $CedulaJuridica
 * @property string $BusArea
 * @property string $Tel1
 * @property string $Tel2
 * @property string $Email
 * @property string $Address
 * @property string $Comments
 * @property \Cake\I18n\Time $Entered
 * @property string $IP
 */
class Form extends Entity
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
        'FormID' => false
    ];
}
