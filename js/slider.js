/**
 * Created by irworks on 06.09.16.
 * onPointCMS 2 - Slider
 * This is part of the onPointCMS 2 Software
 *
 * @author Ilja Rozhko <admin@irworks.de>
 * @link https://github.com/irworks/onPointCMS-2
 */

var imageDataArray  = [];
var imgArray        = [];
var currentImage    = 0;
var imageDuration   = 8000;

getImageData();

function startUpdater() {
    setInterval(function() {
        slideImage();
    }, imageDuration);
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

            prepareImagesArray();

            if(imgArray.length > 0) {
                _('#source').html.src   = imgArray[0].source;
                _('#target').html.href  = imgArray[0].target;

                startUpdater();
            }
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

    _('#source').fadeOut(0.5, true, function () {
        _('#source').html.src   = imgArray[currentImage].source;
        _('#target').html.href  = imgArray[currentImage].target;

        _('#source').fadeIn(0.5);
    });
}

