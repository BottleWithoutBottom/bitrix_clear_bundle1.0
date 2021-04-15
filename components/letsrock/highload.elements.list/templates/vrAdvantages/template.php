<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use Letsrock\Lib\Models\Highload\VrAdvantage;

$items = $arResult['ITEMS'];
?>

<? if (!empty($items)): ?>
    <section class="section">
        <div class="container">
            <h2 class="h2 section__title">В чем преимущества VR формата?</h2>
        </div>
        <div class="advantage">
            <div class="advantage__container swiper-container js-advantage">
                <div class="advantage__wrapper swiper-wrapper">
                    <? foreach ($items as $item):
                        if (
                            empty($item[VrAdvantage::UF_TEXT])
                            && empty($item[VrAdvantage::UF_NAME])
                        ) continue;
                        ?>
                        <div class="advantage-item swiper-slide">
                            <div class="advantage-item__inner">
                                <div class="advantage-item__title">
                                    <?= $item[VrAdvantage::UF_NAME] ?>
                                </div>
                                <div class="advantage-item__text">
                                    <?= $item[VrAdvantage::UF_TEXT] ?>
                                </div>
                            </div>
                        </div>
                    <? endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<? endif; ?>
