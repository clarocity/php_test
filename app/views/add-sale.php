<?php
/**
 * Response to AJAX request - just a table row
 */
    echo '<tr><td>' . $this->request->getParam('saleDate') . '</td><td> ' . number_format($this->request->getParam('salePrice'), 2) .'</td></tr>' . PHP_EOL;
?>
