<?php

/**
 * This is the model class for table "mail_conversation".
 *
 * The followings are the available columns in table 'mail_conversation':
 * @property integer $id
 * @property integer $mail_id
 * @property string $description
 * @property string $attachment
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 */
class MailConversation extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'mail_conversation';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('mail_id, updated_at', 'required'),
            array('mail_id', 'numerical', 'integerOnly' => true),
            array('attachment', 'length', 'max' => 100),
            array('status', 'length', 'max' => 8),
            array('description, created_at', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, mail_id, description, attachment, status, created_at, updated_at', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'mail_id' => 'Mail',
            'description' => 'Description',
            'attachment' => 'Attachment',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
        $criteria->compare('mail_id', $this->mail_id);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('attachment', $this->attachment, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('updated_at', $this->updated_at, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return MailConversation the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * Insert mail Conservation
     * 
     * @param type $postDataObject
     * @return \MailConversation
     */
    public static function create($postDataObject) {
        BaseClass::traceLog("Creating new Mail by:");
        $createdTime = new CDbExpression('NOW()');
        $mailObject = new MailConversation();
        $mailObject->attributes = $postDataObject;
        $mailObject->created_at = $createdTime;
        $mailObject->updated_at = $createdTime;
        if (!$mailObject->save()) {
            $errors = $mailObject->getErrors();
            BaseClass::traceLog("Creating new Mail Error:", $errors);
        }
        return $mailObject;
    }

}
