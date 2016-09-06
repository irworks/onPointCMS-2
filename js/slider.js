/**
 * Created by irworks on 06.09.16.
 * onPointCMS 2 - Slider
 * This is part of the onPointCMS 2 Software
 *
 * @author Ilja Rozhko <admin@irworks.de>
 * @link https://github.com/irworks/onPointCMS-2
 */

var imageDataArray = [];
var imgArray = [];
var currentImage = 0;

getImageData();

function startUpdater() {
    setInterval(function() {
        slideImage();
    }, 8000);
}

function prepareImagesArray() {
    for (var i = 0; i < imageDataArray.length; i++) {
        imgArray[i] = new Image();
        imgArray[i].source = imageDataArray[i].source;
        imgArray[i].target = imageDataArray[i].target;
    }
}

function getImageData() {

    _GET('/ajax/slides', true, {}, function (data) {
        if(data.success) {
            imageDataArray = JSON.parse(data.response);

            /*
            prepareImagesArray();

            $("#source").attr("src", imgArray[0].source);
            $("#target").attr("href", imgArray[0].target);
            */
            startUpdater();
        }
    });
}

function slideImage() {
    var imagesCount = imageDataArray.length;
    if (currentImage < imagesCount - 1) {
        currentImage++;
    } else {
        currentImage = 0;
    }
    $("#source").fadeOut(function() {
        $(this).load(function() {
            $(this).fadeIn(800);
        });
        $("#target").attr("href", imgArray[currentImage].target);
        $(this).attr("src", imgArray[currentImage].source);
    });
}

