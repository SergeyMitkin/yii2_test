<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

\app\assets\TestAsset::register($this);

$this->title = 'Тестовая страница';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="test-container">
    <form action="/site/test" method="post" id="form-captcha">
        <input type="text" name="name" />
        <input type="hidden" id="g-recaptcha-response" name="recaptcha" />
        <input type="submit" value="submit" />
    </form>
</div>

<button class="btn btn-primary" id="test-captcha-button">test</button>

<button class="btn btn-danger" id="test-captcha-red-button">test</button>

<script src="https://www.google.com/recaptcha/api.js?render=<?=$site_key?>"></script>
<?php

$script = '
    let site_key = "' . $site_key . '"
';

$this->registerJs($script, yii\web\View::POS_HEAD);
?>
