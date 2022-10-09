<?php
require "csv_util.php";


//if we have the index of author and the quote string from the detail form
if (isset($_POST['author_index']) && isset($_POST['quote'])) {

    requestDeleteConfirmation($_POST['quote'], $_POST['quote_index'], $_POST['author_index'], getArrayElementFromCsv('authors.csv', $_POST['author_index']));
}

//if the user submitted the delete confirmation
else if (isset($_POST['delete_confirm'])) {
    $confirm = $_POST['delete_confirm'];
    if($confirm == 'Yes') {
        //delete quote using utility function
        $quote = $_POST['quote'];
        $i = $_POST['authorIndex'];
        $j = $_POST['quoteIndex'];
        if (deleteStringFromCsv($quote, $j, $i, 'quotes.csv') == true) {
            ?>
                <div>
                    <p><?php 'The quote has been deleted'?></p>
                    <a href="detail.php?index=<?=$i?>&quote=<?=$j?>&quoteDeleted=<?=true?>"><?= 'Detail' ?></a>
                    <a href="index.php">
                        <input type="<?='submit'?>"/>
                    </a>
                </div>
            <?php
        }
    }
    else if ($confirm == 'No') {
        header('Location: /index.php');
    }
}
else {
    header('Location: /index.php');
}


//request confirmation and delete the quote
function requestDeleteConfirmation($quote, $quoteIndex, $authorIndex, $author)
{
    $quotes = getArrayFromCsv('quotes.csv');

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
        <link rel="stylesheet" href="assets/css/detail.css" />
        <title><?= "Delete Quote"; ?></title>
    </head>
    <body>
        <!-- Prompt to delete the quote -->
        <div class="container-fluid">
            <div class="row">
                <form method="post" action="/delete.php">
                    <p><?= 'Do you want to delete this quote by ' . ' -' . $author[0]  . ' ' . $author[1] . ' ?' ?></p>
                    <h5><?= $quote ?></h5>
                    <input type="radio" value="<?='Yes'?>" name="<?='delete_confirm'?>"/><?='Yes'?><br>
                    <input type="radio" value="<?='No'?>" name="<?='delete_confirm'?>"/><?='No'?><br>
                    <input type="hidden" value="<?= $quote ?>" name="<?= 'quote' ?>" />
                    <input type="hidden" value="<?= $quoteIndex ?>" name="<?= 'quoteIndex' ?>" />
                    <input type="hidden" value="<?= $authorIndex ?>" name="<?= 'authorIndex' ?>" />
                    <input type = "submit" value = "<?='submit'?>" name = "<?= 'submitDeleteQuote' ?>" />
                </form>
            </div>
            <!-- prompt to delete all the quotes for the author (the entire row) -->

        </div>
    </body>
</html>
<?php
}
