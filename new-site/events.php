<?php include "./header.php"; ?>

<?php
$imageData = 
[

    ["./images/events/1.jpg", "The Game is totally dependent on your ability to search things on internet."],
    ["./images/events/2.jpg", "Shield Gallery 2"],
    ["./images/events/3.jpg", "Shield Gallery 3"],
    ["./images/events/4.jpg", "Shield Gallery 4"],
    ["./images/events/5.jpg", "Shield Gallery 5"],
    ["./images/events/6.jpg", "Shield Gallery 6"],
    ["./images/events/7.jpg", "Shield Gallery 7"],

]
?>

<!-- content goes here -->
<div class="container">

    <div class="row">

        <?php for ($i = 0; $i < sizeof($imageData); $i++) {
        ?>
            <div class="col-md-4" style="height: 400px;">
                <center>
                    <img loading="lazy" src="<?php echo $imageData[$i][0]; ?>" alt="<?php echo $imageData[$i][1]; ?>" onclick="openImage('<?php echo $imageData[$i][0]; ?>')" style="width:auto;max-width: 100%; max-height: 250px; border: ridge; margin:10px;">
                    <h3 class="font-styled-header">
                        <?php echo $imageData[$i][1]; ?>
                    </h3>
                </center>
            </div>
        <?php
        } ?>
    </div>
</div>

<?php include "./footer.php"; ?>


<script>
    function openImage(path) {
        document.location = '' + path;
    }
</script>