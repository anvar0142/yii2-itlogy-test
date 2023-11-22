<?php

namespace backend\assets;
/** @var yii\web\View $this */
/** @var $lessons */

$this->title = 'My Yii Application';
$assets = AppAsset::register($this);
?>
<div class="site-index">
    <div class="body-content">
        <i class="bi bi-bookmark-check"></i>
        <div class="row">
            <?php for ($i = 0; $i < count($lessons); $i++): ?>
                <div class="col-lg-4">
                    <h2 class="d-flex">
                        <?= $lessons[$i]['title'] ?>
                        <?php if ($lessons[$i]['status'] == 1):?>
                            <img src="<?=$assets->baseUrl.'/css/check-icon.png'?>" alt="" style="width: 32px;">
                        <?php endif; ?>
                    </h2>
                    <?php if ($i === 0 || ($i>0 && $lessons[$i-1]['status'] === 1)): ?>
                        <iframe src="<?= $lessons[$i]['video_link'] ?>" frameborder="0"></iframe>
                        <p><a class="btn btn-outline-secondary" href="lesson?id=<?=$lessons[$i]['id']?>">See lesson &raquo;</a></p>
                    <?php else: ?>
                        <img src="https://placehold.co/300x150" alt="">
                    <?php endif; ?>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</div>
