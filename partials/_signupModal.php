<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signupModalLabel">Signup for a V-Thread Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>


<!-- SIGNIN FORM -->
      <div class="modal-body">
        <form action="/forum/partials/_handlesignup.php" method="POST">
             <div class="mb-3">
                 <label for="SignupUsername" class="form-label">Username</label>
                 <input type="text" class="form-control" id="SignupUsername" name="SignupUsername" aria-describedby="emailHelp" required>
             </div>
             <div class="mb-3">
                 <label for="signupFullname" class="form-label">Full Name</label>
                 <input type="text" class="form-control" id="signupFullname" name="signupFullname" aria-describedby="emailHelp" required>
             </div>
             <div class="mb-3">
                 <label for="SignupEmail" class="form-label">Email address</label>
                 <input type="email" class="form-control" id="SignupEmail" name="SignupEmail" aria-describedby="emailHelp" required>
             </div>
             <div class="mb-3">
                 <label for="SignupPassword" class="form-label">Password</label>
                 <input type="password" class="form-control" id="SignupPassword" name="SignupPassword" required>
             </div>
             <div class="mb-3">
                 <label for="SignupCpassword" class="form-label">Confirm Password</label>
                 <input type="password" class="form-control" id="SignupCpassword" name="SignupCpassword" required>
                 <div id="emailHelp" class="form-text">Make sure to enter the same password</div>
             </div>
                 <button type="submit" class="btn btn-primary">Sign-Up</button>
        </form>
      </div>


    </div>
  </div>
</div>