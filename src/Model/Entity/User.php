<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $UserID
 * @property string $FirstName
 * @property string $LastName
 * @property string $Email
 * @property string $Password
 * @property int $UserStatus
 * @property int $AccessLevelID
 * @property string $ModifiedBy
 * @property \Cake\I18n\Time $Entered
 * @property string $EnteredBy
 * @property \Cake\I18n\Time $Modified
 */
class User extends Entity
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
        'UserID' => false
    ];
}
