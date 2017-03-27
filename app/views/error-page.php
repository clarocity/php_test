<div class="alert alert-danger">
    <h3><p class="text-center">
            <?php
                echo $this->message;
            ?>
        </p>
    </h3>
</div>
<code>
    <?php 
        echo ((isset($this->exception))?$this->exception->getTrace():'');
    ?>
</code>