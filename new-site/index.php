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


<section id="home" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500">

    <center>

        <h1 class="font-styled-header">
            <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" fill="currentColor" class="bi bi-laptop" viewBox="0 0 16 16">
  <path d="M13.5 3a.5.5 0 0 1 .5.5V11H2V3.5a.5.5 0 0 1 .5-.5h11zm-11-1A1.5 1.5 0 0 0 1 3.5V12h14V3.5A1.5 1.5 0 0 0 13.5 2h-11zM0 12.5h16a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5z"/>
</svg> COMPUTER DEPARTMENT PRESENTS
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

<section id="events" data-aos="fade-down">
    <center>
        <h3 class="font-styled-header">
            EVENTS
        </h3>
    </center>

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
            transform: scale(1.1);
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
        .image-event{
            width:auto;
            max-width: 90%; 
            height: 180px; 
            object-fit: cover;
            object-position: center; 
            margin:10px;
        }
    </style>
    <!-- content goes here -->
    <div class="container">

        <div class="row">

            <?php for ($i = 0; $i < sizeof($eventData); $i++) {
            ?>
                <div class="col-md-4" style="padding: 10px;">

                    <center>

                        <div class="event-container" data-aos="zoom-in" onclick="openPage('<?php echo $eventData[$i][0]; ?>')">
                            <div class="main">
                                <img loading="lazy" src="<?php echo $eventData[$i][2]; ?>" alt="<?php echo $eventData[$i][1]; ?>" class="image-event">
                                 <h5 class="font-styled-header">
                                    <?php echo $eventData[$i][1]; ?>
                                </h5> 
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

<footer class="" style="background-color: rgba(255,255,255,0.1);">
        <div class="container">
          <span class="">
            <center>
                
                <div class="row" >
                    <div class="col-md-6">
                        <div style="text-align: left; margin-left: 15%;" class="font-styled-header"><br>
                            <h5>
                                <b>
                                    Government Polytechnic, Jalgaon<br>
                                </b>
                            </h5>
                            शासकीय तंत्रनिकेतन, जळगांव
                            <p>
                                NH6, Jalgaon-425002, Maharashtra
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="font-styled-header">
                            Site Developed By:-
                        </h5>
                        <div style="display: block;align-content: space-evenly;" class="font-styled-header">
                            Aditya Bodhankar<br>
                            Kalpak Nemade&nbsp;&nbsp;&nbsp;<br>
                            Vishal Chaudhari<br>
                            Mahesh Pimparkar<br>
                        </div>
                    </div>
                </div>
            <br>
            
            </center>
          </span>
        </div>
      </footer>
<?php include "./footer.php"; ?>
<script src="./JS/scroll.js"></script>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>

<script>
    function openPage(path) {
        document.location = './events.php?id=' +path;
    }
</script>