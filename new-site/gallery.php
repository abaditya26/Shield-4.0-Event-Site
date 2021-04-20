<?php include "./header.php"; ?>

<?php
$imageData = [
    [
        "./images/background.png",
        "Shield BAckground"
    ],
    [
        "./images/gallery/1.jpg",
        "Shield BAckground"
    ],
    [
        "./images/gallery/2.jpg",
        "Shield BAckground"
    ],
    [
        "./images/gallery/3.jpg",
        "Shield BAckground"
    ],
    [
        "./images/gallery/4.jpg",
        "Shield BAckground"
    ],
    [
        "./images/gallery/5.jpg",
        "Shield BAckground"
    ],
    [
        "./images/gallery/6.jpg",
        "Shield BAckground"
    ],
    [
        "./images/gallery/7.jpg",
        "Shield BAckground"
    ],
    [
        "./images/gallery/8.jpg",
        "Shield BAckground"
    ],
    [
        "./images/gallery/9.jpg",
        "Shield BAckground"
    ],
    [
        "./images/gallery/10.jpg",
        "Shield BAckground"
    ],
    [
        "./images/gallery/11.jpg",
        "Shield BAckground"
    ],
    [
        "./images/gallery/12.jpg",
        "Shield BAckground"
    ],
    [
        "./images/gallery/13.jpg",
        "Shield BAckground"
    ],
    [
        "./images/gallery/14.jpg",
        "Shield BAckground"
    ],
    [
        "./images/gallery/15.jpg",
        "Shield BAckground"
    ],
    [
        "./images/gallery/16.jpg",
        "Shield BAckground"
    ],
    [
        "./images/gallery/17.jpg",
        "Shield BAckground"
    ],
    [
        "./images/gallery/18.jpg",
        "Shield BAckground"
    ],
    [
        "./images/gallery/19.jpg",
        "Shield BAckground"
    ],
    [
        "./images/gallery/20.jpg",
        "Shield BAckground"
    ],
    [
        "./images/gallery/21.jpg",
        "Shield BAckground"
    ],
    
]
?>

<!-- content goes here -->
<div class="container">
    <div class="row">

        <?php for ($i = 0; $i < sizeof($imageData); $i++) {
        ?>
            <div class="col-md-4">
                <center>
                    <img src="<?php echo $imageData[$i][0]; ?>" alt="<?php echo $imageData[$i][1]; ?>" style="max-width: 100%; max-height: 250px; border: ridge; margin:10px;">
                </center>
            </div>
        <?php
        } ?>
    </div>
</div>

<?php include "./footer.php"; ?>