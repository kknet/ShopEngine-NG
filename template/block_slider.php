<?php $array = GetSliderSettings(); ?>
    <div id="center_slider" pause="<?php echo $array["speed"]?>" style="width:<?php echo $array["width"]?>px;height:<?php echo $array["height"]?>px">
        <div id="wrapper">
            <div class="slider-wrapper theme-default">
                <div id="slider" class="nivoSlider" style="height:<?php echo $array["height"]?>px !important;">
                    <?php GetSlider(); ?>
                </div>
            </div>
        </div>
    <script type="text/javascript" src="/plugins/nivo-slider3.0.1/js/jquery.nivo.slider.js"></script>
    <script type="text/javascript">
        $(window).load(function() {
            var pause = $("#center_slider").attr("pause");
            $("#slider").nivoSlider({
            effect:"random",
            pauseTime:pause
            });
        });
    </script>
</div>