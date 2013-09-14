<script>
    function showProperty(id){
        // Redirect to page with property details
        window.location.replace('/property/id/'+id);
    }
    
    function deleteSearchWord(word) {
        // Deletes label with search word from panel
        // Also requests removal of this word from session
        $.get('/search/delete/'+word)
        .fail(
        function(e, ts, et)
        {
            console.log(ts);
            console.log(e);
            console.log(et);
        })
        .done(function(data){
 //           $("#search"+word).remove();
            window.location.replace('/');
        });
    }
    $(document).ready(function(){
        $("#search").tooltip();
    });
</script>
<style>
    .search {
        margin-bottom: 20px;
    }

    .search-words {
        margin-left: 10px;
    }
</style>
<!-- List container -->
<div class="row">
    <?php
    if (!isset($this->propertyList)) {
        echo '<div class="alert alert-info"><h3>No records found in DB.</h3></div>';
    } else {
        // Create records output
        ?>
        <div class="col-lg-4 col-lg-offset-4 search">
            <form role="form" method="post" action="/search" class="search">
                <div class="input-group">
                    <input type="text" class="form-control" id="search" name="search" value ="<?php echo $this->search; ?>" placeholder="Search by City, Address, ZIP or State" data-toggle="tooltip" data-placement="left" data-original-title="Search will return any matching results for any field (address, city, zip or state)">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                    </span>
                </div><!-- /input-group -->
            </form>
            <?php
            if (!empty($_SESSION['filter']['search'])) {
                ?>
                <!-- Panel with search keywords used to filter records -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Search words:
                    </div>
                    <div class="panel-body">
                        <?php
                        foreach ($_SESSION['filter']['search'] as $key => $value) {
                            echo '<span class="label label-warning search-words" id="search' . $key . '"><a href="javascript:deleteSearchWord(\'' . $key . '\')">&times</a> ' . $value . '</span>' . PHP_EOL;
                        }
                        ?>
                    </div><!-- /.panel-body-->
                </div><!-- /.panel-->
                <?php
            }
            ?>
        </div>

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
                $search = '';
                if (isset($_SESSION['filter']['search'])) {
                    $search = $_SESSION['filter']['search'];
                }
                foreach ($this->propertyList as $row) {
                    if ($row->saleHistory) {
                        $saleHistory = $row->saleHistory;
                    }
                    echo '<tr onClick = "showProperty(' . $row->propertyId . ')">' .
                    '<td>' . $this->highlightText($row->address, $search) . '</td>' .
                    '<td>' . $this->highlightText($row->city, $search) . '</td>' .
                    '<td>' . $this->highlightText($row->zip, $search) . '</td>' .
                    '<td>' . $this->highlightText($row->state, $search) . '</td>' .
                    '<td>' . (($saleHistory[0]->saleDate) ? $saleHistory[0]->saleDate : 'No data') . '</td>' .
                    '<td>' . (($saleHistory[0]->salePrice) ? number_format($saleHistory[0]->salePrice, 2) : 'No data') . '</td></tr>' . PHP_EOL;
                }
                ?>
            </table>

        </div>
        <div class="text-center">
            <ul class="pagination">
                <?php
                if ($this->pages > 1) {
                    echo '<li ' . ((1 == $this->activePage) ? 'class="disabled"' : '') . '><a href="show/page/1"><span>&laquo;</span></a></li>' . PHP_EOL;
                    for ($i = 1; $i <= $this->pages; $i++) {
                        $class = '';
                        if ($i == $this->activePage) {
                            $class = 'class="active"';
                        }
                        echo '<li ' . $class . '><a href="/show/page/' . $i . '">' . $i . '</a></li>';
                    }
                    echo '<li ' . (($this->pages == $this->activePage) ? 'class="disabled"' : '') . '><a href="show/page/' . $this->pages . '"><span>&raquo;</span></a></li>' . PHP_EOL;
                }
                ?>
            </ul>
        </div>
        <?php
    }
    ?>
</div>
<!-- / List container -->