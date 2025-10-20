<div class="content">
<div class="container">
<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form action="/config/delete.php" method="post">
<div class="modal-body">
  <h1>
    Are You Sure You Want To Delete ?
  </h1>
  <input type="hidden" value="1" name="id" />
  <input type="hidden" name="delete" />
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Close </button>
  <button type="submit" class="btn btn-danger">Delete User</button>
</div>
</form>
</div>
</div>
</div>
<!-- Add -->
<div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Add Balance</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="addForm">
<div class="modal-body">
  <label for="" class="form-label">Amount</label>
  <br />
  <input type="number" class="form-control" name="amount" required />
  <br />
  <label for="">Description</label>
  <br />
  <input type="text" class="form-control" name="desc" />
  <input type="hidden" value="1" name="id" />
  <input type="hidden" name="add" />
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close </button>
  <button type="submit" class="btn btn-success" id="addBtn"> Add Balance </button>
  <button class="btn btn-success" type="button" id="addBtnLoad" style="display: none">
    <img  src="../Images/load.png.png" alt="" style="width: 15px; height: 15px"/>
    Adding Balance
  </button>
</div>
</form>
</div>
</div>
</div>

<div class="modal fade" id="change" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="passForm">
<div class="modal-body">
  <label for="" class="form-label">New Password</label>
  <br />
  <input type="password" class="form-control" name="password" required/>
  <br />
  <label for="" class="form-label">Confirm Password</label>
  <br />
  <input type="password" class="form-control" name="cpassword" required />
  <input type="hidden" value="1" name="id" />
  <input type="hidden" name="change" />
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">
    Close
  </button>
  <button type="submit" class="btn btn-danger" id="passBtn"> Change Password</button>
  <button class="btn btn-danger" type="button" id="passBtnLoad" style="display: none">
    <img src="../images/1.gif"  alt="" style="width: 15px; height: 15px" />
     Changing
  </button>
</div>
</form>
</div>
</div>
</div>

<div
class="modal fade"
id="set"
tabindex="-1"
aria-labelledby="exampleModalLabel"
aria-hidden="true"
>
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Set Balance</h5>
<button
  type="button"
  class="btn-close"
  data-bs-dismiss="modal"
  aria-label="Close"
></button>
</div>
<form id="setForm">
<div class="modal-body">
  <label for="">Amount</label>
  <br />
  <input type="number" class="form-control" name="amount" value="2287" required />
  <br />
  <label for="">Description</label>
  <br />
  <input type="text" class="form-control" name="desc" />
  <input type="hidden" value="1" name="id" />
  <input type="hidden" name="set" />
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" > Close </button>
  <button type="submit" class="btn btn-success" id="setBtn">Set Balance </button>
  <button class="btn btn-success" type="button"  id="setBtnLoad" style="display: none">
    <img src="../images/1.gif" alt="" style="width: 15px; height: 15px"/> 
      Setting Balance </button>
</div>
</form>
</div>
</div>
</div>
<div class="modal fade" id="deduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Deduct Balance</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="deductForm">
<div class="modal-body">
  <label for="">Amount</label>
  <br />
  <input type="number" class="form-control" name="amount" required />
  <br />
  <label for="">Description</label>
  <br />
  <input type="text" class="form-control" name="desc" />
  <input type="hidden" value="1" name="id" />
  <input type="hidden" name="deduct" />
</div>
<div class="modal-footer">
  <button
    type="button"
    class="btn btn-secondary"
    data-bs-dismiss="modal"
  >
    Close
  </button>
  <button type="submit" class="btn btn-danger" id="deductBtn"> Deduct Balance </button>
  <button class="btn btn-danger" type="button" id="deductBtnLoad" style="display: none">
    <img src="../images/1.gif" alt="" style="width: 15px; height: 15px"/> Deducting Balance </button>
</div>
</form>
</div>
</div>
</div>
<div class="modal fade" id="package" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Set Package</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal aria-label="Close"></button>
</div>
<form id="packageForm">
<div class="modal-body">
  <label for="">Package</label>
  <br />
  <selectclass="form-select" aria-label="Default select example" name="package">
    <option selected disabled>customer</option>
     <option value="Airtel Gifting "> Airtel Gifting   </option>
   </select>
  <br />
  <input type="hidden" value="1" name="id" />
  <input type="hidden" name="ipackage" />
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-warning">Update Package</button>
  <button class="btn btn-warning" type="button" id="packBtnLoad" style="display: none">
    <img src="../images/1.gif"alt="" style="width: 15px; height: 15px" />Setting Packag</button>
</div>
</form>
</div>
</div>
</div>