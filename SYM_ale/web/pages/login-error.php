<?php 
if (isset($_GET['error'])){
?>
    <div class="alert alert-warning d-flex align-items-center" role="alert">
	    <svg class="bi flex-shrink-0 me-2 icon-warning" role="img" aria-label="Warning:">
        <use xlink:href="#exclamation-triangle-fill"/>
        </svg>
    <div>
            <?php echo $_GET['error']; ?>
        </div>
    </div>
<?php 
}  
?>