<?php include "./header.php"; ?>

<?php
$imageData = [
    [
        "./images/background.png",
        "Shield BAckground"
    ],
    [
        "./images/gpj_logo.png",
        "GPJ Logo"
    ],
    [
        "./images/shield_logo.png",
        "Shield Logo"
    ],
    [
        "./images/shield_title.png",
        "Shield Title"
    ]
]
?>

<!-- content goes here -->
<div class="container">
    <div class="row">

        <?php for ($i = 0; $i < sizeof($imageData); $i++) {
        ?>
            <div class="col-md-4">
                <center>
                    <img src="<?php echo $imageData[$i][0]; ?>" alt="<?php echo $imageData[$i][1]; ?>" style="max-width: 100%; max-height: 300px;">
                </center>
            </div>
        <?php
        } ?>
    </div>
</div>

<?php include "./footer.php"; ?>