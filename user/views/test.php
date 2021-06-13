<?php
    $headerName = "Home";
    include("layout/topbar.php");
    include("layout/sidebar.php");
?>

<style>

.imgAttributes{
    height: max-content !important;
    width: 900px !important;
}

</style>
    <img id = "sliderImage" src = "../public/sliderImage/bilashi.jpg" class = "imgAttributes">
<?php include("layout/footer.php");?>

<script>
    let selector = {
        sliderImage: $("#sliderImage"),
    }
    function ImageSlider()
    {
        let imageSrc = selector.sliderImage.attr("src");
        if(imageSrc === "../public/sliderImage/bilashi.jpg")
            selector.sliderImage.attr("src", "../public/sliderImage/cheledhora.jpg");
        else if(imageSrc === "../public/sliderImage/cheledhora.jpg")
            selector.sliderImage.attr("src", "../public/sliderImage/nokshiKatharMath.jpg");
        else if(imageSrc === "../public/sliderImage/nokshiKatharMath.jpg")
            selector.sliderImage.attr("src", "../public/sliderImage/bilashi.jpg");
        
        selector.sliderImage.fadeIn("slow");
    }

    window.onload = function(){
        setInterval(ImageSlider, 3000);
    }
</script>