<?php
use yii\helpers\Url;
?>

<div class="u-container-layout u-similar-container u-container-layout-1">

    <h4 class="u-custom-font u-font-lato u-text u-text-palette-1-dark-3 u-text-1"><? echo $model->name; ?></h4>

    <span class="u-border-2 u-border-grey-90 u-icon u-icon-circle u-text-grey-90 u-icon-1">

         <svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 36 36"
              data-rate-id="<? echo $model->id ?>"
              data-rate-name="<? echo $model->name ?>"
              data-price="<? echo $model->price ?>"
              data-url="<? echo Url::toRoute(['site/index'])?>"
         >
             <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-7da8_<? echo $model->id ?>">
             </use>
         </svg>

        <svg class="u-svg-content" viewBox="0 0 36 36" id="svg-7da8_<? echo $model->id ?>">
             <path d="m27.417 3.914c-6.915.129-11.732-3.365-15.064-3.302s-10.296 2.109-10.009 17.44 9.744 17.404 13.41 17.336c17.163-.321 23.911-31.703 11.663-31.474z" fill="#efefef"></path>
             <circle cx="17" cy="28" fill="#2fdf84" r="1.5"></circle>
             <circle cx="24" cy="28" fill="#2fdf84" r="1.5"></circle>
             <path d="m30.15 14.5-3.17 8.68c-.29.79-1.04 1.32-1.88 1.32h-9.09c-.89 0-1.68-.59-1.92-1.45l-2.45-8.55z" fill="#f3f3f1"></path>
             <path d="m24 19.5s5.5-2.321 5.5-6.964c0-1.857 0-4.179 0-4.179l-5.5-1.857-5.5 1.857v4.179c0 4.643 5.5 6.964 5.5 6.964z" fill="#2fdf84"></path><path d="m18.01 24.5h-2c-.89 0-1.68-.59-1.92-1.45l-2.45-8.55h2l2.45 8.55c.24.86 1.03 1.45 1.92 1.45z" fill="#d5dbe1"></path>
             <path d="m25 18.98c-.59.35-1 .52-1 .52s-5.5-2.32-5.5-6.96c0-2.79 0-4.18 0-4.18l5.5-1.86 1 .34-4.5 1.52v4.18c0 3.38 2.92 5.53 4.5 6.44z" fill="#00b871"></path>
             <path d="m17 30.25c-1.24 0-2.25-1.009-2.25-2.25s1.01-2.25 2.25-2.25 2.25 1.009 2.25 2.25-1.01 2.25-2.25 2.25zm0-3c-.413 0-.75.336-.75.75s.337.75.75.75.75-.336.75-.75-.337-.75-.75-.75z"></path>
             <path d="m24 30.25c-1.24 0-2.25-1.009-2.25-2.25s1.01-2.25 2.25-2.25 2.25 1.009 2.25 2.25-1.01 2.25-2.25 2.25zm0-3c-.413 0-.75.336-.75.75s.337.75.75.75.75-.336.75-.75-.337-.75-.75-.75z"></path>
             <path d="m11.75 13.75h3.75v1.5h-3.75z"></path>
             <path d="m25.1 25.25h-9.09c-1.228 0-2.313-.822-2.643-1.999l-3.178-11.095c-.15-.536-.643-.907-1.199-.907h-2.49v-1.5h2.49c1.228 0 2.313.822 2.643 1.999l3.178 11.095c.15.536.643.907 1.199.907h9.09c.522 0 .995-.333 1.177-.828l.909-2.489 1.408.515-.909 2.49c-.398 1.084-1.437 1.812-2.585 1.812z"></path>
             <path d="m24 20.25c-.1 0-.198-.02-.292-.059-.243-.103-5.958-2.573-5.958-7.655v-4.179c0-.322.205-.607.51-.71l5.5-1.857c.156-.053.324-.053.48 0l5.5 1.857c.305.103.51.389.51.71v4.179c0 5.082-5.715 7.553-5.958 7.655-.094.039-.192.059-.292.059zm-4.75-11.354v3.64c0 3.516 3.673 5.601 4.749 6.136 1.075-.538 4.751-2.633 4.751-6.136v-3.64l-4.75-1.604z"></path>
             <path d="m23.5 15.25c-.014 0-.027 0-.041-.001-.214-.012-.411-.114-.545-.28l-2-2.5 1.172-.938 1.477 1.846 2.907-2.907 1.061 1.061-3.5 3.5c-.141.14-.333.219-.531.219z"></path>

             <g>
                 <path d="m5.375 1.417h1v2h-1z"></path>
                 <path d="m5.375 7.167h1v2h-1z"></path>
                 <path d="m1.875 4.667h2v1h-2z"></path>
                 <path d="m7.625 4.667h2v1h-2z"></path>
             </g>
        </svg>
    </span>
    <p class="u-text u-text-palette-1-dark-3 u-text-2"><? echo $model->description; ?></p>
    <p class="u-text u-text-palette-1-dark-3 u-text-3">Цена: <? echo $model->price; ?> $</b></p>
</div>
