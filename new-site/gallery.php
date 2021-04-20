<?php include "./header.php"; ?>

<?php
$imageData = [
    ["./images/background.png", "Shield Background"],
    ["./images/gallery/1.jpg", "Shield Gallery 1"],
    ["./images/gallery/2.jpg", "Shield Gallery 2"],
    ["./images/gallery/3.jpg", "Shield Gallery 3"],
    ["./images/gallery/4.jpg", "Shield Gallery 4"],
    ["./images/gallery/5.jpg", "Shield Gallery 5"],
    ["./images/gallery/6.jpg", "Shield Gallery 6"],
    ["./images/gallery/7.jpg", "Shield Gallery 7"],
    ["./images/gallery/8.jpg", "Shield Gallery 8"],
    ["./images/gallery/9.jpg", "Shield Gallery 9"],
    ["./images/gallery/10.jpg", "Shield Gallery 10"],
    ["./images/gallery/11.jpg", "Shield Gallery 11"],
    ["./images/gallery/12.jpg", "Shield Gallery 12"],
    ["./images/gallery/13.jpg", "Shield Gallery 13"],
    ["./images/gallery/14.jpg", "Shield Gallery 14"],
    ["./images/gallery/15.jpg", "Shield Gallery 15"],
    ["./images/gallery/16.jpg", "Shield Gallery 16"],
    ["./images/gallery/17.jpg", "Shield Gallery 17"],
    ["./images/gallery/18.jpg", "Shield Gallery 18"],
    ["./images/gallery/19.jpg", "Shield Gallery 19"],
    ["./images/gallery/20.jpg", "Shield Gallery 20"],
    ["./images/gallery/21.jpg", "Shield Gallery 21"]
]
?>

<!-- content goes here -->
<div class="container">
    <img src="./images/shield_poster.png" alt="Shield Poster" style="max-width: 100%;">
    <div class="row">

        <?php for ($i = 0; $i < sizeof($imageData); $i++) {
        ?>
            <div class="col-md-4" style="height: 400px;">
                <center>
                    <img loading="lazy" src="<?php echo $imageData[$i][0]; ?>" alt="<?php echo $imageData[$i][1]; ?>" onclick="openImage('<?php echo $imageData[$i][0]; ?>')" style="width:auto;max-width: 100%; max-height: 250px; border: ridge; margin:10px;">
                    <h3>
                        <?php echo $imageData[$i][1]; ?>
                    </h3>
                    <!-- <img src="<?php echo $imageData[$i][0]; ?>" alt="<?php echo $imageData[$i][1]; ?>" style="max-width: 100%; max-height: 250px; border: ridge; margin:10px;"> -->
                </center>
            </div>
        <?php
        } ?>
    </div>
</div>

<?php include "./footer.php"; ?>


<script>
    function openImage(path){
        document.location=''+path;
    }
</script>