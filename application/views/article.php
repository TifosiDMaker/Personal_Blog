<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <h2 class="text-center"><?php echo $title; ?></h2>
            <br />
            <p class="article-main"><?php echo nl2br(html_escape(html_entity_decode($content))); ?></p>
