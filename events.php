<?php
$eventData = [
    [
        "th", "Treasure Hunt", "path to image", "description"
    ]
];
?>
<?php include "./header.php"; ?>
<?php include "./data.php"; ?>

<?php
$eData = [];
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    for ($i = 0; $i < sizeof($eventData); $i++) {
        if ($eventData[$i][0] == $id) {
            $eData = $eventData[$i];
        }
    }
} else {
    echo "<script>alert('invalid navigation');document.location='./#events';</script>";
}
?>

<!-- 
Treasure Hunt511
 -->

<section id="treasure">

    <center>

        <div class="card container" style="width: auto; background: black;">
            <center>

                <img src="<?php echo $eData[2]; ?>" class="card-img-top" style="width:auto;max-width: 80%; border: ridge; margin:2%;">
            </center>
            <div class="card-body" style="padding: 0;">
                <h2 class="card-title font-styled-header">
                    <b><?php echo $eData[1]; ?></b>
                </h2>
                <div class="card-text text-left">
                    &emsp;&emsp;<?php echo $eData[5]; ?>
                </div><br><br>
                <div class="text-left">
                    <?php echo nl2br($eData[6]); ?>
                </div>

                <a href="./registration.php?id=<?php echo $eData[0]; ?>" class="btn btn-success" style=" margin-bottom: 10px; margin-top:10px;">
                    Register
                </a>

                <a href="<?php echo $eData[3]; ?>" class="btn btn-primary" style="margin-left: 10px; margin-bottom: 0px;">
                    Download Instructions(PDF)
                </a>
            </div>

        </div>
    </center>

</section>
<br><br>




<?php include "./footer.php"; ?>