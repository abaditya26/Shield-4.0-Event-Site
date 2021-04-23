<?php 
$eventData = [
    [
        "th","Treasure Hunt","path to image", "description"
    ]
];
?>
<?php include "./header.php"; ?>
<?php include "./data.php"; ?>

<?php
$eData = [];
if(isset($_GET['id'])){
$id = $_GET['id'];
for($i=0;$i<sizeof($eventData);$i++){
    if($eventData[$i][0]==$id){
        $eData = $eventData[$i];
    }
}
}else{
    echo "<script>alert('invalid navigation');document.location='./#events';</script>";
}
?>

<!-- 
Treasure Hunt
 -->

<section id="treasure">

    <center>

    <div class="card" style="width: 48rem; background: black;">
    <img src="<?php echo $eData[2]; ?>" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">
        <?php echo $eData[1]; ?>
        </h5>
        <p class="card-text">
        <?php echo $eData[3]; ?>
        </p>
        <a href="./registration.php?id=<?php echo $eData[0]; ?>" class="btn btn-primary">
            Register
        </a>
    </div>
</div>   
       
    </center>

</section>





<?php include "./footer.php"; ?>




<!-- 

    
<center>
<div class="card" style="width: 48rem; background: black;">
    <img src="./images/events/1.jpg" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">
            Treasure Hunt
        </h5>
        <p class="card-text">
            Some quick example text to build on the card title and make up the bulk of the card's content.
        </p>
        <a href="./registration.php?id=th" class="btn btn-primary">
            Register
        </a>
    </div>
</div>
</center>

 -->