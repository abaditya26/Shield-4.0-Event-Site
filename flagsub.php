<?php include "./header.php"; ?>



<div class="container" style="max-width:600px;" >

<center>

<h2>VIRTUAL TREASURE HUNT</h2>
<p>Select Flag number From DropDown Menu and Submit Code.</p><br>

<select class="form-control" aria-label="Default select example" id="flagno" >

  <option selected>Select FLAG</option>
  <option value="1">FLAG NO 1</option>
  <option value="2">FLAG NO 2</option>
  <option value="3">FLAG NO 3</option>
  <option value="3">FLAG NO 4</option>
  <option value="3">FLAG NO 5</option>
  <option value="3">FLAG NO 6</option>
  <option value="3">FLAG NO 7</option>
  <option value="3">FLAG NO 8</option>
  <option value="3">FLAG NO 9</option>
  <option value="3">FLAG NO 10</option>

</select>
<br>

<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">FLAG CODE</label>
  <input type="text" class="form-control" id="flagcode" placeholder="Enter FLAG CODE">
</div>
<br>


<button type="button" class="btn btn-primary">Submit FLAG</button>

</center>



</div>
 


<?php include "./footer.php"; ?>