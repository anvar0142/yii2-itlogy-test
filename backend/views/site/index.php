<?php

namespace backend\assets;
/** @var yii\web\View $this */
/** @var $lessons */
/** @var $completed */

$this->title = 'My Yii Application';
$assets = AppAsset::register($this);
?>
<div class="site-index">
    <div class="body-content">
        <?php if ($completed): ?>
            <h2 class="mt-2 mb-5 text-center text-primary">Congratulations you finished all lessons</h2>
        <?php endif; ?>
        <div class="row">
            <?php for ($i = 0; $i < count($lessons); $i++): ?>
                <div class="col-lg-4">
                    <h2 class="d-flex">
                        <?= $lessons[$i]['title'] ?>
                        <?php if ($lessons[$i]['status'] == 1): ?>
                            <img src="<?= $assets->baseUrl . '/css/check-icon.png' ?>" alt="" style="width: 32px;">
                        <?php endif; ?>
                    </h2>
                    <?php if ($i === 0 || ($i > 0 && $lessons[$i - 1]['status'] == 1)): ?>
                        <iframe src="<?= $lessons[$i]['video_link'] ?>" frameborder="0"></iframe>
                        <p><a class="btn btn-outline-secondary" href="/admin/site/lesson?id=<?= $lessons[$i]['id'] ?>">See
                                lesson &raquo;</a></p>
                    <?php else: ?>
                        <img src="https://placehold.co/300x150" alt="">
                    <?php endif; ?>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</div>
