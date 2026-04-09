<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Arrays: Insult Generator</title>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    </head>

    <body class="container text-center">
        <section class="row min-vh-100 align-items-center justify-content-center">
            <div class="col-lg-8">
                <h1 class="display-5 mb-4">Insult Generator</h1>
                <p class="lead">You're nothing but a …</p>

                <!-- This entire block could also be made into a function that is called whenever the page is loaded (or reloaded). -->
                <?php
                if (isset($_POST['generate-btn']))
                {
                    $adjectives = array('bloody', 'witless', 'lousy', 'lumpy', 'crusty');
                    $nouns = array('gremlin', 'fungus', 'goblin', 'juggler', 'cow');

                    $first_word = $adjectives[rand(0, count($adjectives) - 1)];
                    $second_word = $nouns[rand(0, count($nouns) - 1)];

                    echo '<p class="fs-3">' . $first_word . ' ' . $second_word . "</p>";
                }
                ?>

                <!-- This button doesn't have an action, so it doesn't actually do anything. Hitting it just refreshes the page. -->
                <form method="POST">
                    <input type="submit" class="btn btn-primary" name="generate-btn" id="generate-btn" value="Generate Insult">
                </form>

            </div>
        </section>
    </body>

</html>
