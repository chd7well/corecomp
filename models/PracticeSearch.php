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
class PracticeSearch extends Model
{
    /** @var string */
    public $practicename;

    /** @var integer */
    public $funfactor;

    /** @var integer */
    public $specifics;
    
    /** @var integer */
    public $expertise;
    
    /** @var integer */
    public $competence;

    /** @var Finder */
    protected $finder;

    protected $id;
    /**
     * @param Finder $finder
     * @param array $config
     */
    public function __construct($id, $config = [])
    {
        $this->id = $id;
        parent::__construct($config);
    }

    /** @inheritdoc */
    public function rules()
    {
        return [
            [['specifics', 'expertise', 'funfactor'], 'integer'],
            [['practicename', 'competence'], 'safe'],
        ];
    }

    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'practicename'        => \Yii::t('corecomp', 'Practice Name'),
            'expertise'      => \Yii::t('corecomp', 'Expertise'),
        		'specifics'      => \Yii::t('corecomp', 'Specifics'),
        		'funfactor'      => \Yii::t('corecomp', 'Fun Factor'),
        		'competence'      => \Yii::t('corecomp', 'Competence'),
        ];
    }

    /**
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = CorecompPractice::find();
		$query->where("profile_ID=".$this->id);

	//	$query->select(['ID'=>'ID', 'practicename'=>'practicename','expertise'=>'expertise','specifics'=>'specifics','funfactor'=>'funfactor', 'competence'=>'funfactor']);
$query->select("`ID` AS `ID`, `practicename` AS `practicename`, `expertise` AS `expertise`, `specifics` AS `specifics`, `funfactor` AS `funfactor`, `funfactor`+specifics+expertise AS `competence`");
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		$dataProvider->sort->attributes['competence'] = [
				'asc' => ['competence' => SORT_ASC],
				'desc' => ['competence' => SORT_DESC],
		];
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'practicename', $this->practicename])
        ->andFilterWhere(['expertise'=> $this->expertise])
        ->andFilterWhere(['specifics'=> $this->specifics])
            ->andFilterWhere(['funfactor'=> $this->funfactor]) ;/*
        ->andFilterWhere(['competence'=> $this->competence]);*/

        return $dataProvider;
    }
}
