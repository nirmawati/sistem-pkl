public function behaviors() {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['tanggal', 'mulai','selesai'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['tanggal', 'mulai','selesai'],
                ],
                'value' => function() {
            return time();
        },
            ],
            'user' => [
                'class' => UserBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_by', 'updated_by'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_by',
                ],
                'value' => function() {
            return \Yii::$app->user->id == '' ? 0 : \Yii::$app->user->id;
        },
            ],
        ];
    }