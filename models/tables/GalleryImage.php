<?php

namespace app\models\tables;

use zxbodya\yii2\galleryManager\GalleryBehavior;
use Yii;


/**
 * This is the model class for table "gallery_image".
 *
 * @property int $id
 * @property string|null $type
 * @property string $ownerId
 * @property int $rank
 * @property string|null $name
 * @property string|null $description
 */
class GalleryImage extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'gallery_image';
    }

    public function rules()
    {
        return [
            [['type', 'ownerId', 'name', 'description'], 'required'],
            [['type', 'ownerId', 'name', 'description'], 'string'],
            [['rank'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'ownerId' => 'Owner ID',
            'rank' => 'Rank',
            'name' => 'Name',
            'description' => 'Description',
        ];
    }

    public function behaviors()
    {
        return [
            'galleryBehavior' => [
                'class' => GalleryBehavior::className(),
                'type' => 'gallery-image',
                'extension' => 'jpg',

                'directory' => Yii::getAlias('@webroot') . '/images/gallery-image/gallery',
                'url' =>  Yii::getAlias('@web') . '/images/gallery-image/gallery',

                'versions' => [
                    'small' => function ($img) {
                        /** @var \Imagine\Image\ImageInterface $img */
                        return $img
                            ->copy()
                            ->thumbnail(new \Imagine\Image\Box(200, 200));
                    },
                    'medium' => function ($img) {
                        /** @var Imagine\Image\ImageInterface $img */
                        $dstSize = $img->getSize();
                        $maxWidth = 800;
                        if ($dstSize->getWidth() > $maxWidth) {
                            $dstSize = $dstSize->widen($maxWidth);
                        }
                        return $img
                            ->copy()
                            ->resize($dstSize);
                    },
                ]
            ]
        ];
    }

    // Создаём галлерею
    public function setGallery($name, $description){
        $this->type = 'gallery';
        $this->rank = 0;
        $this->name = $name;
        $this->description = $description;
        $this->save();
    }

    // Создаём заказ
    /*
    public function setOrder($rate_id, $user_id){

        $this->rate_id = $rate_id;
        $this->user_id = $user_id;
        $this->save();
    }
    */

}