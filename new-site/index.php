<?php include 'ip.php'; ?>

<?php include "./header.php"; ?>


<style>
    .title {
        background-image: url("./images/shield_logo_bg_only.png");
        /* Used if the image is unavailable */
        background-position: center;
        /* Center the image */
        background-repeat: no-repeat;
        /* Do not repeat the image */
        background-size: 400px;
        /* Resize the background image to cover the entire container */
        color: #FFFFFF;
        min-height: 400px;
    }
</style>


<!-- main code here -->
<section id="home">

    <center>

        <h1 class="font-styled-header">
            COMPUTER DEPARTMENT PRESENTS
        </h1>
        <div class="title"><br><br><br><br><br>
            <h1>
                <!-- <img src="./images/shield_logo.png" alt="Shield Image Logo here" style="max-width: 200px; max-height: 200px;"><br> TODO:replace with shield new image -->
                <img src="./images/shield_title.png" alt="Shield" style="max-width: 300px;">
                <br>
                4.0
            </h1>
            <h5>
                VISION&nbsp; TO&nbsp; REALITY
            </h5>
            <br>
            <h5>
                [Date to be announced]
            </h5>
        </div>

        <!-- <h3 class="font-styled-header">
            SPONSORED BY
        </h3>
        <div class="container" id="sponsors">
        </div> -->
    </center>

</section>

<hr class="hr" style="border-color: #FFFFFF; max-width:90%;">
<br><br>
<section id="events">

    <?php
    $imageData =
        [

            ["./images/events/1.jpg", "The Game is totally dependent on your ability to search things on internet."],
            ["./images/events/1.jpg", "The Project Presentation is totally based on knowledge and creativity of all participants."],
            ["./images/events/1.jpg", "Shield Gallery 3"],
            ["./images/events/1.jpg", "Shield Gallery 4"],
            ["./images/events/1.jpg", "Shield Gallery 5"],
            ["./images/events/1.jpg", "Shield Gallery 6"],
            ["./images/events/1.jpg", "Shield Gallery 7"],

        ]
    ?>

    <style>
        .event-container {
            border: ridge;
            border-radius: 10px;
        }

        @media (min-width: 1600px) {
            .container {
                max-width: 1500px;
            }
        }

        .event-container:hover {
            opacity: 0.3;
        }
    </style>
    <!-- content goes here -->
    <div class="container">

        <div class="row">

            <?php for ($i = 0; $i < sizeof($imageData); $i++) {
            ?>
                <div class="col-md-4" style="min-height: 400px; padding: 10px;">

                    <center>

                        <div class="event-container">
                            <div class="main">
                                <img loading="lazy" src="<?php echo $imageData[$i][0]; ?>" alt="<?php echo $imageData[$i][1]; ?>" onclick="openImage('<?php echo $imageData[$i][0]; ?>')" style="width:auto;max-width: 90%; max-height: 250px; border: ridge; margin:10px;">
                                <!-- <h5 class="font-styled-header">
                                    <?php echo $imageData[$i][1]; ?>
                                </h5> -->
                            </div>
                            <div class="middle">
                                <div class="btn btn-danger"><?php echo $imageData[$i][1]; ?></div>
                            </div>

                        </div>


                    </center>
                </div>

            <?php
            } ?>
        </div>
    </div>

</section>

<?php include "./footer.php"; ?>

<script>
    function openImage(path) {
        document.location = '' + path;
    }
</script>