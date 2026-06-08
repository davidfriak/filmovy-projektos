<?= view('layout/header', ['title' => 'Filmová databáze']) ?>

<div class="p-5 mb-4 bg-white rounded shadow-sm">
    <h1 class="display-5">Filmová databáze</h1>

    <p class="lead">
        Minimální webová aplikace v CodeIgniteru 4 pro správu filmů.
    </p>

    <hr>

    <a href="<?= site_url('movies') ?>" class="btn btn-primary">
        Zobrazit filmy
    </a>

    <a href="<?= site_url('movies/statistics') ?>" class="btn btn-outline-primary">
        Statistiky
    </a>

    <?php if (session()->get('isLoggedIn')): ?>
        <a href="<?= site_url('movies/addForm') ?>" class="btn btn-success">
            Přidat film
        </a>
    <?php else: ?>
        <a href="<?= site_url('login') ?>" class="btn btn-dark">
            Přihlásit se
        </a>
    <?php endif; ?>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-body">
                <h3>Filmy</h3>
                <p>Výpis filmů v kartách, obrázky a stránkování.</p>
                <a href="<?= site_url('movies') ?>" class="btn btn-sm btn-primary">
                    Přejít
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-body">
                <h3>Statistiky</h3>
                <p>Agregační funkce, počet filmů a průměrné hodnocení.</p>
                <a href="<?= site_url('movies/statistics') ?>" class="btn btn-sm btn-primary">
                    Přejít
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-body">
                <h3>Přihlášení</h3>
                <p>CRUD operace jsou dostupné jen po přihlášení.</p>

                <?php if (session()->get('isLoggedIn')): ?>
                    <a href="<?= site_url('logout') ?>" class="btn btn-sm btn-danger">
                        Odhlásit
                    </a>
                <?php else: ?>
                    <a href="<?= site_url('login') ?>" class="btn btn-sm btn-dark">
                        Přihlásit
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= view('layout/footer') ?>