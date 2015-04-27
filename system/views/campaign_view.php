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
        <li class="active"><a href="<?php echo conf::BASE_URL ?>campaign/">Campaigns <span class="sr-only">(current)</span></a></li>
        <li><a href="<?php echo conf::BASE_URL ?>banner/">Banners</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo conf::BASE_URL ?>exit">Exit</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container main-container">
    <div role="tabpanel">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation"<?php if (!isset($data['error']['open'])||$data['error']['open']==='list') {echo ' class="active"';} ?>>
                <a href="#list" aria-controls="list" role="tab" data-toggle="tab">Campaigns list</a>
            </li>
            <li role="presentation"<?php if (isset($data['error']['open'])&&$data['error']['open']==='new') {echo ' class="active"';} ?>>
                <a href="#new" aria-controls="new" role="tab" data-toggle="tab">New campaign</a>
            </li>
            <li role="presentation"<?php if (isset($data['error']['open'])&&$data['error']['open']==='condition-list') {echo ' class="active"';} ?>>
                <a href="#condition-list" aria-controls="condition-list" role="tab" data-toggle="tab">Conditions list</a>
            </li>
            <li role="presentation"<?php if (isset($data['error']['open'])&&$data['error']['open']==='condition-new') {echo ' class="active"';} ?>>
                <a href="#condition-new" aria-controls="condition-new" role="tab" data-toggle="tab">New condition</a>
            </li>
            
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane<?php if (!isset($data['error']['open'])||$data['error']['open']==='list') {echo ' active';} ?>" id="list">
            <?php 
                if (isset($data['error'])&&$data['error']['open']==='list')
                {
                    foreach ($data['error']['msg'] as $error) 
                    {
                        echo "\t\t\t\t<p class=\"text-danger\">$error</p>\r\n";
                    }
                }
           
                if (isset($data['campaigns']))
                {
                    if (count($data['campaigns'])>0)
                    {
                        echo "\t\t\t\t<table class=\"table\">\r\n";
                        echo "\t\t\t\t<thead>\r\n"
                            . "\t\t\t\t\t<tr>\r\n"
                            . "\t\t\t\t\t\t<th>id</th>\r\n"
                            . "\t\t\t\t\t\t<th>name</th>\r\n"
                            . "\t\t\t\t\t\t<th>banners</th>\r\n"
                            . "\t\t\t\t\t\t<th>operations</th>\r\n"
                            . "\t\t\t\t\t</tr>\r\n"
                            . "\t\t\t\t</thead>\r\n"
                            . "\t\t\t\t<tbody>\r\n";
                        foreach ($data['campaigns'] as $campaign)
                        {
                            echo "\t\t\t\t\t<tr>\r\n"
                            . "\t\t\t\t\t\t<td>".$campaign[0]."</td>\r\n";  
                            echo "\t\t\t\t\t\t<td>".$campaign[1]."</td>\r\n";
                            if ($campaign[2]===null)
                            {
                                $campaign[2]=0;
                            }
                            $campaign[2].=' (<a href="campaign/add_banners">add more</a>)';
                            echo "\t\t\t\t\t\t<td>".$campaign[2]."</td>\r\n"
                            . "\t\t\t\t\t\t<td>\r\n"
                            . "\t\t\t\t\t\t\t\t<form action='".conf::BASE_URL."campaign/edit' class='inline' method='POST'>\r\n"
                            . "\t\t\t\t\t\t\t\t<button type=\"submit\" name='ation' value='edit' class=\"btn btn-default\">\r\n"
                            . "\t\t\t\t\t\t\t\t\t<span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span>\r\n"
                            . "\t\t\t\t\t\t\t\t</button><input type='hidden' name='campaign-id' value='$campaign[0]'/></form>\r\n"
                            . "\t\t\t\t\t\t\t\t<form action='".conf::BASE_URL."campaign/delete' class='inline' method='POST' onsubmit=\"return confirm('Do you really want to delete this campaign?');\">"
                            . "<button type=\"submit\" name='ation' value='delete' class=\"btn btn-default\">\r\n"
                            . "\t\t\t\t\t\t\t\t\t<span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span>\r\n"
                            . "\t\t\t\t\t\t\t\t</button>\r\n"
                            . "\t\t\t\t\t\t\t\t<input type='hidden' name='campaign-id' value='$campaign[0]'/>"     
                            . "\t\t\t\t\t\t\t\t</form>\r\n" 
                            . "\t\t\t\t\t</tr>\r\n";
                        }
                        echo  "\t\t\t\t</tbody>\r\n"
                        . "\t\t\t\t</table>\r\n";
                    }
                    else
                    {
                        echo "\r\n\t\t\t\t<br/>\r\n\t\t\t\t<p>No campaigns in database.</p>\r\n";
                    }
                }
            ?>
            </div>
            <div role="tabpanel" class="tab-pane<?php if (isset($data['error']['open'])&&$data['error']['open']==='new') {echo ' active';} ?>" id="new">
                <h3>Add new campaign</h2>
                <?php 
                if (isset($data['error'])&&$data['error']['open']==='new')
                {
                    foreach ($data['error']['msg'] as $error) 
                    {
                        echo "\t\t\t\t<p class=\"text-danger\">$error</p>\r\n";
                    }
                }
                ?>
                 <form action="<?php echo conf::BASE_URL ?>campaign/add_new" method="POST">
                    <div class="form-group">
                        <label for="new-campaign-name">Campaign name</label>
                        <input type="text" class="form-control" id="new-campaign-name" name="new-campaign-name" placeholder="Enter name" required>
                    </div>
                    <button type="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        Add new campaign
                    </button>
                </form>
            </div>
            <div role="tabpanel" class="tab-pane<?php if (isset($data['error']['open'])&&$data['error']['open']==='condition-list') {echo ' active';} ?>" id="condition-list">
                
            </div>
            <div role="tabpanel" class="tab-pane<?php if (isset($data['error']['open'])&&$data['error']['open']==='condition-new') {echo ' active';} ?>" id="condition-new">
                
            </div>
            
        </div>

    </div>
</div>