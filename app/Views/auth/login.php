<?= view('layout/header', ['title' => 'Přihlášení']) ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= site_url('/') ?>">Domů</a></li>
        <li class="breadcrumb-item active">Přihlášení</li>
    </ol>
</nav>

<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-header"><h1 class="h4 mb-0">Přihlášení</h1></div>
            <div class="card-body">
                <form method="post" action="<?= site_url('login') ?>">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Uživatelské jméno</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Heslo</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button class="btn btn-primary">Přihlásit</button>
                </form>
                <p class="text-muted mt-3 mb-0">Testovací účet: admin / admin123</p>
            </div>
        </div>
    </div>
</div>

<?= view('layout/footer') ?>
