<?= view('layout/header', ['title' => 'Přidat film']) ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Domů</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url('/movies') ?>">Filmy</a></li>
        <li class="breadcrumb-item active">Přidat film</li>
    </ol>
</nav>

<h1>Přidat film</h1>

<form
    method="post"
    action="<?= base_url('/movies/add') ?>"
    enctype="multipart/form-data"
>

    <?= csrf_field() ?>

    <div class="mb-3">
        <label class="form-label">Název filmu</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Popis filmu</label>
        <textarea name="description" class="form-control tinymce" required></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Datum vydání</label>
        <input type="date" name="published_at" class="form-control" required>
    </div>

    <input type="hidden" name="release_date" value="<?= date('Y-m-d') ?>">

    <div class="mb-3">
        <label class="form-label">Délka v minutách</label>
        <input type="number" name="duration" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Hodnocení</label>
        <input type="number" name="rating" class="form-control" min="0" max="100" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Žánr</label>

        <select name="genre_id" class="form-select" required>
            <option value="" disabled selected>Vyber žánr</option>

            <?php foreach($genres as $genre): ?>
                <option value="<?= $genre->pid_genre ?>">
                    <?= esc($genre->name) ?>
                </option>
            <?php endforeach; ?>

        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Plakát filmu</label>
        <input type="file" name="poster" class="form-control" accept="image/*">
    </div>

    <button class="btn btn-success">
        Přidat
    </button>

    <a href="<?= base_url('/movies') ?>" class="btn btn-secondary">
        Zpět
    </a>

</form>

<?= view('layout/footer') ?>