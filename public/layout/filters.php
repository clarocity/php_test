<?php
$query=$_GET;
$query["priceRange"]="inexpensive";
$url1=$_SERVER['PHP_SELF']. '?' . http_build_query($query);
$query["priceRange"]="moderate";
$url2=$_SERVER['PHP_SELF']. '?' . http_build_query($query);
$query["priceRange"]="pricey";
$url3=$_SERVER['PHP_SELF']. '?' . http_build_query($query);
if (isset($query["year"])){
    $url4 = $_SERVER['REQUEST_URI'];
} else {
    $url4 = $_SERVER['REQUEST_URI'].='&year=2017';
}
$url5 = $_SERVER['PHP_SELF']. '?' . "searchInput={$_GET["searchInput"]}";
?>
<div class='btn-toolbar mb-3 flex-wrap'>
    <div class='btn-group mr-2'>
        <a role="button" class='btn btn-secondary filter' id='btn--inexpensive' href='<?php echo $url1 ?>'>$</a>
        <a role="button" class='btn btn-secondary filter' id='btn--moderate' href='<?php echo $url2 ?>'>$$</a>
        <a role="button" class='btn btn-secondary filter' id='btn--pricey' href='<?php echo $url3 ?>'>$$$</a>
    </div>
    <div class='btn-group mr-2'>
        <a class='btn btn-secondary filter' id='btn--year' href='<?php echo $url4 ?>'>Sold in 2017</a>
    </div>
    <div class='btn-group mr-2'>
        <a class='btn btn-warning filter' id='btn--reset' href='<?php echo $url5 ?>'>Reset</a>
    </div>
    <div class='btn-group'>
        <button type="button" class="btn btn-success" id="add-button">Add Property</button>
    </div>
</div>