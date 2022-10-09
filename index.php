<?php
require "csv_util.php";

function printAuthorsQuotes($authors, $quotes) {

    for($i=0; $i<count($authors); $i++){
        ?>
        <h3><?= $authors[$i][0] ?> <?= $authors[$i][1] ?></h3>
        <?php
        for($j=0; $j<count($quotes[$i]); $j++) {
            if ($quotes[$i][$j]) {
                ?>
                <p><?= $quotes[$i][$j] ?><a href="detail.php?index=<?=$i?>&quote=<?=$j?>"><?= 'Detail' ?></a></p><br>
                <?php
            }
        }
    }
}

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/css/index.css" />
        <title><?= 'Great Quotes' ?></title>
    </head>
    <body>
        <div class="class="container-fluid">
            <?php
    printAuthorsQuotes(getArrayFromCsv('authors.csv'),getArrayFromCsv('quotes.csv'));
    ?>
        <p><a href="create.php?"><?= 'Create Quote' ?></a></p>
        </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </body>
</html>


