<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Company Entity
 *
 * @property int $CompanyID
 * @property string $LocaleCode
 * @property string $CompanyName
 * @property string $Email
 * @property string $ReplyTo
 * @property string $ExtraCC
 * @property string $Logo
 * @property string $CompanyUrl
 * @property int $CompanyStatus
 * @property string $EmailSubject
 * @property string $TaxID
 * @property \Cake\I18n\Time $Entered
 * @property string $EnteredBy
 * @property \Cake\I18n\Time $Modified
 * @property string $ModifiedBy
 * @property string $CompanyInfo
 * @property string $Processor
 * @property int $AcquirerID
 * @property int $CommerceID
 * @property int $MallID
 * @property string $TerminalID
 * @property string $HexNumber
 * @property string $KeyName
 * @property string $BgColor
 * @property string $BgImage
 * @property string $DefaultNote
 */
class Company extends Entity
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
        'CompanyID' => false
    ];
}
