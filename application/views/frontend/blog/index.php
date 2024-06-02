<div class="blog_list">
    <div class="container">
        <div class="row">
            <?php foreach ($posts as $post): ?>
                <div class="col-md-4">
                    <div class="card">
                        <img src="<?= base_url('uploads/' . $post->image); ?>" class="card-img-top" alt="<?= $post->title; ?>">
                        <div class="card-body">
                            <h5 class="card-title
                            "><?= $post->title; ?></h5>
                            <p class="card-text"><?= $post->description; ?></p>
                            <a href="<?= site_url('blog/show/' . $post->id); ?>" class="btn btn-primary">Ver mais</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
// Compare this snippet from application/views/frontend/blog/show.php:

<style>
    .blog_show {
        padding-top: 50px;
    }
</style>

<div class="blog_show">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><?= $post->title; ?></h1>
                <img src="<?= base_url('uploads/' . $post->image); ?>" class="img-fluid" alt="<?= $post->title; ?>">
                <p><?= $post->description; ?></p>
                <p><?= $post->content; ?></p>
            </div>
        </div>
    </div>
</div>

