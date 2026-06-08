<div class="container mt-4">

    <h1>Filmová databáze</h1>

    <div class="row mb-4">

        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h3><?= $movieCount ?></h3>
                    <p>Filmů</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h3><?= $actorCount ?></h3>
                    <p>Herci</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h3><?= $genreCount ?></h3>
                    <p>Žánry</p>
                </div>
            </div>
        </div>

    </div>

    <h2>Filmy</h2>

    <table class="table table-striped">

        <thead>
            <tr>
                <th>Název</th>
                <th>Žánr</th>
                <th>Délka</th>
                <th>Hodnocení</th>
            </tr>
        </thead>

        <tbody>

        <?php foreach($latestMovies as $movie): ?>

            <tr>
                <td><?= esc($movie['title']) ?></td>
                <td><?= esc($movie['name']) ?></td>
                <td><?= esc($movie['duration']) ?> min</td>
                <td><?= esc($movie['rating']) ?></td>
            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

</div>