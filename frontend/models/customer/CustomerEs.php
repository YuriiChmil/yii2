<?php

namespace frontend\models\customer;

use yii\elasticsearch\ActiveRecord;

/**
 * @property integer $id
 * @property string $firstName
 * @property string $lastName
 * @property string[] $phones
 */
class CustomerEs extends ActiveRecord
{
    const INDEX_NAME = 'customer-index';
    const INDEX_TYPE = 'customer-document';

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return ['id', 'firstName', 'lastName', 'phones'];
    }

    public static function index()
    {
        return static::INDEX_NAME;
    }

    /**
     * @return string the name of the type of this record.
     */
    public static function type()
    {
        return static::INDEX_TYPE;
    }

    public function rules()
    {
        return [
            [$this->attributes(), 'safe']
        ];
    }

    public static function createIndex()
    {
        if (self::getDb()->createCommand()->indexExists(static::index())) {
            self::getDb()->createCommand()->deleteIndex(static::index());
        }

        self::getDb()->createCommand()->createIndex(
            self::INDEX_NAME,
            [
                'settings' => [
                    'analysis' => [
                        'filter' => [
                            'ru_stop' => [
                                'type' => 'stop',
                                'stopwords' => '_russian_'
                            ],
                            'ru_stemmer' => [
                                'type' => 'stemmer',
                                'language' => 'russian'
                            ]
                        ],
                        'analyzer' => [
                            'russian' => [
                                'char_filter' => ['html_strip'],
                                'tokenizer' => 'standard',
                                'filter' => [
                                    'lowercase',
                                    'ru_stop',
                                    'ru_stemmer'
                                ]
                            ]

                        ],
                    ]
                ],
                'mappings' => [
                    self::type() => [
                        'properties' => [
                            'id' => ['type' => 'long'],
                            'firstName' => [
                                'type' => 'string',
                                'analyzer' => 'russian',
                            ],
                            'lastName' => ['type' => 'string'],
                        ]
                    ],
                ],
            ]
        );
    }
}