<?php

namespace chd7well\corecomp\models;

use Yii;

/**
 * This is the model class for table "mkt_corecomp_practice".
 *
 * @property integer $ID
 * @property integer $profile_ID
 * @property string $practicename
 * @property integer $expertise
 * @property integer $specifics
 * @property integer $funfactor
 *
 * @property MktCorecompProfile $profile
 */
class CorecompPractice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%mkt_corecomp_practice}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profile_ID', 'practicename', 'expertise', 'specifics', 'funfactor'], 'required'],
            [['profile_ID', 'expertise', 'specifics', 'funfactor'], 'integer'],
            [['practicename'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'profile_ID' => \Yii::t('corecomp', 'Profile ID'),
            'practicename' => \Yii::t('corecomp', 'Practicename'),
            'expertise' => \Yii::t('corecomp', 'Expertise'),
            'specifics' => \Yii::t('corecomp', 'Specifics'),
            'funfactor' => \Yii::t('corecomp', 'Fun Factor'),
        	'sum' => \Yii::t('corecomp', 'Competence Factor'),
        ];
    }

    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(MktCorecompProfile::className(), ['ID' => 'profile_ID']);
    }
    
    public function getCompetence()
    {
    	return $this->expertise + $this->specifics + $this->funfactor;
    }
}
