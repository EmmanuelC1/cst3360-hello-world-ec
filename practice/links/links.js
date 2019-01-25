
// $('#image1').click(function(){
//         $("#dialog").dialog();
//     });   
//     $(function ()
// {
//     $('#my-image').on('click', function ()
//     {
//         $(this).width(1000);
//     });
// });

// var $img = $('img'); // finds all image tags

// $img.click(function resize(e) { // bind click event to all images
//   $img.css({ // resize the image
//      height: '300px',
//      width: '300px'
//   });
// });


document.getElementById("img").addEventListener("click", myFunction);

function myFunction() {
   document.getElementById("img").style.width = "300px";
}