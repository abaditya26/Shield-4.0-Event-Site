<?php include "./header.php"; ?>

<?php
$imageData = [
    ["./images/background.png", "Shield Background"],
    ["./images/gallery/banner.jpeg", "Shield 4.0 banner"],
    ["./images/gallery/s21_1.jpeg", "Shield 4.0 1"],
    ["./images/gallery/s21_2.jpeg", "Shield 4.0 2"],
    ["./images/gallery/s21_3.jpeg", "Shield 4.0 3"],
    ["./images/gallery/s21_4.jpeg", "Shield 4.0 4"],
    ["./images/gallery/s21_5.jpeg", "Shield 4.0 5"],
    ["./images/gallery/s21_6.jpeg", "Shield 4.0 6"],
    ["./images/gallery/s21_7.jpeg", "Shield 4.0 7"],
    ["./images/gallery/s21_8.jpeg", "Shield 4.0 8"],
    ["./images/gallery/s21_9.jpeg", "Shield 4.0 9"],
    ["./images/gallery/s21_10.jpeg", "Shield 4.0 10"],
]
?>

<style>
    .col-hover:hover {
        cursor: pointer;
        transform: scale(1.1);
    }

    .col-hover {
        transition: .5s ease;
    }

    .item-hover:hover {
        cursor: pointer;
    }
</style>

<!-- content goes here -->
        <center>
            <h3 class="font-styled-header">
                Shield 4.0 Gallery
            </h3>
        </center><br>
<div class="container">
    <div>
        <div id="carousel" class="carousel slide" data-ride="carousel" style="background: rgba(255, 255, 255, 0.1); border-radius:20px;">
            <ol class="carousel-indicators">
                <?php for ($i = 0; $i < sizeof($imageData) && $i < 5; $i++) { ?>
                    <li data-target="#carousel" data-slide-to="<?php echo $i; ?>" <?php if ($i == 0) {
                                                                                        echo 'class="active"';
                                                                                    } ?>></li>
                <?php } ?>
            </ol>
            <div class="carousel-inner">
                <?php for ($i = 0; $i < sizeof($imageData) && $i < 5; $i++) { ?>
                    <div class="carousel-item <?php if ($i == 0) {
                                                    echo "active";
                                                } ?>">
                        <img src="<?php echo $imageData[$i][0]; ?>" class="d-block w-100 item-hover" alt="<?php echo $imageData[$i][1]; ?>" onclick="openImage('<?php echo $imageData[$i][0]; ?>')" style="max-height: 500px; object-fit: scale-down;object-position: center;">
                    </div>
                <?php } ?>
            </div>
            <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <hr>


    </div>
    <div class="row">

        <?php for ($i = 0; $i < sizeof($imageData); $i++) {
        ?>
            <div class="col-md-4 col-hover" style="height: 400px;" data-aos="flip-left" data-aos-duration="2000">
                <center>
                    <img loading="lazy" src="<?php echo $imageData[$i][0]; ?>" alt="<?php echo $imageData[$i][1]; ?>" onclick="openImage('<?php echo $imageData[$i][0]; ?>')" style="width:auto;max-width: 100%; height: 250px; border: ridge; margin:10px; object-fit: scale-down; object-position: center; background: rgba(255, 255, 255, 0.05);">
                </center>
            </div>
        <?php
        } ?>
    </div>
    <center>
        <a href="./gallery20.php" class="btn btn-outline-success">Shield 3.0 Galllery</a>
    </center>
    <br><br>
</div>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>

<script>
    function openImage(path) {
        document.location = '' + path;
    }
</script>
<?php include "./footer.php"; ?>