<style>
  body{margin-top:150px;}
  .avatar{
  width:200px;
  height:200px;
  }
  .buttonsubmit{
    margin-top: 20px;
    margin-left: 570px
  }
</style>
<div id="layoutSidenav_content"></div>
<div class="container bootstrap snippets bootdey">
    <h1 class="text-primary">Edit Profile</h1>
	<div class="row mt-4">
      <!-- left column -->
      <div class="col-md-3">
        <div class="text-center">
          <img src="https://bootdey.com/img/Content/avatar/avatar7.png" class="avatar img-circle img-thumbnail" alt="avatar">
          <h6>Upload ur Profile...</h6>
          
          <input type="file" class="form-control">
        </div>
      </div>
      
      <!-- edit form column -->
      <div class="col-md-9 personal-info">
        <!-- <div class="alert alert-info alert-dismissable">
          <a class="panel-close close" data-dismiss="alert">×</a> 
          <i class="fa fa-coffee"></i>
          This is an <strong>.alert</strong>. Use this to show important messages to the user.
        </div> -->
        <h3>Personal info</h3>
        
        <form class="form-horizontal" role="form">
          <div class="form-group">
            <label class="col-lg-3 control-label">Username:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" placeholder="username here" value="">
            </div>
          </div>
          <!-- <div class="form-group">
            <label class="col-lg-3 control-label">Alamat:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" placeholder="alamat here" value="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Contact:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" placeholder="contact here" value="">
            </div>
          </div> -->
          <div class="form-group">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" placeholder="email here" value="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Update password</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" placeholder="new password here" value="">
            </div>
          </div>
          <div class="col-auto buttonsubmit">
					  <a class="btn btn-success " href="?page=dashboard" role="button"><i class=""></i>Submit</a>
					</div>
          <!-- <div class="form-group">
            <label class="col-lg-3 control-label">Time Zone:</label>
            <div class="col-lg-8">
              <div class="ui-select">
                <select id="user_time_zone" class="form-control">
                  <option value="Hawaii">(GMT-10:00) Hawaii</option>
                  <option value="Alaska">(GMT-09:00) Alaska</option>
                  <option value="Pacific Time (US &amp; Canada)">(GMT-08:00) Pacific Time (US &amp; Canada)</option>
                  <option value="Arizona">(GMT-07:00) Arizona</option>
                  <option value="Mountain Time (US &amp; Canada)">(GMT-07:00) Mountain Time (US &amp; Canada)</option>
                  <option value="Central Time (US &amp; Canada)" selected="selected">(GMT-06:00) Central Time (US &amp; Canada)</option>
                  <option value="Eastern Time (US &amp; Canada)">(GMT-05:00) Eastern Time (US &amp; Canada)</option>
                  <option value="Indiana (East)">(GMT-05:00) Indiana (East)</option>
                </select>
              </div>
            </div>
          </div> -->
        </form>
      </div>
  </div>
</div>
</div>
<hr>