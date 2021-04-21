<?php include 'ip.php'; ?>

<?php include "./header.php"; ?>

<?php include "./data.php"; ?>


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

        .main {

            opacity: 1;
            display: block;
            width: 100%;
            height: auto;
            transition: .5s ease;
            backface-visibility: hidden;
        }

        .event-container:hover .main {
            opacity: 0.3;
        }

        .middle {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }

        .event-container:hover .middle {
            opacity: 1;
        }
    </style>
    <!-- content goes here -->
    <div class="container">

        <div class="row">

            <?php for ($i = 0; $i < sizeof($eventData); $i++) {
            ?>
                <div class="col-md-4" style="padding: 10px;">

                    <center>

                        <div class="event-container" onclick="openPage('<?php echo $eventData[$i][0]; ?>')">
                            <div class="main">
                                <img loading="lazy" src="<?php echo $eventData[$i][2]; ?>" alt="<?php echo $eventData[$i][1]; ?>" style="width:auto;max-width: 90%; max-height: 250px; border: ridge; margin:10px;">
                                <!-- <h5 class="font-styled-header">
                                    <?php echo $eventData[$i][1]; ?>
                                </h5> -->
                            </div>
                            <div class="middle">
                                <div class="btn btn-danger">View Details</div>
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
    function openPage(path) {
        document.location = './event.php?id=' + path;
    }
</script>