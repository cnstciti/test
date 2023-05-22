<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\SqlDataProvider;
use yii\db\Exception;

/**
 * OrderSearch represents the model behind the search form of `app\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return SqlDataProvider
     */
    public function search($params)
    {
        $this->load($params);
    
        $sql = " select o.id, o.created_at, o.name, s.name as status";
        $sqlTotal = 'select COUNT(*)';
        $sqlBody = '
            from `order` o
            left join status s on s.id=o.status_id
        ';
        $sql .= $sqlBody;
        $sqlTotal .= $sqlBody;
    
        if ($this->name) {
            $where = " where o.name like '%{$this->name}%'";
            $sql .= $where;
            $sqlTotal .= $where;
        }
    
        $sql .= " order by created_at DESC";
    
        try {
            $count = Yii::$app->db->createCommand($sqlTotal)->queryScalar();
        } catch (Exception $e) {
            throw new \RuntimeException('Ошибка выполнения. ' . $e->getMessage());
        }
    
        $dataProvider = new SqlDataProvider([
            'db' => Yii::$app->db,
            'sql' => $sql,
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }
}
