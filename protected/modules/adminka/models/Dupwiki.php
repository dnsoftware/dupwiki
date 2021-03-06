<?php

/**
 * This is the model class for table "{{dupwiki}}".
 *
 * The followings are the available columns in table '{{dupwiki}}':
 * @property integer $id
 * @property integer $parent_id
 * @property string $problem
 */
class Dupwiki extends CActiveRecord
{
//    public $problem;

    // иерархия меню
    public $items = array();
    public $maxlevel;
    public $parent_item = null;

/*    public function __construct($maxlevel)
    {
        $this->maxlevel = $maxlevel;
        parent::__construct();
    }
*/

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{dupwiki}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent_id, problem, level, sortnumber', 'required'),
            //array('problem', 'required'),
			array('id, parent_id, level, sortnumber', 'numerical', 'integerOnly'=>true),
            array('content', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			//array('id, parent_id, problem', 'safe', 'on'=>'search'),
		);
	}

    public function menu_hierarh()
    {
        $temp = self::model()->findAll(array(
            'select'=>'*',
            'condition'=>'level <= '.$this->maxlevel,
            'order'=>'level ASC, sortnumber ASC',
        ));

        foreach ($temp as $ikey => $ival)
        {
            $this->items[$ival['parent_id']][] = $ival;
        }

        //deb::dump($this->items);
    }

    public function render_tree($parent_id, $level, $active_id)
    {
        if (isset($this->items[$parent_id]))
        {
            $class = "";
            if ($level == 1)
            {
                $class = " class='topnav'";
            }


            echo "\n<ul".$class.">\n";
            foreach ($this->items[$parent_id] as $val)
            {
                //deb::dump($val->id);
                //die();
                $class = "";
                if ($val->id == $active_id)
                {
                    $class = ' class="active" ';
                }
                echo "\n<li ".$class.">\n";
                $itemurl = Yii::app()->createUrl('adminka/tree/edititem', array('id'=>$val->id));
                $itemaddurl = Yii::app()->createUrl('adminka/tree/additem', array('id'=>$val->id));


                echo "<a href=\"#\">".$val->problem."</a>";
                ?><div onclick="get_tree_item('<?= $itemurl;?>', 'div_itemedit');">edit</div>
                  <div onclick="get_tree_item('<?= $itemaddurl;?>', 'div_itemedit');">add</div><?


                //echo CHtml::ajaxLink('edit', $itemurl, array('update'=>'#div_itemedit'));

                $level++; //Увеличиваем уровень вложености
                //Рекурсивно вызываем этот же метод, но с новым $parent_id и $level
                $this->render_tree($val->id, $level, $active_id);
                $level--; //Уменьшаем уровень вложенности
                echo "\n</li>\n";
            }
            echo "\n</ul>\n";
        }
    }


	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent_id' => 'Parent',
			'problem' => 'Problem',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('problem',$this->problem,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Dupwiki the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
