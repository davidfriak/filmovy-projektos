<?= view('layout/header', ['title' => 'Upravit film']) ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Domů</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url('/movies') ?>">Filmy</a></li>
        <li class="breadcrumb-item active">Upravit film</li>
    </ol>
</nav>

<h1>Upravit film</h1>

<form
    method="post"
    action="<?= base_url('/movies/edit/' . $movie->pid_movie) ?>"
    enctype="multipart/form-data"
>

    <?= csrf_field() ?>

    <div class="mb-3">
        <label class="form-label">Název filmu</label>
        <input
            type="text"
            name="title"
            class="form-control"
            value="<?= esc($movie->title) ?>"
            required
        >
    </div>

    <div class="mb-3">
        <label class="form-label">Popis filmu</label>
        <textarea
            name="description"
            class="form-control tinymce"
            required
        ><?= esc($movie->description) ?></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Datum vydání</label>
        <input
            type="date"
            name="release_date"
            class="form-control"
            value="<?= !empty($movie->release_date) ? date('Y-m-d', (int)$movie->release_date) : date('Y-m-d') ?>"
            required
        >
    </div>

    <div class="mb-3">
        <label class="form-label">Délka v minutách</label>
        <input
            type="number"
            name="duration"
            class="form-control"
            value="<?= esc($movie->duration) ?>"
            required
        >
    </div>

    <div class="mb-3">
        <label class="form-label">Hodnocení</label>
        <input
            type="number"
            name="rating"
            class="form-control"
            min="0"
            max="100"
            value="<?= esc($movie->rating) ?>"
            required
        >
    </div>

    <div class="mb-3">
        <label class="form-label">Žánr</label>

        <select name="genre_id" class="form-select" required>
            <option value="" disabled>Vyber žánr</option>

            <?php foreach($genres as $genre): ?>
                <option value="<?= $genre->pid_genre ?>" <?= ((string)($selectedGenreId ?? '') === (string)$genre->pid_genre) ? 'selected' : '' ?>>
                    <?= esc($genre->name) ?>
                </option>
            <?php endforeach; ?>

        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Nový plakát filmu</label>
        <input type="file" name="poster" class="form-control" accept="image/*">
    </div>

    <?php if(!empty($movie->poster)): ?>

        <div class="mb-3">
            <p>Aktuální plakát:</p>

            <img
                src="<?= base_url('uploads/posters/' . $movie->poster) ?>"
                style="max-height: 200px;"
                alt="<?= esc($movie->title) ?>"
            >
        </div>

    <?php endif; ?>

    <button class="btn btn-warning">
        Uložit změny
    </button>

    <a href="<?= base_url('/movies') ?>" class="btn btn-secondary">
        Zpět
    </a>

</form>

<?= view('layout/footer') ?>