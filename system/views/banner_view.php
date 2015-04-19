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
    <div role="tabpanel">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation"<?php if (!isset($data['error']['open'])||$data['error']['open']==='list') {echo ' class="active"';} ?>>
                <a href="#list" aria-controls="list" role="tab" data-toggle="tab">Banners list</a>
            </li>
            <li role="presentation"<?php if (isset($data['error']['open'])&&$data['error']['open']==='new') {echo ' class="active"';} ?>>
                <a href="#new" aria-controls="new" role="tab" data-toggle="tab">New banner</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane<?php if (!isset($data['error']['open'])||$data['error']['open']==='list') {echo ' active';} ?>" id="list">
            <?php
                if (isset($data))
                {
                    if (count($data['banners'])>0)
                    {
                        echo "\t\t\t\t<table class=\"table\">\r\n";
                        echo "\t\t\t\t<thead>\r\n"
                            . "\t\t\t\t\t<tr>\r\n"
                            . "\t\t\t\t\t\t<th>id</th>\r\n"
                            . "\t\t\t\t\t\t<th>campaign id</th>\r\n"
                            . "\t\t\t\t\t\t<th>name</th>\r\n"
                            . "\t\t\t\t\t\t<th>code</th>\r\n"
                            . "\t\t\t\t\t\t<th>moderated</th>\r\n"
                            . "\t\t\t\t\t\t<th>operations</th>\r\n"
                            . "\t\t\t\t\t</tr>\r\n"
                            . "\t\t\t\t</thead>\r\n"
                            . "\t\t\t\t<tbody>\r\n";
                        foreach ($data['banners'] as $banner)
                        {
                            echo "\t\t\t\t\t<tr>\r\n"
                            . "\t\t\t\t\t\t<td>".$banner[0]."</td>\r\n"
                            . "\t\t\t\t\t\t<td>".$banner[1]."</td>\r\n"
                            . "\t\t\t\t\t\t<td>".$banner[2]."</td>\r\n"
                            . "\t\t\t\t\t\t<td>".$banner[3]."</td>\r\n";
                            if ($banner[4]===NULL)
                            {
                                $banner[4]='In progress...';
                            }
                            echo  "\t\t\t\t\t\t<td>".$banner[4]."</td>\r\n"
                            . "\t\t\t\t\t\t<td>\r\n"
                            . "\t\t\t\t\t\t\t\t<form action='".conf::BASE_URL."banner/manage' method='POST'>\r\n"
                            . "\t\t\t\t\t\t\t<div class=\"btn-group\" role=\"group\" aria-label=\"operations\">\r\n"
                            . "\t\t\t\t\t\t\t\t<button type=\"submit\" name='ation' value='edit' class=\"btn btn-default\">\r\n"
                            . "\t\t\t\t\t\t\t\t\t<span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span>\r\n"
                            . "\t\t\t\t\t\t\t\t</button>\r\n"
                            . "\t\t\t\t\t\t\t\t<button type=\"submit\" name='ation' value='delete' class=\"btn btn-default\">\r\n"
                            . "\t\t\t\t\t\t\t\t\t<span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span>\r\n"
                            . "\t\t\t\t\t\t\t\t</button>\r\n"
                            . "\t\t\t\t\t\t\t\t<input type='hidden' name='banner-id' value='$banner[0]'/>"     
                            . "\t\t\t\t\t\t\t</div>\r\n"
                            . "\t\t\t\t\t\t\t\t</form>\r\n" 
                            . "\t\t\t\t\t</tr>\r\n";
                        }
                        echo  "\t\t\t\t</tbody>\r\n"
                        . "\t\t\t\t</table>\r\n";
                    }
                    else
                    {
                        echo "\r\n\t\t\t\t<br/>\r\n\t\t\t\t<p>No banners in database.</p>\r\n";
                    }
                }
            ?>
            </div>
            <div role="tabpanel" class="tab-pane<?php if (isset($data['error']['open'])&&$data['error']['open']==='new') {echo ' active';} ?>" id="new">
                <h3>Add new banner</h2>
                <?php 
                if (isset($data['error']))
                {
                    foreach ($data['error']['msg'] as $error) 
                    {
                        echo "\t\t\t\t<p class=\"text-danger\">$error</p>\r\n";
                    }
                }
                ?>
                 <form action="<?php echo conf::BASE_URL ?>banner/add_new" method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Banner name</label>
                        <input type="text" class="form-control" id="new-banner-name" name="new-banner-name" placeholder="Enter name" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Banner code</label>
                        <textarea class="form-control" id="new-banner-code" name="new-banner-code" placeholder="Enter HTMLcode" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        Add new banner
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>