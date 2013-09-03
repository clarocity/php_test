<?php
/**
 * Response to AJAX request - just a table row
 */
    echo '<tr><td>' . $this->request->getParam('saleDate') . '</td><td> ' . $this->request->getParam('salePrice') .'</td></tr>' . PHP_EOL;
?>
