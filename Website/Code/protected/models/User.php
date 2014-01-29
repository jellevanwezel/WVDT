<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 *
 * The followings are the available model relations:
 * @property Payment[] $payments
 * @property ProductUser[] $productUsers
 */
class User extends CActiveRecord {

    public $password_repeat;
    public $password_old;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('email, password, password_repeat, first_name, last_name', 'required'),
            array('password_old', 'required', 'on'=>'password'),
            array('email', 'email'),
            array('email', 'unique'),
            array('password, password_old', 'length', 'min' => 6, 'max' => 128),
            array('password', 'passwordStrength'),
            array('password', 'compare', 'compareAttribute' => 'password_repeat', 'strict' => true),
            array('password', 'length', 'allowEmpty' => true, 'on' => 'update'),
            array('password', 'passwordStrength', 'allowEmpty' => true, 'on' => 'update'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, email, password', 'safe', 'on' => 'search'),
        );
    }

    public function passwordStrength($attribute,$params) {
        if($this->scenario == 'update'){
            return;
        }
        if(!preg_match('/[A-Za-z]/', $attribute)){
            $this->addError($attribute, "Moet tenminste één hoofdletter bevatten.");
        }        
        if (preg_match('/[0-9]/', $attribute)) {
            $this->addError($attribute, "Moet tenminste één nummer bevatten.");
        }
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'payments' => array(self::HAS_MANY, 'Payment', 'user_id'),
            'productUsers' => array(self::HAS_MANY, 'ProductUser', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'email' => 'Email',
            'password_old' => 'Oude Wachtwoord',
            'password' => 'Wachtwoord',
            'password_repeat' => 'Wachtwoord herhalen',
            'first_name' => 'Voornaam',
            'last_name' => 'Achternaam'
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('password', $this->password, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
