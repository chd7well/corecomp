<?php

namespace chd7well\corecomp\models;

use Yii;
use chd7well\user\models\User;
/**
 * This is the model class for table "mkt_corecomp_profile".
 *
 * @property integer $ID
 * @property integer $user_ID
 * @property string $profilename
 * @property string $comment
 * @property string $created_at
 *
 * @property MktCorecompPractice[] $mktCorecompPractices
 * @property SysUser $user
 */
class CorecompProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%mkt_corecomp_profile}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_ID', 'profilename'], 'required'],
            [['user_ID'], 'integer'],
            [['created_at'], 'safe'],
            [['profilename', 'comment'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'user_ID' => \Yii::t('corecomp', 'User'),
            'profilename' => \Yii::t('corecomp', 'Profile name'),
            'comment' => \Yii::t('corecomp', 'Comment'),
            'created_at' => \Yii::t('corecomp', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMktCorecompPractices()
    {
        return $this->hasMany(MktCorecompPractice::className(), ['profile_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_ID']);
    }
}