<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace chd7well\corecomp\models;

use chd7well\corecomp\models\CorecompProfile;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UserSearch represents the model behind the search form about User.
 */
class ProfileSearch extends Model
{
    /** @var string */
    public $profilename;

    /** @var integer */
    public $created_at;

    /** @var integer */
    public $user_id;
    
    
    /** @var string */
    public $comment;

    /** @var Finder */
    protected $finder;

    /**
     * @param Finder $finder
     * @param array $config
     */
   /* public function __construct(Finder $finder, $config = [])
    {
        $this->finder = $finder;
        parent::__construct($config);
    }*/

    /** @inheritdoc */
    public function rules()
    {
        return [
            [['created_at', 'user_id'], 'integer'],
            [['profilename', 'comment', 'user_id'], 'safe'],
        ];
    }

    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'profilename'        => \Yii::t('corecomp', 'Profile Name'),
            'created_at'      => \Yii::t('corecomp', 'Creation time'),
            'comment' => \Yii::t('corecomp', 'Comment'),
        ];
    }

    /**
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = CorecompProfile::find();
        if(!\Yii::$app->user->identity->getIsAdmin())
        {
        	$query->where('user_ID=' . \Yii::$app->user->getId());
        }
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['created_at'=> $this->created_at])
            ->andFilterWhere(['like', 'profilename', $this->profilename])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        
        return $dataProvider;
    }
}
