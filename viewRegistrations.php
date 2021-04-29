<?php include "./header.php"; ?>

<style>
    tr,
    th,
    td {
        color: white;
    }
</style>

<center>
    <h3>
        Registrations
    </h3>
</center>

<div class="container" id="loading">
    <center>
        <div class="loader"></div>
    </center>
</div>

<div class="container" id="registration">
    <center>
        <p>
            Please take a Screenshot of following Details.
        </p>
    </center>
    <table class="table table-stripped table-hover">
        <tr>
            <th>
                Your Name
            </th>
            <td>
                <span id="name"></span>
            </td>
        </tr>
        <tr>
            <th>
                Your Phone Number
            </th>
            <td>
                <span id="phone"></span>
            </td>
        </tr>
        <tr>
            <th>
                Your Email Address
            </th>
            <td>
                <span id="email"></span>
            </td>
        </tr>
        <tr>
            <th>
                Your College Name
            </th>
            <td>
                <span id="college"></span>
            </td>
        </tr>
        <tr>
            <th>
                Your College City
            </th>
            <td>
                <span id="city"></span>
            </td>
        </tr>
        <tr>
            <th>
                Your Events
            </th>
            <td>
                <span id="events"></span>
            </td>
        </tr>
    </table>

</div>

<script src="./JS/viewRegistrations.js"></script>

<?php include "./footer.php"; ?>