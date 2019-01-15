<?php
Yii::app()->clientScript->registerScript('r-buttons','
    $(function(){
        $(".r-buttons a.n-dev").click(function(e){
        //alert("wdwd");
            e.preventDefault();
            $(this).parent().parent().parent().siblings("input").val("Не визначено");
            //$(this).css("background-color", "green");
        });
        $(".r-buttons a.o-dev").click(function(e){
            e.preventDefault();
            $(this).parent().parent().parent().siblings("input").val("Відсутня");
        });
    });
',CClientScript::POS_HEAD);

Yii::app()->clientScript->registerCss('r-buttons','
    div.r-buttons{
        display: inline-block;
        height: 25px;
        width: 125px;
    }
    div.r-buttons ul{
        list-style-type: none;
        margin:5px 0 0 0;
    }
    div.r-buttons ul li a{
        display:block;
        height:25px;
        width:25px;
        float:left;
        margin:0 5px;
    }
    div.r-buttons ul li a.n-dev{
        border: 1px solid #2C2C2C;
	    font-size: 10px;
        height: 3em;
        position: relative;
        width: 3em;
	    background: #2C2C2C;
	    border-radius: 0.2em;
	    border-radius: 5px;
    }

    div.r-buttons ul li a.n-dev:before{
        background: #eee;
        border-radius: 50%;
        -webkit-box-shadow:  1em 0 0 #eee, -1em 0 0 #eee;
        box-shadow: 1em 0 0 #eee, -1em 0 0 #eee;
        content: "";
        height: 0.8em;
        left: 1.1em;
        position: absolute;
        top: 1.1em;
        width: 0.8em;
    }

    div.r-buttons ul li a.o-dev{
        position:relative;
        width:0.3em;
        height:1.5em;
        background: #2C2C2C;
        -webkit-transform: rotate(45deg);
        -moz-transform: rotate(45deg);
        -o-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
        font-size: 22px;
        margin: 0 20px;
        border-radius: 5px;
    }

    div.r-buttons ul li a.o-dev:after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width:0.3em;
        height:1.5em;
        background: #2C2C2C;
        -webkit-transform: rotate(-90deg);
        -moz-transform: rotate(-90deg);
        -o-transform: rotate(-90deg);
        -ms-transform: rotate(-90deg);
        transform: rotate(-90deg);
        border-radius: 5px;
    }

');
?>
<?php echo $content; ?>
<div class="r-buttons">
    <ul>
        <li><a href="#" class="n-dev" title="Не визначено"></a></li>
        <li><a href="#" class="o-dev" title="Відсутня"></a></li>
    </ul>
</div>
