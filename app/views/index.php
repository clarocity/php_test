<script>
    function showProperty(id){
        window.location.replace('/property/id/'+id);
    }
</script>
<!-- List container -->
<div class="row">
    <?php
    if (empty($propertyList)) {
        echo '<div class="alert alert-info"><h3>There are no records in DB yet.</h3></div>';
    } else {
        ?>
        <div class="row">
            <div class="col-lg-6">
                <div class="input-group">
                    <input type="text" class="form-control">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Go!</button>
                    </span>
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
        <div>
            <table class="table table-hover table-striped">
                <tr>
                    <th>Address</th>
                    <th>City</th>
                    <th>ZIP</th>
                    <th>State</th>
                    <th>Last sale date</th>
                    <th>Last sale price</th>
                </tr>
                <?php
                foreach ($propertyList as $row) {
                    if ($row->saleHistory) {
                        $saleHistory = $row->saleHistory;
                    }
                    echo '<tr onClick = "showProperty(' . $row->propertyId . ')">' .
                    '<td>' . $row->address . '</td>' .
                    '<td>' . $row->city . '</td>' .
                    '<td>' . $row->zip . '</td>' .
                    '<td>' . $row->state . '</td>' .
                    '<td>' . $saleHistory[0]->saleDate . '</td>' .
                    '<td>' . $saleHistory[0]->salePrice . '</td></tr>' . PHP_EOL;
                }
                ?>
            </table>

        </div>
        <ul class="pagination">
            <?php
            if ($pages > 1) {
                for ($i = 1; $i <= $pages; $i++) {
                    $class = '';
                    if ($i == $activePage) {
                        $class = 'class="active"';
                    } 
                    echo '<li '. $class. '><a href="/show/page/' . $i . '">' . $i . '</a></li>';
                }
            }
            ?>
        </ul>
        <?php
    }
    ?>
</div>
<!-- / List container -->