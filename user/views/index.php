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

<div class="row">
    <div class="col-md-12">
        <form id="bookCreateForm" enctype="multipart/form-data">
            <div class="card">
                <div id="headingOne" class="card-header bg-blue1">
                    <!-- <button type="button" data-toggle="collapse" data-target="#Collapse" aria-expanded="true" class="text-left m-0 p-0 btn btn-block" style="box-shadow: none;">
                        <h5 class="m-0 p-0" style="color: #000;">Add Book</h5>
                    </button> -->
                </div>
                <div class="card-body">
                    <img id = "sliderImage" src = "../public/sliderImage/bilashi.jpg" class = "imgAttributes">
                </div>
            </div>
        </form>
    </div>
</div>


    
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
        setInterval(ImageSlider, 2000);
    }
</script>