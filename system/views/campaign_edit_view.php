<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Banners rotation system</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="<?php echo conf::BASE_URL ?>">Home</a></li>
        <li><a href="<?php echo conf::BASE_URL ?>campaign/">Campaigns</a></li>
        <li class="active"><a href="<?php echo conf::BASE_URL ?>banner/">Banners <span class="sr-only">(current)</span></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo conf::BASE_URL ?>exit">Exit</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container main-container">    
    <h3>Edit campaign</h2>
    <form action="<?php echo conf::BASE_URL ?>campaign/save_edit" method="POST">
        <div class="form-group">
            <label for="new-campaign-name">Campaign name</label>
            <input type="text" class="form-control" id="new-campaign-name" name="new-campaign-name" placeholder="Enter name" required value="<?php if (isset($data['campaign'])) {echo $data['campaign'][0];} ?>">
        </div>
        <button type="submit" class="btn btn-default">
            <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
            Save campaign
        </button>
        <input type="hidden" name="campaign-id" value="<?php if (isset($data['campaign'])) {echo $data['campaign'][1];} ?>">
    </form>

</div>