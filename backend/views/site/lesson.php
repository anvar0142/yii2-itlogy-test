<?php
/** @var $lesson */
?>

<div class="container">
    <h2><?=$lesson['title']?></h2>
    <iframe src="<?= $lesson['video_link'] ?>" class="w-100 vh-100" frameborder="0"></iframe>
    <button class="btn btn-primary" id="complete-btn">Complete</button>
    <p style="text-align: justify"><?=$lesson['description']?></p>
</div>

<?php
$script = <<< JS
$(document).ready(function(){
    $('#complete-btn').click(function(){
        $.ajax({
            url: '/admin/site/complete-lesson',
            type: 'POST',
            data: {id: $_GET[id]},
            success: function(){
                window.location.replace('/admin')
            },
            error: function(){
                alert('Error!');
            }
        });
    });
}); 
JS;
$this->registerJs($script);
?>