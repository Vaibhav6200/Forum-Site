<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Login to V-Threads</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>


<!-- Login FORM -->
      <div class="modal-body">
        <form action="/forum/partials/_handlelogin.php" method="POST">
             <div class="mb-3">
                 <label for="loginusername" class="form-label">Username</label>
                 <input type="text" class="form-control" id="loginusername" name="loginusername" aria-describedby="emailHelp" required>
             </div>
             <div class="mb-3">
                 <label for="loginemail" class="form-label">Email address</label>
                 <input type="email" class="form-control" id="loginemail" name="loginemail" aria-describedby="emailHelp" required>
             </div>
             <div class="mb-3">
                 <label for="loginpassword" class="form-label">Password</label>
                 <input type="password" class="form-control" id="loginpassword" name="loginpassword" required>
             </div>
                 <button type="submit" class="btn btn-primary">Login</button>
        </form>
      </div>


    </div>
  </div>
</div>