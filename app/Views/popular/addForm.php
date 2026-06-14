<?= view('layout/header', ['title' => 'Přidat populární film']) ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= site_url('/') ?>">Domů</a></li>
        <li class="breadcrumb-item"><a href="<?= site_url('popular') ?>">Populární filmy</a></li>
        <li class="breadcrumb-item active">Přidat</li>
    </ol>
</nav>

<h1>Přidat populární film</h1>

<form method="post" action="<?= site_url('popular/add') ?>" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="mb-3">
        <label class="form-label">Název filmu</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Popis filmu</label>
        <textarea name="description" class="form-control tinymce"></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Datum vydání</label>
        <input type="date" name="release_date" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Délka v minutách</label>
        <input type="number" name="duration" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Hodnocení</label>
        <input type="number" name="rating" min="0" max="100" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Plakát filmu</label>
        <input type="file" name="poster" class="form-control" accept="image/*" required>
    </div>

    <button class="btn btn-success">Přidat</button>
    <a href="<?= site_url('popular') ?>" class="btn btn-secondary">Zpět</a>
</form>

<?= view('layout/footer') ?>
