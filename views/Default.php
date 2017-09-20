<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title><?=$this->getSite()->getTitle()?></title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <?=$this->printCss()?>
</head>
<body>
    <div class="flex-center position full-height">
        <div class="content">
            <?=$this->getContentHtml()?>
        </div>
    </div>
    <!--? /*=$this->printJs(); if any */ ?-->
</body>
</html>
