<?php



//read the content of the csv file and return an array
function getArrayFromCsv($fileName) {
    return $arr = array_map('str_getcsv', file($fileName));

}

function getArrayElementFromCsv($fileName, $index) {
    $arr = array_map('str_getcsv', file($fileName));
    return $arr[$index];
}

//append a record to the end of the row
function addRecord($fileName, $authorIndex, $record) {
    //get array of csv contents
    $csvArray = getArrayFromCsv($fileName);

    $i = 0;
    $input = fopen($fileName, 'r');  //open for reading
    $output = fopen('temporary.csv', 'w'); //open for writing

    //get row contents using index of the author
    while( false !== ( $data = fgetcsv($input) ) ){  //read line as array

        //stop at selected author
        if ($i == $authorIndex) {
            array_push($data, $record);
            fputcsv($output, $data);
            $i++;
            continue;
        }
        else {
            //skip the row
        }
        //adding a new author
        if($authorIndex > count($csvArray) && $i == $authorIndex - 1) {
            fputcsv($output, $data);
        }
        $i++;
        //write modified data to new file
        fputcsv( $output, $data);
    }

    fclose( $input );
    fclose( $output );

    //clean up
    unlink($fileName);// Delete
    rename('temporary.csv', $fileName); //Rename
}

function modifyRecord($fileName, $authorIndex, $quoteIndex, $record) {
    //get array of csv contents
    $csvArray = getArrayFromCsv($fileName);
    $i = 0;
    $input = fopen($fileName, 'r');  //open for reading
    $output = fopen('temporary.csv', 'w'); //open for writing

    //get row contents using index of the author
    while( false !== ( $data = fgetcsv($input) ) ){  //read line as array
        //stop at selected author
        if ($i == $authorIndex) {
            for ($j=0;$j<count($data);$j++) {
                if ($j == $quoteIndex) {
                    $data[$j] = $record;
                    fputcsv($output, $data);
                }
            }
            $i++;
            continue;
        }
        $i++;
        //write modified data to new file
        fputcsv( $output, $data);
    }
    fclose( $input );
    fclose( $output );
    //clean up
    unlink($fileName);// Delete
    rename('temporary.csv', $fileName); //Rename
    return true;
}

//delete the single entry
function deleteStringFromCsv($quote, $quoteIndex, $authorIndex, $fileName) {

    //get array of csv contents
    $csvArray = getArrayFromCsv($fileName);
    $i = 0;
    $input = fopen($fileName, 'r');  //open for reading
    $output = fopen('temporary.csv', 'w'); //open for writing

    //get row contents using index of the author
    while( false !== ( $data = fgetcsv($input) ) ){  //read line as array
        //stop at selected author
        if ($i == $authorIndex) {
            for ($j=0;$j<count($data);$j++) {
                if ($j == $quoteIndex) {
                    $data[$j] = '';
                    fputcsv($output, $data);
                }
            }
            $i++;
            continue;
        }
        $i++;
        //write modified data to new file
        fputcsv( $output, $data);
    }
    fclose( $input );
    fclose( $output );
    //clean up
    unlink($fileName);// Delete
    rename('temporary.csv', $fileName); //Rename
    return true;
}

//Per instructions, a function to remove the contents of the entire row
function deleteRowFromCsv($fileName, $authorIndex) {

    $i = 0;
    $input = fopen($fileName, 'r');  //open for reading
    $output = fopen('temporary.csv', 'w'); //open for writing

    //get row contents using index of the author
    while( false !== ( $data = fgetcsv($fileName) ) ){  //read line as array
        //stop at selected author
        if ($i == $authorIndex)
        {
            //skip the row
        }
        else {
            fputcsv($output, $data);
        }
        $i++;
        fputcsv( $output, $data);
    }
    fclose( $input );
    fclose( $output );
    //clean up
    unlink($fileName);// Delete
    rename('temporary.csv', $fileName); //Rename
}

?>