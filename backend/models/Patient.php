<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "patient".
 *
 * @property integer $id
 * @property integer $title_id
 * @property string $first_name
 * @property string $last_name
 * @property string $other_name
 * @property string $opd_number
 * @property string $personal_phone
 * @property string $work_phone
 * @property string $home_phone
 * @property string $email
 * @property string $address
 * @property string $house_number
 * @property string $description
 * @property integer $gender_id
 * @property string $city
 * @property integer $region_id
 * @property integer $type_id
 * @property string $dob
 * @property string $reg_date
 * @property integer $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class Patient extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'patient';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['created_at', 'updated_at'], 'safe'],
            [['first_name', 'last_name', 'other_name'], 'string', 'max' => 25],
            [['opd_number'], 'unique'],

            [['first_name', 'last_name', 'gender_id', 'opd_number', 'dob', 'reg_date', 'city', 'region_id', 'personal_phone', 'marital_status_id', 'address'], 'required'],
            [['description', 'work_phone', 'home_phone', 'address'], 'safe'],

            ['type_id', 'default', 'value' => 1],
            ['type_id', 'in', 'range' => [1, 0]],

            ['status', 'default', 'value' => 1],
            ['status', 'in', 'range' => [1, 0]],

        ];
    }

    /** @inheritdoc */
    public function behaviors()
    {
        // TimestampBehavior also provides a method named touch() that allows you to assign the current timestamp to the specified attribute(s) and save them to the database. For example,
        // $model->touch('confirmed_at');
        // $model->touch('last_login_at');
        // $model->touch('blocked_at');
        // return [
        //     [
        //         'class' =>  TimestampBehavior::className(),
        //         'createdAtAttribute' => 'created_at',
        //         'updatedAtAttribute' => 'updated_at',
        //         'value' => date('Y-m-d H:i:s')
        //     ]
        // ];

        return [
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => function() { return date('U'); },
            ],
        ];
    }

    // explicitly list every field, best used when you want to make sure the changes
    // in your DB table or model attributes do not cause your field changes (to keep API backward compatibility).
    public function fields()
    {
        return [
            'id',
            'title_id',
            'first_name',
            'last_name',
            'other_name',
            'opd_number',
            'home_phone',
            'address',
            'personal_phone',
            'work_phone',
            'type_id',
            'gender_id',
            'marital_status_id',
            'region_id',
            'city',
            'dob',
            'reg_date',
            'description',
            'status',
            'updated_at',
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'First Name'),
            'other_name' => Yii::t('app', 'Other Name'),
            'personal_phone' => Yii::t('app', 'Personal Phone'),
            'work_phone' => Yii::t('app', 'Work Phone'),
            'home_phone' => Yii::t('app', 'Home Phone'),
            'opd_number' => Yii::t('app', 'OPD Number'),
            'gender_id' => Yii::t('app', 'Gender'),
            'marital_status_id' => Yii::t('app', 'Marital Status'),
            'type_id' => Yii::t('app', 'Patient Type'),
            'description' => Yii::t('app', 'Description'),
            'dob' => Yii::t('app', 'DOB'),
            'reg_date' => Yii::t('app', 'Reg Date'),
            'title_id' => Yii::t('app', 'Title'),
            'city' => Yii::t('app', 'City'),
            'region_id' => Yii::t('app', 'Region'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
